<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::latest()->paginate(10);
        return view('items.index', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:items,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'merk'        => 'nullable|string|max:255',
            'jenis'       => 'required|in:alat,bahan',
            'spesifikasi' => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // upload foto (jika ada)
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'item_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/items'), $filename);
            $data['foto'] = $filename;
        }

        Item::create($data);

        return redirect()->route('items.index')
            ->with('success', 'Data barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
