@extends('layouts.template')

@section('content')
    <div class="flex items-center justify-center h-screen mt-[-10%]">
        <div class="max-w-md mx-auto bg-white p-8 rounded-md shadow-md">
            <h2 class="text-2xl font-semibold mb-6">Register</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="name" class="text-sm">Name</label>
                    <input id="name" type="text" class="w-full p-2 border border-red-300 rounded-md" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="text-sm">Email Address</label>
                    <input id="email" type="email" class="w-full p-2 border border-red-300 rounded-md" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="text-sm">Password</label>
                    <input id="password" type="password" class="w-full p-2 border border-red-300 rounded-md" name="password" required autocomplete="new-password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password-confirm" class="text-sm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="w-full p-2 border border-red-300 rounded-md" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div>
                    <label for="profile_picture">Profile Picture</label>
                    <input id="profile_picture" type="file" name="profile_picture" accept="image/*">
                </div>
                <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-md hover:bg-red-600 transition duration-300 ease-in-out">Register</button>
            </form>
        </div>
    </div>
@endsection
