<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PdfLogController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // 🔹 Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🔹 Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        // Service management (admin full access)
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
        Route::patch('/services/{id}', [ServiceController::class, 'update'])->name('services.update');

        // Customer management
        Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customers.show');
        Route::patch('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    });

    // 🔹 Technician routes
    Route::middleware('role:technician')->group(function () {
        Route::get('/technician', function () {
            return view('technician.dashboard');
        })->name('technician.dashboard');

        // Service (technician only update)
        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
        Route::patch('/services/{id}', [ServiceController::class, 'update'])->name('services.update');

        // Media management
        Route::get('/media/{serviceId}', [MediaController::class, 'index'])->name('media.index');
        Route::post('/media', [MediaController::class, 'store'])->name('media.store');
        Route::patch('/media/{serviceId}/{mediaId}', [MediaController::class, 'update'])->name('media.update');
        Route::delete('/media/{serviceId}/{mediaId}', [MediaController::class, 'destroy'])->name('media.destroy');
    });

    // 🔹 PDF log (dipanggil otomatis di backend, route ini opsional)
    Route::post('/pdf/send', [PdfLogController::class, 'sendServicePdf'])->name('pdf.send');
});

require __DIR__ . '/auth.php';