@extends('layouts.template')

@section('title', $video->title)

@section('content')
<body class="bg-gray-100 flex justify-center items-start min-h-screen p-5">
    <div class="container flex flex-wrap gap-5 max-w-7xl">
        <!-- Video Section -->
        <div class="main-video-section flex-1 flex flex-col gap-5">
            <!-- Main Video -->
            <div class="video-container bg-white rounded-lg shadow-lg overflow-hidden relative">
                @if(auth()->check())
                    @if($ownsVideo)
                        <!-- If user owns the video -->
                        <video class="w-full" controls>
                            <source src="{{ asset('storage/'.$video->path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        
                    @else
                        <!-- If user is logged in but doesn't own the video -->
                        <div class="absolute inset-0 bg-gray-300 opacity-90 flex justify-center items-center z-10">
                            <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg text-center">
                                <p class="text-xl text-gray-800 mb-4">Unlock this video</p>

                                <!-- Price and Coin -->
                                <div class="flex items-center justify-center bg-white p-4 rounded-lg shadow-md mb-6">
                                    <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-3">
                                        <span class="text-xs font-bold">H</span>
                                    </div>
                                    <span class="text-2xl font-semibold text-gray-800">{{ $video->price }}</span>
                                </div>

                                <!-- Buy Button -->
                                <button
                                    id="buyNow"
                                    class="bg-orange-500 text-white py-3 px-8 rounded-lg hover:bg-orange-600 transition duration-300 transform hover:scale-105 w-full">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                        <img class="w-full h-full object-cover" src="/storage/novid.jpg" alt="Placeholder">
                    @endif
                @else
                    <!-- If the user is not logged in -->
                    <div class="absolute inset-0 bg-gray-300 opacity-100 flex justify-center items-center z-10">
                        <div class="text-center">
                            <p class="text-white text-xl"></p>
                            <a href="{{ route('login') }}" class="bg-blue-600 text-white py-3 px-6 rounded-lg mt-4 hover:bg-blue-700 transition">Login</a>
                            <p class="text-white mt-6 mb-6">or</p> <!-- Menambahkan margin-top lebih besar -->
                            <a href="{{ route('register') }}" class="bg-green-600 text-white py-3 px-6 rounded-lg mt-6 hover:bg-green-700 transition">Register</a> <!-- Menambahkan margin-top lebih besar -->
                        </div>
                    </div>
                    <img class="w-full h-full object-cover" src="/storage/novid.jpg" alt="Placeholder">
                @endif
            </div>

            <!-- Suggested Videos -->
            <div class="suggestions bg-white rounded-lg shadow-lg p-4 mt-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Suggested Videos</h3>
                @foreach ($suggestedVideos as $suggested)
                    <a href="/video/{{ $suggested->id }}" class="suggestion flex items-center mb-4">
                        <img src="{{ asset('storage/thumbnail1.png') }}" alt="{{ $suggested->title }}" class="w-40 h-20 object-cover rounded-lg mr-4">
                        <div class="suggestion-details flex-grow">
                            <div class="suggestion-title font-bold text-lg truncate">{{ $suggested->title }}</div>
                            <div class="suggestion-meta text-sm text-gray-500">
                                {{ $suggested->views }} views • {{ $suggested->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar flex-1 bg-white rounded-lg shadow-lg p-6 flex flex-col justify-between">
            <!-- Video Title & Description -->
            <div>
                <div class="video-title text-2xl font-bold text-gray-800 mb-4">{{ $video->title }}</div>
                <div class="video-description text-gray-600 text-base leading-relaxed">
                    {{ $video->description }}
                </div>
            </div>

            <!-- Video Actions -->
            <div class="video-actions flex justify-between mt-6">

                <button class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 transition">Add To Wishlist</button>
            </div>
        </div>
    </div>

    @auth
    <!-- Popup Modal -->
    <div id="popup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg text-center">
            <!-- Title -->
            <p class="text-xl text-gray-800 mb-6">Confirm Your Purchase</p>

            <!-- Price and Token Details -->
            <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-6">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-lg font-semibold text-gray-800">Video Price:</span>
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center mr-2">
                            <span class="text-xs font-bold">H</span>
                        </div>
                        <span class="text-lg font-semibold text-gray-800">{{ $video->price }}</span>
                    </div>
                </div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-lg font-semibold text-gray-800">Your Balance:</span>
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center mr-2">
                            <span class="text-xs font-bold">H</span>
                        </div>
                        <span class="text-lg font-semibold text-gray-800">{{ auth()->user()->token }}</span>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold text-gray-800">Remaining Balance:</span>
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center mr-2">
                            <span class="text-xs font-bold">H</span>
                        </div>
                        <span class="text-lg font-semibold text-gray-800">{{ auth()->user()->token - $video->price }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between gap-4">
                <button id="confirmBuy" class="bg-orange-500 text-white py-2 px-6 rounded-lg hover:bg-orange-600 transition duration-300">
                    Confirm
                </button>
                <button id="cancelBuy" class="bg-gray-500 text-white py-2 px-6 rounded-lg hover:bg-gray-600 transition duration-300">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    @endauth


<!-- Top-Up Modal -->
<div id="topupPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg text-center">
        <!-- Title -->
        <p class="text-xl text-gray-800 mb-6">Not Enough Tokens</p>
        <p class="text-gray-600 mb-4">Choose an amount to top up:</p>

      <!-- Top-Up Options Grid -->
      <div class="grid grid-cols-3 gap-4 mb-6">
        <button
            id="btn15"
            class="topupOption bg-gray-100 border border-orange-500 hover:bg-orange-500 hover:text-white text-gray-800 font-semibold py-3 px-4 rounded-lg flex flex-col items-center transition duration-300">
            <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center mb-2">
                <span class="text-xs font-bold">H</span>
            </div>
            <span class="text-lg">15</span>
            <span class="text-sm text-gray-500 mt-2">Rp 5,000</span> <!-- Harga -->
        </button>
        <button
            id="btn30"
            class="topupOption bg-gray-100 border border-orange-500 hover:bg-orange-500 hover:text-white text-gray-800 font-semibold py-3 px-4 rounded-lg flex flex-col items-center transition duration-300">
            <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center mb-2">
                <span class="text-xs font-bold">H</span>
            </div>
            <span class="text-lg">30</span>
            <span class="text-sm text-gray-500 mt-2">Rp 9,000</span> <!-- Harga -->
        </button>
        <button
            id="btn50"
            class="topupOption bg-gray-100 border border-orange-500 hover:bg-orange-500 hover:text-white text-gray-800 font-semibold py-3 px-4 rounded-lg flex flex-col items-center transition duration-300">
            <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center mb-2">
                <span class="text-xs font-bold">H</span>
            </div>
            <span class="text-lg">50</span>
            <span class="text-sm text-gray-500 mt-2">Rp 12,500</span> <!-- Harga -->
        </button>
        <button
            id="btn100"
            class="topupOption bg-gray-100 border border-orange-500 hover:bg-orange-500 hover:text-white text-gray-800 font-semibold py-3 px-4 rounded-lg flex flex-col items-center transition duration-300">
            <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center mb-2">
                <span class="text-xs font-bold">H</span>
            </div>
            <span class="text-lg">100</span>
            <span class="text-sm text-gray-500 mt-2">Rp 20,000</span> <!-- Harga -->
        </button>
        <button
            id="btn200"
            class="topupOption bg-gray-100 border border-orange-500 hover:bg-orange-500 hover:text-white text-gray-800 font-semibold py-3 px-4 rounded-lg flex flex-col items-center transition duration-300">
            <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center mb-2">
                <span class="text-xs font-bold">H</span>
            </div>
            <span class="text-lg">200</span>
            <span class="text-sm text-gray-500 mt-2">Rp 35,000</span> <!-- Harga -->
        </button>
        <button
            id="btn500"
            class="topupOption bg-gray-100 border border-orange-500 hover:bg-orange-500 hover:text-white text-gray-800 font-semibold py-3 px-4 rounded-lg flex flex-col items-center transition duration-300">
            <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center mb-2">
                <span class="text-xs font-bold">H</span>
            </div>
            <span class="text-lg">500</span>
            <span class="text-sm text-gray-500 mt-2">Rp 80,000</span> <!-- Harga -->
        </button>
    </div>

        <!-- Credit Card Form -->
        <form id="creditCardForm" class="hidden flex flex-col items-start mb-6">
            <label for="cardNumber" class="block text-left text-gray-700 font-semibold mb-2">Card Number</label>
            <input
                id="cardNumber"
                type="text"
                class="w-full border border-gray-300 rounded-lg py-2 px-4 mb-4 focus:outline-none focus:border-orange-500"
                placeholder="1234 5678 9012 3456">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="expiryDate" class="block text-left text-gray-700 font-semibold mb-2">Expiry Date</label>
                    <input
                        id="expiryDate"
                        type="text"
                        class="w-full border border-gray-300 rounded-lg py-2 px-4 mb-4 focus:outline-none focus:border-orange-500"
                        placeholder="MM/YY">
                </div>
                <div>
                    <label for="cvv" class="block text-left text-gray-700 font-semibold mb-2">CVV</label>
                    <input
                        id="cvv"
                        type="text"
                        class="w-full border border-gray-300 rounded-lg py-2 px-4 mb-4 focus:outline-none focus:border-orange-500"
                        placeholder="123">
                </div>
            </div>
        </form>

        <!-- Confirm and Close Buttons -->
        <div class="flex justify-between gap-4">
            <button
                id="confirmTopup"
                class="bg-orange-500 text-white py-2 px-6 rounded-lg hover:bg-orange-600 transition duration-300">
                Confirm
            </button>
            <button
                id="closeTopup"
                class="bg-gray-500 text-white py-2 px-6 rounded-lg hover:bg-gray-600 transition duration-300">
                Close
            </button>
        </div>
    </div>
</div>
</body>

<script>


</script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buyButton = document.getElementById('buyNow');
        const popup = document.getElementById('popup');
        const confirmBuy = document.getElementById('confirmBuy');
        const cancelBuy = document.getElementById('cancelBuy');
        const userTokens = {{ auth()->user()->token ?? 0 }};
        const videoPrice = {{ $video->price }};
        const storeUrl = "/store";
        const topupPopup = document.getElementById('topupPopup');


        buyButton.addEventListener('click', () => {
            if (userTokens >= videoPrice) {
                popup.classList.remove('hidden');
            }

            else {
                topupPopup.classList.remove('hidden');
            }
        });


        cancelBuy.addEventListener('click', () => {
            popup.classList.add('hidden');
        });
    });


    document.getElementById('confirmBuy').addEventListener('click', function () {
    const videoId = {{ $video->id }}; // Pass the video ID dynamically

    fetch('/purchase-video', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ video_id: videoId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Video purchased successfully!');
            location.reload(); // Reload the page to reflect changes
        } else {
            alert(data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while processing your request.');
    });
});

</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const creditCardForm = document.getElementById('creditCardForm');
        let selectedAmount = 0;

        // Manual buttons
        const btn15 = document.getElementById('btn15');
        const btn30 = document.getElementById('btn30');
        const btn50 = document.getElementById('btn50');
        const btn100 = document.getElementById('btn100');
        const btn200 = document.getElementById('btn200');
        const btn500 = document.getElementById('btn500');

        // All buttons array for easy reset
        const allButtons = [btn15, btn30, btn50, btn100, btn200, btn500];

        // Function to reset all buttons
        const resetButtons = () => {
            allButtons.forEach(btn => {
                btn.classList.remove('bg-orange-500', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-800');
            });
        };

        // Add event listeners for each button
        btn15.addEventListener('click', () => {
            resetButtons();
            btn15.classList.add('bg-orange-500', 'text-white');
            selectedAmount = 15;
            creditCardForm.classList.remove('hidden');
        });

        btn30.addEventListener('click', () => {
            resetButtons();
            btn30.classList.add('bg-orange-500', 'text-white');
            selectedAmount = 30;
            creditCardForm.classList.remove('hidden');
        });

        btn50.addEventListener('click', () => {
            resetButtons();
            btn50.classList.add('bg-orange-500', 'text-white');
            selectedAmount = 50;
            creditCardForm.classList.remove('hidden');
        });

        btn100.addEventListener('click', () => {
            resetButtons();
            btn100.classList.add('bg-orange-500', 'text-white');
            selectedAmount = 100;
            creditCardForm.classList.remove('hidden');
        });

        btn200.addEventListener('click', () => {
            resetButtons();
            btn200.classList.add('bg-orange-500', 'text-white');
            selectedAmount = 200;
            creditCardForm.classList.remove('hidden');
        });

        btn500.addEventListener('click', () => {
            resetButtons();
            btn500.classList.add('bg-orange-500', 'text-white');
            selectedAmount = 500;
            creditCardForm.classList.remove('hidden');
        });
    });
</script>

@endsection
