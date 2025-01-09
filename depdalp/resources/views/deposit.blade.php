@extends('layouts.template')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Deposit Tokens to Real Money</h2>

    <!-- Display success message -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display error messages -->
    @if($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('deposit.submit') }}" method="POST">
        @csrf

        <!-- Token Amount Input -->
        <div class="mb-4">
            <label for="token_amount" class="block text-gray-700">Amount of Tokens to Exchange</label>
            <input
                type="number"
                id="token_amount"
                name="token_amount"
                class="mt-2 p-2 border border-gray-300 rounded w-full"
                required
                min="1"
                placeholder="Enter the amount of tokens"
                value="{{ old('token_amount') }}">
        </div>

        <!-- Bank Account Number Input -->
        <div class="mb-4">
            <label for="account_number" class="block text-gray-700">Bank Account Number</label>
            <input
                type="text"
                id="account_number"
                name="account_number"
                class="mt-2 p-2 border border-gray-300 rounded w-full"
                required
                placeholder="Enter your bank account number"
                value="{{ old('account_number') }}">
        </div>

        <!-- Account Holder Name Input -->
        <div class="mb-4">
            <label for="account_name" class="block text-gray-700">Account Holder Name</label>
            <input
                type="text"
                id="account_name"
                name="account_name"
                class="mt-2 p-2 border border-gray-300 rounded w-full"
                required
                placeholder="Enter the account holder's name"
                value="{{ old('account_name') }}">
        </div>

        <!-- Bank Selection -->
        <div class="mb-4">
            <label for="bank_name" class="block text-gray-700">Bank Name</label>
            <select
                id="bank_name"
                name="bank_name"
                class="mt-2 p-2 border border-gray-300 rounded w-full"
                required>
                <option value="BCA" {{ old('bank_name') == 'BCA' ? 'selected' : '' }}>BCA</option>
                <option value="Mandiri" {{ old('bank_name') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                <option value="BRI" {{ old('bank_name') == 'BRI' ? 'selected' : '' }}>BRI</option>
                <option value="BNI" {{ old('bank_name') == 'BNI' ? 'selected' : '' }}>BNI</option>
                <!-- Add more bank options as needed -->
            </select>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Submit Deposit Request
            </button>
        </div>
    </form>
</div>
@endsection
