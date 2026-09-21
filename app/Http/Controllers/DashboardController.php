<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\User;
use App\Models\Pesanans;

class DashboardController extends Controller
{
    public function index()
    {
       // Gunakan tabel Pesanan agar sinkron dengan Laporan (mulai dari 0 dengan jujur)
        $totalPendapatan = Pesanans::sum('total_harga'); 
        
        $menuTersedia = Menu::where('stok', '>', 0)->count();
        $totalPengguna = User::where('role', 'user')->count();

        return view('admin.dashboard', compact('totalPendapatan', 'menuTersedia', 'totalPengguna'));
    }
}
