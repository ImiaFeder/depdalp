<?php

namespace App\Http\Controllers;

use App\Models\user_video;
use App\Models\video;

use App\Models\User;

use App\Http\Requests\Storeuser_videoRequest;
use App\Http\Requests\Updateuser_videoRequest;
use Illuminate\Support\Facades\Auth;

class UserVideoController extends Controller
{   

    public function userPage()
    {
        $user = Auth::user();

        // Get all user_video records associated with this user
        $userVideos = user_video::where('user_id', $user->id)->get();

        // Retrieve the videos associated with the user_video records
        $videos = $userVideos->map(function ($userVideo) {
            return $userVideo->video; // Accessing the related 'video' for each user_video
        });

        return view('userPage', compact('user', 'videos')); 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        // Ambil video yang tidak memiliki status pending
        $featuredVideos = \App\Models\Video::where('pending', false)
                            ->inRandomOrder()
                            ->take(9)
                            ->get();
    
        // Return view dengan data video
        return view('main', compact('featuredVideos'));
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
    public function store(Storeuser_videoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(user_video $user_video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user_video $user_video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateuser_videoRequest $request, user_video $user_video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user_video $user_video)
    {
        //
    }
}
