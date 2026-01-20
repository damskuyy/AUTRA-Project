<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Peminjaman;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * RIWAYAT PEMINJAMAN
     */
    public function index()
    {
        $peminjamans = Peminjaman::with(['inventory', 'siswa'])
            ->whereDoesntHave('pengembalian')
            ->latest()
            ->get();

        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * FORM PEMINJAMAN (HASIL SCAN QR)
     */
    public function form(Inventory $inventory)
    {
        if (
            !$inventory->barangMasuk ||
            $inventory->barangMasuk->jenis_barang !== 'alat'
        ) {
            abort(404);
        }

        // Validasi kondisi: hanya bisa pinjam jika kondisi BAIK
        if ($inventory->kondisi !== 'BAIK') {
            $pesan = match ($inventory->kondisi) {
                'RUSAK_RINGAN', 'RUSAK_BERAT' => 'Barang ini dalam kondisi rusak dan tidak dapat dipinjam.',
                'HILANG' => 'Barang ini hilang dan tidak dapat dipinjam.',
                'SEDANG DIPERBAIKI' => 'Barang ini sedang diperbaiki dan tidak dapat dipinjam.',
                default => 'Barang ini tidak dalam kondisi baik dan tidak dapat dipinjam.',
            };

            return redirect()
                ->route('scan.index')
                ->with('error', $pesan)
                ->with('swal', true);
        }

        $peminjamanAktif = Peminjaman::where('inventory_id', $inventory->id)
            ->whereNull('waktu_kembali_aktual')
            ->first();

        $siswas = Siswa::where('is_active', true)
            ->where('is_banned', false)
            ->orderBy('kelas')
            ->orderBy('nama')
            ->get();

        return view('form.peminjaman-form', compact(
            'inventory',
            'peminjamanAktif',
            'siswas'
        ));
    }

    /**
     * SIMPAN PEMINJAMAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'inventory_id'         => 'required|exists:inventories,id',
            'siswa_id'             => 'required|exists:siswas,id',
            'waktu_kembali_aktual' => 'required',
            'catatan_pinjam'       => 'nullable|string',
            'keperluan'            => 'nullable|string',
            'keperluan_manual'     => 'nullable|string',
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);

        if ($siswa->is_banned) {
            abort(403, 'Siswa sedang dibanned sampai ' . $siswa->banned_until);
        }

        if (!$siswa->is_active) {
            abort(403, 'Siswa tidak aktif');
        }

        $keperluan = $request->keperluan === '__manual'
            ? $request->keperluan_manual
            : $request->keperluan;

        DB::transaction(function () use ($request, $keperluan) {

            $inventory = Inventory::lockForUpdate()
                ->findOrFail($request->inventory_id);

            // Validasi kondisi: hanya bisa pinjam jika kondisi BAIK
            if ($inventory->kondisi !== 'BAIK') {
                abort(400, 'Barang tidak dalam kondisi baik dan tidak dapat dipinjam');
            }

            // ❗ QR = 1 BARANG
            if ($inventory->stok < 1) {
                abort(400, 'Stok tidak mencukupi');
            }

            $waktuPinjam = Carbon::now('Asia/Jakarta');

            $estimasiKembali = Carbon::parse(
                $waktuPinjam->format('Y-m-d') . ' ' . $request->waktu_kembali_aktual,
                'Asia/Jakarta'
            );

            // ✅ SIMPAN PEMINJAMAN
            Peminjaman::create([
                'inventory_id'        => $inventory->id,
                'siswa_id'            => $request->siswa_id,
                'admin_id'            => auth()->id(),
                'quantity'            => 1,          // FORCE
                'waktu_pinjam'        => $waktuPinjam,
                'waktu_kembali_aktual'=> $estimasiKembali,
                'kondisi_pinjam'      => 'BAIK',      // FORCE
                'catatan_pinjam'      => $request->catatan_pinjam,
                'keperluan'           => $keperluan,
            ]);

            // ➖ STOK KURANG 1
            $inventory->decrement('stok', 1);

            // UPDATE STATUS BARANG
            $inventory->update([
                'status' => 'DIPINJAM'
            ]);

        });

        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dicatat');
    }
}