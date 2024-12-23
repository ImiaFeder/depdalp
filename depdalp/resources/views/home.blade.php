@extends('layouts.template')

@section('content')
<body class="bg-gray-100">

    <!-- Full Page Container -->
    <div class="flex items-center justify-center h-screen bg-gradient-to-r from-red-500 to-black">

        <!-- App Introduction Container -->
        <div class="text-center text-white px-6 sm:px-24 md:px-24 max-w-3xl w-full space-y-8">

            <!-- Logo Section (Large Logo) -->
            <div class="mb-8">
                <img src="storage/logo.png" alt="App Logo" class="mx-auto animate-pulse h-48 w-48">
            </div>

            <!-- App Description -->
            <h1 class="text-4xl font-semibold leading-tight">
                Welcome to Hobby Sync Platform!
            </h1>
            <p class="text-lg mt-4 mb-8">
                Discover amazing video tutorials for a wide variety of hobbies. Whether you’re into 3D modelling, photography, audiophile content, or fitness, we have everything to take your hobby to the next level.
            </p>

            <!-- Call-to-Action Button -->
            <a href="/home" class="inline-block bg-orange-500 text-white px-8 py-3 rounded-lg text-lg font-bold hover:bg-orange-400 transition duration-300">
                Get Started
            </a>

            <!-- Secondary Link (optional) -->
            <p class="text-sm mt-4">
                Already have an account? <a href="/login" class="text-orange-300 hover:text-orange-200">Login here</a>.
            </p>
        </div>
    </div>

    </body>
@endsection
