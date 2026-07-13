<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        if ($request->has('error')) {
            return redirect('/');
        }

        $googleUser = Socialite::driver('google')->user();

        $fullName = $googleUser->getName() ?? '';
        $nameParts = explode(' ', $fullName, 2);

        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if (!$user) {
            $user = new User();
            $user->password = Hash::make('123');
        }

        $user->google_id = $googleUser->getId();
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->email = $googleUser->getEmail();
        $user->profile_image_url = $googleUser->getAvatar();
        $user->email_verified_at = now();
        $user->google_token = $googleUser->token;

        if ($googleUser->refreshToken) {
            $user->google_refresh_token = $googleUser->refreshToken;
        }

        $user->save();

        Auth::login($user);

        return redirect('/dashboard');
    }
}
