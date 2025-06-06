<?php

use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SuperAdmin\LoginController as SuperAdminLoginController;
use App\Http\Controllers\SuperAdmin\RegisterController as SuperAdminRegisterController;

    Route::get('/', function () {
        return view('welcome');
    });

    Route::prefix('superadmin')->group(function () {
    // Public routes (no auth)
        Route::get('/login', [SuperAdminLoginController::class, 'showLoginForm'])->name('superadmin.login');
        Route::post('/login', [SuperAdminLoginController::class, 'login']);
        Route::get('/register', [SuperAdminRegisterController::class, 'showRegistrationForm'])->name('superadmin.register');
        Route::post('/register', [SuperAdminRegisterController::class, 'register']);
        Route::get('/welcome', function () {
            return view('superadmin/welcome');
        });
        

        // Protected routes (auth + superadmin role)
        Route::middleware(['auth', 'role:superadmin'])->group(function () {
            Route::post('/logout', [SuperAdminLoginController::class, 'logout'])->name('superadmin.logout');
            Route::get('/dashboard', fn () => view('superadmin.dashboard'))->name('superadmin.dashboard');
            
        });
    });





    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

    // Admin routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::resource('admin/menu', MenuController::class);
        Route::resource('admin/feedback', FeedbackController::class);
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
    // staff
    
    //Routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::middleware('role:staff,admin')->group(function () {
            
            Route::resource('customers', CustomerManagementController::class);
        });

        Route::middleware('role:staff,admin,manager')->group(function () {
            Route::resource('orders', OrderController::class);
        });
        
        Route::middleware('role:manager,admin')->group(function () {
            
            Route::resource('reservations', ReservationController::class);
            Route::resource('inventory', InventoryController::class);
        });
    });

    
    

    Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
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

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Add these new register routes
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
