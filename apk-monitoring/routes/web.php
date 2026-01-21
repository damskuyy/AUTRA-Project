<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\LoginController;

// ==========================================
// AUTH ROUTES
// ==========================================
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/api/login', [LoginController::class, 'store'])->name('api.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==========================================
// PROTECTED ROUTES
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    });

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/control', function () {
        return view('control.index');
    });

    // ==========================================
    // LAPORAN ROUTES (Updated with Export)
    // ==========================================
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('/laporan/statistics', [LaporanController::class, 'statistics'])->name('laporan.statistics');

    // API endpoint untuk menerima data dari PLC
    Route::post('/api/sensor-data', [LaporanController::class, 'store'])->name('api.sensor-data.store');

    // Cleanup old data (optional - dapat dijadwalkan di cron)
    Route::delete('/laporan/cleanup', [LaporanController::class, 'cleanup'])->name('laporan.cleanup');

    // ==========================================
    // NOTIFIKASI ROUTES
    // ==========================================
    Route::get('/notifikasi', [NotifikasiController::class, 'index']);
    Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead']);
    Route::post('/notifikasi/read-all', [NotifikasiController::class, 'markAllAsRead']);
    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy']);

    // ==========================================
    // MANAGE USER ROUTES
    // ==========================================
    Route::get('/manage-user', [ManageUserController::class, 'index'])->name('manage-user.index');
    Route::post('/manage-user', [ManageUserController::class, 'store'])->name('manage-user.store');
    Route::get('/manage-user/{id}', [ManageUserController::class, 'show'])->name('manage-user.show');
    Route::put('/manage-user/{id}', [ManageUserController::class, 'update'])->name('manage-user.update');
    Route::delete('/manage-user/{id}', [ManageUserController::class, 'destroy'])->name('manage-user.destroy');

    // ==========================================
    // API REALTIME (untuk Dashboard)
    // ==========================================
    Route::get('/api/realtime', function () {
        return response()->json([
            'time' => now()->format('H:i:s'),
            'temperature' => rand(28, 35),
            'light' => rand(300, 800),
            'humidity' => rand(45, 70),
        ]);
    });
});