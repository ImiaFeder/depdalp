<?php

namespace App\Http\Controllers;

use App\Models\video;
use App\Models\genre_video;
use App\Models\user_video;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\StorevideoRequest;
use App\Http\Requests\UpdatevideoRequest;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function inspect($id)
    {
        // Cari video berdasarkan ID
        $video = Video::find($id);

        // Jika video tidak ditemukan, tampilkan 404
        if (!$video) {
            abort(404, 'Video not found');
        }

        // Kirim data video ke view
        return view('inspect', compact('video'));
    }

    public function show($id)
    {
        // Ambil video berdasarkan ID
        $video = Video::find($id);

        // If the video is not found, show a 404 page
        if (!$video || $video->pending) {
            abort(404, 'Video not found');
        }

        // Get the genre_id(s) for the current video's genres
        $genreVideos = genre_video::with('genre')
            ->where('video_id', $video->id)
            ->get();

        // Extract all the genre_ids from the genre_videos
        $genreIds = $genreVideos->pluck('genre_id');

        // Fetch all videos with the same genre_id(s), excluding the current video
        $suggestedVideos = Video::whereHas('genres', function ($query) use ($genreIds) {
            $query->whereIn('genre_id', $genreIds);
        })
            ->where('id', '!=', $video->id) // Exclude the current video
            ->inRandomOrder() // Get random videos
            ->take(2) // Limit to 2 suggested videos
            ->get();

        // Check if the user is logged in
        $user = Auth::user();

        // Check if the user owns the current video
        $ownsVideo = false;
        if ($user) {
            // Get all user_video records associated with this user
            $userVideos = user_video::where('user_id', $user->id)
                ->where('video_id', $video->id)
                ->exists(); // Check if this user has the specific video

            // If the user has the video, set the boolean to true
            $ownsVideo = $userVideos;
        }

        // Tampilkan view dengan data video, suggested videos, and ownership status
        return view('videoview', compact('video', 'suggestedVideos', 'ownsVideo'));
    }

    public function purchaseVideo(Request $request)
    {
        $user = Auth::user();
        $videoId = $request->input('video_id');
        $video = Video::find($videoId);
    
        if (!$video) {
            return response()->json(['error' => 'Video not found.'], 404);
        }
    
        $ownsVideo = user_video::where('user_id', $user->id)->where('video_id', $video->id)->exists();
        if ($ownsVideo) {
            return response()->json(['error' => 'You already own this video.'], 400);
        }
    
        if ($user->token < $video->price) {
            return response()->json(['error' => 'Insufficient balance.'], 400);
        }
    
        User::where('id', $user->id)->update([
            'token' => $user->token - $video->price,
        ]);
    
        user_video::create([
            'user_id' => $user->id,
            'video_id' => $video->id,
        ]);
    
        // Tambahkan logika untuk menambah buyed count
        $video->buyed = $video->buyed+1;
        $video->save();
    
        return response()->json(['success' => 'Video purchased successfully.'], 200);
    }


    public function processTopUp(Request $request)
    {
        // Validasi input
        $request->validate([
            'amount' => 'required|integer|min:15',  // Pastikan amount minimal 15
        ]);

        // Ambil data amount dari request
        $amount = $request->input('amount');

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Update tokens menggunakan User::update
        User::where('id', $user->id)
            ->update([
                'token' => $user->token + $amount,  // Menambah token sesuai jumlah yang dipilih
            ]);

        // Kirimkan response sukses
        return response()->json([
            'success' => true,
            'message' => "Top-up of {$amount} tokens successful!"
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function station()
    {
        // Ambil user ID dari pengguna yang sedang login
        $userId = Auth::id();

        // Ambil semua video yang diunggah oleh pengguna tersebut
        $videos = Video::where('user_id', $userId)->get();

        // Return view dengan data video
        return view('station', compact('videos'));
    }
    public function index()
    {
        // Periksa apakah pengguna adalah admin
        if (!Auth::user()->isAdmin) {
            abort(404); // Kembalikan halaman "Not Found"
        }

        // Ambil semua video dengan pending = 1
        $pendingVideos = video::where('pending', true)->get();

        // Ambil semua pengguna kecuali admin
        $users = User::where('isAdmin', false)->get();

        // Kirim data ke view
        return view('adminpage', compact('pendingVideos', 'users'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pengecekan apakah user adalah creator
        if (!Auth::user()->isCreator) {
            abort(404); // Menampilkan halaman "Page Not Found"
        }

        // Ambil semua genre
        $genres = \App\Models\Genre::all();

        // Return view upload dengan data genre
        return view('upload', compact('genres'));
    }


    // Proses penyimpanan video
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'genre_id' => 'required|exists:genres,id',
        'video' => 'required|mimetypes:video/mp4|max:102400',
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('video') && $request->hasFile('thumbnail')) {
        // Unggah file video
        $videoFilename = $request->file('video')->getClientOriginalName();
        $videoDestination = 'videos';
        $videoPath = $request->file('video')->storeAs($videoDestination, $videoFilename, 'public');

        // Unggah file thumbnail
        $thumbnailFilename = $request->file('thumbnail')->getClientOriginalName();
        $thumbnailDestination = 'thumbnails';
        $thumbnailPath = $request->file('thumbnail')->storeAs($thumbnailDestination, $thumbnailFilename, 'public');

        // Buat video baru
        $video = Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'path' => $videoPath,
            'thumbnail' => $thumbnailPath,
            'pending' => 1,
            'user_id' => Auth::user()->id
        ]);

        // Buat hubungan dengan genre
        \App\Models\genre_video::create([
            'video_id' => $video->id,
            'genre_id' => $request->genre_id,
        ]);

        user_video::create([
            'user_id' => Auth::user()->id,
            'video_id' => $video->id
        ]);

        session()->flash('success', 'Video and thumbnail uploaded successfully!');
        return redirect()->back();
    }

    session()->flash('error', 'Video or thumbnail file not found in the request.');
    return redirect()->back();
}





    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('edit-video', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $video = Video::findOrFail($id);
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->save();

        return redirect()->route('edit.video', $id)->with('success', 'Video updated successfully.');
    }

    public function approve($id)
    {
        $video = Video::findOrFail($id);
        $video->pending = false;
        $video->save();

        return redirect()->route('admin.index')->with('success', 'Video approved successfully.');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.index')->with('success', 'Video deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Jika query kosong atau wildcard, tampilkan semua video
        if (empty($query) || $query == '*') {
            $featuredVideos = Video::all(); // Mengambil semua video
        } else {
            // Mencari video berdasarkan judul jika query tidak kosong
            $featuredVideos = Video::where('title', 'like', '%' . $query . '%')->get();
        }

        return view('main', compact('featuredVideos'));
    }
}
