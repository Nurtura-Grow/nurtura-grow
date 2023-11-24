<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\LahanController;
use App\Http\Controllers\Pages\TanamanController;
use App\Http\Controllers\Pages\PengendalianManual\PemupukanController as PemupukanManualController;
use App\Http\Controllers\Pages\PengendalianManual\PengairanController as PengairanManualController;
use App\Http\Controllers\Pages\PengendalianManual\TinggiTanamanController as TinggiTanamanManualController;
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
    Route::get('/forgot/password', [ForgotPasswordController::class, 'index'])->name('password');
    Route::get('/verifikasi', [ForgotPasswordController::class, 'index_verifikasi'])->name('verifikasi');

    Route::group([
        'prefix' => 'auth',
        'as' => 'auth.'
    ], function () {
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
        Route::post('/forgot/password', [ForgotPasswordController::class, 'password'])->name('password');
        Route::post('/verifikasi', [ForgotPasswordController::class, 'verifikasi'])->name('verifikasi');
    });
});

Route::group([
    'middleware' => 'authenticated',
], function () {
    // Route Logout
    Route::group([
        'prefix' => 'auth',
        'as' => 'auth.'
    ], function () {
        Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Data Dashboard JSON
    Route::group([
        'prefix' => 'dashboard',
        'as' => "dashboard."
    ], function () {
        Route::get('/data', [DashboardController::class, 'data'])->name('data');
    });

    // Route Lahan
    Route::resource('lahan', LahanController::class)->except(['show']);
    Route::get('/lahan/search', [LahanController::class, 'search_lahan'])->name('lahan.search');

    // Route Tanaman
    Route::resource('tanaman', TanamanController::class)->except(['show']);

    // Route Manual
    Route::group([
        'prefix' => 'manual',
        'as' => 'manual.'
    ], function () {
        Route::resource('/tinggi', TinggiTanamanManualController::class)->except(['index', 'show']);
        Route::get('/tinggi/penanaman/{id}', [TinggiTanamanManualController::class, 'search_tanggal'])->name('tinggi.search_tanggal');
        Route::resource('/pengairan', PengairanManualController::class)->except(['index', 'show']);
        Route::resource('/pemupukan', PemupukanManualController::class)->except(['index', 'show']);
    });

    // Route Riwayat
    Route::group([
        'prefix' => 'riwayat',
        'as' => 'riwayat.'
    ], function () {
        Route::get('/', [RiwayatController::class, 'index'])->name('index');
    });

    // Route Panduan
    Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan');
});
