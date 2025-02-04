<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerifikatorController;

// Route untuk guest (pengguna yang belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login_action'])->name('login.action');
});

// Route untuk pengguna yang sudah login
Route::middleware(['auth'])->group(function () {
    // Route logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    // Route untuk superadmin
    Route::middleware(['role:superadmin'])->group(function () {
        Route::get('/dashboard/superadmin', [DashboardController::class, 'dssuperadmin'])->name('superadmin.dashboard');
    });

    // Route untuk adminpusat
    Route::middleware(['role:adminpusat'])->group(function () {
        Route::get('/dashboard/adminpusat', [DashboardController::class, 'dsadminpusat'])->name('adminpusat.dashboard');
    });

    // Route untuk adminpusat dan superadmin
    Route::middleware(['role:adminpusat|superadmin'])->group(function () {
        Route::get('/verifikator', [VerifikatorController::class, 'index'])->name('data.verifikator');
        Route::get('/jenis_disabilitas', function () {
            return view('admin.jenis-disabilitas.jenis_disabilitas_view');
        })->name('jenis_disabilitas');
        Route::get('/sub_jenis_disabilitas', function () {
            return view('admin.jenis-disabilitas.sub-jenis.sub_jenis_view');
        })->name('sub_jenis_disabilitas');
        Route::get('/bantuan', function () {
            return view('admin.bantuan-disabilitas.bantuan_view');
        })->name('bantuan_disabilitas');
        Route::get('/cutomer_service', function () {
            return view('admin.customer-service.cs_view');
        })->name('customer_service');
    });

    // Route untuk petugasdesa
    Route::middleware(['role:petugasdesa'])->group(function () {
        Route::get('/dashboard/petugasdesa', [DashboardController::class, 'dspetugasdesa'])->name('petugasdesa.dashboard');

        Route::get('/datadisabilitas', function () {
            return view('petugas-desa.disabilitas.disabilitas-view');
        })->name('disabilitas');
        Route::get('/disabilitas-create', function () {
            return view('petugas-desa.disabilitas.disabilitas-create');
        })->name('disabilitas.create');
        Route::get('/disabilitas-edit', function () {
            return view('petugas-desa.disabilitas.disabilitas-edit');
        })->name('disabilitas.edit');
    });

    // Route untuk verifikator
    Route::middleware(['role:verifikator'])->group(function () {
        Route::get('/dashboard/verifikator', [DashboardController::class, 'dsverifikator'])->name('verifikator.dashboard');
    });

    // Route untuk kadis
    Route::middleware(['role:kadis'])->group(function () {
        Route::get('/dashboard/kadis', [DashboardController::class, 'dskadis'])->name('kadis.dashboard');
    });
});
