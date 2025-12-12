<?php

use Illuminate\Support\Facades\Route;

// Arahkan root ke login
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login.login');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index');
});

// Semua halaman lain
Route::get('/barang-masuk', function () {
    return view('barang-masuk.index');
});

Route::get('/inventaris', function () {
    return view('inventaris.index');
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
