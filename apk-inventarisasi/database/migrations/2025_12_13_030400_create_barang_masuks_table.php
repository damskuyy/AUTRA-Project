<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->enum('jenis_barang', ['alat', 'bahan']);
            $table->integer('jumlah');
            $table->string('satuan')->nullable();
            $table->string('sumber');
            $table->string('nomor_dokumen')->nullable(); // untuk seri alat
            $table->foreignId('ruangan_id')->constrained('ruangans');
            $table->timestamp('tanggal_masuk');
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')
                ->references('id')
                ->on(DB::raw('`users`'));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};