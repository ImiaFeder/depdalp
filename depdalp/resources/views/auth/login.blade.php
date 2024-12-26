@extends('layouts.template')

@section('content')
    <div class="flex items-center justify-center h-screen mt-[-10%]">
        <div class="max-w-md mx-auto bg-white p-8 rounded-md shadow-md">
            <h2 class="text-2xl font-semibold mb-6">Login</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="text-sm">Email Address</label>
                    <input id="email" type="email" class="w-full p-2 border border-red-300 rounded-md" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="text-sm">Password</label>
                    <input id="password" type="password" class="w-full p-2 border border-red-300 rounded-md" name="password" required autocomplete="current-password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input class="mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="text-sm">Remember Me</label>
                </div>

                <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-md hover:bg-red-600 transition duration-300 ease-in-out">Login</button>

                @if (Route::has('password.request'))
                    <a class="text-sm text-red-500 hover:text-blue-600" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                @endif
            </form>
        </div>
    </div>
@endsection
