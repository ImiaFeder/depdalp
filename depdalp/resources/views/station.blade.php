@extends('layouts.template')

@section('title', 'Station')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold text-center mb-6">Your Station</h1>
    <p class="text-center text-gray-600 mb-8">Manage your videos and track your earnings.</p>

    <!-- Dummy Data for Videos -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">
                    <th class="py-3 px-6">#</th>
                    <th class="py-3 px-6">Title</th>
                    <th class="py-3 px-6">Purchases</th>
                    <th class="py-3 px-6">Coins Earned</th>
                    <th class="py-3 px-6">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Dummy Data -->
                @foreach($videos as $video)
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-6">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6">
                            <a href="{{ route('editVideo', $video->id) }}" class="text-blue-500 hover:underline">
                                {{ $video->title }}
                            </a>
                        </td>
                        <td class="py-3 px-6">{{ $video->purchases }}</td>
                        <td class="py-3 px-6">{{ $video->coins }}</td>
                        <td class="py-3 px-6">
                            <a href="{{ route('editVideo', $video->id) }}"
                                class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection