<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'status_baca',
        'tanggal_kirim',
        'jenis',
        'peminjaman_id',
        'pemakaian_bahan_id',
        'pelanggaran_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function pemakaianBahan()
    {
        return $this->belongsTo(PemakaianBahan::class);
    }

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class);
    }
}
