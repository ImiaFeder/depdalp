<?php

namespace App\Http\Controllers;

use App\Models\video;
use App\Models\genre_video;
use App\Models\user_video;

use Illuminate\Support\Facades\Auth;

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
        $suggestedVideos = Video::whereHas('genres', function($query) use ($genreIds) {
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorevideoRequest $request)
    {
        //
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
