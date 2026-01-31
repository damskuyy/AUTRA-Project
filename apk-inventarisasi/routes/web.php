<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    DashboardController,
    InventoriesController,
    BarangMasukController,
    ItemsController,
    RuanganController,
    SiswaController,
    ScanController,
    PemakaianBahanController,
    PeminjamanController,
    PengembalianController,
    TransaksiMassalController,
    LogController,
    ExportController,
    ProfileController,
    SarprasController
};

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | MASTER DATA
    |--------------------------------------------------------------------------
    */
    Route::resource('barang-masuk', BarangMasukController::class);

    Route::resource('inventaris', InventoriesController::class)
        ->parameters(['inventaris' => 'inventaris']);

    Route::get(
        'inventaris/generate-qr-bulk/{barangMasuk}',
        [InventoriesController::class, 'generateQrBulk']
    )->name('inventaris.generateQrBulk');

    Route::resource('items', ItemsController::class);
    Route::resource('ruangan', RuanganController::class);
    Route::resource('siswa', SiswaController::class);

    Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
    Route::post('/siswa/{siswa}/ban', [SiswaController::class, 'ban'])->name('siswa.ban');
    Route::post('/siswa/{siswa}/unban', [SiswaController::class, 'unban'])->name('siswa.unban');
    Route::post('/siswa/naik-kelas', [SiswaController::class, 'naikKelasMassal'])
        ->name('siswa.naik-kelas');

    /*
    |--------------------------------------------------------------------------
    | SCAN QR
    |--------------------------------------------------------------------------
    */
    Route::get('/scan-qr', [ScanController::class, 'index'])->name('scan.index');
    Route::post('/scan-qr/process', [ScanController::class, 'process'])->name('scan.process');

    // Form berdasarkan hasil scan
    Route::get(
        '/scan-qr/pemakaian-bahan/{inventory}',
        [PemakaianBahanController::class, 'form']
    )->name('form.pemakaian-bahan-form');

    Route::get(
        '/scan-qr/peminjaman/{inventory}',
        [PeminjamanController::class, 'form']
    )->name('form.peminjaman-form');

    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI
    |--------------------------------------------------------------------------
    */
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])
        ->name('peminjaman.index');

    Route::post('/peminjaman', [PeminjamanController::class, 'store'])
        ->name('peminjaman.store');

    Route::post('/pemakaian-bahan', [PemakaianBahanController::class, 'store'])
        ->name('pemakaian-bahan.store');

    /*
    |--------------------------------------------------------------------------
    | PENGEMBALIAN
    |--------------------------------------------------------------------------
    */
    Route::get('/pengembalian', [PengembalianController::class, 'index'])
        ->name('pengembalian.index');

    Route::get(
        '/pengembalian/{peminjaman}/create',
        [PengembalianController::class, 'create']
    )->name('pengembalian.create');

    Route::post('/pengembalian', [PengembalianController::class, 'store'])
        ->name('pengembalian.store');

    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI MASSAL
    |--------------------------------------------------------------------------
    */
    Route::prefix('transaksi-massal')->group(function () {

        Route::get('/', [TransaksiMassalController::class, 'index'])
            ->name('transaksi.massal.index');

        Route::get('/create', [TransaksiMassalController::class, 'create'])
            ->name('transaksi.massal.create');

        Route::post('/store', [TransaksiMassalController::class, 'store'])
            ->name('transaksi.massal.store');

        Route::get(
            '/kembalikan/{transaksi}',
            [TransaksiMassalController::class, 'showFormKembalikan']
        )->name('transaksi.massal.formKembalikan');

        Route::post(
            '/kembalikan/{transaksi}',
            [TransaksiMassalController::class, 'formKembalikan']
        )->name('transaksi.massal.prosesKembalikan');

        Route::get('/riwayat', [TransaksiMassalController::class, 'riwayat'])
            ->name('transaksi.massal.riwayat');
    });

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT AKTIVITAS
    |--------------------------------------------------------------------------
    */
    Route::get('/riwayat-aktivitas', [LogController::class, 'index'])
        ->name('riwayat-aktivitas.index');

    Route::get(
        '/riwayat-aktivitas/export/excel',
        [ExportController::class, 'excel']
    )->name('riwayat-aktivitas.export.excel');

    Route::get(
        '/riwayat-aktivitas/export/pdf',
        [ExportController::class, 'pdf']
    )->name('riwayat-aktivitas.export.pdf');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])
        ->name('profile.update');

    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');

    /*
    |--------------------------------------------------------------------------
    | SARPRAS
    |--------------------------------------------------------------------------
    */
    Route::post('/barang-masuk/sarpras/scan',[SarprasController::class, 'scan'])->name('sarpras.scan');

    Route::post('/barang-masuk/sarpras/store',[SarprasController::class, 'store'])->name('sarpras.store');

});
