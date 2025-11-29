<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    protected $table = 'pelanggaran';

    protected $fillable = [
        'siswa_id',
        'peminjaman_id',
        'jenis_pelanggaran',
        'tanggal_pelanggaran',
        'status',
        'deskripsi',
        'sanksi',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }
}
