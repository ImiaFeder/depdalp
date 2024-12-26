@extends('layouts.template')

@section('content')
<div class="container">
    <!-- Search Bar Section -->
    <div class="row mb-6">
        <div class="col-12">
            <h2 class="text-2xl font-semibold mb-4">Search Hobbies and Videos</h2>
            <form method="GET">
                {{-- action="{{ route('search') }}"  --}}
                <div class="flex">
                    <input
                        type="text"
                        name="query"
                        class="form-input px-4 py-2 w-full rounded-lg shadow-md"
                        placeholder="Search hobbies or videos..."
                    />
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2 hover:bg-blue-400">
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
        <h2 class="text-2xl font-semibold mb-4">Featured Videos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($featuredVideos as $video)
                <a href="/video/{{ $video->id}}" class="bg-gray-200 p-4 rounded-lg shadow-lg hover:bg-gray-300 transition">
                    <div class="h-48 bg-gray-300 rounded-lg mb-4">
                        <img src="{{ asset('storage/thumbnail1.png') }}" alt="{{ $video->title }}" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <h3 class="text-lg font-bold">{{ $video->title }}</h3>
                    <p class="text-sm text-gray-600">{{ $video->description }}</p>
                </a>
            @endforeach
        </div>
    </div>
</div>



</div>
@endsection
