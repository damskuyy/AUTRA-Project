<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    // INDEX — tempat form + riwayat dropdown
    public function index()
    {
        $inventories = Inventory::all();

        $riwayatNamaBahan = BarangMasuk::where('jenis_barang','bahan')
            ->pluck('nama_barang')->unique();

        $riwayatNamaAlat = BarangMasuk::where('jenis_barang','alat')
            ->pluck('nama_barang')->unique();

        $riwayatSeriAlat = BarangMasuk::where('jenis_barang','alat')
            ->pluck('nomor_dokumen')->unique();

        return view('barang-masuk.index', compact(
            'inventories',
            'riwayatNamaBahan',
            'riwayatNamaAlat',
            'riwayatSeriAlat'
        ));
    }


    // STORE BARANG MASUK
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string',
            'jenis_barang' => 'required|in:alat,bahan',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'nullable|string',
            'sumber' => 'required|string',
            'nomor_dokumen' => 'nullable|string',
            'tanggal_masuk' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $validated['admin_id'] = Auth::id();

        BarangMasuk::create($validated);

        return back()->with('success', 'Data barang masuk berhasil disimpan.');
    }
}
