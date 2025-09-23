<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect sesuai role
            if (Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard');
            } elseif (Auth::user()->role == 'pemilik') {
                return redirect('/owner/dashboard');
            } else {
                return redirect('/renter/dashboard');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    // Form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'no_tlpn' => 'required',
            'role' => 'required|in:admin,pemilik,penyewa',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_tlpn' => $request->no_tlpn,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        if ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role == 'pemilik') {
            return redirect('/owner/dashboard');
        } else {
            return redirect('/renter/dashboard');
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
