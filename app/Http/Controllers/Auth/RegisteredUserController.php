<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Exception;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.pages.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ], [
                'first_name.required' => 'Nama depan wajib diisi.',
                'last_name.required' => 'Nama belakang wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'password.required' => 'Kata sandi wajib diisi.',
                'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            ]);

            $user = User::create([
                'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            if (!$user->hasRole('customer')) {
                $user->assignRole('customer');
            }

            event(new Registered($user));
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang di Robodeliver.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (Exception $e) {
            return redirect()->route('register')
                ->withErrors(['msg' => 'Terjadi kesalahan. Silakan coba lagi.'])
                ->withInput();
        }
    }
}
