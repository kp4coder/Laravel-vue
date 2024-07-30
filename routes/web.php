<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\Admin\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/', function () {
    return view('index');
    // return view('welcome');
    // return redirect('admin/dashboard');
});

Route::get('/login', function () {
    return view('auth/signIn');
});

Route::get('/login', function () {
    return view('auth/signIn');
});

Route::get('/apiDocs', function () {
    return view('apiDocs');
});

Route::post('/login_user', [AuthController::class, 'loginUser']);

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/login');
});

// Route::get('/createAdmin', [AuthController::class, 'createAdmin']);