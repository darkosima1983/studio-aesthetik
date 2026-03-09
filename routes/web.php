<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Dodaj ovo za svaki slučaj
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// 1. Osnovne javne rute
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// 2. Autentifikacija
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 3. Resursi (Klijentski deo)
Route::resource('services', ServiceController::class);
Route::resource('products', ProductController::class);
Route::resource('appointments', AppointmentController::class)->middleware('auth');
Route::resource('messages', MessageController::class);

// 4. Admin Panel (Zaštićeno)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Ovo će biti početna strana kad admin klikne na "Admin Bereich"
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/appointments', [AdminController::class, 'index'])->name('admin.appointments.index');
    Route::patch('/appointments/{id}/approve', [AdminController::class, 'approve'])->name('admin.appointments.approve');
    Route::patch('/appointments/{id}/reject', [AdminController::class, 'reject'])->name('admin.appointments.reject');
    
    // Ostalo (usluge, proizvodi, poruke) ćemo dodati kasnije u statistiku
});