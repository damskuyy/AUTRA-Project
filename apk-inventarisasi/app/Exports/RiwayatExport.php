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

        /** =========================
         * BARANG MASUK
         * ========================= */
        foreach ($data['barangMasuks'] as $item) {
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
                return
                    $inv->barangMasuk->nama_barang .
                    ' x' . $inv->pivot->quantity .
                    ' (Rak: ' . ($inv->penempatan_rak ?? '-') . ')';
            })->implode(', ');

            $rows[] = [
                $tm->jam_transaksi,
                'Transaksi Massal',
                $tm->siswa->nama . ' | ' . $items .
                ($tm->keperluan ? ' | Keperluan: '.$tm->keperluan : ''),
                $tm->admin->name ?? '-',
            ];
        }



        /** =========================
         * PELANGGARAN / BANNED
         * ========================= */
        foreach ($data['pelanggarans'] as $item) {
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
