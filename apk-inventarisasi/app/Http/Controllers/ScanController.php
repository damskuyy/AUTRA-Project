<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Str;

class ScanController extends Controller
{
    public function index()
    {
        return view('scan-qr.index');
    }

    public function process(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string'
        ]);

        $qr = strtoupper(trim($request->qr_code));

        // Validasi format QR
        if (!Str::startsWith($qr, ['QR-ALT-', 'QR-BHN-'])) {
            return redirect()
                ->route('scan.index')
                ->withErrors('Format QR tidak valid');
        }

        $inventory = Inventory::with('barangMasuk')
            ->where('kode_qr_jurusan', $qr)
            ->first();

        if (!$inventory) {
            return redirect()
                ->route('scan.index')
                ->withErrors('Inventory tidak ditemukan');
        }

        if (!$inventory->barangMasuk) {
            return redirect()
                ->route('scan.index')
                ->withErrors('Data barang masuk tidak valid');
        }

        $jenis = $inventory->barangMasuk->jenis_barang;

        // 🔁 ARAH SESUAI JENIS
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
