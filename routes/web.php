<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdmin\LoginController as SuperAdminLoginController;
use App\Http\Controllers\SuperAdmin\RegisterController as SuperAdminRegisterController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;

    
foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        
        Route::get('/', function () {
            return view('superadmin.welcome');
        });

        Route::prefix('superadmin')->group(function () {
        // Public routes (no auth)
            Route::get('/login', [SuperAdminLoginController::class, 'showLoginForm'])->name('superadmin.login');
            Route::post('/login', [SuperAdminLoginController::class, 'login']);
            Route::get('/register', [SuperAdminRegisterController::class, 'showRegistrationForm'])->name('superadmin.register');
            Route::post('/register', [SuperAdminRegisterController::class, 'registerTenant']);
            Route::get('/welcome', function () {
                return view('superadmin/welcome');
            });

            // Protected routes (auth + superadmin role)
            Route::middleware(['auth', 'role:superadmin'])->group(function () {
                Route::get('/tenants', [SuperAdminController::class, 'index'])->name('superadmin.tenants.index');
                Route::get('/tenants/create', [SuperAdminController::class, 'create'])->name('superadmin.tenants.create');
                Route::post('/tenants', [SuperAdminController::class, 'store'])->name('superadmin.tenants.store');
                Route::get('/tenants/{tenant}', [SuperAdminController::class, 'show'])->name('superadmin.tenants.show');
                Route::delete('/tenants/{tenant}', [SuperAdminController::class, 'destroy'])->name('superadmin.tenants.destroy');

                // Optional: For approving/rejecting tenants
                Route::post('/tenants/{tenant}/approve', [SuperAdminController::class, 'approve'])->name('superadmin.tenants.approve');
                Route::post('/tenants/{tenant}/reject', [SuperAdminController::class, 'reject'])->name('superadmin.tenants.reject');

                Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
                Route::post('/logout', [SuperAdminLoginController::class, 'logout'])->name('superadmin.logout');
                // Route::get('/dashboard', fn () => view('superadmin.dashboard'))->name('superadmin.dashboard');
                
            });
        });
    });
}


    





    
