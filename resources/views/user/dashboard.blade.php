@extends('user.layouts.app')

@section('title', 'Status Pesanan — Sadena')

@section('content')
  <h1 style="margin: 0; font-size: 32px; font-weight: 700; color: #461309;">Status Pesanan Anda</h1>
  <p style="margin: 8px 0 0; font-size: 20px; color: #927265;">Pantau proses masak makananmu secara real-time disini</p>

  <!-- Kartu ringkasan -->
  <section style="display: grid; grid-template-columns: 1fr 1fr; gap: 34px; margin-top: 40px;">
    <div style="background: #fad1a3; padding: 20px 24px; border-radius: 20px; position: relative; overflow: hidden;">
      <span style="font-size: 32px; font-weight: 800; color: #000;">1</span>
      <p style="margin: 4px 0 0; font-size: 15px; color: #000;">Sedang Dimasak</p>
    </div>
    <div style="background: #fff; padding: 20px 24px; border-radius: 20px; border: 1px solid rgba(0,0,0,0.1);">
      <span style="font-size: 32px; font-weight: 800; color: #000;">3</span>
      <p style="margin: 4px 0 0; font-size: 15px; color: #000;">Selesai Hari ini</p>
    </div>
  </section>

  <!-- Daftar Pesanan Singkat -->
  <div style="margin-top: 40px; display: flex; flex-direction: column; gap: 18px;">
    <article style="background: #fff; padding: 20px; border-radius: 20px; border: 1px solid rgba(0,0,0,0.2);">
      <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(0,0,0,0.15); padding-bottom: 12px;">
        <strong>#ORD-20260909-02</strong>
        <span style="background: #fbd9b3; color: #653b2b; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600;">Sedang Dimasak</span>
      </div>
      <p style="margin: 14px 0 6px; font-size: 16px; font-weight: 700;">2X Nasi Goreng Spesial + 1x Es Teh Manis</p>
      <p style="margin: 0; font-size: 13px; color: #7a5c50;">Catatan: Pedas Sedang, Kerupuk dipisah</p>
    </article>
  </div>
@endsection