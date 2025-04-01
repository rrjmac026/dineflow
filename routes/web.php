<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('menu', MenuController::class);
    Route::resource('feedback', FeedbackController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('inventory', InventoryController::class);

});

Route::middleware(['auth', 'verified', 'customer'])->group(function () {
    // Customer Routes
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        Route::get('/menu', [CustomerController::class, 'menu'])->name('menu');
        Route::get('/orders', [CustomerController::class, 'orders'])->name('orders');
        Route::get('/feedback', [CustomerController::class, 'feedback'])->name('feedback');
        Route::post('/order', [CustomerController::class, 'placeOrder'])->name('order');
        Route::post('/feedback', [CustomerController::class, 'submitFeedback'])->name('feedback.store');
    });
});

require __DIR__.'/auth.php';
