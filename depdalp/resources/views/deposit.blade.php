@extends('layouts.template')

@section('content')
<div class="container mx-auto max-w-lg p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Exchange Token</h2>

    <!-- Display success message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display error messages -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('deposit.submit') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Token Amount Input -->
        <div>
            <label for="token_amount" class="block text-sm font-medium text-gray-700">Amount of Tokens to Exchange</label>
            <input
                type="number"
                id="token_amount"
                name="token_amount"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                required
                min="100"
                placeholder="Enter the amount of tokens"
                value="{{ old('token_amount') }}">
            <div id="idr_details" class="text-sm text-gray-500 mt-2"></div>
        </div>

        <!-- Bank Account Number Input -->
        <div>
            <label for="account_number" class="block text-sm font-medium text-gray-700">Bank Account Number</label>
            <input
                type="text"
                id="account_number"
                name="account_number"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                required
                placeholder="Enter your bank account number"
                value="{{ old('account_number') }}">
        </div>

        <!-- Account Holder Name Input -->
        <div>
            <label for="account_name" class="block text-sm font-medium text-gray-700">Account Holder Name</label>
            <input
                type="text"
                id="account_name"
                name="account_name"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                required
                placeholder="Enter the account holder's name"
                value="{{ old('account_name') }}">
        </div>

        <!-- Bank Selection -->
        <div>
            <label for="bank_name" class="block text-sm font-medium text-gray-700">Bank Name</label>
            <select
                id="bank_name"
                name="bank_name"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                required>
                <option value="BCA" {{ old('bank_name') == 'BCA' ? 'selected' : '' }}>BCA</option>
                <option value="Mandiri" {{ old('bank_name') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                <option value="BRI" {{ old('bank_name') == 'BRI' ? 'selected' : '' }}>BRI</option>
                <option value="BNI" {{ old('bank_name') == 'BNI' ? 'selected' : '' }}>BNI</option>
                <!-- Add more bank options as needed -->
            </select>
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button
                type="submit"
                class="w-full bg-red-600 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Submit Deposit Request
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('token_amount').addEventListener('input', function () {
        const tokenAmount = this.value;

        if (tokenAmount >= 100) {
            fetch('{{ route('calculate.idr') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ token_amount: tokenAmount })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('idr_details').innerHTML = `
                    <p>Gross Amount: <strong>IDR ${data.gross_amount}</strong></p>
                    <p>Application Fee (10%): <strong>IDR ${data.app_fee}</strong></p>
                    <p>Net Amount: <strong>IDR ${data.net_amount}</strong></p>
                `;
            })
            .catch(error => console.error('Error:', error));
        } else {
            document.getElementById('idr_details').textContent = 'Minimum amount is 100 tokens.';
        }
    });
</script>
@endsection
