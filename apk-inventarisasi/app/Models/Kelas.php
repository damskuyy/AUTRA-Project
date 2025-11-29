<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'batas_pelanggaran',
        'total_pelanggaran',
        'status_blokir',
        'tanggal_blokir_mulai',
        'tanggal_blokir_selesai',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
