<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\PemakaianBahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemakaianBahanController extends Controller
{
    /**
     * RIWAYAT PEMAKAIAN
     */
    public function index()
    {
        $pemakaians = PemakaianBahan::with('inventory')
            ->latest()
            ->get();

        return view('pemakaian-bahan.index', compact('pemakaians'));
    }

    /**
     * FORM PEMAKAIAN (HASIL REDIRECT DARI SCAN QR)
     */
    public function form(Inventory $inventory)
    {
        // proteksi: pastikan ini BAHAN
        if ($inventory->jenis !== 'BAHAN') {
            abort(404);
        }

        return view('pemakaian-bahan.form', compact('inventory'));
    }

    /**
     * SIMPAN PEMAKAIAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'nama_siswa'   => 'required|string',
            'jumlah'       => 'required|integer|min:1',
        ]);

        $inventory = Inventory::findOrFail($request->inventory_id);

        if ($request->jumlah > $inventory->stok) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi']);
        }

        DB::transaction(function () use ($request, $inventory) {

            PemakaianBahan::create([
                'inventory_id' => $inventory->id,
                'nama_siswa'   => $request->nama_siswa,
                'jumlah'       => $request->jumlah,
            ]);

            $inventory->decrement('stok', $request->jumlah);
        });

        return redirect()
            ->route('pemakaian-bahan.index')
            ->with('success', 'Pemakaian bahan berhasil dicatat');
    }
}
