<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\genre;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserVideoController;


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/', function () {
    return view('home');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/adminPage', function () {
        return view('adminpage');
    });
});

Route::get('/video/{id}', [VideoController::class, 'show']);


Route::get('/home', function () {
    return view('main');
})->name('home');

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
    });

    // Kembalikan tampilan dengan data genre dan videos
    return view('videospage', compact('genre', 'videos'));
});


Auth::routes();