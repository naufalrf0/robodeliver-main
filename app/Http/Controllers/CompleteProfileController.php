<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class CompleteProfileController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        if ($user->userInfo) {
            return redirect()->route('dashboard')->with('info', 'Profile is already completed.');
        }

        return view('auth.pages.complete-profile');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'phone_number' => 'required|string|max:15',
                'address' => 'required|string|max:255',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);


            Auth::user()->userInfo()->create($request->only('phone_number', 'address', 'latitude', 'longitude'));

            return redirect()->route('dashboard')->with('success', 'Profile completed successfully.');
        } catch (Exception $e) {
            Log::error('Error completing profile: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withErrors(['general' => 'An unexpected error occurred. Please try again later.'])->withInput();
        }
    }
}
