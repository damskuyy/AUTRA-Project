<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');  // Hapus constrained('users') di sini
            $table->string('judul');
            $table->text('pesan');
            $table->boolean('status_baca')->default(false);
            $table->timestamp('tanggal_kirim');
            $table->enum('jenis', ['peminjaman', 'pemakaian', 'pengembalian', 'pelanggaran', 'blokir', 'system']);
            $table->foreignId('peminjaman_id')->nullable()->constrained('peminjaman');  // Tetap, karena tabel lain mendapat prefix
            $table->foreignId('pemakaian_bahan_id')->nullable()->constrained('pemakaian_bahan');
            $table->foreignId('pelanggaran_id')->nullable()->constrained('pelanggaran');
            $table->timestamps();
        });

        // Tambahkan foreign key secara manual tanpa prefix untuk user_id
        DB::statement('ALTER TABLE inv_notifikasi ADD CONSTRAINT inv_notifikasi_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE inv_notifikasi DROP FOREIGN KEY inv_notifikasi_user_id_foreign');
        Schema::dropIfExists('notifikasi');
    }
};
