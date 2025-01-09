<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\genre;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserVideoController;
use App\Http\Controllers\UserProfileController;


Route::get('/home', [App\Http\Controllers\UserVideoController::class, 'index']);
Route::get('/', function () {
    return view('home');
});

Route::get('/join-creator', function () {
    return view('creator');
})->middleware('auth');


Route::middleware(['admin'])->group(function () {

    Route::get('/admin/videos/{id}', [VideoController::class, 'inspect'])->name('admin.inspect');

    Route::patch('/admin/approve/{id}', [VideoController::class, 'approve'])->name('admin.approve');
    Route::delete('/admin/delete/{id}', [VideoController::class, 'destroy'])->name('admin.delete');
    Route::patch('/make-creator/{id}', [UserVideoController::class, 'makeCreator'])->name('makeCreator');

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



Route::get('/station', [VideoController::class, 'station'])->name('station');
Route::get('/edit-video/{id}', [VideoController::class, 'edit'])->name('edit.video');
Route::post('/edit-video/{id}', [VideoController::class, 'update'])->name('update.video');

Route::post('/process-topup', [VideoController::class, 'processTopUp']);

Route::get('/upload-video', [VideoController::class, 'create'])->name('video.create');
Route::post('/upload-video', [VideoController::class, 'store'])->name('video.store');

Route::post('/purchase-video', [VideoController::class, 'purchaseVideo'])->middleware('auth');
Route::get('/search', [VideoController::class, 'search'])->name('video.search');

Route::middleware('auth')->get('/profile', [UserProfileController::class, 'show'])->name('profile');
Route::middleware('auth')->patch('/profile/update-profpic', [UserProfileController::class, 'update_profpic'])->name('profile.update_profpic');
Route::middleware('auth')->patch('/profile/update-background', [UserProfileController::class, 'update_background'])->name('profile.update_background');
Route::middleware('auth')->patch('/profile/description', [UserProfileController::class, 'update_description'])->name('profile.update_description');
Route::middleware('auth')->patch('/profile/update-name', [UserProfileController::class, 'update_name'])->name('profile.update_name');
Route::middleware('auth')->get('/profile/owned_video', [UserProfileController::class, 'owned_video'])->name('profile.owned_video');


Auth::routes();
