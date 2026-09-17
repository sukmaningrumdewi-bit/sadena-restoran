@extends('user.layouts.app')

@section('title', 'Menu Favorit — Sadena')

@section('content')
  <h1 style="margin: 0; font-size: 32px; font-weight: 800; color: #3D1000; text-align: center;">Makanan Kesukaanmu</h1>
  <p style="margin: 8px 0 0; font-size: 16px; color: #927265; text-align: center;">Simpan dan pesan kembali makanan favoritmu dengan sekali klik</p>

  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 24px; margin-top: 32px;">
    @forelse($favorites ?? [] as $menu)
      <article style="border: 1px solid rgba(0,0,0,0.15); border-radius: 12px; background: #fff; overflow: hidden;">
        <div style="height: 150px; background: #fdf1e3; display: grid; place-items: center;">
          <span style="font-weight: 700; color: #3D1000;">{{ $menu->nama_menu }}</span>
        </div>
        <div style="padding: 16px;">
          <span style="font-weight: 700; color: #3D1000;">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
        </div>
      </article>
    @empty
      <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: #fff; border-radius: 12px;">
        <p style="margin: 0; font-weight: 700; color: #3D1000;">Belum ada menu favorit yang disimpan.</p>
      </div>
    @endforelse
  </div>
@endsection