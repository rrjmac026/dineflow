<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
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

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::get('/welcome', function () {
            return view('welcome');
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
});
