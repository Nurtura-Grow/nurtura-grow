<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
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
//Route::get('/, ', [LandingPageController::class, 'index'])->name('landing-page');
Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan');

// Todo: Add middleware for authenticated
Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.'
    ], function () {
        Route::post('/login', [LoginController::class, 'login'])->name('logout');
        Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    });

// Todo: Add middleware for logged in
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/lahan', [LahanController::class, 'index'])->name('lahan');
Route::get('/tanaman', [TanamanController::class, 'index'])->name('tanaman');
Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi');
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
