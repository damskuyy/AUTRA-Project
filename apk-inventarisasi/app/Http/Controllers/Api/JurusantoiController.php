<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use App\Models\Inventory;
use Illuminate\Http\Request;

class JurusantoiController extends Controller
{
    public function index()
    {
        $barangs = BarangMasuk::with(['inventories', 'ruangan'])
            ->where('from_sarpras', true)
            ->get();

        if ($barangs->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => []
            ], 404);
        }

        $data = $barangs->map(function ($barang) {
            $inventory = $barang->inventories->first();

            return [
                'kodeBarang'  => $barang->kode_unik,
                'namaBarang'  => $barang->nama_barang,
                'spesifikasi' => $barang->spesifikasi,
                'merk'        => $barang->merk,
                'ruangan'     => optional($barang->ruangan)->nama_ruangan,
                'status'      => strtolower($inventory->status ?? '-'),
                'kondisi'     => strtolower($inventory->kondisi ?? '-'),
                'foto'        => $barang->foto,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Request successful',
            'data' => $data
        ]);
    }


}
