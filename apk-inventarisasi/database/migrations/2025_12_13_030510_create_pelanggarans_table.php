<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('peminjaman_id')->nullable()->constrained('peminjamans')->onDelete('cascade');
            $table->enum('tipe', ['TELAT_KEMBALI', 'KERUSAKAN', 'HILANG']);
            $table->integer('poin');
            $table->text('keterangan')->nullable();
            $table->timestamp('tanggal_kejadian');
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')
                ->references('id')
                ->on(DB::raw('`users`'));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggarans');
    }
};