<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;
use App\Models\MerchantProduct;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $data = [];

    // Customer Data
    if ($user->hasRole('customer')) {
        $data['wallet'] = $user->wallet;
        $data['transactions'] = $user->wallet
            ? $user->wallet->transactions()->latest()->take(5)->get()
            : collect();
        $data['merchant'] = $user->merchant; // Add merchant data for customer
    }

    // Admin Data
    if ($user->hasRole('admin')) {
        $data['totalUsers'] = User::count();
        $data['totalOrders'] = Order::count();
        $data['totalMerchants'] = Merchant::count();
        $data['pendingMerchants'] = Merchant::where('status', 'pending')->count();
        $data['merchants'] = Merchant::latest()->paginate(10);
    }

    // Merchant Data
    if ($user->hasRole('merchant')) {
        $merchant = $user->merchant;

        $data['merchant'] = $merchant;
        $data['totalProducts'] = $merchant ? $merchant->products()->count() : 0;
        $data['merchantOrders'] = $merchant ? $merchant->orders()->count() : 0;
        $data['balance'] = $merchant ? $merchant->owner->wallet->balance : 0;
        $data['products'] = $merchant ? $merchant->products()->paginate(10) : [];
    }


    return view('dashboard', $data);
}

}
