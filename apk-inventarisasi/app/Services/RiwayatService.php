<?php

namespace App\Services;

use App\Models\BarangMasuk;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\PemakaianBahan;
use App\Models\Pelanggaran;
use App\Models\TransaksiMassal;

class RiwayatService
{
    public static function get($request)
    {
        $from = $request->from_date;
        $to = $request->to_date;
        $siswa = $request->siswa;
        $kelas = $request->kelas;
        $barang = $request->barang;
        $jenis = $request->jenis;

        $barangMasuks = BarangMasuk::with('admin')
            ->when($from && $to, fn($q) =>
                $q->whereBetween('tanggal_masuk', [$from, $to])
            )->get();

        $peminjamans = Peminjaman::with(['inventory.barangMasuk','siswa','admin'])
            ->whereHas('pengembalian')
            ->when($siswa, fn($q) =>
                $q->whereHas('siswa', fn($s) =>
                    $s->where('nama','like',"%$siswa%")
                )
            )
            ->when($kelas, fn ($q) =>
                $q->whereHas('siswa', fn ($s) =>
                    $s->where('kelas', $kelas)
                )
            )->get();

        $pengembalians = Pengembalian::with(['peminjaman.inventory.barangMasuk','peminjaman.siswa','admin'])
            ->get();

        $pemakaians = PemakaianBahan::with([
                'inventory.barangMasuk',
                'siswa',
                'admin'
            ])
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
            ->get();
        
        $transaksiMassals = TransaksiMassal::with([
            'siswa',
            'admin',
            'inventaris.barangMasuk'
        ])
        ->when($from && $to, fn ($q) =>
            $q->whereBetween('jam_transaksi', [$from, $to])
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



        $pelanggarans = Pelanggaran::with(['siswa','admin'])
            ->get();

        if ($jenis) {
            $barangMasuks = $jenis === 'barang_masuk' ? $barangMasuks : collect();
            $peminjamans = $jenis === 'peminjaman' ? $peminjamans : collect();
            $pengembalians = $jenis === 'pengembalian' ? $pengembalians : collect();
            $pemakaians    = $jenis === 'pemakaian' ? $pemakaians : collect();
            $transaksiMassals = $jenis === 'transaksi_massal'? $transaksiMassals: collect();
            $pelanggarans = $jenis === 'banned' ? $pelanggarans : collect();
        }

        return compact(
            'barangMasuks',
            'peminjamans',
            'pengembalians',
            'pemakaians',
            'transaksiMassals',
            'pelanggarans'
        );
    }
}
