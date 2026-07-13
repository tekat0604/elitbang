<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $cariUser = User::where('google_id', $googleUser->id)->first();
            if ($cariUser) {
                Auth::login($cariUser);
                return redirect()->intended(route('dashboard'));
            } else {
                $existingEmail = User::where('email', $googleUser->email)->first();

                if ($existingEmail) {
                    $existingEmail->update([
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar,
                    ]);
                    Auth::login($existingEmail);
                } else {
                    $newUser = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar,
                        'password' => null,
                        'role' => 'user',
                        'email_verified_at' => now(),
                    ]);
                    Auth::login($newUser);
                }
                return redirect()->intended(route('dashboard'));
            }
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }


}
