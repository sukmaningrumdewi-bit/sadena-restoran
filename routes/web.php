<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasirAuthController;
use App\Http\Controllers\AuthController; // Pastikan import AuthController

// ==========================================
// LANDING PAGE
// ==========================================
Route::get('/', function () {
    return view('index'); // Memanggil index.blade.php
});

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
// ADMIN & USER (Menggunakan AuthController)
// ==========================================
// Form Login
Route::get('/admin', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::get('/user', function () {
    return view('user.login');
})->name('user.login');

// Proses Login Utama (Menggunakan method login di AuthController agar mendukung Admin & User sekaligus)
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/user/login', [AuthController::class, 'login'])->name('user.login.post');

// (Opsional jika ingin mempertahankan rute /login-proses bawaan fetch sebelumnya)
Route::post('/login-proses', [AuthController::class, 'login'])->name('login.proses');

// Dashboard Admin & User (Dilindungi middleware)
Route::middleware(['auth'])->group(function () {
    // ---- ADMIN ROUTES ----
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/pemesanan', function () {
        return view('admin.pemesanan');
    })->name('admin.pemesanan');

    // ---- USER ROUTES ----
    Route::get('/user/dashboard', function () {
        return view('user.dashboard'); 
    })->name('user.dashboard');

    Route::get('/user/pesanan', function () {
        return view('user.pesanan'); 
    })->name('user.pesanan');

    Route::get('/user/favorit', function () {
        return view('user.favorit'); 
    })->name('user.favorit');

    // Proses Logout bersama
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});