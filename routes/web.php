<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotspotController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\SuAdmin\DataMenaraController;
use App\Http\Controllers\SuAdmin\RegulasiController;
use App\Http\Controllers\SuAdmin\HotspotController as AdminHotspotController;
use App\Http\Controllers\PetaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Rute Halaman Utama ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/data-menara', [HomeController::class, 'dataMenara'])->name('datamenara'); // URL diperbaiki (tanpa strip)
Route::get('/regulasi', [HomeController::class, 'regulasi'])->name('regulasi');
Route::get('/hotspot', [HotspotController::class, 'index'])->name('hotspot.index');
Route::get('/peta', [PetaController::class, 'index'])->name('peta.index');
Route::get('/peta/menara-data', [App\Http\Controllers\PetaController::class, 'getMenaraData'])->name('peta.menara_data');


// --- Rute Autentikasi ---
Route::get('/wadai', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/wadai', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Anda bisa hapus rute di bawah ini jika tidak memerlukan fitur registrasi dan reset password
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// --- Rute Admin ---
Route::middleware(['is_admin'])->prefix('suadmin')->name('suadmin.')->group(function () {

    Route::resource('datamenara', DataMenaraController::class);
    
    Route::resource('regulasi', RegulasiController::class); 
    
    Route::resource('hotspot', AdminHotspotController::class);
});
