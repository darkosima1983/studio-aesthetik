<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;

// 1. Javne rute (Gosti i Klijenti)
Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::get('/contact', function () { return view('contact'); })->name('contact');

// 2. Autentifikacija
Auth::routes();

// 3. Resursi za klijente (Samo pregled i slanje poruka/termina)
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::resource('appointments', AppointmentController::class)->middleware('auth');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

// 4. ADMIN PANEL (Potpuna kontrola)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard & Termini
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/appointments', [AdminController::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{appointment}/approve', [AdminController::class, 'approve'])->name('appointments.approve');
    Route::patch('/appointments/{appointment}/reject', [AdminController::class, 'reject'])->name('appointments.reject');

    // CRUD za Usluge (Dienstleistungen)
    // Ovo pokriva: listu, dodavanje, editovanje i brisanje usluga
    Route::resource('services', ServiceController::class)->except(['index', 'show']); 
    // Dodajemo index i show posebno ako želiš drugačiji prikaz za admina, 
    // ali resource je najbrži put:
    Route::resource('services', ServiceController::class)->names('services');

    // CRUD za Proizvode (Webshop Management)
    Route::resource('products', ProductController::class)->names('products');

    // Upravljanje Porukama
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});