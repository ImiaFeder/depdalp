@extends('layouts.template')

@section('title', 'User Page')

@section('content')
    <!-- User Page Content -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold">Welcome {{ $user->name }}</h1>
        <p class="text-lg mt-4">These are the videos you currently own:</p>
    </div>

    <!-- User Videos List -->
    <div class="container mx-auto mt-10">
      
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($videos as $video)
                    <div class="video-card bg-white shadow-lg rounded-lg overflow-hidden relative group">
                        <!-- Video Thumbnail -->
                        <div class="w-full h-48 bg-gray-300 flex justify-center items-center">
                            <img src="/storage/thumbnail1.png" alt="{{ $video->title }}" class="w-full h-full object-cover" onerror="this.onerror=null;this.src='https://via.placeholder.com/300x200?text=No+Image';">
                        </div>
    
                        <div class="p-4">
                            <h2 class="text-xl font-semibold">{{ $video->title }}</h2>
                            <p class="text-gray-600">{{ $video->description }}</p>
                        </div>
    
                        <!-- Hover Effects for Interactivity -->
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="{{ url('/video/' . $video->id) }}" class="text-white font-bold text-xl">Watch Now</a>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
    

@endsection
