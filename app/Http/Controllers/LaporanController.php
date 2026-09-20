<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu; // Memanggil model Menu

class LaporanController extends Controller
{
    public function index()
    {
        // 1. Ambil seluruh data menu beserta stok & harganya dari database
        $menus = Menu::all();

        // 2. Kirim data $menus ke halaman view admin/laporan.blade.php
        return view('admin.laporan', compact('menus'));
    }
}