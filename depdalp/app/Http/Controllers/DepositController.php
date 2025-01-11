<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;

class DepositController extends Controller
{
    // Fungsi untuk menampilkan form deposit
    public function showForm()
    {
        return view('deposit-token');
    }

    // Fungsi untuk menangani pengiriman form deposit
    public function submitDeposit(Request $request)
{
    // Assuming the user is authenticated and you have access to the user's token balance
    $user = Auth::user();
    $userTokenBalance = $user->token; // Make sure 'token_balance' is a field in the user model

    // Validate the amount of tokens entered by the user
    $request->validate([
        'token_amount' => 'required|integer|min:1',
        'account_number' => 'required|string',
        'account_name' => 'required|string',
        'bank_name' => 'required|string',
    ]);

    $tokenAmount = $request->input('token_amount');

    if ($tokenAmount > $userTokenBalance) {
        return back()->withErrors(['token_amount' => 'Not enough tokens to exchange.']);
    }

    // Proceed with the deposit logic (e.g., updating the user's token balance and processing the deposit)
    $user->token -= $tokenAmount;
    $user->save();

    // Handle deposit logic (store transaction, notify user, etc.)

    return back()->with('success', 'Deposit request submitted successfully!');
}

public function calculateIdr(Request $request)
{
    $request->validate([
        'token_amount' => 'required|numeric|min:100',
    ]);

    $tokenAmount = $request->token_amount;
    $tokenPrice = 330; // Price per token in IDR
    $grossAmount = $tokenAmount * $tokenPrice;
    $appFee = $grossAmount * 0.1; // 10% application fee
    $netAmount = $grossAmount - $appFee;

    return response()->json([
        'gross_amount' => number_format($grossAmount, 0, ',', '.'),
        'app_fee' => number_format($appFee, 0, ',', '.'),
        'net_amount' => number_format($netAmount, 0, ',', '.'),
    ]);
}


}
