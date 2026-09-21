<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanans; // Pastikan model Pesanan sudah ada
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        // 1. Ambil data Menu untuk tabel Produk Terlaris
        // (Bisa disesuaikan nanti jika ingin diurutkan berdasarkan yang paling laku)
        $menus = Menu::all();

        // 2. Hitung Data HARI INI
        $todayRevenue = Pesanans::whereDate('created_at', Carbon::today())->sum('total_harga'); 
        $todayOrders  = Pesanans::whereDate('created_at', Carbon::today())->count();

        // 3. Hitung Data MINGGU INI
        $weekRevenue = Pesanans::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_harga');
        $weekOrders  = Pesanans::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        // 4. Hitung Data BULAN INI
        $monthRevenue = Pesanans::whereMonth('created_at', Carbon::now()->month)
                               ->whereYear('created_at', Carbon::now()->year)
                               ->sum('total_harga');
        $monthOrders  = Pesanans::whereMonth('created_at', Carbon::now()->month)
                              ->whereYear('created_at', Carbon::now()->year)
                              ->count();

        // Kirim semua variabel ke tampilan laporan.blade.php
        return view('admin.laporan', compact(
            'menus', 
            'todayRevenue', 'todayOrders', 
            'weekRevenue', 'weekOrders', 
            'monthRevenue', 'monthOrders'
        ));
    }
}