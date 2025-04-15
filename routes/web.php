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

        



require __DIR__.'/auth.php';
