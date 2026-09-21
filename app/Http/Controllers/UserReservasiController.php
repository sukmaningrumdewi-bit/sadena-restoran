<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserReservasiController extends Controller
{
    public function index()
    {
        // Ambil data reservasi milik user yang sedang login
        $reservations = Reservation::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.reservasi', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'      => 'required|date|after_or_equal:today',
            'waktu'        => 'required',
            'jumlah_orang' => 'required|numeric|min:1|max:20',
            'area'         => 'required|string',
            'catatan'      => 'nullable|string|max:255',
        ]);

        // Buat kode unik otomatis, misal RES-84920
        $kode = 'RES-' . strtoupper(Str::random(5));

        Reservation::create([
            'user_id'        => Auth::id(),
            'kode_reservasi' => $kode,
            'tanggal'        => $request->tanggal,
            'waktu'          => $request->waktu,
            'jumlah_orang'   => $request->jumlah_orang,
            'area'           => $request->area,
            'catatan'        => $request->catatan,
            'status'         => 'pending',
        ]);

        return redirect()->back()->with('success', 'Pengajuan reservasi berhasil dikirim!');
    }
}