<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class UserFavoriteController extends Controller
{
    // Halaman Menu Favorit
    public function index()
{
    $favorites = Menu::whereIn('id_menu', function($query) {
        $query->select('id_menu')
              ->from('favorites')
              ->where('user_id', Auth::id());
    })->get();

    // Pastikan penulisan nama variabel 'favorites' sama persis dengan di compact()
    return view('user.favorit', compact('favorites'));
}

    // Toggle Tambah/Hapus via AJAX
    public function toggle(Request $request)
    {
        $request->validate([
            'id_menu' => 'required|exists:menus,id_menu'
        ]);

        $userId = Auth::id();
        $idMenu = $request->id_menu;

        $favorite = Favorite::where('user_id', $userId)->where('id_menu', $idMenu)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'user_id' => $userId,
                'id_menu' => $idMenu
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}