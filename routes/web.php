<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/{locale}', \App\Http\Controllers\LocalizationController::class)
    ->name('lang.switcher');
