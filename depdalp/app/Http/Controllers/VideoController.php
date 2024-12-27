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
         // Periksa apakah pengguna adalah admin
         if (!Auth::user()->isAdmin) {
             abort(404); // Kembalikan halaman "Not Found"
         }
 
         // Ambil semua video dengan pending = 1
         $pendingVideos = video::where('pending', true)->get();
     
         // Kirim data ke view
         return view('adminpage', compact('pendingVideos'));
     }
 
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   

        $genres = \App\Models\genre::all();

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
        ]);
    
        if ($request->hasFile('video')) {
            // Unggah file video
            $filename = $request->file('video')->getClientOriginalName();
            $destinationPath = 'videos';
            $filePath = $request->file('video')->storeAs($destinationPath, $filename, 'public');
    
            // Buat video baru
            $video = Video::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'path' => $filePath,
                'pending' => 1,
            ]);
    
            // Buat hubungan dengan genre
            \App\Models\genre_video::create([
                'video_id' => $video->id,
                'genre_id' => $request->genre_id,
            ]);
    
            session()->flash('success', 'Video uploaded and associated with genre successfully!');
            return redirect()->back();
        }
    
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
    
 
}
