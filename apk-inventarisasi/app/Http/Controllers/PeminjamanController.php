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
     * FORM PEMINJAMAN (HASIL REDIRECT DARI SCAN QR)
     */
    public function form(Inventory $inventory)
    {
        if (
            !$inventory->barangMasuk ||
            $inventory->barangMasuk->jenis_barang !== 'alat'
        ) {
            abort(404);
        }

        $peminjamanAktif = Peminjaman::where('inventory_id', $inventory->id)
            ->whereNull('waktu_kembali_aktual')
            ->first();

        // 🔥 AMBIL DATA SISWA
        $siswas = Siswa::where('is_active', true)
            ->where('is_banned', false)
            ->orderBy('kelas')
            ->orderBy('nama')
            ->get();

        return view(
            'form.peminjaman-form',
            compact('inventory', 'peminjamanAktif', 'siswas')
        );
    }

    /**
     * SIMPAN PEMINJAMAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'inventory_id'    => 'required|exists:inventories,id',
            'siswa_id'        => 'required|exists:siswas,id',
            'quantity' => 'required|integer|min:1',
            'kondisi_pinjam'  => 'required|in:BAIK,RUSAK_RINGAN,RUSAK_BERAT',
            'waktu_kembali_aktual' => 'required',
            'catatan_pinjam' => 'nullable|string',
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);

        if ($siswa->is_banned) {
            abort(403, 'Siswa sedang dibanned sampai ' . $siswa->banned_until);
        }



        DB::transaction(function () use ($request) {

            // 🔒 LOCK BIAR AMAN
            $inventory = Inventory::lockForUpdate()
                ->findOrFail($request->inventory_id);

            // ❗ CEK STOK
            if ($inventory->stok < $request->quantity) {
                abort(400, 'Stok tidak mencukupi');
            }

            // 🔥 WIB
            $waktuPinjam = Carbon::now('Asia/Jakarta');

            // 🔥 Gabung tanggal + jam estimasi
            $estimasiKembali = Carbon::parse(
                $waktuPinjam->format('Y-m-d') . ' ' . $request->waktu_kembali_aktual,
                'Asia/Jakarta'
            );

            // ✅ SIMPAN PEMINJAMAN
            Peminjaman::create([
                'inventory_id' => $inventory->id,
                'siswa_id' => $request->siswa_id,
                'admin_id' => auth()->id(),
                'quantity' => $request->quantity,
                'waktu_pinjam' => now(),
                'waktu_kembali_aktual' => $estimasiKembali,
                'kondisi_pinjam' => $request->kondisi_pinjam,
                'catatan_pinjam' => $request->catatan_pinjam,
            ]);

            // ➖ KURANGI STOK
            $inventory->decrement('stok', $request->quantity);
        });
        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dicatat');
    }
}
