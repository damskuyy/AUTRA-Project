<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\{InventoriesController, BarangMasukController, DashboardController, LoginController, SiswaController, RuanganController, ItemsController,
ScanController, PemakaianBahanController, PeminjamanController, PengembalianController, LogController, ExportController, ProfileController, SarprasController};

// Arahkan root ke login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Semua halaman lain
Route::middleware('auth')->group(function () {
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('inventaris', InventoriesController::class)->parameters(['inventaris' => 'inventaris']);
    Route::get(
        'inventaris/generate-qr-bulk/{barangMasuk}',
        [InventoriesController::class, 'generateQrBulk']
    )->name('inventaris.generateQrBulk');

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
    //FORM
    Route::get('/scan-qr/pemakaian-bahan/{inventory}', [PemakaianBahanController::class, 'form'])->name('form.pemakaian-bahan-form');
    Route::get('/scan-qr/peminjaman/{inventory}', [PeminjamanController::class, 'form'])->name('form.peminjaman-form');
    //STORY
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/pemakaian-bahan',[PemakaianBahanController::class, 'store'])->name('pemakaian-bahan.store');
    Route::post('/peminjaman',[PeminjamanController::class, 'store'])->name('peminjaman.store');

    Route::get('/pengembalian', [PengembalianController::class, 'index'])
    ->name('pengembalian.index');

    Route::get('/pengembalian/{peminjaman}/create', [PengembalianController::class, 'create'])->name('pengembalian.create');

    Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');

    Route::post('/siswa/{siswa}/ban', [SiswaController::class, 'ban'])->name('siswa.ban');
    Route::post('/siswa/{siswa}/unban', [SiswaController::class, 'unban'])->name('siswa.unban');
    Route::post('/siswa/naik-kelas', [SiswaController::class, 'naikKelasMassal'])->name('siswa.naik-kelas');

    Route::get('riwayat-aktivitas', [LogController::class, 'index'])->name('riwayat-aktivitas.index');

    Route::get('/riwayat-aktivitas/export/excel', [ExportController::class, 'excel'])
        ->name('riwayat-aktivitas.export.excel');

    Route::get('/riwayat-aktivitas/export/pdf', [ExportController::class, 'pdf'])
        ->name('riwayat-aktivitas.export.pdf');

    // Profile
    // Halaman Utama Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    // Proses Update Data (Nama/Email)
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    // Proses Update Password
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');



    //SARPRAS

    Route::post('/barang-masuk/sarpras/scan',
        [SarprasController::class, 'scan']
    )->name('sarpras.scan');

    Route::post('/barang-masuk/sarpras/store',
        [SarprasController::class, 'store']
    )->name('sarpras.store');
});


