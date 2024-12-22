@extends('layouts.template')

@section('content')
<div class="container">
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

    <!-- Featured Videos Section -->
    <div class="row">
        <div class="col-12">
            <h2 class="text-2xl font-semibold mb-4">Featured Videos</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Video 1 -->
                <div class="bg-gray-200 p-4 rounded-lg shadow-lg">
                    <div class="h-48 bg-gray-300 rounded-lg mb-4"></div> <!-- Placeholder for video thumbnail -->
                    <h3 class="text-lg font-bold">Video Title 1</h3>
                    <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <!-- Video 2 -->
                <div class="bg-gray-200 p-4 rounded-lg shadow-lg">
                    <div class="h-48 bg-gray-300 rounded-lg mb-4"></div> <!-- Placeholder for video thumbnail -->
                    <h3 class="text-lg font-bold">Video Title 2</h3>
                    <p class="text-sm text-gray-600">Phasellus iaculis lorem ac nisi pellentesque, eget volutpat velit malesuada.</p>
                </div>
                <!-- Video 3 -->
                <div class="bg-gray-200 p-4 rounded-lg shadow-lg">
                    <div class="h-48 bg-gray-300 rounded-lg mb-4"></div> <!-- Placeholder for video thumbnail -->
                    <h3 class="text-lg font-bold">Video Title 3</h3>
                    <p class="text-sm text-gray-600">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <!-- Video 4 -->
                <div class="bg-gray-200 p-4 rounded-lg shadow-lg">
                    <div class="h-48 bg-gray-300 rounded-lg mb-4"></div> <!-- Placeholder for video thumbnail -->
                    <h3 class="text-lg font-bold">Video Title 4</h3>
                    <p class="text-sm text-gray-600">Donec varius augue quis augue fringilla, et convallis sapien consequat.</p>
                </div>
                <!-- Video 5 -->
                <div class="bg-gray-200 p-4 rounded-lg shadow-lg">
                    <div class="h-48 bg-gray-300 rounded-lg mb-4"></div> <!-- Placeholder for video thumbnail -->
                    <h3 class="text-lg font-bold">Video Title 5</h3>
                    <p class="text-sm text-gray-600">Fusce vehicula neque at turpis sodales, ac iaculis neque condimentum.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
