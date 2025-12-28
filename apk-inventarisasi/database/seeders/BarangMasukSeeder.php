<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BarangMasuk;
use App\Models\Items;
use App\Models\Inventory;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Support\Str;

class BarangMasukSeeder extends Seeder
{
    public function run()
    {
        // Asumsikan ada user admin (gunakan yang pertama atau buat baru jika belum ada)
        $admin = User::first() ?? User::factory()->create(['name' => 'Admin', 'email' => 'admin@example.com']);

        // Asumsikan ada ruangan (gunakan yang pertama atau buat baru jika belum ada)
        $ruangan = Ruangan::first() ?? Ruangan::create([
            'kode_ruangan' => 'RUANG-001',
            'nama_ruangan' => 'Ruangan Utama'
        ]);

        // Data untuk Bahan (Habis Pakai)
        $itemBahan = Items::firstOrCreate(
            ['nama_barang' => 'Kertas A4', 'jenis' => 'bahan'],
            ['kode_barang' => 'BHN-' . strtoupper(Str::random(6))]
        );

        $inventoryBahan = Inventory::firstOrCreate(
            ['item_id' => $itemBahan->id, 'ruangan_id' => $ruangan->id],
            ['stok' => 0, 'status' => 'TERSEDIA', 'kondisi' => 'BAIK']
        );
        $inventoryBahan->increment('stok', 50);

        BarangMasuk::create([
            'inventory_id' => $inventoryBahan->id,
            'nama_barang' => 'Kertas A4',
            'jenis_barang' => 'bahan',
            'jumlah' => 50,
            'satuan' => 'rim',
            'sumber' => 'Toko ATK ABC',
            'nomor_dokumen' => null,
            'tanggal_masuk' => now()->subDays(5),
            'catatan' => 'Pembelian rutin',
            'admin_id' => $admin->id,
        ]);

        // Data untuk Alat (Non-Habis Pakai)
        $itemAlat = Items::firstOrCreate(
            ['nama_barang' => 'Komputer Desktop', 'jenis' => 'alat'],
            ['kode_barang' => 'ALT-' . strtoupper(Str::random(6))]
        );

        $inventoryAlat = Inventory::create([
            'item_id' => $itemAlat->id,
            'ruangan_id' => $ruangan->id,
            'serial_number' => 'PC-2025-001',
            'stok' => null,
            'status' => 'TERSEDIA',
            'kondisi' => 'BAIK',
        ]);

        BarangMasuk::create([
            'inventory_id' => $inventoryAlat->id,
            'nama_barang' => 'Komputer Desktop',
            'jenis_barang' => 'alat',
            'jumlah' => 1,
            'satuan' => null,
            'sumber' => 'Supplier IT XYZ',
            'nomor_dokumen' => 'PC-2025-001',
            'tanggal_masuk' => now()->subDays(2),
            'catatan' => 'Untuk ruang kerja',
            'admin_id' => $admin->id,
        ]);

        // Tambahkan lebih banyak data jika diperlukan
        // Contoh bahan lainnya
        $itemBahan2 = Items::firstOrCreate(
            ['nama_barang' => 'Spidol Boardmarker', 'jenis' => 'bahan'],
            ['kode_barang' => 'BHN-' . strtoupper(Str::random(6))]
        );

        $inventoryBahan2 = Inventory::firstOrCreate(
            ['item_id' => $itemBahan2->id, 'ruangan_id' => $ruangan->id],
            ['stok' => 0, 'status' => 'TERSEDIA', 'kondisi' => 'BAIK']
        );
        $inventoryBahan2->increment('stok', 20);

        BarangMasuk::create([
            'inventory_id' => $inventoryBahan2->id,
            'nama_barang' => 'Spidol Boardmarker',
            'jenis_barang' => 'bahan',
            'jumlah' => 20,
            'satuan' => 'buah',
            'sumber' => 'Toko ATK ABC',
            'nomor_dokumen' => null,
            'tanggal_masuk' => now()->subDays(10),
            'catatan' => 'Untuk presentasi',
            'admin_id' => $admin->id,
        ]);

        // Contoh alat lainnya
        $itemAlat2 = Items::firstOrCreate(
            ['nama_barang' => 'Proyektor', 'jenis' => 'alat'],
            ['kode_barang' => 'ALT-' . strtoupper(Str::random(6))]
        );

        $inventoryAlat2 = Inventory::create([
            'item_id' => $itemAlat2->id,
            'ruangan_id' => $ruangan->id,
            'serial_number' => 'PROJ-2025-002',
            'stok' => null,
            'status' => 'TERSEDIA',
            'kondisi' => 'BAIK',
        ]);

        BarangMasuk::create([
            'inventory_id' => $inventoryAlat2->id,
            'nama_barang' => 'Proyektor',
            'jenis_barang' => 'alat',
            'jumlah' => 1,
            'satuan' => null,
            'sumber' => 'Supplier IT XYZ',
            'nomor_dokumen' => 'PROJ-2025-002',
            'tanggal_masuk' => now()->subDays(7),
            'catatan' => 'Untuk ruang meeting',
            'admin_id' => $admin->id,
        ]);
    }
}