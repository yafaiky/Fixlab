<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

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

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/admin/service', function () {
            return view('admin.service');
        })->name('admin.service');

        Route::get('/admin/services/create', [ServiceController::class, 'create'])
        ->name('admin.services.create');

        Route::post('/admin/services', [ServiceController::class, 'store'])
        ->name('admin.services.store');
    });

    Route::middleware('role:technician')->group(function () {
        Route::get('/technician', function () {
            return view('teknisi.dashboard');
        })->name('teknisi.dashboard');
        Route::get('/teknisi/service', function () {
            return view('teknisi.service');
        })->name('teknisi.service');
    });
});

require __DIR__.'/auth.php';
