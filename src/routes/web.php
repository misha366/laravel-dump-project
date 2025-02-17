<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);

// Temp auth routes
Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('/confirm-password', [AuthController::class, 'confirmPassword'])->name('auth.confirm-password');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot-password');
    Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile');
});
