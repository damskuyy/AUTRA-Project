<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\BarangMasuk;
use App\Models\Pelanggaran;
use App\Models\PemakaianBahan;
use Carbon\Carbon;


class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $from = $request->from_date;
        $to   = $request->to_date;
        $siswa = $request->siswa;
        $kelas = $request->kelas;
        $barang = $request->barang;
        $jenis = $request->jenis;

        // ================= BARANG MASUK =================
        $barangMasuks = BarangMasuk::with(['admin', 'ruangan'])
            ->when($from && $to, fn($q) =>
                $q->whereBetween('tanggal_masuk', [$from, $to])
            )
            ->when($barang, fn($q) =>
                $q->where('nama_barang', 'like', "%$barang%")
            )
            ->latest()
            ->get();

        // ================= PEMINJAMAN =================
        $peminjamans = Peminjaman::with(['inventory.barangMasuk', 'siswa', 'admin'])
            ->whereHas('pengembalian') // hanya selesai
            ->when($from && $to, fn($q) =>
                $q->whereBetween('created_at', [$from, $to])
            )
            ->when($siswa, fn($q) =>
                $q->whereHas('siswa', fn($s) =>
                    $s->where('nama', 'like', "%$siswa%")
                )
            )
            ->when($kelas, fn($q) =>
                $q->whereHas('siswa', fn($s) =>
                    $s->where('kelas', $kelas)
                )
            )
            ->when($barang, fn($q) =>
                $q->whereHas('inventory.barangMasuk', fn($b) =>
                    $b->where('nama_barang', 'like', "%$barang%")
                )
            )
            ->latest()
            ->get();

        // ================= PENGEMBALIAN =================
        $pengembalians = Pengembalian::with(['peminjaman.inventory.barangMasuk','peminjaman.siswa','admin'])
            ->when($from && $to, fn($q) =>
                $q->whereBetween('created_at', [$from, $to])
            )
            ->latest()
            ->get();

        // ================= PEMAKAIAN BAHAN (LEBIH DARI 1 HARI) =================
        $pemakaians = PemakaianBahan::with(['inventory.barangMasuk', 'siswa', 'admin'])
        ->when($from && $to, fn($q) =>
            $q->whereBetween('created_at', [$from, $to])
        )
        ->when($siswa, fn($q) =>
            $q->whereHas('siswa', fn($s) =>
                $s->where('nama', 'like', "%$siswa%")
            )
        )
        ->when($kelas, fn($q) =>
            $q->whereHas('siswa', fn($s) =>
                $s->where('kelas', $kelas)
            )
        )
        ->when($barang, fn($q) =>
            $q->whereHas('inventory.barangMasuk', fn($b) =>
                $b->where('nama_barang', 'like', "%$barang%")
            )
        )
        ->latest()
        ->get();

        // ================= PELANGGARAN =================
        $pelanggarans = Pelanggaran::with(['siswa','admin'])
            ->when($from && $to, fn($q) =>
                $q->whereBetween('created_at', [$from, $to])
            )
            ->when($siswa, fn($q) =>
                $q->whereHas('siswa', fn($s) =>
                    $s->where('nama', 'like', "%$siswa%")
                )
            )
            ->when($kelas, fn($q) =>
                $q->whereHas('siswa', fn($s) =>
                    $s->where('kelas', $kelas)
                )
            )
            ->latest()
            ->get();

        // ================= FILTER JENIS =================
        if ($jenis) {
            $barangMasuks = $jenis === 'barang_masuk' ? $barangMasuks : collect();
            $peminjamans  = $jenis === 'peminjaman' ? $peminjamans : collect();
            $pengembalians= $jenis === 'pengembalian' ? $pengembalians : collect();
            $pemakaians    = $jenis === 'pemakaian' ? $pemakaians : collect();
            $pelanggarans = $jenis === 'banned' ? $pelanggarans : collect();
        }

        $kelasList = \App\Models\Siswa::select('kelas')->distinct()->pluck('kelas');

        return view('riwayat-aktivitas.index', compact(
            'barangMasuks',
            'peminjamans',
            'pengembalians',
            'pelanggarans',
            'pemakaians',
            'kelasList'
        ));
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
        //
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
