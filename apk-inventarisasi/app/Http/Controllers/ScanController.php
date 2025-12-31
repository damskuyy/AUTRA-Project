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

        if (!$inventory || !$inventory->barangMasuk) {
            return redirect()
                ->route('scan.index')
                ->withErrors('QR tidak valid');
        }

        // gunakan properti jenis pada inventory agar konsisten dengan controller tujuan
        if ($inventory->jenis === 'ALAT') {
            return redirect()->route('peminjaman-form', ['inventory' => $inventory->id]);
        }

        if ($inventory->jenis === 'BAHAN') {
            return redirect()->route('pemakaian-bahan-form', ['inventory' => $inventory->id]);
        }

        return redirect()->route('scan.index');
    }


}
