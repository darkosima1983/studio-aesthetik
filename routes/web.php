<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;

// 1. JAVNE RUTE
Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::get('/contact', function () { return view('contact'); })->name('contact');

// 2. AUTENTIFIKACIJA
Auth::routes();

// 3. KLIJENTSKI RESURSI
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::resource('appointments', AppointmentController::class)->middleware('auth');

// SAMO store ruta za klijente da pošalju poruku
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

// 4. ADMIN PANEL (prefix 'admin', name 'admin.')
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard & Termini
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/appointments', [AdminController::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{appointment}/approve', [AdminController::class, 'approve'])->name('appointments.approve');
    Route::patch('/appointments/{appointment}/reject', [AdminController::class, 'reject'])->name('appointments.reject');

    // CRUD za Usluge i Proizvode (Admin deo)
    // .names('services') automatski pravi admin.services.index, admin.services.create itd.
    Route::resource('services', ServiceController::class)->names('services');
    Route::resource('products', ProductController::class)->names('products');

    // Upravljanje Porukama (Admin pregled i brisanje)
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});