<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'nis',
        'kelas_id',
        'status',
        'tanggal_blokir',
        'tanggal_aktif_kembali',
        'no_hp',
        'alamat',
        'foto_profil',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function pemakaianBahan()
    {
        return $this->hasMany(PemakaianBahan::class);
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }

    public function keranjang()
    {
        return $this->hasMany(KeranjangPeminjaman::class);
    }
}
