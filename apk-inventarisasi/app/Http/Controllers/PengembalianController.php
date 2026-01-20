<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    /**
     * ==============================
     * LIST RIWAYAT PENGEMBALIAN
     * ==============================
     */
    public function index()
    {
        $pengembalians = Pengembalian::with([
            'peminjaman.inventory.barangMasuk',
            'peminjaman.siswa'
        ])
        ->latest()
        ->get();

        return view('pengembalian.index', compact('pengembalians'));
    }

    /**
     * ==============================
     * FORM PENGEMBALIAN
     * ==============================
     */
    public function create($peminjamanId)
    {
        $peminjaman = Peminjaman::with([
            'inventory.barangMasuk',
            'siswa'
        ])->findOrFail($peminjamanId);

        return view('pengembalian.index', compact('peminjaman'));
    }

    /**
     * ==============================
     * SIMPAN PENGEMBALIAN
     * ==============================
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'kondisi' => 'required|in:BAIK,RUSAK_RINGAN,RUSAK_BERAT,HILANG',
            'catatan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            $peminjaman = Peminjaman::with(['inventory', 'siswa'])
                ->lockForUpdate()
                ->findOrFail($request->peminjaman_id);

            /**
             * SIMPAN DATA PENGEMBALIAN
             */
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'admin_id' => auth()->id(),
                'quantity' => $peminjaman->quantity,
                'waktu_kembali' => now(),
                'kondisi' => $request->kondisi,
                'catatan' => $request->catatan,
            ]);

            $siswa = $peminjaman->siswa;

            /**
             * ==============================
             * LOGIKA PELANGGARAN (FIX UTAMA)
             * ==============================
             */
            $now = Carbon::now();
            $deadline = Carbon::parse($peminjaman->waktu_kembali_aktual);

            $isTelat = $now->greaterThan($deadline);
            $isRusakAtauHilang = in_array($request->kondisi, [
                'RUSAK_RINGAN',
                'RUSAK_BERAT',
                'HILANG'
            ]);

            // 👉 kalau ADA pelanggaran (telat ATAU rusak/hilang)
            if ($isTelat || $isRusakAtauHilang) {

                $tipe = match (true) {
                    $isRusakAtauHilang && $request->kondisi === 'HILANG' => 'HILANG',
                    $isRusakAtauHilang => 'KERUSAKAN',
                    default => 'TELAT_KEMBALI',
                };

                $keterangan = match ($tipe) {
                    'HILANG' => 'Barang hilang saat pengembalian',
                    'KERUSAKAN' => 'Barang dikembalikan dalam kondisi rusak',
                    'TELAT_KEMBALI' => 'Terlambat mengembalikan alat',
                };

                Pelanggaran::create([
                    'siswa_id' => $siswa->id,
                    'peminjaman_id' => $peminjaman->id,
                    'tipe' => $tipe,
                    'poin' => 1,
                    'keterangan' => $keterangan,
                    'tanggal_kejadian' => now(),
                    'admin_id' => auth()->id(),
                ]);

                // ⚠️ HANYA +1 POIN (TIDAK DOBEL)
                $siswa->increment('total_poin');
                $siswa->refresh();
                $siswa->checkAndAutoBan();
            }

            /**
             * TAMBAH STOK KEMBALI
             */
            $peminjaman->inventory
                ->increment('stok', $peminjaman->quantity);

            /**
             * UPDATE KONDISI DAN STATUS INVENTARIS
             */
            $status = match ($request->kondisi) {
                'BAIK' => 'TERSEDIA',
                'RUSAK_RINGAN', 'RUSAK_BERAT' => 'RUSAK',
                'HILANG' => 'HILANG',
                default => 'TERSEDIA',
            };

            $peminjaman->inventory->update([
                'kondisi' => $request->kondisi,
                'status' => $status,
            ]);
        });

        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Alat berhasil dikembalikan');
    }
}
