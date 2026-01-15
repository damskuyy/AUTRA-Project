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

            /**
             * ===== CEK TELAT =====
             */
            $now = Carbon::now();
            $deadline = Carbon::parse($peminjaman->waktu_kembali_aktual);

            $siswa = $peminjaman->siswa;

            if ($now->greaterThan($deadline)) {

                // ➕ simpan ke pelanggarans
                Pelanggaran::create([
                    'siswa_id' => $siswa->id,
                    'peminjaman_id' => $peminjaman->id,
                    'tipe' => 'TELAT_KEMBALI',
                    'poin' => 1,
                    'keterangan' => 'Terlambat mengembalikan alat',
                    'tanggal_kejadian' => now(),
                    'admin_id' => auth()->id(),
                ]);

                // naikkan total pelanggaran
                $siswa->increment('total_poin');
                $siswa->refresh();

                // 3️⃣ auto banned
                if ($siswa->total_pelanggaran >= 3 && !$siswa->is_banned) {
                    $siswa->update([
                        'is_banned' => true,
                        'banned_until' => now()->addDays(3),
                        'alasan_ban' => 'Terlambat mengembalikan alat 3 kali',
                    ]);
                }
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
                default => 'TERSEDIA', // fallback
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
