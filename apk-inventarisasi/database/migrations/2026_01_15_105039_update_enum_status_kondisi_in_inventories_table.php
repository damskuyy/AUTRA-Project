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
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('kondisi');
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->enum('status', ['TERSEDIA', 'DIPINJAM', 'HILANG', 'DIPERBAIKI', 'RUSAK'])->default('TERSEDIA')->after('barang_masuk_id');
            $table->enum('kondisi', ['BAIK', 'RUSAK_RINGAN', 'RUSAK_BERAT', 'HILANG'])->default('BAIK')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('kondisi');
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->enum('status', ['TERSEDIA', 'DIPINJAM', 'HILANG', 'DIPERBAIKI'])->default('TERSEDIA')->after('barang_masuk_id');
            $table->enum('kondisi', ['BAIK', 'RUSAK_RINGAN', 'RUSAK_BERAT'])->default('BAIK')->after('status');
        });
    }
};
