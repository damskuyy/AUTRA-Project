<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PlcController;


Route::post('/plc-data', [PlcController::class, 'store']);
Route::get('/sensor-latest', function () {
    return DB::table('sensor_logs')
        ->latest()
        ->first();
});
Route::get('/sensor-history', function () {
    return DB::table('sensor_logs')
        ->orderBy('created_at', 'desc')
        ->limit(30)
        ->get()
        ->reverse()
        ->values();
});
