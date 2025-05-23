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
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
        Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware(['auth', 'verified'])->name('dashboard');

        Route::middleware(['auth', 'superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
            Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('dashboard');
            Route::resource('tenants', SuperAdminController::class);
            Route::post('tenants/{tenant}/approve', [SuperAdminController::class, 'approve'])->name('tenants.approve');
            Route::post('tenants/{tenant}/reject', [SuperAdminController::class, 'reject'])->name('tenants.reject');
        });


        // Tenant home page
    // Route::get('/', function () {
    //     return view('tenant.welcome');
    // });

    // Admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
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

        // Reports Routes
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/sales', [ReportController::class, 'salesReport'])->name('reports.sales');
        Route::get('/reports/inventory', [ReportController::class, 'inventoryReport'])->name('reports.inventory');
        Route::get('/reports/feedback', [ReportController::class, 'feedbackReport'])->name('reports.feedback');
    });

    // Customer routes
    Route::middleware(['auth', 'customer'])->prefix('customer')->name('customer.')->group(function () {
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

        



require __DIR__.'/auth.php';
