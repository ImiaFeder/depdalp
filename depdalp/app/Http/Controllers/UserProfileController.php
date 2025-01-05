<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Tampilkan halaman profil pengguna
        return view('profile', compact('user'));
    }
}
