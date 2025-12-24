<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\{InventoriesController, BarangMasukController, DashboardController, LoginController, SiswaController};

// Arahkan root ke login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Semua halaman lain
Route::middleware('auth')->group(function () {
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('inventaris', InventoriesController::class);
    Route::get('inventaris/{inventaris}/generate-qr', [InventoriesController::class, 'generateQr'])->name('inventaris.generateQr');
    Route::resource('items', App\Http\Controllers\ItemsController::class);
    Route::get("/dashboard", [DashboardController::class, "index"])->name('dashboard');
    Route::resource('peminjaman', App\Http\Controllers\PeminjamanController::class);
    Route::resource('pemakaian-bahan', App\Http\Controllers\PemakaianBahanController::class);
    Route::resource('riwayat-aktivitas', App\Http\Controllers\LogController::class);
    Route::resource('pengembalian', App\Http\Controllers\PengembalianController::class);
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
    Route::resource('scan-qr', App\Http\Controllers\ScanController::class);
});

Route::get('/pemakaian-bahan', function () {
    return view('pemakaian-bahan.index');
});

Route::get('/riwayat-aktivitas', function () {
    return view('riwayat-aktivitas.index');
});

Route::get('/peminjaman', function () {
    return view('peminjaman.index');
});

Route::get('/scan-qr', function () {
    return view('scan-qr.index');
});

Route::get('/siswa', function () {
    return view('siswa.index');
});
