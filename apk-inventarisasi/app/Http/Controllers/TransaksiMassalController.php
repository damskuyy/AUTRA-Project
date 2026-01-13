<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\BarangMasuk;
use App\Models\TransaksiMassal; // nanti kita bikin model
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class TransaksiMassalController extends Controller
{
    public function index()
    {
        // Riwayat transaksi aktif (belum dikembalikan)
        $transaksis = TransaksiMassal::with('inventaris', 'siswa')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transaksi-massal.index', compact('transaksis'));
    }

    public function create()
    {
        // Ambil inventaris yang tersedia & kondisi baik
        $inventarisAlat = Inventory::whereHas('barangMasuk', fn($q) => $q->where('jenis_barang', 'alat'))
            ->where('status', 'TERSEDIA')
            ->where('kondisi', 'BAIK')
            ->get();

        $inventarisBahan = Inventory::whereHas('barangMasuk', fn($q) => $q->where('jenis_barang', 'bahan'))
            ->where('status', 'TERSEDIA')
            ->where('kondisi', 'BAIK')
            ->get();

        $siswas = Siswa::all();

        return view('transaksi-massal.create', compact('inventarisAlat', 'inventarisBahan', 'siswas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa' => 'required|string',
            'inventaris_ids' => 'required|array',
            'jam_kembali' => 'required|date_format:H:i',
            'catatan' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated) {
            $transaksi = TransaksiMassal::create([
                'siswa' => $validated['siswa'],
                'jam_transaksi' => now(),
                'jam_kembali' => $validated['jam_kembali'],
                'catatan' => $validated['catatan'] ?? null,
            ]);

            // Attach inventaris
            foreach ($validated['inventaris_ids'] as $id) {
                $inventory = Inventory::find($id);
                $inventory->update(['status' => 'DIPINJAM']); // ubah status jadi dipinjam
                $transaksi->inventaris()->attach($inventory->id);
            }
        });

        return redirect()->route('transaksi.massal.index')->with('success', 'Transaksi massal berhasil dibuat.');
    }

    public function kembalikan(TransaksiMassal $transaksi)
    {
        DB::transaction(function () use ($transaksi) {
            foreach ($transaksi->inventaris as $inventory) {
                $inventory->update(['status' => 'TERSEDIA']);
            }
            $transaksi->update(['dikembalikan' => true]);
        });

        return back()->with('success', 'Semua inventaris berhasil dikembalikan.');
    }
}
