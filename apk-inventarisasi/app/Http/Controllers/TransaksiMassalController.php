<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\TransaksiMassal;
use App\Models\Siswa;
use App\Models\ActivityLog;
use App\Models\Pelanggaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiMassalController extends Controller
{
    /**
     * INDEX → transaksi aktif (belum dikembalikan)
     */
    public function index()
    {
        $transaksis = TransaksiMassal::with(['inventaris', 'siswa'])
            ->where('dikembalikan', false)
            ->latest()
            ->get();

        return view('transaksi-massal.index', compact('transaksis'));
    }

    /**
     * RIWAYAT → transaksi sudah dikembalikan
     */
    public function riwayat()
    {
        $transaksis = TransaksiMassal::with(['inventaris', 'siswa'])
            ->where('dikembalikan', true)
            ->latest()
            ->get();

        return view('transaksi_massal.riwayat', compact('transaksis'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $inventarisAlat = Inventory::whereHas('barangMasuk', fn ($q) =>
            $q->where('jenis_barang', 'alat')
        )
            ->where('status', 'TERSEDIA')
            ->where('kondisi', 'BAIK')
            ->get();

        $inventarisBahan = Inventory::whereHas('barangMasuk', fn ($q) =>
            $q->where('jenis_barang', 'bahan')
        )->get();

        $siswas = Siswa::where('is_active', true)
            ->where('is_banned', false)
            ->orderBy('nama')
            ->get();
        
        //AMBIL RAK YANG BENAR-BENAR ADA DI INVENTORIES
        $rakInventories = Inventory::whereNotNull('penempatan_rak')
            ->select('penempatan_rak')
            ->distinct()
            ->pluck('penempatan_rak')
            ->toArray();

        //MASTER LABEL RAK (SAMA DENGAN BARANG MASUK)
        $rakLabels = [
            'PT'  => 'Power Tools',
            'HT'  => 'Hand Tools',
            'RK'  => 'Rak Komponen',
            'RBK' => 'Rak Bahan Kecil',
            'RBB' => 'Rak Bahan Besar',
            'UK'  => 'Rak Alat Ukur',
            'PPE' => 'Rak PPE',
        ];

        return view('transaksi-massal.create', compact(
            'inventarisAlat',
            'inventarisBahan',
            'siswas',
            'rakInventories',
            'rakLabels'
        ));
    }

    /**
     * STORE TRANSAKSI MASSAL
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'inventaris_ids' => 'nullable|array',
            'jumlah' => 'nullable|array',
            'jam_kembali' => 'nullable|date_format:H:i',
            'catatan' => 'nullable|string|max:255',
            'keperluan' => 'nullable|string|max:255',
        ]);

        $siswa = Siswa::findOrFail($validated['siswa_id']);

        if ($siswa->is_banned) {
            return back()->withErrors('Siswa sedang dibanned dan tidak dapat melakukan transaksi');
        }


        if (empty($validated['inventaris_ids']) && empty($validated['jumlah'])) {
            return back()->withErrors('Pilih minimal 1 barang');
        }

        DB::transaction(function () use ($validated) {

            $transaksi = TransaksiMassal::create([
                'siswa_id' => $validated['siswa_id'],
                'admin_id' => auth()->id(),
                'jam_transaksi' => now(),
                'jam_kembali' => $validated['jam_kembali'],
                'catatan' => $validated['catatan'] ?? null,
                'keperluan' => $validated['keperluan'] ?? null,
            ]);

            $adaAlat = false;

            // ALAT
            if (!empty($validated['inventaris_ids'])) {
                $adaAlat = true;
                foreach ($validated['inventaris_ids'] as $id) {
                    $inv = Inventory::findOrFail($id);
                    $inv->update(['status' => 'DIPINJAM']);
                    $transaksi->inventaris()->attach($inv->id, ['quantity' => 1]);
                }
            }

            // BAHAN
            if (!empty($validated['jumlah'])) {
                foreach ($validated['jumlah'] as $id => $qty) {
                    if ($qty > 0) {
                        $inv = Inventory::findOrFail($id);
                        $inv->decrement('stok', $qty);
                        $transaksi->inventaris()->attach($inv->id, ['quantity' => $qty]);
                    }
                }
            }

            // Jika hanya bahan → langsung selesai
            if (!$adaAlat) {
                $transaksi->update(['dikembalikan' => true]);
            }
        });

        return redirect()
            ->route('transaksi.massal.index')
            ->with('success', 'Transaksi massal berhasil dibuat');
    }

    /**
     * FORM PENGEMBALIAN
     */
    public function showFormKembalikan($id)
    {
        $transaksi = TransaksiMassal::with(['inventaris', 'siswa'])->findOrFail($id);
        return view('kembalikan.index', compact('transaksi'));
    }

    /**
     * PROSES PENGEMBALIAN
     */
    public function formKembalikan(Request $request, $id)
    {
        $transaksi = TransaksiMassal::with(['inventaris', 'siswa'])->findOrFail($id);

        $request->validate([
            'kondisi' => 'nullable|array',
            'kondisi.*' => 'in:BAIK,RUSAK_RINGAN,RUSAK_BERAT,HILANG',
        ]);

        DB::transaction(function () use ($request, $transaksi) {

            $kenaPelanggaran = false;
            $alasan = [];

            // ================= INVENTARIS =================
            foreach ($request->kondisi ?? [] as $invId => $kondisi) {
                $inv = Inventory::findOrFail($invId);

                $status = match ($kondisi) {
                    'BAIK' => 'TERSEDIA',
                    'RUSAK_RINGAN', 'RUSAK_BERAT' => 'RUSAK',
                    'HILANG' => 'HILANG',
                    default => $inv->status,
                };

                $inv->update([
                    'kondisi' => $kondisi,
                    'status' => $status,
                ]);

                if (in_array($kondisi, ['RUSAK_RINGAN', 'RUSAK_BERAT', 'HILANG'])) {
                    $kenaPelanggaran = true;
                    $alasan[] = "Barang {$inv->barangMasuk->nama_barang} {$kondisi}";
                }
            }

            // ================= TELAT =================
            if ($transaksi->jam_kembali) {
                $jamKembali = Carbon::parse(
                    $transaksi->jam_transaksi->format('Y-m-d') . ' ' . $transaksi->jam_kembali
                );

                if (now()->greaterThan($jamKembali)) {
                    $kenaPelanggaran = true;
                    $alasan[] = 'Pengembalian terlambat';
                }
            }

            // ================= PELANGGARAN (SATU KALI) =================
            if ($kenaPelanggaran) {

                Pelanggaran::create([
                    'siswa_id' => $transaksi->siswa_id,
                    'tipe' => 'TRANSAKSI_MASSAL',
                    'poin' => 1,
                    'keterangan' => implode(', ', $alasan),
                    'tanggal_kejadian' => now(),
                    'admin_id' => auth()->id(),
                ]);

                $siswa = Siswa::findOrFail($transaksi->siswa_id);

                $siswa->increment('total_poin');
                $siswa->refresh();          // 🔥 WAJIB
                $siswa->checkAndAutoBan();  // 🔥 AUTO BANNED FIX
            }


            // ================= TRANSAKSI =================
            $transaksi->update(['dikembalikan' => true]);

            ActivityLog::create([
                'waktu' => now(),
                'aktivitas' => 'Pengembalian Transaksi Massal',
                'detail' => "Pengembalian oleh {$transaksi->siswa->nama}",
                'admin_id' => auth()->id(),
                'siswa_id' => $transaksi->siswa_id,
                'subject_id' => $transaksi->id,
                'subject_type' => TransaksiMassal::class,
            ]);
        });

        return redirect()
            ->route('transaksi.massal.index')
            ->with('success', 'Pengembalian berhasil diproses');
    }
}