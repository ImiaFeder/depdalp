<!-- resources/views/creator.blade.php -->

@extends('layouts.template')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold mb-4">
        Become a Creator and Earn 
        <span class="inline-flex items-center justify-center w-8 h-8 bg-orange-500 text-white rounded-full text-xs font-bold ml-2">
            H
        </span>
        for Each Video Purchased!
    </h1>
    <p class="text-lg mb-6">
        Join our Creator Program and start uploading your tutorial videos. When your video is purchased by other users, you will earn 
        <span class="inline-flex items-center justify-center w-8 h-8 bg-orange-500 text-white rounded-full text-xs font-bold ml-2">
            H
        </span>.
    </p>
    
    <div class="bg-gray-50 p-6 rounded-md shadow-md mb-6">
        <h2 class="text-2xl font-semibold mb-2">What is the Creator Program?</h2>
        <p class="text-lg">
            The Creator Program allows you to upload high-quality video tutorials. When your videos are purchased by other users, you will earn 
            <span class="inline-flex items-center justify-center w-8 h-8 bg-orange-500 text-white rounded-full text-xs font-bold ml-2">
                H
            </span>.
        </p>
    </div>

    <div class="bg-gray-50 p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold mb-2">How to Join</h2>
        <ul class="list-disc pl-6 text-lg">
            <li class="mb-2">Sign up to become a creator by clicking the button below.</li>
            <li class="mb-2">Start uploading videos for users to purchase.</li>
            <li class="mb-2">Earn 
                <span class="inline-flex items-center justify-center w-8 h-8 bg-orange-500 text-white rounded-full text-xs font-bold ml-2">
                    H
                </span> whenever your video is purchased.</li>
        </ul>
    </div>

    <div class="mt-6">
        <a href="" class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-400 transition duration-300 ease-in-out">Become a Creator</a>
    </div>
</div>
@endsection
