@extends('user.layouts.app')

@section('title', 'Menu Favorit — Sadena')

@section('content')
<h1 style="margin: 0; font-size: 32px; font-weight: 800; color: #3D1000; text-align: center;">Makanan Kesukaanmu</h1>
<p style="margin: 8px 0 0; font-size: 16px; color: #927265; text-align: center;">Simpan dan pesan kembali menu favoritmu dengan mudah</p>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 24px; margin-top: 30px;">
  
  @forelse($favorites as $menu)
    <article style="border: 1px solid rgba(0,0,0,0.15); border-radius: 12px; background: #fff; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
      <div>
        @if($menu->gambar)
          <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" style="width: 100%; height: 150px; object-fit: cover;">
        @else
          <div style="height: 150px; background: #fdf1e3; display: grid; place-items: center; font-size: 32px;">🍽️</div>
        @endif

        <div style="padding: 16px;">
          <span style="font-size: 12px; font-weight: 700; color: #64748b; background: #f1f5f9; padding: 3px 8px; border-radius: 6px;">{{ $menu->kategori }}</span>
          <h3 style="margin: 8px 0 4px; font-size: 16px; font-weight: 800; color: #3D1000;">{{ $menu->nama_menu }}</h3>
          <span style="font-weight: 700; color: #16a34a;">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
        </div>
      </div>
    </article>
  @empty
    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: #fff; border-radius: 12px; color: #64748b; border: 1px solid #e2e8f0;">
      Belum ada menu favorit yang disimpan.
    </div>
  @endforelse

</div>
@endsection