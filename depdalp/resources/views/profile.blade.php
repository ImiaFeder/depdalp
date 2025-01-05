@extends('layouts.template')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-semibold mb-4">User Profile</h1>

    <div class="flex items-center mb-6">
        <!-- Tampilkan gambar profil atau inisial pengguna -->
        @if($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="w-24 h-24 rounded-full mr-4">
        @else
            <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center mr-4">
                <span class="text-2xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
            </div>
        @endif

        <div>
            <!-- Tampilkan nama pengguna -->
            <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
            <!-- Tampilkan email pengguna -->
            <p class="text-sm text-gray-500">{{ $user->email }}</p>
        </div>
    </div>

    <div class="space-y-4">
        <h3 class="text-lg font-medium">Account Details</h3>
        <p><strong>Username:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <!-- Tambahkan informasi lainnya yang diinginkan -->
    </div>

    {{-- <div class="mt-6">
        <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">Edit Profile</a>
    </div> --}}
</div>
@endsection
