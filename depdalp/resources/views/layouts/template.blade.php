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
<body class="bg-gray-100 mb-12">


<nav class="bg-gradient-to-r from-red-600 to-black text-white p-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-lg font-bold flex items-center space-x-2 mr-6">
            <!-- Logo (Image) yang dapat diklik untuk kembali ke halaman utama -->
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <img src="/storage/logo.png" alt="Hobby Sync Logo" class="w-16 h-16 rounded-full">
                <span class="text-2xl font-semibold tracking-wide">HobbySync</span>
            </a>
        </div>
        <ul class="flex space-x-6">
            <li><a href="{{ url('/home') }}" class="hover:text-yellow-400 transition duration-300 ease-in-out">Home</a></li>
            {{-- <li><a href="{{ url('/userPage') }}" class="hover:text-yellow-400 transition duration-300 ease-in-out">User</a></li> --}}
            @auth
                @if(Auth::user()->isAdmin)
                    <li><a href="{{ url('/adminPage') }}" class="hover:text-yellow-400 transition duration-300 ease-in-out">Admin</a></li>
                @endif
                @if(Auth::user()->isCreator)
                <li><a href="{{ url('/upload-video') }}" class="hover:text-yellow-400 transition duration-300 ease-in-out">Upload</a></li>
            @else
                <li><a href="{{ url('/join-creator') }}" class="hover:text-yellow-400 transition duration-300 ease-in-out">Join Creators</a></li>
            @endif



            @endauth
        </ul>
        <!-- Right Side Of Navbar -->
        <div class="ml-auto relative flex items-center">
            @auth
            <button id="buytoken" class="flex items-center mr-4 bg-white p-3 rounded-lg shadow-md transform transition-all hover:scale-105 hover:bg-red-100">
                <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-2">
                    <span class="text-sm font-bold">H</span>
                </div>
                <span class="text-sm font-semibold text-gray-800">Tokens: {{ Auth::user()->token }}</span>
            </button>
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
                <button id="userDropdownButton" class="hover:text-yellow-400 focus:outline-none text-lg font-semibold flex items-center">
                    <!-- Tampilkan nama pengguna dengan sedikit margin ke kanan -->
                    <span class="mr-2">{{ Auth::user()->name }}</span>
                    <!-- Tampilkan gambar profil jika ada -->
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="w-8 h-8 rounded-full ml-2">
                    @else
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center ml-2">
                            <span class="text-sm font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                    @endif
                </button>
                <!-- Dropdown Menu -->
                <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white text-black shadow-lg rounded-lg z-10">
                    <a href="{{ route('profile') }}"
                       class="block px-4 py-2 hover:bg-gray-200 transition duration-200 ease-in-out">
                       Profile
                    </a>
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

    @auth

    <div id="topupPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg text-center">
            <!-- Title -->
            <p class="text-xl text-gray-800 mb-6">Get More Tokens</p>
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

    <script>


        document.addEventListener('DOMContentLoaded', () => {
            const topupPopup = document.getElementById('topupPopup');
            const topupOptions = document.querySelectorAll('.topupOption');
            const creditCardForm = document.getElementById('creditCardForm');
            const closeTopup = document.getElementById('closeTopup');
            const confirmTopup = document.getElementById('confirmTopup');
            const buyToken = document.getElementById('buytoken');


            buyToken.addEventListener('click', () => {

                topupPopup.classList.remove('hidden');
        });

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

            // Close Top-Up Modal
            closeTopup.addEventListener('click', () => {
                topupPopup.classList.add('hidden');
                creditCardForm.classList.add('hidden'); // Hide credit card form
            });

            // Confirm Top-Up
            confirmTopup.addEventListener('click', () => {
                const cardNumber = document.getElementById('cardNumber').value;
                const expiryDate = document.getElementById('expiryDate').value;
                const cvv = document.getElementById('cvv').value;

                if (!selectedAmount) {
                    alert("Please select a top-up amount.");
                    return;
                }

                if (!cardNumber || !expiryDate || !cvv) {
                    alert("Please fill in all credit card details.");
                    return;
                }

                // Submit top-up details
                fetch('/process-topup', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        amount: selectedAmount,
                        cardNumber: cardNumber,
                        expiryDate: expiryDate,
                        cvv: cvv
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Top-up of ${selectedAmount} tokens successful!`);
                        location.reload(); // Reload the page to reflect new balance
                    } else {
                        alert(data.error || "Failed to process top-up.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while processing your request.');
                });
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



    @endauth
    @yield('content')
</div>
</body>
</html>
