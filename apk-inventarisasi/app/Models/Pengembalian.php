<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id',
        'tanggal_pengembalian',
        'kondisi_barang',
        'keterangan',
        'foto_bukti',
    ];

    protected $casts = [
        'tanggal_pengembalian' => 'datetime',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
