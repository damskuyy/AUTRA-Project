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
        Schema::create('pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('peminjaman_id')->nullable()->constrained('transactions')->onDelete('cascade');
            $table->enum('tipe', ['TELAT_KEMBALI', 'KERUSAKAN', 'HILANG']);
            $table->integer('poin'); // Poin pelanggaran
            $table->text('keterangan')->nullable();
            $table->timestamp('tanggal_kejadian');
            $table->foreignId('admin_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggarans');
    }
};
