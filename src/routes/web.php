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
    Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile');
});
