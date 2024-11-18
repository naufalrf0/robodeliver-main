<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserInfoIsComplete
{
    public function handle(Request $request, Closure $next)
{
    $user = Auth::user();

    if ($user->hasRole('customer')) {
        if (!$user->userInfo && !$request->routeIs('completeprofile')) {
            return redirect()->route('completeprofile')->with('warning', 'Please complete your profile first.');
        }

        if ($user->userInfo && $request->routeIs('completeprofile')) {
            return redirect()->route('home')->with('info', 'You have already completed your profile.');
        }
    }

    return $next($request);
}

}
