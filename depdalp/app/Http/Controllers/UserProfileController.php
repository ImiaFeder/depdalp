<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\user_video;


class UserProfileController extends Controller
{
    public function show()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Ambil video yang dimiliki oleh pengguna
        $userVideos = user_video::where('user_id', $user->id)->get();

        // Mengambil video yang terkait
        $videos = $userVideos->map(function ($userVideo) {
            return $userVideo->video;
        });

        // Kirim data ke view
        return view('profile', compact('user', 'videos'));
    }

    public function update_name(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $user->name = $request->input('name');
        $user->save();

        return redirect()->back()->with('success', 'Name updated successfully.');
    }

    public function update_profpic(Request $request)
    {
        // Validate the uploaded file (optional)
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user(); // Get the authenticated user

        if ($request->hasFile('profile_picture')) {
            $profilePicture= $request->file('profile_picture');
            $path = $profilePicture->store('profile_pictures', 'public');

            $user->profile_picture = $path;
            $user->save();
        }

        // Redirect back with success message
        return back()->with('success', 'Profile picture updated successfully!');
    }

    public function update_background(Request $request)
    {
        // Validate the uploaded file (optional)
        $request->validate([
            'background_profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user(); // Get the authenticated user

        // Check if there's a new background image and store it
        if ($request->hasFile('background_profile')) {
            $backgroundImage = $request->file('background_profile');
            $path = $backgroundImage->store('background_profiles', 'public'); // Store in 'public/background_profiles'

            // Update the user's background profile in the database
            $user->background_profile = $path;
            $user->save();
        }

        // Redirect back with success message
        return back()->with('success', 'Background updated successfully!');
    }

    public function update_description(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string|max:5000', // Sesuaikan maksimal karakter
        ]);

        $user = auth()->user();

        // Check for delete request
        if ($request->has('delete') && $request->delete == 1) {
            $user->description = null;
            $user->save();

            return redirect()->back()->with('success', 'Description deleted successfully.');
        }

        // Validate the description input
        $validatedData = $request->validate([
            'description' => 'nullable|string|max:5000', // Validate description
        ]);

        // Update the description in the database
        $user->description = $validatedData['description'];
        $user->save();

        return redirect()->back()->with('success', 'Description updated successfully.');
    }
}
