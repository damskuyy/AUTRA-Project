<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SensorData extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'sensor_datas';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'waktu',
        'suhu',
        'cahaya',
        'kelembapan',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'waktu' => 'datetime',
        'suhu' => 'decimal:2',
        'kelembapan' => 'decimal:2',
    ];

    /**
     * Automatically determine status based on sensor values.
     */
    public static function determineStatus($suhu, $cahaya, $kelembapan)
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
     * Scope untuk filter berdasarkan status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan range tanggal.
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('waktu', [$startDate, $endDate]);
    }

    /**
     * Scope untuk data hari ini.
     */
    public function scopeToday($query)
    {
        return $query->whereDate('waktu', Carbon::today());
    }

    /**
     * Scope untuk data minggu ini.
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('waktu', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    /**
     * Scope untuk data bulan ini.
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('waktu', Carbon::now()->month)
                     ->whereYear('waktu', Carbon::now()->year);
    }

    /**
     * Accessor untuk format waktu yang lebih readable.
     */
    public function getFormattedWaktuAttribute()
    {
        return $this->waktu->format('d M Y H:i:s');
    }

    /**
     * Accessor untuk status color class.
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'Normal' => 'success',
            'Warning' => 'warning',
            'Danger' => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Generate hourly summary based on SensorReading data.
     * Returns the created SensorData instance or null when nothing created.
     */
    public static function generateHourlySummary($from = null, $to = null)
    {
        $from = $from ? \Carbon\Carbon::parse($from) : \Carbon\Carbon::now()->subHour();
        $to = $to ? \Carbon\Carbon::parse($to) : \Carbon\Carbon::now();

        // Check if PLC is online (latest reading online and recent)
        $latest = \App\Models\SensorReading::latest('received_at')->first();
        if (! $latest || $latest->status !== 'ONLINE' || $latest->received_at->lt(\Carbon\Carbon::now()->subMinutes(5))) {
            return null; // PLC not online or no recent data
        }

        $rows = \App\Models\SensorReading::whereBetween('received_at', [$from, $to])->get();
        if ($rows->isEmpty()) {
            return null; // no data
        }

        // Mapping: sensor1 = humidity, sensor2 = temperature (suhu), sensor3 = lux (cahaya)
        $avgHumidity = round($rows->avg('sensor1'), 2);
        $avgTemp = round($rows->avg('sensor2'), 2);
        $avgLux = round($rows->avg('sensor3'), 2);

        $status = self::determineStatus($avgTemp, $avgLux, $avgHumidity);

        return self::create([
            'waktu' => \Carbon\Carbon::now(),
            'suhu' => $avgTemp,
            'cahaya' => $avgLux,
            'kelembapan' => $avgHumidity,
            'status' => $status,
        ]);
    }
}