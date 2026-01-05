<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class ScanController extends Controller
{
    public function index()
    {
        return view('scan-qr.index');
    }

    public function process(Request $request)
    {
        $request->validate([
            'qr_code' => 'required'
        ]);

        $qr = $request->qr_code;

        $inventory = Inventory::with('barangMasuk')
            ->where('kode_qr_jurusan', $qr)
            ->first();

        // 1️⃣ inventory tidak ditemukan
        if (!$inventory) {
            return redirect()
                ->route('scan.index')
                ->withErrors('Inventory tidak ditemukan');
        }

        // 2️⃣ barang masuk tidak ada
        if (!$inventory->barangMasuk) {
            return redirect()
                ->route('scan.index')
                ->withErrors('Data barang masuk tidak ditemukan');
        }

        // 3️⃣ ambil jenis dari BARANG MASUK
        $jenis = $inventory->barangMasuk->jenis_barang;

        if ($jenis === 'alat') {
            return redirect()->route(
                'form.peminjaman-form',
                ['inventory' => $inventory->id]
            );
        }

        if ($jenis === 'bahan') {
            return redirect()->route(
                'form.pemakaian-bahan-form',
                ['inventory' => $inventory->id]
            );
        }

        return redirect()->route('scan.index');
    }



}
