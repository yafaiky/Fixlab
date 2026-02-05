<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rute Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Group khusus Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', function () {
            $status = request('status');
            $search = request('search');

            $query = \App\Models\Service::with(['customer','media','items'])->orderBy('created_at','desc');

            if ($status && $status !== 'All') {
                $valid = ['OPEN','PROGRESS','SOLVED','WARRANTY','DONE','CANCELLED'];
                if (in_array($status, $valid)) {
                    $query->where('serviceStatus', $status);
                }
            }

            if ($search) {
                $query->whereHas('customer', function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('phone', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
                })->orWhere('Model', 'like', '%' . $search . '%')
                  ->orWhere('Keluhan', 'like', '%' . $search . '%');
            }

            $services = $query->paginate(12); // 12 cards per page

            return view('admin.dashboard', compact('services'));
        })->name('admin.dashboard');

        Route::get('/admin/service', function () {
            return view('admin.service');
        })->name('admin.service');

        Route::get('/admin/services/create', [ServiceController::class, 'create'])
        ->name('admin.services.create');

        Route::post('/admin/services', [ServiceController::class, 'store'])
        ->name('admin.services.store');

        Route::get('/admin/services/{id}', [ServiceController::class, 'show'])
        ->name('admin.services.show');

        Route::patch('/admin/services/{id}/status', [ServiceController::class, 'updateStatus'])
        ->name('admin.services.updateStatus');
    });

    // Group khusus Technician/Teknisi
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