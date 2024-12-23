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

    public function show($id)
    {
        // Ambil video berdasarkan ID
        $video = Video::find($id);

        // If the video is not found, show a 404 page
        if (!$video) {
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

        // Validate if the video exists
        if (!$video) {
            return response()->json(['error' => 'Video not found.'], 404);
        }

        // Check if user already owns the video
        $ownsVideo = user_video::where('user_id', $user->id)->where('video_id', $video->id)->exists();
        if ($ownsVideo) {
            return response()->json(['error' => 'You already own this video.'], 400);
        }

        // Check if the user has enough tokens
        if ($user->token < $video->price) {
            return response()->json(['error' => 'Insufficient balance.'], 400);
        }

        // Deduct the price from user's balance
        User::where('id', $user->id)->update([
            'token' => $user->token - $video->price,
        ]);

        // Create a new UserVideo record
        user_video::create([
            'user_id' => $user->id,
            'video_id' => $video->id,
        ]);

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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('upload');
    }

    // Proses penyimpanan video
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'video' => 'required|mimetypes:video/mp4|max:102400', // Hanya menerima MP4, max 100MB
        ]);
    
        if ($request->hasFile('video')) {
            // Nama file asli
            $filename = $request->file('video')->getClientOriginalName();
    
            // Path tujuan di public/videos
            $destinationPath = public_path('storage/videos');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
    
            // Pindahkan file ke folder tujuan
            $request->file('video')->move($destinationPath, $filename);
    
            // Set session flash message
            session()->flash('success', 'Video uploaded successfully!');
    
            return redirect()->back(); // Kembali ke halaman sebelumnya
        }
    
        // Jika tidak ada file, tampilkan pesan error
        session()->flash('error', 'No video file found in the request.');
        return redirect()->back();
    }
    
    

   
    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatevideoRequest $request, video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(video $video)
    {
        //
    }
}
