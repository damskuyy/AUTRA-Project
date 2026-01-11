<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SarprasController extends Controller
{
    public function byKodeBarang($kode)
    {
        $response = Http::get(
            "https://be-sarpras.aryajaka.site/inventarisasi-kib/by-kode-barang/".$kode
        );

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return $response->json();
    }
}
