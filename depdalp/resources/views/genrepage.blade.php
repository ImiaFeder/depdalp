@extends('layouts.template') <!-- Layout utama -->

@section('title', 'Videos for ' . $genre->name) <!-- Mengatur judul halaman berdasarkan genre -->

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-semibold text-blue-600 mb-6">Genre: {{ $genre->name }}</h1>
    
    @if($videos->isEmpty())
        <p class="text-gray-600">No videos available for this genre.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($videos as $video)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ $video->path }}" alt="{{ $video->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $video->title }}</h2>
                        <p class="text-gray-600">{{ $video->description }}</p>
                        <p class="text-gray-900 font-bold mt-2">Price: ${{ $video->price }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
