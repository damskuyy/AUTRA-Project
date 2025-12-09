<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'admin_id');
    }

    public function pengembalians()
    {
        return $this->hasMany(Pengembalian::class, 'admin_id');
    }

    public function pemakaians()
    {
        return $this->hasMany(Pemakaian::class, 'admin_id');
    }

    public function pelanggarans()
    {
        return $this->hasMany(Pelanggaran::class, 'admin_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class, 'admin_id');
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'admin_id');
    }
}
