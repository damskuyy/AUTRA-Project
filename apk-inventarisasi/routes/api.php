<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ScanSarprasController;

Route::get('/sarpras/by-kode-barang/{kode}',[ScanSarprasController::class, 'byKodeBarang']);
