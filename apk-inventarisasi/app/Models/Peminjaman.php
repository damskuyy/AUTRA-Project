<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'siswa_id',
        'mapel',
        'ruangan_id',
        'waktu_pinjam',
        'waktu_kembali_rencana',
        'waktu_kembali_real',
        'status',
        'kode_pinjam',
        'kode_verifikasi',
        'expired_at',
        'alasan_penolakan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }
}
