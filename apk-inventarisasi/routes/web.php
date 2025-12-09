<?php

use Illuminate\Support\Facades\Route;

Route::get('/data-inventaris', function () {
    return view('data-inventaris.index');
});


Route::get('/data-pengembalian', function () {
    return view('data-pengembalian.index');
});

Route::get('/inventaris', function () {
    return view('inventaris.index');
});

Route::get('/laporan', function () {
    return view('laporan.index');
});

Route::get('/manage-user', function () {
    return view('manage-user.index');
});


Route::get('/notifikasi', function () {
    return view('notifikasi.index');
});

Route::get('/pemakaian', function () {
    return view('pemakaian.index');
});

Route::get('/peminjaman', function () {
    return view('peminjaman.index');
});

Route::get('/pengembalian', function () {
    return view('pengembalian.index');
});

Route::get('/persetujuan-alat', function () {
    return view('persetujuan-alat.index');
});

Route::get('/persetujuan-bahan', function () {
    return view('persetujuan-bahan.index');
});

// Route::get('/', function () {
//     return view('siswa.index');
// });

Route::get('/', function () {
    return view('admin.index');
});

// Custom responsive login for design mock
Route::get('/login', function () {
    return view('login.login');
});

