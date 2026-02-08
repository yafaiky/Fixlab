<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PdfLogController;

Route::get('/', function () {
    // Jika user sudah login dan role admin, arahkan ke admin dashboard
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Jika user sudah login dan role technician, arahkan ke technician dashboard
    if (Auth::check() && Auth::user()->role === 'technician') {
        return redirect()->route('teknisi.dashboard');
    }

    // Jika belum login, tampilkan welcome page
    return view('auth.login');
})->name('home');

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

            $query = \App\Models\Service::with(['customer', 'media', 'items'])->orderBy('created_at', 'desc');

            if ($status && $status !== 'All') {
                $valid = ['OPEN', 'PROGRESS', 'SOLVED', 'WARRANTY', 'DONE', 'CANCELLED'];
                if (in_array($status, $valid)) {
                    $query->where('serviceStatus', $status);
                }
            }

            if ($search) {
                $query->whereHas('customer', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })->orWhere('Model', 'like', '%' . $search . '%')
                    ->orWhere('Keluhan', 'like', '%' . $search . '%');
            }

            $services = $query->paginate(10); // 10 items per page

            return view('admin.dashboard', compact('services'));
        })->name('admin.dashboard');

        Route::get('/admin/service', function () {
            return view('admin.service');
        })->name('admin.service');

        Route::post('/admin/services', [ServiceController::class, 'store'])
            ->name('admin.services.store');

        Route::get('/admin/services/{id}', [ServiceController::class, 'showAdmin'])
            ->name('admin.show');

        Route::get('/admin/services/{id}/edit', [ServiceController::class, 'editAdmin'])
            ->name('admin.update-service');

        Route::patch('/admin/services/{id}', [ServiceController::class, 'updateAdmin'])->name('admin.update');

    });

    // 🔹 Technician routes
    Route::middleware('role:technician')->group(function () {
        Route::get('/teknisi', function () {
            $status = request('status');
            $search = request('search');

            $query = \App\Models\Service::with(['customer', 'media', 'items'])->orderBy('created_at', 'desc');

            if ($status && $status !== 'All') {
                $valid = ['OPEN', 'PROGRESS', 'SOLVED', 'WARRANTY', 'DONE', 'CANCELLED'];
                if (in_array($status, $valid)) {
                    $query->where('serviceStatus', $status);
                }
            }

            if ($search) {
                $query->whereHas('customer', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })->orWhere('Model', 'like', '%' . $search . '%')
                    ->orWhere('Keluhan', 'like', '%' . $search . '%');
            }

            $services = $query->paginate(10); // 10 items per page

            return view('teknisi.dashboard', compact('services'));
        })->name('teknisi.dashboard');

        Route::get('/teknisi/services/{id}', [ServiceController::class, 'teknisiShow'])
            ->name('teknisi.show');

        Route::get('/teknisi/services/{id}/edit', [ServiceController::class, 'teknisiEdit'])
            ->name('teknisi.update-service');

        Route::patch('/teknisi/services/{id}', [ServiceController::class, 'updateTeknisi'])->name('teknisi.update');
    });

    // 🔹 PDF Generate & Download (untuk admin dan teknician)
    Route::get('/service/{id}/pdf/{type}', [PdfLogController::class, 'generateAndDownloadPdf'])
        ->name('service.generate.pdf');

    // 🔹 Finish Warranty Route
     Route::post('/service/{id}/finish-warranty', [ServiceController::class, 'finishWarranty'])
            ->name('service.finishWarranty');
});

require __DIR__ . '/auth.php';
