@extends('layouts.template')

@section('title', 'Station')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold text-center mb-6">Your Station</h1>
    <p class="text-center text-gray-600 mb-8">Manage your videos and track your earnings.</p>

    <!-- Video Table -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">
                    <th class="py-3 px-6">#</th>
                    <th class="py-3 px-6">Thumbnail</th>
                    <th class="py-3 px-6">Title</th>
                    <th class="py-3 px-6">Purchases</th>
                    <th class="py-3 px-6">Coins Earned</th>
                    <th class="py-3 px-6">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $video)
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-6">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6">
                            <!-- Thumbnail (Placeholder) -->
                            <img src="{{ asset('storage/'.$video->thumbnail) }}" alt="Video Thumbnail"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="py-3 px-6">
                            <a href="{{ route('edit.video', $video->id) }}" class="text-blue-500 hover:underline">
                                {{ $video->title }}
                            </a>
                        </td>
                        <td class="py-3 px-6">{{ $video->buyed }}</td>
                        <td class="py-3 px-6">{{ $video->buyed * $video->price }}</td>
                        <td class="py-3 px-6">
                            <a href="{{ route('edit.video', $video->id) }}"
                                class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection