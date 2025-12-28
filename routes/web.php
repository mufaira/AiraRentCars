<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\UserCarController;
use App\Models\CarPhoto;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rental routes (customers only)
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index')->middleware(\App\Http\Middleware\CustomerOnly::class);
    Route::get('/rentals/{rental}', [RentalController::class, 'show'])->name('rentals.show')->middleware(\App\Http\Middleware\CustomerOnly::class);
    Route::get('/cars/{car}/rent', [RentalController::class, 'create'])->name('rentals.create')->middleware(\App\Http\Middleware\CustomerOnly::class);
    Route::post('/cars/{car}/rent', [RentalController::class, 'store'])->name('rentals.store')->middleware(\App\Http\Middleware\CustomerOnly::class);
    Route::get('/rentals/{rental}/payment', [RentalController::class, 'payment'])->name('rentals.payment')->middleware(\App\Http\Middleware\CustomerOnly::class);
    Route::post('/rentals/{rental}/payment', [RentalController::class, 'storePayment'])->name('rentals.storePayment')->middleware(\App\Http\Middleware\CustomerOnly::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard & Infografis
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/infografis', [DashboardController::class, 'index'])->name('dashboard.infografis');
    
    // Admin user management
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    
    // Admin refund management
    Route::get('/admin/refunds', [RefundController::class, 'adminIndex'])->name('refunds.admin.index');
    Route::get('/admin/refunds/{refund}', [RefundController::class, 'adminShow'])->name('refunds.admin.show');
    Route::post('/admin/refunds/{refund}/process', [RefundController::class, 'process'])->name('refunds.process');
    
    // Admin blog routes
    Route::get('/admin/blogs', [BlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('/admin/blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/admin/blogs', [BlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('/admin/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('/admin/blogs/{blog}', [BlogController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/admin/blogs/{blog}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');
    
    // Admin rental management
    Route::get('/admin/rentals', [RentalController::class, 'adminIndex'])->name('rentals.admin.index');
    Route::post('/admin/rentals/{rental}/payment', [RentalController::class, 'verifyPayment'])->name('rentals.verifyPayment');
    Route::post('/admin/rentals/{rental}/complete', [RentalController::class, 'completeRental'])->name('rentals.complete');
    
    // API for payment details
    Route::get('/api/rentals/{rental}/payment', [RentalController::class, 'getPaymentDetails']);

    // TEST ROUTE - Simple form without layout
    Route::get('/test/edit/{car}', function(\App\Models\Car $car) {
        return view('admin.cars.edit_test', compact('car'));
    })->name('cars.admin.edit.test');

    // DEBUG ROUTE - Ultra simple
    Route::get('/debug-form', function() {
        return view('admin.cars.debug_form');
    })->name('debug.form');
});

// Cars management - Admin & Staff only
Route::middleware(['auth', 'admin.or.staff'])->group(function () {
    Route::resource('/admin/cars', CarController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->names(['index' => 'cars.admin.index', 'create' => 'cars.admin.create', 'store' => 'cars.admin.store', 'edit' => 'cars.admin.edit', 'update' => 'cars.admin.update', 'destroy' => 'cars.admin.destroy']);
    Route::delete('/photos/{photo}', function(CarPhoto $photo) {
        $carId = $photo->car_id;
        \Illuminate\Support\Facades\Storage::disk('public')->delete($photo->photo_path);
        $photo->delete();
        return redirect()->route('cars.admin.edit', $carId)->with('success', 'Foto berhasil dihapus');
    })->name('photos.delete');
});

// User refund routes (customers only)
Route::post('/rentals/{rental}/cancel', [RefundController::class, 'cancel'])->name('rentals.cancel')->middleware('auth', \App\Http\Middleware\CustomerOnly::class);
Route::get('/rentals/{rental}/refund', [RefundController::class, 'create'])->name('refunds.create')->middleware('auth', \App\Http\Middleware\CustomerOnly::class);
Route::post('/rentals/{rental}/refund', [RefundController::class, 'store'])->name('refunds.store')->middleware('auth', \App\Http\Middleware\CustomerOnly::class);
// User Cars Routes
Route::get('/katalog', [UserCarController::class, 'index'])->name('cars.catalog');
Route::get('/katalog/{car}', [UserCarController::class, 'show'])->name('cars.detail');

// Blog Routes - Public
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog:slug}', [BlogController::class, 'show'])->name('blogs.show');

require __DIR__.'/auth.php';
