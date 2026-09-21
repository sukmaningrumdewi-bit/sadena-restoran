<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManajemenAkunController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        $totalAkun = $users->count();
        // Menyesuaikan dengan nilai enum role di database (misal 'admin' atau 'Admin')
        $totalAdmin = $users->whereIn('role', ['admin', 'Admin', 'master admin'])->count();
        $totalKasir = $users->whereIn('role', ['kasir', 'Kasir', 'user'])->count();

        $admins = $users->whereIn('role', ['admin', 'Admin', 'master admin']);
        $cashiers = $users->whereIn('role', ['kasir', 'Kasir', 'user']);

        return view('admin.manajemen_akun', compact('totalAkun', 'totalAdmin', 'totalKasir', 'admins', 'cashiers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:255',
            'role'  => 'required|string',
        ]);

        User::create([
            'nama'     => $request->name,
            'email'    => $request->email,
            'no_telp'  => $request->phone, // Menyesuaikan kolom database 'no_telp'
            'role'     => strtolower($request->role) === 'kasir' ? 'kasir' : strtolower($request->role),            
            'password' => Hash::make('password123'),
        ]);

        return redirect()->route('admin.manajemen-akun')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.manajemen-akun')->with('success', 'Akun berhasil dihapus!');
    }
}