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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjamans')->onDelete('cascade'); // Relasi ke transaksi peminjaman
            $table->foreignId('admin_id')->constrained('users'); // Admin yang memproses pengembalian
            $table->timestamp('waktu_kembali');
            $table->enum('kondisi', ['BAIK', 'RUSAK_RINGAN', 'RUSAK_BERAT']);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
