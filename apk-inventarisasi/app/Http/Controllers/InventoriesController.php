<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Items;
use App\Models\Ruangan;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;

class InventoriesController extends Controller
{
    public function index()
    {
        $alat = Inventory::with('barangMasuk')
            ->whereHas('barangMasuk', function ($q) {
                $q->where('jenis_barang', 'alat')
                ->where('from_sarpras', false);
            })
            ->get()
            ->groupBy(fn($item) => $item->barangMasuk->nama_barang);
            
        $bahan = Inventory::with('barangMasuk')->whereHas('barangMasuk', function($q) {
            $q->where('jenis_barang', 'bahan');
        })->get();

        // Inventaris yang berasal dari SARPRAS (flag from_sarpras di tabel barang_masuks)
        $sarpras = Inventory::with('barangMasuk')
            ->whereHas('barangMasuk', fn($q) => $q->where('from_sarpras', true))
            ->get()
            ->groupBy(fn ($item) => $item->barangMasuk->nama_barang);
            
            

        return view('inventaris.index', compact('alat', 'bahan', 'sarpras'));
    }

    public function create()
    {
        $barangMasukBahan = BarangMasuk::where('jenis_barang', 'bahan')->get();
        $barangMasukAlat = BarangMasuk::where('jenis_barang', 'alat')->get();

        $type = request('type', 'bahan'); // default bahan

        return view('inventaris.create', compact('barangMasukBahan', 'barangMasukAlat', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_masuk_id' => 'required|exists:barang_masuks,id',
            'status' => 'required|in:TERSEDIA,DIPINJAM,RUSAK,HILANG,DIPERBAIKI',
            'kondisi' => 'required|in:BAIK,RUSAK_RINGAN,RUSAK_BERAT,HILANG,SEDANG DIPERBAIKI',
            'stok' => 'nullable|integer|min:0',
            'kode_qr_jurusan' => 'nullable|unique:inventories,kode_qr_jurusan',
        ]);

        // Jika status DIPERBAIKI, kondisi otomatis SEDANG DIPERBAIKI
        $kondisi = $request->status === 'DIPERBAIKI' ? 'SEDANG DIPERBAIKI' : $request->kondisi;

        Inventory::create([
            'barang_masuk_id' => $request->barang_masuk_id,
            'status' => $request->status,
            'kondisi' => $kondisi,
            'stok' => $request->stok,
            'penempatan_rak' => strtoupper($request->penempatan_rak),
            'kode_qr_jurusan' => $request->kode_qr_jurusan,
        ]);

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil ditambahkan.');
    }

    public function show(Inventory $inventaris)
    {
        if (!$inventaris->barangMasuk) {
            abort(404, 'Data barang masuk tidak ditemukan untuk inventaris ini.');
        }
        return view('inventaris.show', compact('inventaris'));
    }

    public function edit(Inventory $inventaris)
    {
        if (!$inventaris->barangMasuk) {
            abort(404, 'Data barang masuk tidak ditemukan untuk inventaris ini.');
        }

        // Bahan tidak boleh diedit
        if ($inventaris->barangMasuk->jenis_barang === 'bahan') {
            abort(403, 'Bahan tidak dapat diedit.');
        }

        $barangMasukBahan = BarangMasuk::where('jenis_barang', 'bahan')->get();
        $barangMasukAlat = BarangMasuk::where('jenis_barang', 'alat')->get();

        return view('inventaris.edit', compact('inventaris', 'barangMasukBahan', 'barangMasukAlat'));
    }

    public function update(Request $request, Inventory $inventaris)
    {
        $request->validate([
            'barang_masuk_id' => 'required|exists:barang_masuks,id',
            'status' => 'required|in:TERSEDIA,DIPINJAM,HILANG,DIPERBAIKI',
            'kondisi' => 'required|in:BAIK,RUSAK_RINGAN,RUSAK_BERAT,HILANG,SEDANG DIPERBAIKI',
        ]);

        // Jika status DIPERBAIKI, kondisi otomatis SEDANG DIPERBAIKI
        $kondisi = $request->status === 'DIPERBAIKI' ? 'SEDANG DIPERBAIKI' : $request->kondisi;

        $inventaris->update([
            'barang_masuk_id' => $request->barang_masuk_id,
            'status' => $request->status,
            'kondisi' => $kondisi,
        ]);

        return redirect()->route('inventaris.index')
            ->with('success', 'Inventaris berhasil diperbarui.');
    }


    public function destroy(Inventory $inventaris)
    {
        $activePeminjaman = $inventaris->peminjamans()
            ->whereNull('waktu_kembali_aktual')
            ->exists();

        if ($activePeminjaman) {
            return redirect()->route('inventaris.index')
                ->with('error', 'Tidak dapat menghapus inventaris yang masih dalam peminjaman aktif.');
        }

        $inventaris->delete();

        return redirect()->route('inventaris.index')
            ->with('success', 'Inventaris berhasil dihapus.');
    }


    public function generateQrBulk(BarangMasuk $barangMasuk)
    {
        $inventaris = Inventory::where('barang_masuk_id', $barangMasuk->id)->get();

        foreach ($inventaris as $item) {
            if (!$item->kode_qr_jurusan) {
                $item->update([
                    'kode_qr_jurusan' => $this->generateKodeQr(
                        $barangMasuk->jenis_barang,
                        $item->penempatan_rak
                    )
                ]);
            }
        }

        return back()->with('qr_generated', true);
    }

    private function generateKodeQr($jenis, $rak)
    {
        // Mapping rak ke huruf
        $rakMap = [
            'PT'  => 'A',
            'HT'  => 'B',
            'RK'  => 'C',
            'RBK' => 'D',
            'RBB' => 'E',
            'UK'  => 'F',
            'PPE' => 'G',
        ];

        $huruf = $rakMap[$rak] ?? 'X';

        // Prefix ALT / BHN
        $prefix = $jenis === 'alat' ? 'ALT' : 'BHN';

        // Prefix rak: A.PT
        $rakPrefix = "{$huruf}.{$rak}";

        // Contoh: ALT-A.PT-001
        $fullPrefix = "{$prefix}-{$rakPrefix}";

        $last = Inventory::where('kode_qr_jurusan', 'LIKE', "$fullPrefix-%")
            ->orderBy('kode_qr_jurusan', 'desc')
            ->first();

        $number = 1;

        if ($last) {
            $parts = explode('-', $last->kode_qr_jurusan);
            $number = intval(end($parts)) + 1;
        }

        return sprintf('%s-%03d', $fullPrefix, $number);
    }




    // public function show(Inventory $inventaris)
    // {
    //     return view('inventaris.show', compact('inventaris'));
    // }
}