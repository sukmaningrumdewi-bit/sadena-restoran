<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class HomeController extends Controller
{
public function index()
{
    $hidanganUtama = Menu::where('kategori', 'Hidangan Utama')->where('is_active', 1)->get();
        $sajianBerkuah = Menu::where('kategori', 'Sajian Berkuah')->where('is_active', 1)->get();
        $pencuciMulut  = Menu::where('kategori', 'Pencuci Mulut')->where('is_active', 1)->get();
        $minumanSegar  = Menu::where('kategori', 'Minuman Segar')->where('is_active', 1)->get();

        return view('index', compact('hidanganUtama', 'sajianBerkuah', 'pencuciMulut', 'minumanSegar'));
}
}