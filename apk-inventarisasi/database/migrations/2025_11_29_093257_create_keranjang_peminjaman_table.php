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
        Schema::create('keranjang_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa');
            $table->foreignId('alat_id')->nullable()->constrained('alat');
            $table->foreignId('bahan_id')->nullable()->constrained('bahan');
            $table->unsignedInteger('jumlah');
            $table->enum('tipe', ['alat', 'bahan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang_peminjaman');
    }
};
