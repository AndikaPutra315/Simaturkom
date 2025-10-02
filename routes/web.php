<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotspotController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Rute Halaman Utama ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/data-menara', [HomeController::class, 'dataMenara']);
Route::get('/regulasi', [HomeController::class, 'regulasi'])->name('regulasi');
Route::get('/hotspot', [HotspotController::class, 'index'])->name('hotspot.index');


// --- Rute Autentikasi ---
Route::get('/wadai', [LoginController::class, 'showLoginForm'])->name('login');
// URL di bawah ini diubah dari '/login' menjadi '/wadai' agar cocok
Route::post('/wadai', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Anda bisa hapus rute di bawah ini jika tidak memerlukan fitur registrasi dan reset password
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
