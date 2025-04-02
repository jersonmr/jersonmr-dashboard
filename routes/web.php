<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin');

Route::get('lang/{locale}', \App\Http\Controllers\LocalizationController::class)
    ->name('lang.switcher');
