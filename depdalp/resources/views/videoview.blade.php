@extends('layouts.template')

@section('title', 'Admin Page')

@section('content')
<body class="bg-gray-100 flex justify-center items-start min-h-screen p-5">
    <div class="container flex flex-wrap gap-5 max-w-7xl">
        <!-- Video Section -->
        <div class="main-video-section flex-1 flex flex-col gap-5">
            <!-- Main Video -->
            <div class="video-container bg-white rounded-lg shadow-lg overflow-hidden relative">
                @if(auth()->check())
                    @if($ownsVideo)
                        <!-- If user owns the video -->
                        <video class="w-full" controls>
                            <source src="{{ asset('storage/video.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @else
                        <!-- If user is logged in but doesn't own the video -->
                        <div class="absolute inset-0 bg-gray-300 opacity-90 flex justify-center items-center z-10">
                            <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg text-center">
                                <p class="text-xl text-gray-800 mb-4">Unlock this video</p>
                                
                                <!-- Price and Coin -->
                                <div class="flex items-center justify-center bg-white p-4 rounded-lg shadow-md mb-6">
                                    <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-3">
                                        <span class="text-xs font-bold">H</span>
                                    </div>
                                    <span class="text-2xl font-semibold text-gray-800">{{ $video->price }}</span>
                                </div>

                                <!-- Buy Button -->
                                <button class="bg-orange-500 text-white py-3 px-8 rounded-lg hover:bg-orange-600 transition duration-300 transform hover:scale-105 w-full">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                        <img class="w-full h-full object-cover" src="https://via.placeholder.com/600x400?text=Video+Locked" alt="Placeholder">
                    @endif
                @else
                    <!-- If the user is not logged in -->
                    <div class="absolute inset-0 bg-gray-300 opacity-100 flex justify-center items-center z-10">
                        <div class="text-center">
                            <p class="text-white text-xl"></p>
                            <a href="{{ route('login') }}" class="bg-blue-600 text-white py-3 px-6 rounded-lg mt-4 hover:bg-blue-700 transition">Login</a>
                            <p class="text-white mt-2">or</p>
                            <a href="{{ route('register') }}" class="bg-green-600 text-white py-3 px-6 rounded-lg mt-2 hover:bg-green-700 transition">Register</a>
                        </div>
                    </div>
                    <img class="w-full h-full object-cover" src="https://via.placeholder.com/600x400" alt="Placeholder">
                @endif
            </div>

            <!-- Suggested Videos -->
            <div class="suggestions bg-white rounded-lg shadow-lg p-4 mt-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Suggested Videos</h3>
                @foreach ($suggestedVideos as $suggested)
                <div class="suggestion flex items-center mb-4">
                    <img src="https://via.placeholder.com/120x80" alt="Thumbnail" class="w-30 h-20 object-cover rounded-lg mr-4">
                    <div class="suggestion-details">
                        <div class="suggestion-title font-bold text-lg">{{ $suggested->title }}</div>
                        <div class="suggestion-meta text-sm text-gray-500">
                            {{ rand(500000, 5000000) }} views • {{ rand(1, 7) }} days ago
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar flex-1 bg-white rounded-lg shadow-lg p-6 flex flex-col justify-between">
            <!-- Video Title & Description -->
            <div>
                <div class="video-title text-2xl font-bold text-gray-800 mb-4">{{ $video->title }}</div>
                <div class="video-description text-gray-600 text-base leading-relaxed">
                    {{ $video->description }}
                </div>
            </div>
            
            <!-- Video Actions -->
            <div class="video-actions flex justify-between mt-6">
                @if(auth()->check() && !$ownsVideo)
                    <!-- Only show purchase button if the user is logged in but doesn't own the video -->
                    <button class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 transition">Purchase - ${{ $video->price }}</button>
                @endif
                <button class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 transition">Add To Wishlist</button>
            </div>
        </div>
    </div>
</body>
@endsection
