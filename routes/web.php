<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerManagementController;
use App\Http\Controllers\UserManagementController;
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
            Route::resource('customers', CustomerManagementController::class);
            Route::resource('orders', OrderController::class);
            Route::resource('reservations', ReservationController::class);
            Route::resource('inventory', InventoryController::class);
            Route::resource('users', UserManagementController::class);
        });

        // Route::middleware(['auth', 'manager'])->group(function () {
        //     // Manager can only access orders, reservations and inventory
        //     Route::resource('orders', OrderController::class);
        //     Route::resource('reservations', ReservationController::class);
        //     Route::resource('inventory', InventoryController::class);

        //     // Additional order management routes
        //     Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
        //     Route::patch('/orders/{order}/payment', [OrderController::class, 'updatePayment'])->name('orders.update-payment');

        //     // Additional reservation management routes
        //     Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.update-status');
        // });

        // Route::middleware(['auth', 'staff'])->group(function () {
        //     // Staff can only access orders and customers
        //     Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        //     Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        //     Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
            
        //     // Limited customer access - view only
        //     Route::get('/customers', [CustomerManagementController::class, 'index'])->name('customers.index');
        //     Route::get('/customers/{customer}', [CustomerManagementController::class, 'show'])->name('customers.show');
        // });

        Route::middleware(['auth', 'customer'])->group(function () {
            // Customer Routes
            Route::prefix('customer')->name('customer.')->group(function () {
                Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
                Route::get('/menu', [CustomerController::class, 'menu'])->name('menu');
                Route::get('/orders', [CustomerController::class, 'orders'])->name('orders');
                Route::get('/feedback', [CustomerController::class, 'feedback'])->name('feedback');
                Route::post('/feedback', [CustomerController::class, 'submitFeedback'])->name('feedback.store');
                Route::post('/place-order', [CustomerController::class, 'placeOrder'])->name('order');
                Route::delete('/orders/{order}/cancel', [CustomerController::class, 'cancelOrder'])->name('orders.cancel');

                Route::get('/reservations', [CustomerController::class, 'reservations'])->name('reservations');
                Route::get('/reservations/create', [CustomerController::class, 'createReservation'])->name('reservations.create');
                Route::post('/reservations', [CustomerController::class, 'storeReservation'])->name('reservations.store');
                Route::delete('/reservations/{reservation}', [CustomerController::class, 'cancelReservation'])->name('reservations.cancel');
            });
        });

require __DIR__.'/auth.php';
