<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserReservasiController extends Controller
{
    public function index()
    {
        // Nanti data reservasi dari database bisa dipanggil di sini
        return view('user.reservasi');
    }
}