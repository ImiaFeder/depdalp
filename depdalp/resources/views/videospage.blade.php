@extends('layouts.template')

@section('title', 'Videos')

@section('content')
<!-- Content -->
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-semibold text-blue-600 mb-6">Genre: {{ $genre->name }}</h1>
    
    @if($videos->isEmpty())
        <p class="text-gray-600">No videos available for this genre.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($videos as $video)
                <a href="{{ url('/video/' . $video->id) }}" class="block bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Gambar dengan placeholder kotak abu-abu jika gambar tidak ditemukan -->
                    <div class="w-full h-48 bg-gray-300 flex justify-center items-center">
                        <img src="{{ $video->path }}" alt="{{ $video->title }}" class="w-full h-full object-cover" onerror="this.onerror=null;this.src='https://via.placeholder.com/300x200?text=No+Image';">
                    </div>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $video->title }}</h2>
                        <p class="text-gray-600">{{ $video->description }}</p>
                        <p class="text-gray-900 font-bold mt-2">Price: {{ $video->price }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
