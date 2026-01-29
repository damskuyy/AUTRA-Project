<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SarprasController extends Controller
{
    /**
     * PROSES SCAN QR SARPRAS
     * Ambil data dari API & simpan ke session
     */
    public function scan(Request $request)
    {
        $request->validate(['qr_code' => 'required']);

        $raw = trim($request->qr_code);
        $kode = null;

        //Kalau QR berupa URL
        if (filter_var($raw, FILTER_VALIDATE_URL)) {

            // Ambil query (?kodeunik=xxx)
            parse_str(parse_url($raw, PHP_URL_QUERY), $q);

            if (isset($q['kodeunik'])) {
                $kode = $q['kodeunik'];
            } else {
                // Ambil dari path (…/1.01.000024 atau …/1.01.000024.png)
                $path = basename(parse_url($raw, PHP_URL_PATH));
                $kode = str_replace('.png', '', $path);
            }

        } else {
            // 2️⃣ Kalau QR cuma teks: 1.01.000024
            $kode = $raw;
        }

        if (!$kode) {
            return back()->with('error', 'QR Sarpras tidak valid');
        }

        // 🔗 Call API lokal
        $apiUrl = config('app.url') . "/api/sarpras/by-kode-barang/$kode";

        $res = Http::timeout(5)->get($apiUrl);

        if (!$res->successful() || empty($res->json('data'))) {
            return back()->with('error', 'Data Sarpras tidak ditemukan');
        }

        session(['sarpras' => $res->json('data')]);

        return back()->with('success', 'Data Sarpras berhasil diambil');
    }


    /**
     * 2️⃣ SIMPAN BARANG SARPRAS KE DATABASE LOKAL
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_unik'      => 'required|unique:barang_masuks,kode_unik',
            'nama_barang'   => 'required',
            'merk'          => 'nullable',
            'ruangan_id'    => 'required',
            //'penempatan_rak'=> 'required',
        ]);

        BarangMasuk::create([
            'nama_barang'    => $request->nama_barang,
            'jenis_barang'   => 'alat',
            'merk'           => $request->merk,
            'spesifikasi'    => $request->spesifikasi,
            'jumlah'         => 1,
            'kode_unik'      => $request->kode_unik,
            'foto'           => $request->foto,
            'sumber'         => 'SARPRAS',
            'ruangan_id'     => $request->ruangan_id,
            //'penempatan_rak' => $request->penempatan_rak,
            'tanggal_masuk'  => now(),
            'from_sarpras'   => true,
            'admin_id'       => auth()->id(),
        ]);

        // Bersihkan session supaya tidak double submit
        session()->forget('sarpras');

        return back()->with('success', 'Barang Sarpras berhasil disimpan');
    }
}
