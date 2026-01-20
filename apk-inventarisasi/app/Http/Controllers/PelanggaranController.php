<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tipe' => 'required|in:TELAT_KEMBALI,KERUSAKAN,HILANG',
            'poin' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);

        // simpan pelanggaran
        Pelanggaran::create([
            'siswa_id' => $siswa->id,
            'tipe' => $request->tipe,
            'poin' => $request->poin,
            'keterangan' => $request->keterangan,
            'tanggal_kejadian' => now(),
            'admin_id' => auth()->id()
        ]);

        // tambah total pelanggaran
        $siswa->increment('total_poin');
        $siswa->refresh();
        $siswa->checkAndAutoBan();

        return back()->with('success', 'Pelanggaran berhasil dicatat');
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