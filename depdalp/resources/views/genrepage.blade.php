@extends('layouts.template') <!-- Layout utama -->

@section('title', 'Videos for ' . $genre->name) <!-- Mengatur judul halaman berdasarkan genre -->

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-4xl font-extrabold text-red-600 mb-8 flex items-center">
        <span class="mr-4 p-2 bg-red-100 text-red-600 rounded-full shadow-md">
            <!-- Ikon play -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-5.197-3.21A1 1 0 008 8.691v6.618a1 1 0 001.555.832l5.197-3.209a1 1 0 000-1.664z" />
            </svg>
        </span>
        <span class="relative">
            {{ $genre->name }}
            <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r rounded"></span>
        </span>
    </h1>

    @if($videos->isEmpty())
        <p class="text-gray-600">No videos available for this genre.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($videos as $video)
                <a href="{{ url('/video/' . $video->id) }}" class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-2xl transition">
                    <img src="{{ asset('storage/'.$video->thumbnail) }}" alt="{{ $video->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $video->title }}</h2>
                        <p class="text-gray-600">{{ $video->description }}</p>
                        <div class="flex items-center mt-2">
                            <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center mr-2">
                                <span class="text-xs font-bold">H</span>
                            </div>
                            <!-- Format harga sebagai integer -->
                            <p class="text-orange-500 font-semibold">{{ number_format($video->price, 0, '.', '') }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
