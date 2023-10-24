<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\LahanController;
use App\Http\Controllers\Pages\TanamanController;
use App\Http\Controllers\Pages\RekomendasiController;
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

// Todo: Add middleware for not authenticate
Route::get('/, ', [LandingPageController::class, 'index'])->name('index');
Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan');

// Todo: Add middleware for authenticated
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

// Todo: Add middleware for logged in

Route::group([], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::group([
        'prefix' => 'lahan',
        'as' => 'lahan.'
    ], function () {
        Route::get('/', [LahanController::class, 'index'])->name('index');
        Route::get('/tambah', [LahanController::class, 'create'])->name('create');
    });

    Route::group([
        'prefix' => 'tanaman',
        'as' => 'tanaman.'
    ], function () {
        Route::get('/daftar', [TanamanController::class, 'index'])->name('index');
        Route::get('/tambah', [TanamanController::class, 'create'])->name('create');
        Route::post('/tambah', [TanamanController::class, 'store'])->name('store');
    });


    Route::group([
        'prefix' => 'rekomendasi',
        'as' => 'rekomendasi.'
    ], function () {
        Route::get('/pengairan', [RekomendasiController::class, 'index'])->name('pengairan');
        Route::get('/pemupukan', [RekomendasiController::class, 'index'])->name('pemupukan');
    });


    Route::group([
        'prefix' => 'riwayat',
        'as' => 'riwayat.'
    ], function () {
        Route::get('/tanaman/tinggi', [RiwayatController::class, 'index'])->name('tanaman.tinggi');
        Route::get('/rekomendasi', [RiwayatController::class, 'index'])->name('rekomendasi');
    });
});
