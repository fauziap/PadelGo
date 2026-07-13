<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedRequests = $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email:dns', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'confirmed'
            ],
        ]);

        $validatedRequests['password'] = bcrypt($validatedRequests['password']);

        $user = User::create($validatedRequests);

        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();

            event(new Registered($user));

            return redirect('/dashboard/booking-history');
        }

        return back()->with('register-error', 'Something went wrong');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns', 'max:255'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            ],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->with('login-error', 'Email or password wrong!');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function update(Request $request, User $user){
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($request->hasFile('image')){
            if($user->profile_image_url && Storage::disk('public')->exists($user->profile_image_url)){
                Storage::disk('public')->delete($user->profile_image_url);
            }

            $path = $request->file('image')->store('user_photos');

            $validated['profile_image_url'] = $path;
        } else {
            $validated['profile_image_url'] = $request->input('profile_image_url');
        }

        $user->update($validated);

        return redirect('/dashboard')->with('update-profile', 'Berhasil mengubah profile');
    }
}
