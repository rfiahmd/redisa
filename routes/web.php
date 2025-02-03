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
    });

    // Route untuk petugasdesa
    Route::middleware(['role:petugasdesa'])->group(function () {
        Route::get('/dashboard/petugasdesa', [DashboardController::class, 'dspetugasdesa'])->name('petugasdesa.dashboard');
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
