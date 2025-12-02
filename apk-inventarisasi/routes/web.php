<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('data-inventaris.index');
// });


// Route::get('/', function () {
//     return view('data-pengembalian.index');
// });

// Route::get('/', function () {
//     return view('inventaris.index');
// });

// Route::get('/', function () {
//     return view('laporan.index');
// });

// Route::get('/', function () {
//     return view('manage-user.index');
// });


// Route::get('/', function () {
//     return view('notifikasi.index');
// });

// Route::get('/', function () {
//     return view('pemakaian.index');
// });

// Route::get('/', function () {
//     return view('peminjaman.index');
// });

// Route::get('/', function () {
//     return view('pengembalian.index');
// });

// Route::get('/', function () {
//     return view('persetujuan-alat.index');
// });

// Route::get('/', function () {
//     return view('persetujuan-bahan.index');
// });

// Route::get('/', function () {
//     return view('siswa.index');
// });

Route::get('/', function () {
    return view('admin.index');
});

Route::get('/login', function () {
    return view('login.login');
});

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:4',
    ]);


    return back()->with('status', 'Login attempt received for ' . $request->input('email'));
});