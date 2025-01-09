@extends('layouts.template')

@section('content')
    <div class="max-w-8xl mx-auto p-6 bg-white shadow-md rounded-lg">

        <!-- Background profile section -->
        <div class="mb-1 relative">
            @if ($user->background_profile)
                <div class="absolute inset-0 bg-cover bg-center rounded-lg"
                    style="background-image: url('{{ asset('storage/' . $user->background_profile) }}'); height: 200px; z-index: 0;">
                </div>
            @else
                <div class="absolute inset-0 bg-gray-300 rounded-lg" style="height: 200px; z-index: 0;"></div>
            @endif

            <!-- Button to open dialog for updating background image, placed at the bottom-right -->
            <button id="openModalBtn"
                class="absolute top-40 right-0 text-white bg-red-600 px-4 py-2 rounded-md z-10">Update</button>
        </div>

        <!-- Profile picture section -->
        <div class="flex items-center mb-6 relative z-10" style="margin-top: 100px; margin-left: 20px;">
            @if ($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                    class="w-20 h-20 rounded-full mr-4">
            @else
                <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center mr-4">
                    <span class="text-2xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                </div>
            @endif
        </div>

        <div class="space-y-4 mt-12 flex items-center">
            <!-- User Name -->
            <p class="text-3xl font-bold">{{ $user->name }}</p>

            <!-- Edit Button with Pencil Icon -->
            <button id="editNameButton" class="ml-4 text-gray-500 hover:text-gray-700 focus:outline-none flex items-center">
                <!-- Pencil Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.44 19.273a4.5 4.5 0 01-1.691 1.064l-3.862 1.162 1.162-3.862a4.5 4.5 0 011.064-1.691L16.862 3.487z" />
                </svg>
            </button>
        </div>

        <div class="space-y-4 mt-6">
            <p><strong class="text-2xl">{{ $user->email }}</strong></p>
        </div>

        <!-- User Description Section -->
        <div class="space-y-4 mb-6 mt-8 border border-gray-300 p-4 rounded-md relative">
            <!-- Show the current description -->
            @if ($user->description)
                <p>{{ $user->description }}</p>
                <!-- Button to open modal for updating or deleting the description -->
                <button id="openDescriptionModalBtn"
                    class="text-white bg-red-600 mt-8 px-4 py-2 rounded-md absolute bottom-2 right-4">Edit
                    Description</button>
            @else
                <p class="text-gray-500">No description available.</p>
                <button id="openDescriptionModalBtn"
                    class="text-white bg-red-600 mt-4 px-4 py-2 rounded-md absolute bottom-4 right-4">Add
                    Description</button>
            @endif
        </div>

        <!-- Modal for updating user name -->
        <div id="nameModal" class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 hidden z-20">
            <div class="bg-white rounded-lg p-6 w-96 z-30">
                <h3 class="text-lg font-medium mb-4">Update User Name</h3>
                <form action="{{ route('profile.update_name') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4">
                        <label for="name" class="block text-lg font-medium">New Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full p-2 border border-gray-300 rounded-md" value="{{ $user->name }}" required>

                        @if ($errors->has('name'))
                            <div class="mt-2 text-red-600 text-sm">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="button" id="closeNameModalBtn"
                            class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Save Name</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal (Dialog Box) for updating description -->
        <div id="descriptionModal"
            class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 hidden z-20">
            <div class="bg-white rounded-lg p-6 w-96 z-30">
                <h3 class="text-lg font-medium mb-4">{{ $user->description ? 'Update' : 'Add' }} Description</h3>
                <form action="{{ route('profile.update_description') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4">
                        <textarea name="description" rows="4" class="w-full p-2 border border-gray-300 rounded-md"
                            placeholder="Write your description here...">{{ $user->description }}</textarea>

                        @if ($errors->has('description'))
                            <div class="mt-2 text-red-600 text-sm">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="button" id="closeDescriptionModalBtn"
                            class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Save Description</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal (Dialog Box) for uploading background image -->
        <div id="modal" class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 hidden z-20">
            <div class="bg-white rounded-lg p-6 w-96 z-30">
                <h3 class="text-lg font-medium mb-4">Update Background Profile Image</h3>
                <form action="{{ route('profile.update_background') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4">
                        <label for="background_profile" class="block text-lg font-medium">Choose Image</label>
                        <input type="file" name="background_profile" id="background_profile"
                            class="block w-full text-sm text-gray-600 py-2 px-4 border border-gray-300 rounded-md"
                            accept="image/*">
                    </div>

                    @if ($errors->has('background_profile'))
                        <div class="mt-2 text-red-600 text-sm">
                            {{ $errors->first('background_profile') }}
                        </div>
                    @endif

                    <div class="mt-4 flex justify-end">
                        <button type="button" id="closeModalBtn"
                            class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="text-center mb-12 mt-12">
        <h1 class="text-3xl font-bold">Owned Videos</h1>
    </div>

    <div class="container mx-auto mt-10">
        @if ($videos->isEmpty())
            <p>No videos found.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($videos as $video)
                    <div class="video-card bg-white shadow-lg rounded-lg overflow-hidden relative group">
                        <!-- Video Thumbnail -->
                        <div class="w-full h-48 bg-gray-300 flex justify-center items-center">
                            <img src="/storage/{{$video->thumbnail}}" alt="{{ $video->title }}"
                                class="w-full h-full object-cover"
                                onerror="this.onerror=null;this.src='https://via.placeholder.com/300x200?text=No+Image';">
                        </div>

                        <div class="p-4">
                            <h2 class="text-xl font-semibold">{{ $video->title }}</h2>
                            <p class="text-gray-600">{{ $video->description }}</p>
                        </div>

                        <!-- Hover Effects for Interactivity -->
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="{{ url('/video/' . $video->id) }}" class="text-white font-bold text-xl">Watch
                                Now</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        // Get the modal and buttons for updating name
        const nameModal = document.getElementById('nameModal');
        const editNameButton = document.getElementById('editNameButton');
        const closeNameModalBtn = document.getElementById('closeNameModalBtn');

        // Open modal for updating user name
        editNameButton.addEventListener('click', function() {
            nameModal.classList.remove('hidden');
        });

        // Close name modal when clicking "Cancel"
        closeNameModalBtn.addEventListener('click', function() {
            nameModal.classList.add('hidden');
        });

        // Close name modal when clicking outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === nameModal) {
                nameModal.classList.add('hidden');
            }
        });

        // Get the modal and buttons
        const modal = document.getElementById('modal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const descriptionModal = document.getElementById('descriptionModal');
        const openDescriptionModalBtn = document.getElementById('openDescriptionModalBtn');
        const closeDescriptionModalBtn = document.getElementById('closeDescriptionModalBtn');

        const descriptionTextarea = document.querySelector('textarea[name="description"]');
        const wordCountDisplay = document.createElement('span');
        descriptionTextarea.parentNode.appendChild(wordCountDisplay);

        descriptionTextarea.addEventListener('input', function() {
            const wordCount = descriptionTextarea.value.split(/\s+/).filter(word => word.length > 0).length;
            wordCountDisplay.textContent = `${wordCount} / 200 words`;
            if (wordCount > 200) {
                descriptionTextarea.setCustomValidity('Description cannot exceed 200 words.');
            } else {
                descriptionTextarea.setCustomValidity('');
            }
        });

        // Open modal for updating background image
        openModalBtn.addEventListener('click', function() {
            modal.classList.remove('hidden');
        });

        // Close modal for background image when clicking "Cancel"
        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        // Close modal for background image when clicking outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });

        // Open modal for updating or adding description
        openDescriptionModalBtn.addEventListener('click', function() {
            descriptionModal.classList.remove('hidden');
        });

        // Close description modal when clicking "Cancel"
        closeDescriptionModalBtn.addEventListener('click', function() {
            descriptionModal.classList.add('hidden');
        });

        // Close description modal when clicking outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === descriptionModal) {
                descriptionModal.classList.add('hidden');
            }
        });
    </script>
@endsection
