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
                <a href="{{ url('/video/' . $video->id) }}" class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-2xl transition">
                    <img src="/storage/thumbnail1.png" alt="{{ $video->title }}" class="w-full h-48 object-cover">
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
