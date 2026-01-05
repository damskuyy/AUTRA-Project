<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas');
            $table->foreignId('inventory_id')->constrained('inventories');
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')
                ->references('id')
                ->on(DB::raw('`users`'));
            $table->integer('quantity')->default(1);
            $table->timestamp('waktu_pinjam');
            $table->timestamp('waktu_kembali_aktual')->nullable();
            $table->enum('kondisi_pinjam', ['BAIK', 'RUSAK_RINGAN', 'RUSAK_BERAT']);
            $table->text('catatan_pinjam')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};