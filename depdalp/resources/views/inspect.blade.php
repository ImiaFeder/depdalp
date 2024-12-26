@extends('layouts.template')

@section('title', 'Inspect Video')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-6">Inspect Video</h1>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $video->title }}</h2>
            <p class="text-gray-700 mb-4"><strong>Description:</strong> {{ $video->description }}</p>
            <p class="text-gray-700 mb-4"><strong>Price:</strong> {{ number_format($video->price, 2) }}</p>
            <p class="text-gray-700 mb-4"><strong>Pending Status:</strong> {{ $video->pending ? 'Pending' : 'Approved' }}</p>
            
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Video Preview:</h3>
            <div class="aspect-w-16 aspect-h-9">
                <video controls class="w-full rounded">
                    <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Back to Admin Page</a>
        </div>
    </div>
@endsection
