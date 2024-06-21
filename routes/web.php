<?php

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

// route frontend
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('frontend.home');

// route auth
Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [\App\Http\Controllers\LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/register', [\App\Http\Controllers\LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [\App\Http\Controllers\LoginController::class, 'register_proses'])->name('register-proses');

// route middleware
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin'], 'as' => 'admin.'] , function(){
// route backend
Route::get('/admin', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    // route admin
    Route::get('/data', [\App\Http\Controllers\Admin\UserController::class, 'indexAdmin'])->name('backend.admin.data');
    Route::get('/tambah', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('backend.admin.tambah');
    Route::post('/store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('backend.admin.store');
    Route::get('/edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('backend.admin.edit');
    Route::put('/update/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('backend.admin.update');
    Route::delete('/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('backend.admin.delete');
    // route pengguna
    Route::get('/pengguna', [\App\Http\Controllers\Admin\UserController::class, 'indexUser'])->name('backend.pengguna.data');
    // route pemesanan
    Route::get('/pemesanan', [\App\Http\Controllers\PemesananController::class, 'index'])->name('backend.pemesanan.pesan');
    Route::get('/pemesanan/tambah', [\App\Http\Controllers\PemesananController::class, 'create'])->name('backend.pemesanan.tambah');
    Route::post('/pemesanan/store', [\App\Http\Controllers\PemesananController::class, 'store'])->name('backend.pemesanan.store');
    Route::get('/pemesanan/edit/{id}', [\App\Http\Controllers\PemesananController::class, 'edit'])->name('backend.pemesanan.edit');
    Route::put('/pemesanan/update/{id}', [\App\Http\Controllers\PemesananController::class, 'update'])->name('backend.pemesanan.update');
    Route::delete('/pemesanan/delete/{id}', [\App\Http\Controllers\PemesananController::class, 'delete'])->name('backend.pemesanan.delete');
    Route::post('/pemesanan/update-status/{id}', [\App\Http\Controllers\PemesananController::class, 'updateStatus'])->name('backend.pemesanan.update-status');
    // route pembayaran
    Route::get('/pembayaran', [\App\Http\Controllers\PembayaranController::class, 'index'])->name('backend.pembayaran.bayar');
    Route::get('/pembayaran/tambah/{id_pemesanan}', [\App\Http\Controllers\PembayaranController::class, 'create'])->name('backend.pembayaran.tambah');
    Route::post('/pembayaran/store', [\App\Http\Controllers\PembayaranController::class, 'store'])->name('backend.pembayaran.store');
    Route::get('/pembayaran/edit/{id}', [\App\Http\Controllers\PembayaranController::class, 'edit'])->name('backend.pembayaran.edit');
    Route::put('/pembayaran/update/{id}', [\App\Http\Controllers\PembayaranController::class, 'update'])->name('backend.pembayaran.update');
    Route::delete('/pembayaran/delete/{id}', [\App\Http\Controllers\PembayaranController::class, 'delete'])->name('backend.pembayaran.delete');
});

