<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\{InventoriesController, BarangMasukController, DashboardController, LoginController, SiswaController, RuanganController, ItemsController,
ScanController, PemakaianBahanController, PeminjamanController};

// Arahkan root ke login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Semua halaman lain
Route::middleware('auth')->group(function () {
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('inventaris', InventoriesController::class)->parameters(['inventaris' => 'inventaris']);
    Route::get('inventaris/{inventaris}/generate-qr', [InventoriesController::class, 'generateQr'])->name('inventaris.generateQr');
    Route::resource('items', App\Http\Controllers\ItemsController::class);
    Route::get("/dashboard", [DashboardController::class, "index"])->name('dashboard');
    Route::resource('riwayat-aktivitas', App\Http\Controllers\LogController::class);
    Route::resource('pengembalian', App\Http\Controllers\PengembalianController::class);
    Route::resource('ruangan', RuanganController::class);
    Route::resource('siswa', SiswaController::class);
    Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
    //Route::resource('scan-qr', App\Http\Controllers\ScanController::class);
    Route::resource('items', ItemsController::class);
    
    Route::get('/scan-qr', [ScanController::class, 'index'])->name('scan.index');
    Route::post('/scan-qr/process', [ScanController::class, 'process'])->name('scan.process');

    Route::get('/pemakaian-bahan/form/{inventory}', 
        [PemakaianBahanController::class, 'form'])
        ->name('pemakaian-bahan-form');

    Route::get('/peminjaman/form/{inventory}', 
        [PeminjamanController::class, 'form'])
        ->name('peminjaman-form');

    Route::get('/pemakaian-bahan', 
        [PemakaianBahanController::class, 'index'])
        ->name('pemakaian-bahan.index');

    Route::get('/peminjaman', 
        [PeminjamanController::class, 'index'])
        ->name('peminjaman.index');


});

Route::get('/riwayat-aktivitas', function () {
    return view('riwayat-aktivitas.index');
});

