<?php

namespace Database\Seeders;

use App\Models\SensorData;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SensorDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        SensorData::truncate();

        $data = [];
        $now = Carbon::now();

        // Generate 200 records spanning the last 7 days
        for ($i = 200; $i >= 1; $i--) {
            // Calculate time (going backwards from now)
            $waktu = $now->copy()->subMinutes($i * 15); // Every 15 minutes
            
            // Generate realistic sensor values with some variation
            $hour = $waktu->hour;
            
            // Temperature: Higher during day (12-16), lower at night
            $baseTemp = ($hour >= 10 && $hour <= 16) ? 30 : 26;
            $suhu = $baseTemp + rand(-30, 50) / 10; // ±3°C variation
            $suhu = max(18, min(38, $suhu)); // Clamp between 18-38
            
            // Light: Higher during day, very low at night
            if ($hour >= 6 && $hour <= 18) {
                $cahaya = rand(400, 800);
            } else {
                $cahaya = rand(50, 300);
            }
            
            // Humidity: More variation
            $kelembapan = 60 + rand(-200, 200) / 10; // ±20% variation
            $kelembapan = max(30, min(90, $kelembapan)); // Clamp between 30-90
            
            // Determine status
            $status = SensorData::determineStatus($suhu, $cahaya, $kelembapan);
            
            $data[] = [
                'waktu' => $waktu,
                'suhu' => round($suhu, 2),
                'cahaya' => $cahaya,
                'kelembapan' => round($kelembapan, 2),
                'status' => $status,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ];
        }

        // Insert in chunks for better performance
        foreach (array_chunk($data, 50) as $chunk) {
            SensorData::insert($chunk);
        }

        $this->command->info('✅ Successfully seeded ' . count($data) . ' sensor data records!');
        
        // Show statistics
        $normalCount = SensorData::where('status', 'Normal')->count();
        $warningCount = SensorData::where('status', 'Warning')->count();
        $dangerCount = SensorData::where('status', 'Danger')->count();
        
        $this->command->info("📊 Statistics:");
        $this->command->info("   Normal: {$normalCount}");
        $this->command->info("   Warning: {$warningCount}");
        $this->command->info("   Danger: {$dangerCount}");
    }
}