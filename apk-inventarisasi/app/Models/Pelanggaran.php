<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggarans';

    protected $fillable = [
        'siswa_id',
        'peminjaman_id',
        'tipe',
        'poin',
        'keterangan',
        'tanggal_kejadian',
        'admin_id',
    ];

    protected $casts = [
        'tanggal_kejadian' => 'datetime',
        'poin' => 'integer',
    ];

    // Relasi
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}