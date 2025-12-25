<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Items;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InventoriesController extends Controller
{
    public function index()
    {
        $alat = Inventory::with('item', 'ruangan')->whereNull('stok')->get();
        $bahan = Inventory::with('item', 'ruangan')->whereNotNull('stok')->get();

        return view('inventaris.index', compact('alat', 'bahan'));
    }

    public function create()
    {
        $items = Items::all();
        $ruangan = Ruangan::all();

        return view('inventaris.create', compact('items', 'ruangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'status' => 'required|in:TERSEDIA,DIPINJAM,RUSAK,HILANG,DIPERBAIKI',
            'kondisi' => 'required|in:BAIK,RUSAK_RINGAN,RUSAK_BERAT',
            'nomor_inventaris' => 'nullable|unique:inventories,nomor_inventaris',
            'serial_number' => 'nullable',
            'stok' => 'nullable|integer|min:0',
            'kode_qr_jurusan' => 'nullable|unique:inventories,kode_qr_jurusan',
        ]);

        Inventory::create($request->all());

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil ditambahkan.');
    }

    // public function show(Inventory $inventaris)
    // {
    //     return view('inventaris.show', compact('inventaris'));
    // }

    public function edit(Inventory $inventaris)
    {
        $items = Items::all();
        $ruangans = Ruangan::all();

        return view('inventaris.edit', compact('inventaris', 'items', 'ruangan'));
    }

    public function update(Request $request, Inventory $inventaris)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'status' => 'required|in:TERSEDIA,DIPINJAM,RUSAK,HILANG,DIPERBAIKI',
            'kondisi' => 'required|in:BAIK,RUSAK_RINGAN,RUSAK_BERAT',
            'nomor_inventaris' => 'nullable|unique:inventories,nomor_inventaris,' . $inventaris->id,
            'serial_number' => 'nullable',
            'stok' => 'nullable|integer|min:0',
            'kode_qr_jurusan' => 'nullable|unique:inventories,kode_qr_jurusan,' . $inventaris->id,
        ]);

        $inventaris->update($request->all());

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil diperbarui.');
    }

    public function destroy(Inventory $inventaris)
    {
        $inventaris->delete();

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil dihapus.');
    }

    public function generateQr(Inventory $inventaris)
    {
        // Cek jenis barang melalui relasi item
        $prefix = ($inventaris->item->jenis == 'alat') ? 'QR-ALT' : 'QR-BHN';
        
        // Generate kode unik: Prefix - Tahun - RandomString - ID
        $inventaris->kode_qr_jurusan = $prefix . '-' . date('Y') . '-' . strtoupper(Str::random(5)) . '-' . $inventaris->id;
        $inventaris->save();

        return redirect()->route('inventaris.show', $inventaris->id)->with('success', 'QR code berhasil diperbarui.');
    }

    public function show(Inventory $inventaris)
    {
        return view('inventaris.show', compact('inventaris'));
    }
}