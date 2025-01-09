@extends('layouts.template')

@section('content')
<div class="container">
    <!-- Search Bar Section -->
    <div class="row mb-6">
        <div class="col-12">
            <h2 class="text-2xl font-semibold mb-4">Search Hobbies and Videos</h2>
            <form method="GET" action="{{ route('video.search') }}">
                <div class="flex">
                    <input
                        type="text"
                        name="query"
                        class="form-input px-4 py-2 w-full rounded-lg shadow-md"
                        placeholder="Search hobbies or videos..."
                    />
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg ml-2 hover:bg-blue-400">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Genre Hobi Section -->
    <div class="row mb-8">
        <div class="col-12">
            <h2 class="text-2xl font-semibold mb-4">Explore Hobby Genres</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                <!-- Genre 1 -->
                <a href="/genre/1" class="bg-blue-500 text-white p-6 rounded-lg shadow-lg hover:bg-blue-400">
                    <h3 class="text-lg font-bold">3D Modelling</h3>
                </a>
                <!-- Genre 2 -->
                <a href="/genre/2" class="bg-green-500 text-white p-6 rounded-lg shadow-lg hover:bg-green-400">
                    <h3 class="text-lg font-bold">Photography</h3>
                </a>
                <!-- Genre 3 -->
                <a href="/genre/3" class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg hover:bg-yellow-400">
                    <h3 class="text-lg font-bold">Audiophile</h3>
                </a>
                <!-- Genre 4 -->
                <a href="/genre/4" class="bg-red-500 text-white p-6 rounded-lg shadow-lg hover:bg-red-400">
                    <h3 class="text-lg font-bold">Gym</h3>
                </a>
                <!-- Genre 5 -->
                <a href="/genre/5" class="bg-purple-500 text-white p-6 rounded-lg shadow-lg hover:bg-purple-400">
                    <h3 class="text-lg font-bold">Social Media</h3>
                </a>
            </div>
        </div>
    </div>


<div class="row">
    <div class="col-12">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Featured Videos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($featuredVideos as $video)
            <a href="/video/{{ $video->id }}" class="bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                <div class="relative">
                    <img src="{{ asset('storage/'.$video->thumbnail) }}" alt="{{ $video->title }}" class="w-full h-48 object-cover rounded-t-lg">
                    <div class="absolute top-2 left-2 bg-black bg-opacity-50 text-white text-xs font-bold px-2 py-1 rounded">
                        <div class="flex items-center space-x-1">
                            <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center">
                                <span class="text-xs font-bold">H</span>
                            </div>
                            <span>{{ $video->price }}</span>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-800 truncate">{{ $video->title }}</h3>
                    <p class="text-sm text-gray-600 line-clamp-2 mt-2">{{ $video->description }}</p>
                    <div class="mt-4 text-sm text-gray-500">
                        <span>Uploaded by: </span>
                        <span class="font-semibold">{{ $video->user->name }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>





</div>
@endsection
