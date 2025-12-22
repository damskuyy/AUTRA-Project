<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Items;
use App\Models\Inventory;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode; // Pastikan package ini terinstall

class BarangMasukController extends Controller
{
    // INDEX — tempat form + riwayat dropdown
    public function index()
    {
        $inventories = Inventory::all();
        $ruangans = Ruangan::all();

        $riwayatNamaBahan = BarangMasuk::where('jenis_barang','bahan')
            ->pluck('nama_barang')->unique();

        $riwayatNamaAlat = BarangMasuk::where('jenis_barang','alat')
            ->pluck('nama_barang')->unique();

        $riwayatSeriAlat = BarangMasuk::where('jenis_barang','alat')
            ->pluck('nomor_dokumen')->unique();

        return view('barang-masuk.index', compact(
            'inventories',
            'ruangans',
            'riwayatNamaBahan',
            'riwayatNamaAlat',
            'riwayatSeriAlat'
        ));
    }

    // STORE BARANG MASUK (Diperbarui)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string',
            'jenis_barang' => 'required|in:alat,bahan',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'nullable|string',
            'sumber' => 'required|string',
            'nomor_dokumen' => 'nullable|string',
            'tanggal_masuk' => 'required|date',
            'ruangan_id' => 'required|exists:ruangans,id',
            'catatan' => 'nullable|string',
        ]);

        // Handle Input Nama/Seri Baru
        if ($request->nama_barang === '__new') {
            $validated['nama_barang'] = $request->nama_barang_new;
        }
        if ($request->nomor_dokumen === '__new') {
            $validated['nomor_dokumen'] = $request->nomor_dokumen_new;
        }

        DB::transaction(function () use ($validated) {
            // 1. Dapatkan atau Buat Item (Master Data)
            $item = Items::firstOrCreate(
                ['nama_barang' => $validated['nama_barang'], 'jenis' => $validated['jenis_barang']],
                ['kode_barang' => ($validated['jenis_barang'] == 'alat' ? 'ALT-' : 'BHN-') . strtoupper(Str::random(6))]
            );

            $inventory = null;

            if ($validated['jenis_barang'] === 'bahan') {
                // LOGIKA BAHAN: Update stok jika sudah ada, buat baru jika belum
                $inventory = Inventory::firstOrCreate(
                    ['item_id' => $item->id, 'ruangan_id' => $validated['ruangan_id']],
                    [
                        'stok' => 0,
                        'status' => 'TERSEDIA',
                        'kondisi' => 'BAIK'
                    ]
                );
                $inventory->increment('stok', $validated['jumlah']);
            } else {
                // LOGIKA ALAT: Buat record unik (untuk mendukung tracking QR per unit)
                // Jika admin input jumlah > 1 untuk alat, kita buat record satu per satu agar punya QR unik
                for ($i = 0; $i < $validated['jumlah']; $i++) {
                    $inventory = Inventory::create([
                        'item_id' => $item->id,
                        'ruangan_id' => $validated['ruangan_id'],
                        'serial_number' => $validated['nomor_dokumen'], // Bisa diisi seri alat
                        'stok' => null, // Alat biasanya tidak menggunakan kolom stok (stok 1 unit per record)
                        'status' => 'TERSEDIA',
                        'kondisi' => 'BAIK',
                    ]);
                }
            }

            // 2. Auto-Generate QR Code jika belum ada (Gunakan ID Inventory terakhir)
            if ($inventory && empty($inventory->kode_qr_jurusan)) {
                $prefix = ($validated['jenis_barang'] == 'alat') ? 'QR-ALT' : 'QR-BHN';
                $inventory->kode_qr_jurusan = $prefix . '-' . date('Ymd') . '-' . str_pad($inventory->id, 4, '0', STR_PAD_LEFT);
                $inventory->save();
            }

            // 3. Simpan ke Tabel Barang Masuk (Riwayat)
            BarangMasuk::create([
                'inventory_id' => $inventory->id,
                'nama_barang' => $validated['nama_barang'],
                'jenis_barang' => $validated['jenis_barang'],
                'jumlah' => $validated['jumlah'],
                'satuan' => $validated['satuan'],
                'sumber' => $validated['sumber'],
                'nomor_dokumen' => $validated['nomor_dokumen'],
                'tanggal_masuk' => $validated['tanggal_masuk'],
                'catatan' => $validated['catatan'],
                'admin_id' => Auth::id(),
            ]);
        });

        return back()->with('success', 'Barang berhasil masuk dan inventaris otomatis diperbarui.');
    }
}