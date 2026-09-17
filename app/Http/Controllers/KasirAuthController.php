<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama' => 'required',
            'pin'  => 'required|digits:6'
        ]);

        // Coba melakukan login dengan nama, password (pin), dan role 'kasir'
        $credentials = [
            'nama'     => $request->nama, // <--- Ubah dari 'name' menjadi 'nama' di sini!
            'password' => $request->pin,
            'role'     => 'kasir' // Memastikan hanya kasir yang bisa login
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Jika berhasil, arahkan ke dashboard
            return redirect()->intended('/kasir/dashboard');
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'nama' => 'Nama kasir atau Kode Akses salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/kasir');
    }
}