<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth/login');
    }

    public function register(): View
    {
        return view('auth/register');
    }

    public function confirmPassword(): View
    {
        return view('auth/confirm-password');
    }

    public function forgotPassword(): View
    {
        return view('auth/forgot-password');
    }

    public function profile(): View
    {
        return view('auth/profile');
    }
}