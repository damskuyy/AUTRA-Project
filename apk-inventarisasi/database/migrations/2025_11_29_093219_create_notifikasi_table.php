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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('judul');
            $table->text('pesan');
            $table->boolean('status_baca')->default(false);
            $table->timestamp('tanggal_kirim');
            $table->enum('jenis', ['peminjaman', 'pemakaian', 'pengembalian', 'pelanggaran', 'blokir', 'system']);
            $table->foreignId('peminjaman_id')->nullable()->constrained('peminjaman');
            $table->foreignId('pemakaian_bahan_id')->nullable()->constrained('pemakaian_bahan');
            $table->foreignId('pelanggaran_id')->nullable()->constrained('pelanggaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
