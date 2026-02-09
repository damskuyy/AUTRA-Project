<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\BarangMasuk;
use App\Models\Pelanggaran;
use App\Models\PemakaianBahan;
use App\Models\TransaksiMassal;
use Carbon\Carbon;


class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $from   = $request->from_date;
        $to     = $request->to_date;
        $siswa  = $request->siswa;
        $kelas  = $request->kelas;
        $jenis  = $request->jenis;

        // default kosong
        $barangMasuks  = collect();
        $peminjamans   = collect();
        $pengembalians = collect();
        $pemakaians    = collect();
        $pelanggarans  = collect();
        $transaksiMassals = collect();
        $pengembalianMassal = collect();


        // ================= PENGEMBALIAN MASSAL =================
        if (!$jenis || $jenis === 'pengembalian') {
            $pengembalianMassal = TransaksiMassal::with(['inventaris.barangMasuk', 'siswa', 'admin'])
                ->where('dikembalikan', true)
                ->whereHas('inventaris.barangMasuk', fn ($q) =>
                    $q->where('jenis_barang', 'alat')
                )
                ->when($from && $to, fn ($q) =>
                    $q->whereBetween('updated_at', [$from, $to])
                )
                ->when($siswa, fn ($q) =>
                    $q->whereHas('siswa', fn ($s) =>
                        $s->where('nama', 'like', "%$siswa%")
                    )
                )
                ->when($kelas, fn ($q) =>
                    $q->whereHas('siswa', fn ($s) =>
                        $s->where('kelas', $kelas)
                    )
                )
                ->get();
        }


        // ================= BARANG MASUK =================
        if (!$jenis || $jenis === 'barang_masuk') {
            // Barang masuk hanya tampil jika tidak ada filter siswa atau kelas
            if (!$siswa && !$kelas) {
                $barangMasuks = BarangMasuk::with(['admin', 'ruangan'])
                    ->when($from, fn ($q) =>
                        $q->whereDate('created_at', '>=', $from)
                    )
                    ->when($to, fn ($q) =>
                        $q->whereDate('created_at', '<=', $to)
                    )
                    ->latest()
                    ->get();
            }
        }

        // ================= PEMINJAMAN =================
        if (!$jenis || $jenis === 'peminjaman') {
            $peminjamans = Peminjaman::with(['inventory.barangMasuk', 'siswa', 'admin'])
                ->whereHas('pengembalian')
                ->when($from && $to, fn ($q) =>
                    $q->whereBetween('created_at', [$from, $to])
                )
                ->when($siswa, fn ($q) =>
                    $q->whereHas('siswa', fn ($s) =>
                        $s->where('nama', 'like', "%$siswa%")
                    )
                )
                ->when($kelas, fn ($q) =>
                    $q->whereHas('siswa', fn ($s) =>
                        $s->where('kelas', $kelas)
                    )
                )
                ->latest()
                ->get();
        }

        // ================= PENGEMBALIAN =================
        if (!$jenis || $jenis === 'pengembalian') {

            // === PENGEMBALIAN SATUAN (SCAN QR) ===
            $pengembalians = Pengembalian::with([
                    'peminjaman.inventory.barangMasuk',
                    'peminjaman.siswa',
                    'admin'
                ])
                ->when($from && $to, fn ($q) =>
                    $q->whereBetween('created_at', [$from, $to])
                )
                ->when($siswa, fn ($q) =>
                    $q->whereHas('peminjaman.siswa', fn ($s) =>
                        $s->where('nama', 'like', "%$siswa%")
                    )
                )
                ->when($kelas, fn ($q) =>
                    $q->whereHas('peminjaman.siswa', fn ($s) =>
                        $s->where('kelas', $kelas)
                    )
                )
                ->get();

            // === GABUNG DENGAN PENGEMBALIAN MASSAL ===
            $pengembalians = $pengembalians
                ->concat($pengembalianMassal)
                ->sortByDesc(fn ($item) =>
                    $item->created_at ?? $item->updated_at
                )
                ->values();
        }

        // ================= PEMAKAIAN BAHAN =================
        if (!$jenis || $jenis === 'pemakaian') {
            $pemakaians = PemakaianBahan::with(['inventory.barangMasuk', 'siswa', 'admin'])
                ->when($from && $to, fn ($q) =>
                    $q->whereBetween('created_at', [$from, $to])
                )
                ->when($siswa, fn ($q) =>
                    $q->whereHas('siswa', fn ($s) =>
                        $s->where('nama', 'like', "%$siswa%")
                    )
                )
                ->when($kelas, fn ($q) =>
                    $q->whereHas('siswa', fn ($s) =>
                        $s->where('kelas', $kelas)
                    )
                )
                ->latest()
                ->get();
        }

        // ================= PELANGGARAN =================
        if (!$jenis || $jenis === 'banned') {
            $pelanggarans = Pelanggaran::with(['siswa', 'admin'])
                ->when($from && $to, fn ($q) =>
                    $q->whereBetween('created_at', [$from, $to])
                )
                ->when($siswa, fn ($q) =>
                    $q->whereHas('siswa', fn ($s) =>
                        $s->where('nama', 'like', "%$siswa%")
                    )
                )
                ->when($kelas, fn ($q) =>
                    $q->whereHas('siswa', fn ($s) =>
                        $s->where('kelas', $kelas)
                    )
                )
                ->latest()
                ->get();
        }

        // ================= TRANSAKSI MASSAL =================
        if (!$jenis || $jenis === 'transaksi_massal') {
            $transaksiMassals = TransaksiMassal::with(['inventaris.barangMasuk', 'siswa', 'admin'])
                ->where('dikembalikan', true)
                ->when($from && $to, fn ($q) =>
                    $q->whereBetween('created_at', [$from, $to])
                )
                ->when($siswa, fn ($q) =>
                    $q->whereHas('siswa', fn ($s) =>
                        $s->where('nama', 'like', "%$siswa%")
                    )
                )
                ->when($kelas, fn ($q) =>
                    $q->whereHas('siswa', fn ($s) =>
                        $s->where('kelas', $kelas)
                    )
                )
                ->latest()
                ->get();
        }

        $kelasList = \App\Models\Siswa::select('kelas')->distinct()->pluck('kelas');

        return view('riwayat-aktivitas.index', compact(
            'barangMasuks',
            'peminjamans',
            'pengembalians',
            'pemakaians',
            'pelanggarans',
            'transaksiMassals',
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
