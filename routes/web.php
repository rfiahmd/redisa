<?php

use App\Http\Controllers\admin\Jenis\JenisDisabilitasController;
use App\Http\Controllers\admin\Jenis\SubJenis\SubJenisDisabilitasController;
use App\Http\Controllers\admin\ProfilController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\DisabilitasController;
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
    Route::prefix('profil')->group(function () {
        Route::get('/', [ProfilController::class, 'index'])->name('profil.index');
        Route::post('/update', [ProfilController::class, 'update'])->name('profil.update');
        Route::post('/password', [ProfilController::class, 'updatePassword'])->name('profil.update-password');
    });

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
        Route::get('/bantuan', function () {
            return view('admin.bantuan-disabilitas.bantuan_view');
        })->name('bantuan_disabilitas');

        //desa
        Route::get('/desa', [DesaController::class, 'index'])->name('desa');
        Route::post('/desa-create', [DesaController::class, 'store'])->name('desa.store');
        Route::get('/desa/delete/{id}', [DesaController::class, 'destroy'])->name('desa.delete');
        Route::post('/desa/update/{id}', [DesaController::class, 'update'])->name('desa.update');

        // Jenis Disabilitas
        Route::prefix('jenis')->group(function () {
            Route::get('/', [JenisDisabilitasController::class, 'index'])->name('jenis.index');
            Route::post('/', [JenisDisabilitasController::class, 'store'])->name('jenis.store');
            Route::put('/{jenisDisabilitas}', [JenisDisabilitasController::class, 'update'])->name('jenis.update');
            Route::get('/{token}/delete', [JenisDisabilitasController::class, 'destroy'])->name('jenis.delete');
        });

        Route::prefix('subjenis/{jenisDisabilitas}')->group(function () {
            Route::get('/', [SubJenisDisabilitasController::class, 'index'])->name('subjenis.index');
            Route::post('/', [SubJenisDisabilitasController::class, 'store'])->name('subjenis.store');
            Route::post('/{subJenisDisabilitas}', [SubJenisDisabilitasController::class, 'update'])->name('subjenis.update');
            Route::get('/{token}/delete', [SubJenisDisabilitasController::class, 'destroy'])->name('subjenis.destroy');
        });

        //pendidikan
        Route::get('/pendidikan', function () {
            return view('admin.pendidikan.pendidikan-view');
        })->name('pendidikan');

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::post('/', [UserController::class, 'store'])->name('users.store');
            Route::post('/{users}', [UserController::class, 'update'])->name('users.update');
            Route::get('/{users}/delete', [UserController::class, 'destroy'])->name('users.destroy');
        });
    });

    // Route untuk petugasdesa
    Route::middleware(['role:petugasdesa'])->group(function () {
        Route::get('/dashboard/petugasdesa', [DashboardController::class, 'dspetugasdesa'])->name('petugasdesa.dashboard');
    });

    // Route untuk petugasdesa dan superadmin
    Route::middleware(['role:petugasdesa|superadmin'])->group(function () {
        Route::get('/dashboard/petugasdesa', [DashboardController::class, 'dspetugasdesa'])->name('petugasdesa.dashboard');

        Route::get('/datadisabilitas', [DisabilitasController::class, 'index'])->name('disabilitas');
        Route::get('/disabilitas-create', [DisabilitasController::class, 'create'])->name('disabilitas.create');
        Route::post('/getsubjenis', [DisabilitasController::class, 'getSubJenis'])->name('getSubJenis');

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
