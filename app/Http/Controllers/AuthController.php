<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login - support username atau email
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        // Cari user berdasarkan username atau email
        $user = User::where('username', $validated['username'])
                    ->orWhere('email', $validated['username'])
                    ->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withErrors(['username' => 'Username/Email atau password salah']);
        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect berdasarkan role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('siswa.index');
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
