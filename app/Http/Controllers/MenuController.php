<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    // 1. Menampilkan data ke halaman admin/menu.blade.php beserta statistik
    public function index()
    {
        $menus = Menu::all();
        
        // Menghitung statistik untuk kotak atas secara dinamis
        $totalMenu = $menus->count();
        $menuAktif = $menus->where('stok', '>', 0)->count();
        $stokHabis = $menus->where('stok', '<=', 0)->count();

        return view('admin.menu', compact('menus', 'totalMenu', 'menuAktif', 'stokHabis'));
    }

    // 2. Menyimpan menu baru beserta foto aslinya
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori'  => 'required|string',
            'harga'     => 'required|numeric',
            'stok'      => 'required|integer',
            'gambar'    => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        // Menyimpan file foto ke folder storage/app/public/menu_images
        $path = $request->file('gambar')->store('menu_images', 'public');

        // Memasukkan data ke database dengan menyesuaikan seluruh kolom tabel
        Menu::create([
            'nama_menu' => $request->nama_menu,
            'kategori'  => $request->kategori,
            'harga'     => $request->harga,
            'stok'      => $request->stok,
            'gambar'    => $path,
            'deskripsi' => $request->deskripsi,
            'is_active' => 1, // Default aktif
        ]);

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil ditambahkan!');
    }

    // 3. Menghapus menu
    public function destroy($id)
    {
        // Sesuaikan dengan primary key tabel kamu (id_menu)
        $menu = Menu::where('id_menu', $id)->firstOrFail();
        
        // Hapus file gambar fisik jika ada
        if ($menu->gambar && \Storage::disk('public')->exists($menu->gambar)) {
            \Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil dihapus!');
    }


public function storeLandingMenu(Request $request)
{
    $request->validate([
        'id_menu' => 'required|exists:menus,id_menu',
        'kategori_beranda' => 'required|string',
    ]);

    // Hitung jumlah menu yang sudah aktif di kategori tujuan pada landing page
    $currentCount = Menu::where('kategori', $request->kategori_beranda)
                        ->where('is_active', 1)
                        ->count();

    $menu = Menu::where('id_menu', $request->id_menu)->firstOrFail();

    // Jika kategori tersebut sudah berisi 4 atau lebih, dan menu ini bukan bagian dari kategori itu sebelumnya
    if ($menu->kategori !== $request->kategori_beranda && $currentCount >= 4) {
        return redirect()->back()->with('error', 'Kategori "' . $request->kategori_beranda . '" sudah mencapai batas maksimal 4 menu!');
    }

    // Jika jumlah sudah 4 dan menu ini statusnya belum aktif di kategori yang sama
    if ($menu->kategori === $request->kategori_beranda && $currentCount >= 4 && $menu->is_active == 0) {
        return redirect()->back()->with('error', 'Kategori "' . $request->kategori_beranda . '" sudah penuh (maksimal 4 menu).');
    }

    $menu->update([
        'kategori'  => $request->kategori_beranda,
        'is_active' => 1,
    ]);

    return redirect()->back()->with('success', 'Menu berhasil diatur ke Landing Page!');
}

public function removeLandingMenu($id)
{
    $menu = Menu::where('id_menu', $id)->firstOrFail();
    
    // Nonaktifkan menu agar tidak tampil lagi di landing page
    $menu->update([
        'is_active' => 0
    ]);

    return redirect()->back()->with('success', 'Menu berhasil dihapus dari Landing Page!');
}
}