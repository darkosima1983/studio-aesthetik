<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MessageController;

// Rute za administraciju ili pregled
Route::resource('services', ServiceController::class);
Route::resource('products', ProductController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('messages', MessageController::class);
Route::get('/', function () {
    return view('welcome');
});
