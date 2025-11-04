<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotspotController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\SuAdmin\DashboardController;
use App\Http\Controllers\SuAdmin\DataMenaraController;
use App\Http\Controllers\SuAdmin\RegulasiController;
use App\Http\Controllers\SuAdmin\HotspotController as AdminHotspotController;
use App\Http\Controllers\SuAdmin\UserManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Rute Halaman Publik ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/chart-data', [HomeController::class, 'getChartData'])->name('chart.data');

Route::get('/datamenara', [HomeController::class, 'dataMenara'])->name('datamenara');
Route::get('/datamenara/pdf', [HomeController::class, 'generateMenaraPDF'])->name('datamenara.pdf');

Route::get('/regulasi', [HomeController::class, 'regulasi'])->name('regulasi');
// RUTE BARU: Untuk melacak tampilan & unduhan regulasi oleh publik
Route::get('/regulasi/{regulasi}/view', [HomeController::class, 'trackRegulasiView'])->name('regulasi.view.public');
Route::get('/regulasi/{regulasi}/download', [HomeController::class, 'trackRegulasiDownload'])->name('regulasi.download.public');


Route::get('/hotspot', [HotspotController::class, 'index'])->name('hotspot.index');
Route::get('/hotspot/autocomplete', [HotspotController::class, 'autocomplete'])->name('hotspot.autocomplete');
Route::get('/hotspot/pdf', [HotspotController::class, 'generatePDF'])->name('hotspot.pdf');

Route::get('/peta', [PetaController::class, 'index'])->name('peta.index');
Route::get('/peta/menara-data', [PetaController::class, 'getMenaraData'])->name('peta.menara_data');


// --- Rute Autentikasi ---
Route::get('/wadai', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/wadai', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


// --- Rute Admin ---
Route::middleware(['is_admin'])->prefix('suadmin')->name('suadmin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute PDF untuk Admin
    Route::get('/datamenara/pdf', [DataMenaraController::class, 'generatePDF'])->name('datamenara.pdf');
    Route::get('/hotspot/pdf', [AdminHotspotController::class, 'generatePDF'])->name('hotspot.pdf');
    // RUTE BARU: Untuk melacak unduhan regulasi oleh admin
    Route::get('/regulasi/{regulasi}/download', [RegulasiController::class, 'trackDownload'])->name('regulasi.download');
    Route::post('/datamenara/import', [DataMenaraController::class, 'importExcel'])->name('datamenara.import');

    // Rute Resource untuk Admin
    Route::resource('datamenara', DataMenaraController::class);
    Route::resource('regulasi', RegulasiController::class);
    Route::resource('hotspot', AdminHotspotController::class);
    Route::resource('users', UserManagementController::class);
});
