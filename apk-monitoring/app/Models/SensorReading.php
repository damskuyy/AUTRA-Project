<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorReading extends Model
{
    protected $table = 'sensor_readings';

    protected $fillable = [
        'sensor1',
        'sensor2',
        'sensor3',
        'status',
        'received_at',
        'is_summary',
        'condition'
    ];

    protected $casts = [
        'received_at' => 'datetime',
        'is_summary' => 'boolean',
        'sensor1' => 'decimal:2',
        'sensor2' => 'decimal:2',
        'sensor3' => 'decimal:2',
    ];

    public $timestamps = true;

    // Accessors to match previous SensorData naming
    public function getWaktuAttribute()
    {
        return $this->received_at;
    }

    public function getSuhuAttribute()
    {
        return $this->sensor2; // sensor2 is temperature
    }

    public function getCahayaAttribute()
    {
        return $this->sensor3; // sensor3 is lux
    }

    public function getKelembapanAttribute()
    {
        return $this->sensor1; // sensor1 is humidity
    }

    /**
     * Determine condition (Normal/Warning/Danger) from values
     */
    public static function determineCondition($suhu, $cahaya, $kelembapan)
    {
        // Danger conditions
        if ($suhu > 35 || $suhu < 20 || 
            $cahaya < 300 || $cahaya > 800 || 
            $kelembapan > 80 || $kelembapan < 40) {
            return 'Danger';
        }
        
        // Warning conditions
        if ($suhu > 32 || $suhu < 22 || 
            $cahaya < 350 || $cahaya > 750 || 
            $kelembapan > 75 || $kelembapan < 45) {
            return 'Warning';
        }
        
        // Normal
        return 'Normal';
    }

    /**
     * Generate hourly summary and save as a summary row in sensor_readings
     */
    public static function generateHourlySummary($from = null, $to = null)
    {
        $from = $from ? \Carbon\Carbon::parse($from) : \Carbon\Carbon::now()->subHour();
        $to = $to ? \Carbon\Carbon::parse($to) : \Carbon\Carbon::now();

        // Check if PLC is online (latest reading online and recent)
        $latest = self::latest('received_at')->first();
        if (! $latest || $latest->status !== 'ONLINE' || $latest->received_at->lt(\Carbon\Carbon::now()->subMinutes(5))) {
            return null; // PLC not online or no recent data
        }

        $rows = self::whereBetween('received_at', [$from, $to])->get();
        if ($rows->isEmpty()) {
            return null; // no data
        }

        $avgHumidity = round($rows->avg('sensor1'), 2);
        $avgTemp = round($rows->avg('sensor2'), 2);
        $avgLux = round($rows->avg('sensor3'), 2);

        $condition = self::determineCondition($avgTemp, $avgLux, $avgHumidity);

        $summary = self::create([
            'sensor1' => $avgHumidity,
            'sensor2' => $avgTemp,
            'sensor3' => $avgLux,
            'status' => 'ONLINE',
            'received_at' => \Carbon\Carbon::now(),
            'is_summary' => true,
            'condition' => $condition,
        ]);

        // Create a Notification record if condition is Danger or Warning
        try {
            if (class_exists(\App\Models\Notification::class)) {
                $type = strtolower($condition) === 'danger' ? 'danger' : (strtolower($condition) === 'warning' ? 'warning' : 'info');
                \App\Models\Notification::create([
                    'title' => "Summary: {$condition}",
                    'message' => "Hourly summary generated with condition {$condition}. Avg Temp: {$avgTemp}, Avg Lux: {$avgLux}, Avg Humidity: {$avgHumidity}.",
                    'type' => $type,
                    'is_read' => false,
                ]);
            }
        } catch (\Exception $e) {
            // Don't fail summary creation if notification fails
        }

        return $summary;
    }
}
