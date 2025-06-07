<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // Dynamically set redirect URL based on current tenant subdomain
        $redirectUrl = request()->getSchemeAndHttpHost() . '/auth/google/callback';

        return Socialite::driver('google')
            ->redirectUrl($redirectUrl)
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $redirectUrl = request()->getSchemeAndHttpHost() . '/auth/google/callback';

            $googleUser = Socialite::driver('google')
                ->redirectUrl($redirectUrl)
                ->stateless() // prevents session state mismatch issues
                ->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'password' => bcrypt('password123'),
                    'role' => 'customer',
                ]
            );

            Auth::login($user);

            return $user->role === 'customer'
                ? redirect()->route('customer.dashboard')
                : redirect()->route('dashboard');

        } catch (Exception $e) {
            Log::error('Google login failed: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Google login failed. Please try again.');
        }
    }
}
