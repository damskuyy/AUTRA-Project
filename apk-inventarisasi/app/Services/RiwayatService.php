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
        )
        ->when($barang, fn($q) =>
            $q->where('nama_barang', 'like', "%$barang%")
        )
        ->get();

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
        )
        // 🔥 PINDAH KE LUAR (INI KUNCINYA)
        ->when($barang, fn($q) =>
            $q->whereHas('inventory.barangMasuk', fn($b) =>
                $b->where('nama_barang','like',"%$barang%")
            )
        )
        ->get();

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
        ->when($barang, fn ($q) =>
            $q->whereHas('peminjaman.inventory.barangMasuk', fn ($b) =>
                $b->where('nama_barang','like',"%$barang%")
            )
        )
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
            ->when($barang, fn ($q) =>
                $q->whereHas('inventory.barangMasuk', fn ($b) =>
                    $b->where('nama_barang','like',"%$barang%")
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
        ->when($barang, fn ($q) =>
            $q->whereHas('inventaris.barangMasuk', fn ($b) =>
                $b->where('nama_barang','like',"%$barang%")
            )
        )
        ->get();



        $pelanggarans = Pelanggaran::with([
            'siswa',
            'admin',
            'peminjaman.inventory.barangMasuk'
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
        ->when($barang, fn ($q) =>
            $q->whereHas('peminjaman.inventory.barangMasuk', fn ($b) =>
                $b->where('nama_barang','like',"%$barang%")
            )
        )
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
