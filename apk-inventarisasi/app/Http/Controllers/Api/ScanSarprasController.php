<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ScanSarprasController extends Controller
{
    public function byKodeBarang($kode)
    {
        $res = Http::get(
            "https://be-sarpras.aryajaka.site/inventarisasi-kib/by-kode-barang/".$kode
        );

        if (!$res->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $res->json()['data']
        ]);
    }
}
