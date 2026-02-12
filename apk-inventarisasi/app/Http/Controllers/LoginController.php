<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $email = Cookie::get('remembered_email');
        return view('login', ['rememberedEmail' => $email]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            if ($request->has('remember')) {
                // store email for 30 days (minutes)
                Cookie::queue('remembered_email', $request->email, 60 * 24 * 30);
            } else {
                Cookie::queue(Cookie::forget('remembered_email'));
            }

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('status', 'Berhasil logout.');
    }
}
