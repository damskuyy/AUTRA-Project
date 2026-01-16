<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\PemakaianBahan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemakaianBahanController extends Controller
{
    /**
     * ❌ INDEX TIDAK DIPAKAI UNTUK RIWAYAT
     * (biarin kosong atau hapus routenya)
     */
    public function index()
    {
        abort(404);
    }

    /**
     * FORM PEMAKAIAN BAHAN
     */
    public function form(Inventory $inventory)
    {
        // pastikan ini BAHAN
        if (
            !$inventory->barangMasuk ||
            $inventory->barangMasuk->jenis_barang !== 'bahan'
        ) {
            abort(404);
        }

        $siswas = Siswa::where('is_active', true)
            ->where('is_banned', false)
            ->orderBy('nama')
            ->get();

        return view(
            'form.pemakaian-bahan-form',
            compact('inventory', 'siswas')
        );
    }

    /**
     * SIMPAN PEMAKAIAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'siswa_id'     => 'required|exists:siswas,id',
            'jumlah'       => 'required|integer|min:1',
            'keperluan' => 'nullable|string',
            'keperluan_manual' => 'nullable|string',
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);

        if ($siswa->is_banned) {
            abort(403, 'Siswa sedang dibanned');
        }

        if (!$siswa->is_active) {
            abort(403, 'Siswa tidak aktif');
        }

        $inventory = Inventory::findOrFail($request->inventory_id);

        if ($request->jumlah > $inventory->stok) {
            return back()->withErrors([
                'jumlah' => 'Stok tidak mencukupi'
            ]);
        }

        $keperluan = $request->keperluan === '__manual'
            ? $request->keperluan_manual
            : $request->keperluan;


        DB::transaction(function () use ($request, $inventory, $keperluan) {
            PemakaianBahan::create([
                'inventory_id' => $inventory->id,
                'ruangan_id'   => $inventory->barangMasuk->ruangan_id,
                'siswa_id'     => $request->siswa_id,
                'admin_id'     => auth()->id(),
                'jumlah'       => $request->jumlah,
                'keperluan' => $keperluan,
            ]);

            $inventory->decrement('stok', $request->jumlah);
        });

        // 🔥 BALIK KE RIWAYAT (LOG CONTROLLER)
        return redirect()
            ->route('riwayat-aktivitas.index')
            ->with('success', 'Pemakaian bahan berhasil dicatat');
    }
}
