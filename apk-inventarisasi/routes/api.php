<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ScanSarprasController;
use App\Http\Controllers\Api\JurusantoiController;

Route::get('/sarpras/by-kode-barang/{kode}', [ScanSarprasController::class, 'byKodeBarang']);

Route::get('/jurusan/toi', [JurusantoiController::class, 'index']);