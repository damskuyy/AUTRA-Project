<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeranjangPeminjaman extends Model
{
    protected $table = 'keranjang_peminjaman';

    protected $fillable = [
        'siswa_id',
        'alat_id',
        'bahan_id',
        'jumlah',
        'tipe',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    public function bahan()
    {
        return $this->belongsTo(Bahan::class);
    }
}
