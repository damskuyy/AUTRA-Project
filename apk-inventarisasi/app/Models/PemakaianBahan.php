<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemakaianBahan extends Model
{
    protected $table = 'pemakaian_bahan';

    protected $fillable = [
        'siswa_id',
        'bahan_id',
        'jumlah_digunakan',
        'mapel',
        'ruangan_id',
        'tanggal_pakai',
        'status',
        'alasan_penolakan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function bahan()
    {
        return $this->belongsTo(Bahan::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }
}
