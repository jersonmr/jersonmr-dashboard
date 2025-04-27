<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('user-data', \App\Http\Controllers\HomeController::class);

Route::resource('projects', \App\Http\Controllers\ProjectController::class);
