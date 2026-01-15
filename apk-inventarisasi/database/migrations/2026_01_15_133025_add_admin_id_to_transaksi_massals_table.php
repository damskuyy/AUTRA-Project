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
        Schema::table('transaksi_massals', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksi_massals', 'admin_id')) {
                $table->unsignedBigInteger('admin_id')->nullable()->after('siswa_id');
                $table->foreign('admin_id')
                    ->references('id')
                    ->on(DB::raw('`users`'));
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_massals', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }
};
