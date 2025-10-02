<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotspotController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/data-menara', [HomeController::class, 'dataMenara']);
Route::get('/hotspot', [HotspotController::class, 'index'])->name('hotspot.index');

