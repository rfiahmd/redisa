<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('layout.template');
// });


Route::middleware(['guest'])->group(function(){
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'login_action'])->name('login');
});

Route::middleware(['auth', 'role:superadmin'])->group(function(){
    Route::get('/superadmin', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth', 'role:adminpusat'])->group(function(){
    Route::get('/adminpusat', function () {
        return view('admin-pusat.dashboard');
    });
});

Route::middleware(['auth', 'role:petugasdesa'])->group(function(){
    Route::get('/petugasdesa', function () {
        return view('petugas-desa.dashboard');
    });
});

Route::middleware(['auth', 'role:verifikator'])->group(function(){
    Route::get('/verifikator', function () {
        return view('verifikator.dashboard');
    });
});

Route::middleware(['auth', 'role:kadis'])->group(function(){
    Route::get('/kadis', function () {
        return view('kadis.dashboard');
    });
});