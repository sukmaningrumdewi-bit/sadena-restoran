<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Mengambil seluruh data menu yang ada di database
        $menus = Menu::all();
        
        // Mengirim data $menus ke file view user.dashboard
        return view('user.dashboard', compact('menus'));
    }
}