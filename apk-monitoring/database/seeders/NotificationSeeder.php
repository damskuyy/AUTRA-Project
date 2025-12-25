<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use Carbon\Carbon;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notifications = [
            [
                'title' => 'Suhu Tinggi Terdeteksi',
                'message' => 'Suhu mencapai 34.5°C, melebihi batas normal',
                'type' => 'warning',
                'is_read' => false,
                'created_at' => Carbon::now()->subMinutes(5)
            ],
            [
                'title' => 'Kelembapan Rendah',
                'message' => 'Kelembapan turun hingga 45%, segera lakukan pengecekan',
                'type' => 'danger',
                'is_read' => false,
                'created_at' => Carbon::now()->subMinutes(10)
            ],
            [
                'title' => 'Sistem Beroperasi Normal',
                'message' => 'Semua sensor berfungsi dengan baik',
                'type' => 'info',
                'is_read' => true,
                'created_at' => Carbon::now()->subHours(1)
            ],
            [
                'title' => 'Intensitas Cahaya Rendah',
                'message' => 'Cahaya turun ke 250 Lux, periksa pencahayaan',
                'type' => 'warning',
                'is_read' => true,
                'created_at' => Carbon::now()->subHours(2)
            ],
            [
                'title' => 'Motor Utama Mati',
                'message' => 'Motor utama telah dimatikan oleh sistem',
                'type' => 'danger',
                'is_read' => true,
                'created_at' => Carbon::now()->subHours(3)
            ],
            [
                'title' => 'Update Sistem Berhasil',
                'message' => 'Sistem telah berhasil diupdate ke versi terbaru',
                'type' => 'success',
                'is_read' => true,
                'created_at' => Carbon::now()->subHours(5)
            ],
            [
                'title' => 'Backup Data Selesai',
                'message' => 'Proses backup data sensor telah selesai',
                'type' => 'info',
                'is_read' => true,
                'created_at' => Carbon::now()->subHours(8)
            ],
            [
                'title' => 'Suhu Normal Kembali',
                'message' => 'Suhu telah kembali ke range normal',
                'type' => 'success',
                'is_read' => true,
                'created_at' => Carbon::now()->subHours(12)
            ],
        ];

        foreach ($notifications as $notification) {
            Notification::create($notification);
        }
    }
}