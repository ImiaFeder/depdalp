<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\genre;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserVideoController;


Route::get('/home', [App\Http\Controllers\UserVideoController::class, 'index']);
Route::get('/', function () {
    return view('home');
});

Route::middleware(['admin'])->group(function () {

    Route::get('/admin/videos/{id}', [VideoController::class, 'inspect'])->name('admin.inspect');

    Route::patch('/admin/approve/{id}', [VideoController::class, 'approve'])->name('admin.approve');
    Route::delete('/admin/delete/{id}', [VideoController::class, 'destroy'])->name('admin.delete');
});
Route::get('/adminPage', [VideoController::class, 'index'])->name('admin.index')->middleware('auth');

Route::get('/video/{id}', [VideoController::class, 'show']);



Route::middleware('auth')->get('/userPage', [UserVideoController::class, 'userPage']);

Route::get('/index', function () {
    return view('home');
});

Route::get('/genre/{gr}', function ($gr) {
    // Ambil genre berdasarkan ID (gr)
    $genre = Genre::find($gr);

    if (!$genre) {
        abort(404, 'Genre not found'); // Jika genre tidak ditemukan
    }

    // Ambil video-video yang terkait dengan genre ini melalui genre_video
    $videos = $genre->videos->map(function ($genreVideo) {
        return $genreVideo->video; // Mengambil video terkait dengan genre melalui genre_video
    })->filter(function ($video) {
        return !$video->pending; // Hilangkan video dengan pending = true
    });


    // Kembalikan tampilan dengan data genre dan videos
    return view('genrepage', compact('genre', 'videos'));
});


Route::post('/process-topup', [VideoController::class, 'processTopUp']);

Route::get('/upload-video', [VideoController::class, 'create'])->name('video.create');
Route::post('/upload-video', [VideoController::class, 'store'])->name('video.store');

Route::post('/purchase-video', [VideoController::class, 'purchaseVideo'])->middleware('auth');
Route::get('/search', [VideoController::class, 'search'])->name('video.search');

Auth::routes();
