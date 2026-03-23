<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ShopController;

// 1. JAVNE RUTE
Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::get('/contact', function () { return view('contact'); })->name('contact');

// 2. AUTENTIFIKACIJA
Auth::routes();

// 3. KLIJENTSKI RESURSI
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');
Route::middleware('auth')->group(function () {
    Route::patch('appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::resource('appointments', AppointmentController::class);
});

// SAMO store ruta za klijente da pošalju poruku
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

// 4. ADMIN PANEL (prefix 'admin', name 'admin.')
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard & Termini
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/appointments', [AdminController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AdminController::class, 'createSlot'])->name('appointments.create');
    Route::post('/appointments/slot', [AdminController::class, 'storeSlot'])->name('appointments.storeSlot');
    
    // Akcije nad terminima
    Route::patch('/appointments/{appointment}/approve', [AdminController::class, 'approve'])->name('appointments.approve');
    Route::patch('/appointments/{appointment}/reject', [AdminController::class, 'reject'])->name('appointments.reject');
    Route::delete('/appointments/{appointment}', [AdminController::class, 'destroy'])->name('appointments.destroy');

    // CRUD za Usluge i Proizvode (Admin deo)
    // .names('services') automatski pravi admin.services.index, admin.services.create itd.
    Route::resource('services', ServiceController::class)->names('services');
    
    Route::get('products', [ProductController::class, 'adminIndex'])->name('products.index');
    Route::resource('products', ProductController::class)->except(['index'])->names('products');

    // Upravljanje Porukama (Admin pregled i brisanje)
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    //Users
    Route::get('/users', [AdminController::class, 'usersIndex'])->name('users.index');
    Route::get('/users/{user}', [AdminController::class, 'usersShow'])->name('users.show');
    Route::delete('/users/{user}', [AdminController::class, 'userDestroy'])->name('users.destroy');
    Route::patch('/users/{user}/notes', [AdminController::class, 'updateNotes'])->name('users.update_notes');

    // Rute za porudžbine
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');

});

// Korpa rute
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Checkout (privremeno samo view)
Route::get('/checkout', function() { return view('cart.checkout'); })->name('checkout');
Route::post('/place-order', [CartController::class, 'placeOrder'])->name('order.place');