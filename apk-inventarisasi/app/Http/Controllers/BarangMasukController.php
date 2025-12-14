<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    // INDEX — tempat form + riwayat dropdown
    public function index()
    {
        // Riwayat nama bahan
        $riwayatNamaBahan = BarangMasuk::where('jenis_barang', 'bahan')
            ->select('nama_barang')
            ->distinct()
            ->get();

        // Riwayat jenis bahan
        $riwayatJenisBahan = BarangMasuk::where('jenis_barang', 'bahan')
            ->select('satuan')
            ->distinct()
            ->get();

        // Riwayat nama alat
        $riwayatNamaAlat = BarangMasuk::where('jenis_barang', 'alat')
            ->select('nama_barang')
            ->distinct()
            ->get();

        // Riwayat seri alat
        $riwayatSeriAlat = BarangMasuk::where('jenis_barang', 'alat')
            ->select('nomor_dokumen')
            ->distinct()
            ->get();

        // Riwayat sumber
        $riwayatSumber = BarangMasuk::select('sumber')->distinct()->get();

        return view('barang-masuk.index', compact(
            'riwayatNamaBahan',
            'riwayatJenisBahan',
            'riwayatNamaAlat',
            'riwayatSeriAlat',
            'riwayatSumber'
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
