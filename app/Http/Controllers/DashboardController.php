<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total seluruh pendapatan (misal dari harga dikali stok atau total kuantitas terjual)
        $totalPendapatan = Menu::sum(\DB::raw('harga * stok')); 
        
        // Menghitung jumlah menu aktif yang tersedia
        $menuTersedia = Menu::where('stok', '>', 0)->count();

        return view('admin.dashboard', compact('totalPendapatan', 'menuTersedia'));
    }
}
