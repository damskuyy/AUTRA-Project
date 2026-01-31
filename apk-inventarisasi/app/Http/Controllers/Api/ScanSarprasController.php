<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ScanSarprasController extends Controller
{
    public function byKodeBarang($kode)
    {
        $baseUrl = config('services.sarpras.base_url');
        
        $res = Http::timeout(5)->get(
            $baseUrl . "/inventarisasi-kib/by-kode-barang/" . $kode
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
