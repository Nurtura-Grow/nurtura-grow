<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\LahanController;
use App\Http\Controllers\Pages\TanamanController;
use App\Http\Controllers\Pages\PengendalianManualController;
use App\Http\Controllers\Pages\Rekomendasi\PemupukanController;
use App\Http\Controllers\Pages\Rekomendasi\PengairanController;
use App\Http\Controllers\Pages\RiwayatController;

use App\Http\Controllers\Pages\PanduanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// GUEST
Route::group([
    'middleware' => 'guest',
], function () {
    Route::get('/', [LandingPageController::class, 'index'])->name('index');
    Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan');

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');

    Route::group([
        'prefix' => 'auth',
        'as' => 'auth.'
    ], function () {
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
        Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    });
});



Route::group([
    'middleware' => 'authenticated',
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::group([
        'prefix' => 'lahan',
        'as' => 'lahan.'
    ], function () {
        Route::get('/', [LahanController::class, 'index'])->name('index');
        Route::get('/search', [LahanController::class, 'search_lahan'])->name('search');
        Route::get('/tambah', [LahanController::class, 'create'])->name('create');
        Route::post('/tambah', [LahanController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [LahanController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [LahanController::class, 'update'])->name('update');
        Route::delete('/{id}', [LahanController::class, 'destroy'])->name('destroy');
    });

    Route::group([
        'prefix' => 'tanaman',
        'as' => 'tanaman.'
    ], function () {
        Route::get('/daftar', [TanamanController::class, 'index'])->name('index');
        Route::get('/tambah', [TanamanController::class, 'create'])->name('create');
        Route::post('/tambah', [TanamanController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TanamanController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [TanamanController::class, 'update'])->name('update');
        Route::delete('/{id}', [TanamanController::class, 'destroy'])->name('destroy');
    });

    Route::group([
        'prefix' => 'manual',
        'as' => 'manual.'
    ], function () {
        Route::get('/', [PengendalianManualController::class, 'index'])->name('index');
    });


    Route::group([
        'prefix' => 'rekomendasi',
        'as' => 'rekomendasi.'
    ], function () {
        Route::get('/pengairan', [PengairanController::class, 'index'])->name('pengairan');
        Route::get('/pemupukan', [PemupukanController::class, 'index'])->name('pemupukan');
    });


    Route::group([
        'prefix' => 'riwayat',
        'as' => 'riwayat.'
    ], function () {
        Route::get('/', [RiwayatController::class, 'index'])->name('index');
    });

    Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan');
});
