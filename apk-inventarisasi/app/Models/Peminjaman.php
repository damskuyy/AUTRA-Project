<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'siswa_id',
        'inventory_id',
        'admin_id',
        'quantity',
        'waktu_pinjam',
        'waktu_kembali_aktual',
        'kondisi_pinjam',
        'catatan_pinjam',
    ];

    protected $casts = [
        'waktu_pinjam' => 'datetime',
        'waktu_kembali_aktual' => 'datetime',
    ];

    // Relasi
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id');
    }

    public function pelanggarans()
    {
        return $this->hasMany(Pelanggaran::class, 'peminjaman_id');
    }

    public function activityLogs()
    {
        return $this->morphMany(ActivityLog::class, 'subject');
    }

    // Helper methods
    public function isBelumKembali()
    {
        return is_null($this->waktu_kembali_aktual);
    }

    public function isTelat()
    {
        if ($this->waktu_kembali_aktual) {
            return false;
        }
        return now()->greaterThan($this->waktu_kembali_rencana);
    }
}