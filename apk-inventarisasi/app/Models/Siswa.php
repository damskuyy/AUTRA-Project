<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'is_active',
        'is_banned',
        'banned_until',
        'alasan_ban',
        'total_poin',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_banned' => 'boolean',
        'banned_until' => 'datetime',
    ];

    /* ================= RELATIONS ================= */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function pelanggarans()
    {
        return $this->hasMany(Pelanggaran::class);
    }

    /* ================= AUTO BAN ================= */
    public function checkAndAutoBan()
    {
        if ($this->total_poin >= 3 && !$this->is_banned) {
            $this->update([
                'is_banned'   => true,
                'banned_until'=> null,
                'alasan_ban'  => 'Mencapai 3 poin pelanggaran',
            ]);
        }
    }

    public function unban()
    {
        $this->update([
            'is_banned' => false,
            'is_active' => true,
            'banned_until' => null,
            'alasan_ban' => null,
            'total_poin' => 0,
        ]);
    }

    public function isBanned()
    {
        return $this->is_banned;
    }
}
