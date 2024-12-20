<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('video');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/adminPage', function () {
        return view('adminpage');
    });
});

// Route lainnya
Route::get('/video', function () {
    return view('video');
});

Route::get('/home', function () {
    return view('main');
});

Route::middleware('auth')->group(function () {
    Route::get('/userPage', function () {
        return view('userpage');
    });
});

Route::get('/index', function () {
    return view('home');
});

Auth::routes();