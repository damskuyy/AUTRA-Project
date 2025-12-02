<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Eksplisitkan tabel tanpa prefix (meskipun default sudah 'users')
    protected $table = 'users';

    protected $fillable = [
        'nama',
        'email',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',  // Tambahkan jika menggunakan remember token
    ];

    // Tambahkan casts untuk tipe data enum dan timestamps
    protected $casts = [
        'role' => 'string',  // Atau enum jika perlu validasi khusus
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi yang sudah ada
    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }
}
