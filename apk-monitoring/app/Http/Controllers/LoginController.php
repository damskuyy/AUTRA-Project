<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display the login page.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            // Cari user berdasarkan email atau name (username)
            $user = User::where('email', $validated['username'])
                ->orWhere('name', $validated['username'])
                ->first();

            // Jika user tidak ditemukan
            if (!$user) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Username atau password tidak sesuai'
                    ], 401);
                }
                
                return back()->withErrors([
                    'username' => 'Username atau password tidak sesuai'
                ])->withInput($request->only('username'));
            }

            // Cek apakah akun inactive
            if ($user->status === 'inactive') {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Akun Anda telah dinonaktifkan. Hubungi administrator.'
                    ], 403);
                }

                return back()->withErrors([
                    'username' => 'Akun Anda telah dinonaktifkan. Hubungi administrator.'
                ])->withInput($request->only('username'));
            }

            // Verifikasi password
            if (!Hash::check($validated['password'], $user->password)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Username atau password tidak sesuai'
                    ], 401);
                }

                return back()->withErrors([
                    'username' => 'Username atau password tidak sesuai'
                ])->withInput($request->only('username'));
            }

            // Login berhasil
            Auth::login($user);

            // Update last login time
            $user->update(['last_login' => now()]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil',
                    'redirect' => route('dashboard')
                ], 200);
            }

            return redirect()->intended(route('dashboard'))->with('success', 'Login berhasil');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return back()->withErrors([
                'username' => 'Terjadi kesalahan saat login'
            ]);
        }
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil');
    }
}
