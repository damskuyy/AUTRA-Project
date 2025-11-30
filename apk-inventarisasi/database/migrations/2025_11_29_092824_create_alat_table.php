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
        Schema::create('alat', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alat')->unique();
            $table->string('nama_alat');
            $table->foreignId('kategori_id')->constrained('kategori_barang');
            $table->unsignedInteger('jumlah_total');
            $table->unsignedInteger('jumlah_tersedia');
            $table->enum('kondisi', ['baik', 'rusak', 'hilang'])->default('baik');
            $table->string('lokasi');
            $table->text('deskripsi')->nullable();
            $table->string('barcode_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat');
    }
};
