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
            'kode' => 'required'
        ]);

        $inventory = Inventory::where('kode_qr', $request->kode)->firstOrFail();

        if ($inventory->jenis === 'BAHAN') {
            return redirect()->route('pemakaian.form', $inventory);
        }

        return redirect()->route('peminjaman.form', $inventory);
    }
}
