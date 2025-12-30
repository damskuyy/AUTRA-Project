<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * RIWAYAT PEMINJAMAN
     */
    public function index()
    {
        $peminjamans = Peminjaman::with('inventory')
            ->latest()
            ->get();

        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * FORM PEMINJAMAN (HASIL REDIRECT DARI SCAN QR)
     */
    public function form(Inventory $inventory)
    {
        // proteksi: pastikan ini ALAT
        if ($inventory->jenis !== 'ALAT') {
            abort(404);
        }

        $peminjamanAktif = Peminjaman::where('inventory_id', $inventory->id)
            ->whereNull('tanggal_kembali')
            ->first();

        return view('peminjaman.form', compact('inventory', 'peminjamanAktif'));
    }

    /**
     * SIMPAN PEMINJAMAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'nama_siswa'   => 'required|string',
        ]);

        $inventory = Inventory::findOrFail($request->inventory_id);

        if ($inventory->status !== 'TERSEDIA') {
            return back()->withErrors('Alat sedang dipinjam');
        }

        Peminjaman::create([
            'inventory_id'  => $inventory->id,
            'nama_siswa'    => $request->nama_siswa,
            'tanggal_pinjam'=> now(),
        ]);

        $inventory->update(['status' => 'DIPINJAM']);

        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dicatat');
    }
}
