<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';

    protected $fillable = ['nama_ruangan', 'lokasi'];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function pemakaianBahan()
    {
        return $this->hasMany(PemakaianBahan::class);
    }
}
