<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NotifikasiController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard.index-v3');
});
Route::get('/control', function () {
    return view('control.index');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/laporan', function () {
    return view('laporan.index');
});
Route::get('/laporan', [LaporanController::class, 'index']);

Route::get('/notifikasi', [NotifikasiController::class, 'index']);
Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead']);
Route::post('/notifikasi/read-all', [NotifikasiController::class, 'markAllAsRead']);
Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy']);

Route::get('/manage-user', function () {
    return view('manage-user.index');
});

Route::get('/api/realtime', function () {
    return response()->json([
        'time' => now()->format('H:i:s'),
        'temperature' => rand(28, 35),
        'light' => rand(300, 800),
        'humidity' => rand(45, 70),
    ]);
});
