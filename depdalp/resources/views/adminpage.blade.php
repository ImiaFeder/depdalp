@extends('layouts.template')

@section('title', 'Admin Page')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-6">Welcome to the Admin Page</h1>
        <p class="text-center text-gray-600 mb-8">Below is the list of pending videos.</p>

        @if($pendingVideos->isEmpty())
            <p class="text-center text-gray-500">No pending videos found.</p>
        @else
            <div class="bg-white shadow-md rounded-lg p-6">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">
                            <th class="py-3 px-6">#</th>
                            <th class="py-3 px-6">Title</th>
                            <th class="py-3 px-6">Description</th>
                            <th class="py-3 px-6">Price</th>
                            <th class="py-3 px-6">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingVideos as $video)
                            <tr class="border-b border-gray-200">
                                <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6">
                                    <a href="{{ route('admin.inspect', $video->id) }}" class="text-blue-500 hover:underline">
                                        {{ $video->title }}
                                    </a>
                                </td>
                                
                                <td class="py-3 px-6">{{ $video->description }}</td>
                                <td class="py-3 px-6">{{ number_format($video->price, 2) }}</td>
                                <td class="py-3 px-6">
                                    <form action="{{ route('admin.approve', $video->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.delete', $video->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 ml-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
