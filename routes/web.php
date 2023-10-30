<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatatanImunisasiController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\CatatanVaksinController;
use App\Http\Controllers\PencatatanBayiController;
use App\Http\Controllers\UserController;
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
Route::get('', function() {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    /* Dashboard */
    Route::get('/', [DashboardController::class, 'index']);
    Route::middleware(['role:admin'])->group(function () {
        /* User */
        Route::controller(UserController::class)->group(function () {
            Route::get('/user', 'index');
            Route::post('/user/tambah', 'store');
            Route::post('/user/{id}/edit', 'update')->where('id', '[0-9+]');
            Route::delete('/user/{id}/delete', 'delete')->where('id', '[0-9]+');
        });

          /* Pencatatan Bayi */
    Route::controller(PencatatanBayiController::class)->group(function () {
            Route::get('/bayi', 'index');
            Route::post('/bayi/tambah', 'store');
            Route::post('/bayi/{id}/edit', 'update')->where('id', '[0-9+]');
            Route::delete('/bayi/{id}/delete', 'delete')->where('id', '[0-9]+');
    });


        /* catatan imunisasi */
        Route::controller(CatatanImunisasiController::class)->group(function () {
            Route::get('/catatan_imunisasi', 'index');
            Route::post('/catatan_imunisasi/tambah', 'store');
            Route::get('/catatan_imunisasi/download', 'download');
            Route::post('/catatan_imunisasi/{id}/edit', 'update');
            Route::delete('/catatan_imunisasi/{id}/delete', 'delete');
        });

    });

    /* catatan_vaksin */
    Route::controller(CatatanVaksinController::class)->group(function () {
        Route::get('/catatan_vaksin', 'index');
        Route::get('/catatan_vaksin', 'index');
        Route::post('/catatan_vaksin', 'store');
        Route::get('/catatan_vaksin/download', 'download');
        Route::post('/catatan_vaksin/{id}', 'update');
        Route::delete('/catatan_vaksin/{id}', 'delete');
    });

    /* Log */
    Route::controller(LogController::class)->group(function () {
        Route::get('/log', 'index');
    });

});
