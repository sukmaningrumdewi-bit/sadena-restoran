@extends('user.layouts.app')

@section('title', 'Pesanan Saya — Sadena')

@section('content')
  <h1 style="margin: 0; font-size: 28px; font-weight: 800; color: #461300;">Pesanan Saya</h1>

  <!-- Pencarian -->
  <div style="position: relative; margin-top: 22px;">
    <input type="search" placeholder="Cari ID pesanan atau nama makanan" style="width: 100%; height: 42px; padding: 0 16px 0 40px; border: 1px solid rgba(0,0,0,0.3); border-radius: 10px; background: #fff;" />
  </div>

  <!-- Daftar pesanan -->
  <div style="display: flex; flex-direction: column; gap: 20px; margin-top: 24px;">
    <article style="background: #fff; padding: 20px; border-radius: 20px; border: 1px solid rgba(0,0,0,0.2);">
      <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(0,0,0,0.15); padding-bottom: 12px;">
        <strong>#ORD-20260909-02</strong>
        <span style="background: #fff3e0; color: #e87351; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600;">Belum Bayar</span>
      </div>
      <p style="margin: 14px 0 6px; font-size: 16px; font-weight: 700;">1X Nasi Goreng Seafood + 2X Sate Ayam</p>
      <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
        <span style="font-weight: 700; color: #461300;">RP. 38.000</span>
        <button type="button" style="background: #461300; color: #fff; border: none; padding: 8px 18px; border-radius: 8px; font-weight: 700; cursor: pointer;">Bayar Sekarang</button>
      </div>
    </article>
  </div>
@endsection