@extends('layouts.template')

@section('title', 'Edit Video')

@section('content')
<body>
<div class="container mx-auto mt-10">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg">
        <div class="bg-blue-500 text-white rounded-t-lg p-4">
            <h2 class="text-xl font-semibold">Edit Video</h2>
        </div>
        <div class="p-6">
            @if(session('success'))
                <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('update.video', $video->id) }}">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Video Title</label>
                    <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter video title" value="{{ old('title', $video->title) }}" required>
                    @error('title')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Video Description</label>
                    <textarea name="description" id="description" rows="5" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter video description">{{ old('description', $video->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('station') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
@endsection
