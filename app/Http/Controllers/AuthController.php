<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('user.login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            // Tentukan arah redirect berdasarkan role
            $redirectUrl = ($user->role === 'admin') ? route('admin.dashboard') : route('user.dashboard');

            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil! Mengalihkan...',
                'redirect' => $redirectUrl
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Email atau kata sandi salah.'
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', 
        ]);

        // Otomatis login setelah register berhasil
        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'status' => 'success',
            'message' => 'Registrasi berhasil! Mengalihkan...',
            'redirect' => route('user.dashboard')
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/user');
    }
}