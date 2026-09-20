<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserProfileController extends Controller
{
    // Menampilkan halaman profil
    public function index()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // Menyimpan perubahan profil
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'password' => 'nullable|string|min:8'
        ]);

        $user->nama = $request->nama;
        $user->no_telp = $request->no_telp;
        $user->alamat = $request->alamat;

        // Jika user mengisi kolom password, maka update passwordnya
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }
}