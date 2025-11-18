<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('manage-user.index');
});
