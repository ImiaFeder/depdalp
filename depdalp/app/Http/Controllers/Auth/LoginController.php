<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect users after login.
     */
    protected function redirectTo()
    {
        // Periksa role pengguna setelah login
        if (Auth::check() && Auth::user()->isAdmin) {
            return '/adminPage'; // Halaman admin
        }

        return '/userPage'; // Halaman user
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}