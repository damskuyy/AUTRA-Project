<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke inventory (barang yang baru dibuat di jurusan)
            $table->foreignId('inventory_id')->constrained('inventories');
            
            // Snapshot data dari inventory->item (saat barang masuk ke gudang jurusan)
            $table->string('nama_barang'); // Dari inventory->item->nama_barang
            $table->enum('jenis_barang', ['alat', 'bahan']); // Dari inventory->item->jenis
            
            // Detail penerimaan
            $table->integer('jumlah'); // Jumlah yang diterima
            $table->string('satuan')->nullable(); // pcs, unit, botol, kg, dll
            
            // Sumber dan dokumen
            $table->enum('sumber', ['SARPRAS_PUSAT', 'PEMBELIAN', 'HIBAH', 'PENGADAAN', 'RETUR'])->default('SARPRAS_PUSAT');
            $table->string('nomor_dokumen')->nullable(); // Nomor surat jalan, PO, dll
            
            // Waktu dan catatan
            $table->timestamp('tanggal_masuk');
            $table->text('catatan')->nullable();
            
            // Admin yang menerima
            $table->foreignId('admin_id')->constrained('users');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};
