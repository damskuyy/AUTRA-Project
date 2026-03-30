<?php

namespace App\Exports;

use App\Services\RiwayatService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RiwayatExport implements FromArray, WithHeadings
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Aktivitas',
            'Detail',
            'Admin',
        ];
    }

    public function array(): array
    {
        $data = RiwayatService::get($this->request);
        $rows = [];

        $barang = $this->request->barang;

        /** =========================
         * BARANG MASUK
         * ========================= */
        foreach ($data['barangMasuks'] as $item) {
            if ($barang && !str_contains(strtolower($item->nama_barang), strtolower($barang))) {
                continue;
            }
            $rows[] = [
                $item->tanggal_masuk,
                'Barang Masuk',
                $item->nama_barang ?? '-',
                $item->admin->name ?? '-',
            ];
        }

        /** =========================
         * PEMINJAMAN
         * ========================= */
        foreach ($data['peminjamans'] as $item) {
            $namaBarang = $item->inventory->barangMasuk->nama_barang ?? '';

            if ($barang && !str_contains(strtolower($namaBarang), strtolower($barang))) {
                continue;
            }
            $rows[] = [
                $item->created_at,
                'Peminjaman',
                $item->inventory->barangMasuk->nama_barang ?? '-',
                $item->admin->name ?? '-',
            ];
        }

        /** =========================
         * PENGEMBALIAN
         * ========================= */
        foreach ($data['pengembalians'] as $item) {
            $namaBarang = $item->peminjaman->inventory->barangMasuk->nama_barang ?? '';

            if ($barang && !str_contains(strtolower($namaBarang), strtolower($barang))) {
                continue;
            }
            $rows[] = [
                $item->created_at,
                'Pengembalian',
                $item->peminjaman->inventory->barangMasuk->nama_barang ?? '-',
                $item->admin->name ?? '-',
            ];
        }

        /** =========================
         * PEMAKAIAN
         * ========================= */
        foreach ($data['pemakaians'] as $item) {
            $namaBarang = $item->inventory->barangMasuk->nama_barang ?? '';

            if ($barang && !str_contains(strtolower($namaBarang), strtolower($barang))) {
                continue;
            }
            $rows[] = [
                $item->created_at,
                'Pemakaian',
                $item->inventory->barangMasuk->nama_barang ?? '-',
                $item->admin->name ?? '-',
            ];
        }

        /** =========================
         * TRANSAKSI MASSAL
         * ========================= */
        foreach ($data['transaksiMassals'] as $tm) {

            $items = $tm->inventaris->map(function ($inv) {
                return $inv->barangMasuk->nama_barang;
            });

            if ($barang && !$items->contains(fn($i) => str_contains(strtolower($i), strtolower($barang)))) {
                continue;
            }

            $detail = $tm->inventaris->map(function ($inv) {
                return
                    $inv->barangMasuk->nama_barang .
                    ' x' . $inv->pivot->quantity;
            })->implode(', ');

            $rows[] = [
                $tm->jam_transaksi,
                'Transaksi Massal',
                $tm->siswa->nama . ' | ' . $detail,
                $tm->admin->name ?? '-',
            ];
        }



        /** =========================
         * PELANGGARAN / BANNED
         * ========================= */
        foreach ($data['pelanggarans'] as $item) {
            $namaBarang = $item->peminjaman->inventory->barangMasuk->nama_barang ?? '';

            if ($barang && !str_contains(strtolower($namaBarang), strtolower($barang))) {
                continue;
            }
            $rows[] = [
                $item->created_at,
                'Pelanggaran',
                $item->keterangan ?? '-',
                $item->admin->name ?? '-',
            ];
        }

        return $rows;
    }
}
