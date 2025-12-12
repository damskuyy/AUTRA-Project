<?php

namespace App\Http\Controllers;

use App\Models\Inventories;
use App\Models\Item;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class InventoriesController extends Controller
{
    public function index()
    {
        $alat = Inventories::with('item', 'ruangan')->whereNull('stok')->get();
        $bahan = Inventories::with('item', 'ruangan')->whereNotNull('stok')->get();

        return view('be.inventaris.index', compact('alat', 'bahan'));
    }

    public function create()
    {
        $items = Item::all();
        $ruangan = Ruangan::all();

        return view('be.inventaris.create', compact('items', 'ruangan'));
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

        Inventories::create($request->all());

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil ditambahkan.');
    }

    public function show(Inventories $inventaris)
    {
        return view('be.inventaris.show', compact('inventaris'));
    }

    public function edit(Inventories $inventaris)
    {
        $items = Item::all();
        $ruangan = Ruangan::all();

        return view('be.inventaris.edit', compact('inventaris', 'items', 'ruangan'));
    }

    public function update(Request $request, Inventories $inventaris)
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

    public function destroy(Inventories $inventaris)
    {
        $inventaris->delete();

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil dihapus.');
    }
}