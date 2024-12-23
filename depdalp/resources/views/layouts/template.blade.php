<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userDropdownButton = document.getElementById('userDropdownButton');
            const userDropdownMenu = document.getElementById('userDropdownMenu');

            userDropdownButton?.addEventListener('click', function () {
                userDropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function (event) {
                if (!userDropdownButton.contains(event.target) && !userDropdownMenu.contains(event.target)) {
                    userDropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</head>
<body class="bg-gray-100">

<nav class="bg-gradient-to-r from-red-600 to-black text-white p-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-lg font-bold flex items-center space-x-2 mr-6">
            <!-- Logo (Image) yang dapat diklik untuk kembali ke halaman utama -->
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <img src="/storage/logo.png" alt="Hobby Sync Logo" class="w-16 h-16 rounded-full shadow-lg">
                <span class="text-2xl font-semibold tracking-wide">Hobby Sync</span>
            </a>
        </div>
        <ul class="flex space-x-6">
            <li><a href="{{ url('/home') }}" class="hover:text-yellow-400 transition duration-300 ease-in-out">Home</a></li>
            <li><a href="{{ url('/userPage') }}" class="hover:text-yellow-400 transition duration-300 ease-in-out">User</a></li>
            <li><a href="{{ url('/adminPage') }}" class="hover:text-yellow-400 transition duration-300 ease-in-out">Admin</a></li>
        </ul>
        <!-- Right Side Of Navbar -->
        <div class="ml-auto relative flex items-center">
            @auth
                <div class="flex items-center mr-4 bg-white p-3 rounded-lg shadow-md transform transition-all hover:scale-105 hover:bg-red-100">
                    <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-2">
                        <span class="text-sm font-bold">H</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-800">Tokens: {{ Auth::user()->token }}</span>
                </div>
            @else
                <!-- Optionally, you can display something else when the user is not logged in -->
            @endauth

            @guest
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="hover:text-yellow-400 transition duration-300 ease-in-out">Login</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="hover:text-yellow-400 transition duration-300 ease-in-out ml-4">Register</a>
                @endif
            @else
                <!-- Dropdown button for logged-in user -->
                <button id="userDropdownButton" class="hover:text-yellow-400 focus:outline-none text-lg font-semibold">
                    {{ Auth::user()->name }}
                </button>
                <!-- Dropdown Menu -->
                <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white text-black shadow-lg rounded-lg z-10">
                    <a href="#"
                       class="block px-4 py-2 hover:bg-gray-200 transition duration-200 ease-in-out"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <!-- Logout Form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endguest
        </div>
    </div>
</nav>

<!-- Content -->
<div class="container mx-auto mt-10">
    @yield('content')
</div>
</body>
</html>
