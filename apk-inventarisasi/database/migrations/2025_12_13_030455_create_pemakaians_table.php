<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemakaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas');
            $table->foreignId('inventory_id')->constrained('inventories');
            $table->string('keperluan')->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')
                ->references('id')
                ->on(DB::raw('`users`'));
            $table->integer('jumlah');
            $table->timestamp('waktu_pakai');
            $table->foreignId('ruangan_id')->constrained('ruangans');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemakaians');
    }
};