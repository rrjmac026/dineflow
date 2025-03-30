<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Customer accessible routes
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/{menu}', [MenuController::class, 'show'])->name('menu.show');
    
    // Feedback routes
    Route::resource('feedback', FeedbackController::class);
    
    // Order routes
    Route::resource('orders', OrderController::class);
    
    // Reservation routes
    Route::resource('reservations', ReservationController::class);

    // Menu Management
    Route::resource('menu-management', MenuController::class)->except(['index', 'show']);
    
    // Inventory Management
    Route::resource('inventory', InventoryController::class);

     // Reports and Analytics
     Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
     Route::get('/reports/inventory', [ReportController::class, 'inventory'])->name('reports.inventory');

     Route::get('/kitchen/orders', [OrderController::class, 'kitchen'])->name('kitchen.orders');
     Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status.update');
});

// Route::middleware(['auth', 'role:management'])->group(function () {
    
// });

// Staff Routes
// Route::middleware(['auth', 'role:staff'])->group(function () {
   
// });

require __DIR__.'/auth.php';
