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
        
        // Service management (admin full access)

        Route::get('/admin/services/create', [ServiceController::class, 'create'])
        ->name('admin.services.create');

        Route::post('/admin/services', [ServiceController::class, 'store'])
        ->name('admin.services.store');

        Route::get('/admin/services/{id}', [ServiceController::class, 'show'])
        ->name('admin.show');

        Route::get('/admin/services/{id}/edit', [ServiceController::class, 'edit'])
        ->name('admin.update-service');

        Route::patch('/admin/services/{id}', [ServiceController::class, 'update'])->name('admin.update-service');

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
    Route::post('/pdf/send', [pdfLogController::class, 'sendServicePdf'])->name('pdf.send');
});

require __DIR__ . '/auth.php';