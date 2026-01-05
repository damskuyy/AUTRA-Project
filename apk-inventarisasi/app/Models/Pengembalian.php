<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalians';

    protected $fillable = [
        'peminjaman_id',
        'admin_id',
        'quantity',
        'waktu_kembali',
        'kondisi',
        'catatan',
    ];

    protected $casts = [
        'waktu_kembali' => 'datetime',
    ];

    // Relasi
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}