<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Favorite; // 
use Illuminate\Support\Facades\Auth; //

class UserDashboardController extends Controller
{
 public function index()
{
    $menus = Menu::all();
    
    $favoriteMenuIds = Favorite::where('user_id', Auth::id())
                        ->pluck('id_menu')
                        ->toArray();

    return view('user.dashboard', compact('menus', 'favoriteMenuIds'));
}
}