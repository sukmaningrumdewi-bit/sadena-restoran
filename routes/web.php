<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasirAuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserReservasiController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserFavoriteController;

Route::get('/', [HomeController::class, 'index']);

// Landing Page Routes
Route::post('/admin/landing-page/store', [MenuController::class, 'storeLandingMenu'])->name('admin.landing.store');
Route::delete('/admin/landing-page/remove/{id}', [MenuController::class, 'removeLandingMenu'])->name('admin.landing.remove');

// Proses Register (Menggunakan AuthController)
Route::post('/register-proses', [AuthController::class, 'register'])->name('register.proses');

// ==========================================
// KASIR (Menggunakan KasirAuthController)
// ==========================================
Route::get('/kasir', function () {
    return view('kasir.login');
})->name('kasir.login');

Route::post('/kasir/login', [KasirAuthController::class, 'login'])->name('kasir.login.post');

Route::middleware(['auth'])->group(function () {
    Route::get('/kasir/dashboard', function () {
        return view('kasir.dashboard');
    })->name('kasir.dashboard');
    
    Route::post('/kasir/logout', [KasirAuthController::class, 'logout'])->name('kasir.logout');
});

// ==========================================
// ADMIN & USER (View Dipisah Secara Tegas)
// ==========================================
// 1. Halaman Login Admin
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.login');

// 2. Halaman Login User (DIPERBARUI)
Route::get('/user', function () {
    return view('user.login'); 
})->name('user.login'); // <-- Diubah menjadi 'user.login'

// Proses Login POST
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/user/login', [AuthController::class, 'login'])->name('user.login.post');
Route::post('/login-proses', [AuthController::class, 'login'])->name('login.proses');

// Dashboard Admin & User (Dilindungi middleware)
Route::middleware(['auth'])->group(function () {
    // ---- ADMIN ROUTES ----
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/pemesanan', function () {
        return view('admin.pemesanan');
    })->name('admin.pemesanan');

    Route::get('/admin/menu', [MenuController::class, 'index'])->name('admin.menu');
    Route::post('/admin/menu', [MenuController::class, 'store'])->name('admin.menu.store');
    Route::delete('/admin/menu/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
    Route::get('/admin/menu/{id}/edit', [MenuController::class, 'edit'])->name('admin.menu.edit');
    Route::put('/admin/menu/{id}', [MenuController::class, 'update'])->name('admin.menu.update');

    Route::get('/admin/pelanggan', function () {
        return view('admin.pelanggan');
    })->name('admin.pelanggan');

    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');

    Route::get('/admin/pengaturan', function () {
        return view('admin.pengaturan');
    })->name('admin.pengaturan');


    // ---- USER ROUTES ----
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    
    // Route Favorit
    Route::get('/user/favorit', [UserFavoriteController::class, 'index'])->name('user.favorit');
    Route::post('/user/favorit/toggle', [UserFavoriteController::class, 'toggle'])->name('user.favorit.toggle');
 
    Route::get('/user/pesanan', function () {
        return view('user.pesanan'); 
    })->name('user.pesanan');

    // Route Reservasi User
    Route::get('/user/reservasi', [UserReservasiController::class, 'index'])->name('user.reservasi');
    Route::post('/user/reservasi', [UserReservasiController::class, 'store'])->name('user.reservasi.store');

    Route::get('/user/profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::put('/user/profile', [UserProfileController::class, 'update'])->name('user.profile.update');

    // Proses Logout bersama
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});