<?php

use App\Http\Controllers\admin\homeBannerController;
use App\Http\Controllers\admin\profileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('admin/index');
});

// Profile Section
Route::get('/profile', [profileController::class, 'index']);
Route::post('/saveProfile', [profileController::class, 'store']);

// Home Banner
Route::get('/homeBanner', [homeBannerController::class, 'index']);
Route::post('/updateHomeBanner', [homeBannerController::class, 'store']);