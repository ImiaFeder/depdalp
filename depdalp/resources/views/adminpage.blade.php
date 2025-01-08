@extends('layouts.template')

@section('title', 'Admin Page')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold text-center mb-6">Welcome to the Admin Page</h1>

    <!-- Navigation for Admin Actions -->
    <div class="flex justify-center mb-8">
        <button id="showVideos" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 mx-2">Inspect
            Video</button>
        <button id="showUsers" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 mx-2">Update
            User</button>
    </div>

    <!-- Content Section for Inspect Video -->
    <div id="videosSection" class="hidden">
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
                                        <button type="submit"
                                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.delete', $video->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 ml-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Content Section for Update User -->
    <div id="usersSection" class="hidden">
        <p class="text-center text-gray-600 mb-8">Below is the list of all users.</p>

        @if($users->isEmpty())
            <p class="text-center text-gray-500">No users found.</p>
        @else
            <div class="bg-white shadow-md rounded-lg p-6">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">
                            <th class="py-3 px-6">#</th>
                            <th class="py-3 px-6">Name</th>
                            <th class="py-3 px-6">Email</th>
                            <th class="py-3 px-6">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b border-gray-200">
                                <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6">{{ $user->name }}</td>
                                <td class="py-3 px-6">{{ $user->email }}</td>
                                <td class="py-3 px-6">
                                    <form action="{{ route('makeCreator', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Update</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<script>
    document.getElementById('showVideos').addEventListener('click', function () {
        document.getElementById('videosSection').classList.remove('hidden');
        document.getElementById('usersSection').classList.add('hidden');
    });

    document.getElementById('showUsers').addEventListener('click', function () {
        document.getElementById('usersSection').classList.remove('hidden');
        document.getElementById('videosSection').classList.add('hidden');
    });

    // Optionally, you can show one section by default when the page loads
    document.getElementById('showVideos').click();
</script>
@endsection