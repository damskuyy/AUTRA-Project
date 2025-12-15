<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    // INDEX
    public function index()
    {
        $barangMasuk = BarangMasuk::with('inventory', 'admin')->latest()->get();
        return view('barang-masuk.index', compact('barangMasuk'));
    }

    // CREATE
    public function create()
    {
        $inventories = Inventory::all();

        return view('barang-masuk.create', compact('inventories'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'nama_barang' => 'required|string',
            'jenis_barang' => 'required|in:alat,bahan',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'nullable|string',
            'sumber' => 'required|in:SARPRAS_PUSAT,PEMBELIAN,HIBAH,PENGADAAN,RETUR',
            'nomor_dokumen' => 'nullable|string',
            'tanggal_masuk' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $request->merge([
            'admin_id' => Auth::id()
        ]);

        BarangMasuk::create($request->all());

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Data Barang Masuk berhasil ditambahkan.');
    }

    // EDIT
    public function edit(BarangMasuk $barangMasuk)
    {
        $inventories = Inventory::all();

        return view('barang-masuk.edit', compact('barangMasuk', 'inventories'));
    }

    // UPDATE
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'nama_barang' => 'required|string',
            'jenis_barang' => 'required|in:alat,bahan',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'nullable|string',
            'sumber' => 'required|in:SARPRAS_PUSAT,PEMBELIAN,HIBAH,PENGADAAN,RETUR',
            'nomor_dokumen' => 'nullable|string',
            'tanggal_masuk' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $barangMasuk->update($request->all());

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Data Barang Masuk berhasil diperbarui.');
    }

    // DELETE
    public function destroy(BarangMasuk $barangMasuk)
    {
        $barangMasuk->delete();

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Data Barang Masuk berhasil dihapus.');
    }
}
