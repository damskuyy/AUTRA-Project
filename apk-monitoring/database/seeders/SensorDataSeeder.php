<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SensorData;
use Carbon\Carbon;

class SensorDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 50 dummy sensor data
        for ($i = 50; $i >= 1; $i--) {
            $datetime = Carbon::now()->subHours($i);
            
            // Random sensor values
            $suhu = round(rand(250, 350) / 10, 1); // 25.0 - 35.0
            $cahaya = rand(300, 800); // 300 - 800
            $kelembapan = round(rand(500, 700) / 10, 1); // 50.0 - 70.0
            
            // Determine status based on values
            $status = 'Normal';
            
            // Logic untuk menentukan status
            if ($suhu > 33 || $cahaya > 700 || $kelembapan > 68) {
                $status = 'Danger';
            } elseif ($suhu > 31 || $cahaya > 600 || $kelembapan > 65) {
                $status = 'Warning';
            }
            
            SensorData::create([
                'waktu' => $datetime->format('d/m/Y, H.i.s'),
                'suhu' => $suhu,
                'cahaya' => $cahaya,
                'kelembapan' => $kelembapan,
                'status' => $status
            ]);
        }
    }
}