<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingDashboardController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;

// Welcome
Route::get('/', function () {
    return view('welcome');
});

// Dashboard with auth
Route::get('/dashboard', [BookingDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('/notifications', [UserNotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-all-read', [UserNotificationController::class, 'markAllRead'])->name('notifications.markAllRead');

    // Admin-only Booking Panel
    Route::middleware('can:viewAny,App\Models\User')->group(function () {
        Route::get('/admin/bookings', [BookingAdminController::class, 'index'])->name('admin.bookings.index');
        Route::delete('/admin/bookings/{booking}', [BookingAdminController::class, 'destroy'])->name('admin.bookings.destroy');
    });

    // Booking routes (renamed to avoid collision)
    Route::prefix('my-bookings')->name('mybookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::get('/create', [BookingController::class, 'create'])->name('create');
        Route::post('/', [BookingDashboardController::class, 'store'])->name('store');
        Route::get('/{booking}/edit', [BookingDashboardController::class, 'edit'])->name('edit');
        Route::put('/{booking}', [BookingDashboardController::class, 'update'])->name('update');
        Route::delete('/{booking}', [BookingDashboardController::class, 'destroy'])->name('destroy');
    });

    // User management
    Route::resource('users', UserController::class);
});


require __DIR__.'/auth.php';
