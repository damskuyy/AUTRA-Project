<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Items;
use App\Models\Inventory;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode; // Pastikan package ini terinstall

class BarangMasukController extends Controller
{
    // INDEX — tempat form + riwayat dropdown
    public function index()
    {
        $inventories = Inventory::all();
        $ruangans = Ruangan::all();

        $riwayatNamaBahan = BarangMasuk::where('jenis_barang','bahan')
            ->pluck('nama_barang')->unique();

        $riwayatNamaAlat = BarangMasuk::where('jenis_barang','alat')
            ->pluck('nama_barang')->unique();

        $riwayatSeriAlat = BarangMasuk::where('jenis_barang','alat')
            ->pluck('nomor_dokumen')->unique();

        return view('barang-masuk.index', compact(
            'inventories',
            'ruangans',
            'riwayatNamaBahan',
            'riwayatNamaAlat',
            'riwayatSeriAlat'
        ));
    }

    // STORE BARANG MASUK (Diperbarui)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string',
            'jenis_barang' => 'required|in:alat,bahan',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'nullable|string',
            'sumber' => 'required|string',
            'nomor_dokumen' => 'nullable|string',
            'ruangan_id' => 'required|exists:ruangans,id',
            'tanggal_masuk' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        // Handle Input Nama/Seri Baru
        if ($request->nama_barang === '__new') {
            $validated['nama_barang'] = $request->nama_barang_new;
        }
        if ($request->nomor_dokumen === '__new') {
            $validated['nomor_dokumen'] = $request->nomor_dokumen_new;
        }

        $validated['admin_id'] = Auth::id();

        BarangMasuk::create($validated);

        return back()->with('success', 'Barang berhasil masuk.');
    }
}