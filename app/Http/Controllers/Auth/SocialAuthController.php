<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;

class SocialAuthController extends Controller
{
    /**
     * Redirect to Google for authentication.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            Log::error('Redirect to Google failed: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['msg' => 'Tidak dapat terhubung ke Google, coba lagi nanti.']);
        }
    }

    /**
     * Handle Google callback.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            if (!$googleUser->getEmail()) {
                throw new Exception('Google user does not have an email.');
            }

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName() ?? 'Guest User',
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => Hash::make(Str::random(16)),
                    'email_verified_at' => now(),
                ]
            );

            if (!$user->hasRole('customer')) {
                $user->assignRole('customer');
            }

            Auth::login($user);

            return redirect()->intended('/dashboard')->with('success', 'Login berhasil!');
        } catch (Exception $e) {
            Log::error('Google Callback Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['msg' => 'Login gagal, silakan coba lagi.']);
        }
    }
}
