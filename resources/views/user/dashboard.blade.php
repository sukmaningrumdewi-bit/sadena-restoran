@extends('user.layouts.app')

@section('title', 'Buat Pesanan — Sadena')

@section('custom-css')
<!-- CSRF Token untuk request AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
  /* ============================================================
     RESPONSIVE LAYOUT & STYLING (Diperbaiki untuk Desktop)
     ============================================================ */

  .content {
    max-width: 1400px !important;
  }
  
  .dashboard-wrapper {
    width: 100%;
    text-align: left !important;
  }

  .dashboard-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 360px; 
    gap: 30px;
    align-items: start;
  }

  .menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 18px;
    max-height: 78vh; 
    overflow-y: auto; 
    padding-right: 12px;
  }

  .menu-grid::-webkit-scrollbar { width: 6px; }
  .menu-grid::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
  .menu-grid::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

  .page-header {
    margin-bottom: 24px;
    text-align: left !important;
  }

  /* Style Tombol Favorit (Love) */
  .fav-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    z-index: 5;
    transition: transform 0.2s;
  }
  .fav-btn:hover {
    transform: scale(1.1);
  }

  @media (max-width: 1024px) {
    .dashboard-layout {
      grid-template-columns: 1fr;
    }
    .menu-grid {
      max-height: none; 
      overflow-y: visible;
    }
    .cart-sidebar {
      position: static !important;
      margin-top: 16px;
    }
  }

  @media (max-width: 576px) {
    .menu-grid {
      grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    }
  }
</style>
@endsection

@section('content')
<div class="dashboard-wrapper">
  
  <div class="page-header">
    <h1 style="margin: 0; font-size: 28px; font-weight: 800; color: #461309;">Pilih Menu Favoritmu</h1>
    <p style="margin: 6px 0 0; font-size: 15px; color: #7a5c50;">Silakan pilih menu dan atur jumlah pesanan di bawah ini</p>
  </div>

  <div class="dashboard-layout">

    <!-- ================= KOLOM KIRI: DAFTAR MENU & FILTER ================= -->
    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
      
      <div style="display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap;">
        <div style="position: relative; flex: 1; min-width: 200px;">
          <input type="search" id="userSearchInput" placeholder="Cari menu..." style="width: 100%; height: 44px; padding: 0 16px 0 40px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; outline: none; text-align: left;">
          <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8;">🔍</span>
        </div>
        
        <div style="width: 100%; max-width: 200px;">
          <select id="userCategoryFilter" style="width: 100%; height: 44px; padding: 0 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #fff; cursor: pointer; outline: none; text-align: left;">
            <option value="all">Semua Kategori</option>
            <option value="Hidangan Utama">Hidangan Utama</option>
            <option value="Sajian Berkuah">Sajian Berkuah</option>
            <option value="Pencuci Mulut">Pencuci Mulut</option>
            <option value="Minuman Segar">Minuman Segar</option>
          </select>
        </div>
      </div>

      <!-- Grid Daftar Menu -->
      <div id="userMenuGrid" class="menu-grid">
        @foreach($menus as $menu)
          @php
    $isHabis = $menu->stok <= 0;
    // Cek apakah id_menu ada di dalam array $favoriteMenuIds dari controller
    $isFav = in_array($menu->id_menu, $favoriteMenuIds ?? []);
@endphp
          
          <div class="menu-card" data-name="{{ strtolower($menu->nama_menu) }}" data-category="{{ $menu->kategori }}" 
               style="position: relative; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px; background: #fcfdfd; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s; opacity: {{ $isHabis ? '0.6' : '1' }}; filter: {{ $isHabis ? 'grayscale(80%)' : 'none' }}; text-align: left;">
            
            <!-- Tombol Favorit (Love) -->
            <button type="button" class="fav-btn" onclick="toggleFavorite({{ $menu->id_menu }}, this)" title="Sukai / Batal Sukai">
              <span class="heart-icon" style="font-size: 16px;">{{ $isFav ? '❤️' : '🤍' }}</span>
            </button>

            <div>
              @if($menu->gambar)
                <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" style="width: 100%; height: 110px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
              @else
                <div style="width: 100%; height: 110px; background: #f1f5f9; border-radius: 8px; display: grid; place-items: center; font-size: 28px; margin-bottom: 10px;">🍽️</div>
              @endif
              
              <span style="font-size: 11px; font-weight: 700; color: #64748b; background: #f1f5f9; padding: 3px 8px; border-radius: 6px;">{{ $menu->kategori }}</span>
              <h3 style="font-size: 14px; font-weight: 700; color: #1e293b; margin: 8px 0 4px; line-height: 1.3;">{{ $menu->nama_menu }}</h3>
              <div style="font-size: 14px; font-weight: 800; color: #16a34a; margin-bottom: 10px;">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
            </div>

            <div>
              <div style="font-size: 12px; color: {{ $isHabis ? '#dc2626' : '#64748b' }}; font-weight: {{ $isHabis ? '700' : '500' }}; margin-bottom: 8px;">
                {{ $isHabis ? 'Stok Habis' : 'Stok: ' . $menu->stok }}
              </div>
              
              @if(!$isHabis)
                <button type="button" onclick="addToCart({{ $menu->id_menu }}, '{{ $menu->nama_menu }}', {{$menu->harga }})" 
                        style="width: 100%; height: 36px; background: #461309; color: #ffffff; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: 0.2s;">
                  + Tambah
                </button>
              @else
                <button type="button" disabled style="width: 100%; height: 36px; background: #cbd5e1; color: #64748b; border: none; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: not-allowed;">
                  Habis
                </button>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- ================= KOLOM KANAN: KERANJANG PESANAN ================= -->
    <div class="cart-sidebar" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); position: sticky; top: 20px; text-align: left;">
      <h2 style="font-size: 18px; font-weight: 800; color: #461309; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
        🛒 Keranjang Pesanan
      </h2>
        
      <div id="cartItemsContainer" style="max-height: 320px; overflow-y: auto; margin-bottom: 16px; display: flex; flex-direction: column; gap: 10px;">
        <div id="emptyCartText" style="text-align: center; color: #94a3b8; font-size: 14px; padding: 30px 0;">
          Keranjang masih kosong. Yuk pilih menu di samping!
        </div>
      </div>

      <div style="margin-bottom: 16px;">
        <label style="display: block; font-size: 13px; font-weight: 700; color: #461309; margin-bottom: 6px;">Catatan (Opsional)</label>
        <textarea name="catatan" rows="2" placeholder="Contoh: Jangan pakai pedas..." style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; outline: none; box-sizing: border-box; resize: none;"></textarea>
      </div>

      <div style="border-top: 1px solid #f1f5f9; padding-top: 14px; margin-bottom: 16px;">
        <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: 800; color: #1e293b;">
          <span>Total:</span>
          <span id="cartTotalPrice" style="color: #16a34a;">Rp 0</span>
        </div>
      </div>

      <button type="button" id="checkoutBtn" disabled onclick="alert('Fitur Buat Pesanan belum diaktifkan!')" style="width: 100%; height: 50px; background: #cbd5e1; color: #64748b; border: none; border-radius: 10px; font-size: 15px; font-weight: 700; cursor: not-allowed; transition: all 0.2s;">
        Buat Pesanan Sekarang
      </button>
    </div>

  </div>
</div>

<script>
  let cart = [];

  function addToCart(id, name, price) {
    let existingItem = cart.find(item => item.id === id);
    if (existingItem) {
      existingItem.qty += 1;
    } else {
      cart.push({ id: id, name: name, price: price, qty: 1 });
    }
    updateCartUI();
  }

  function changeQty(id, delta) {
    let item = cart.find(item => item.id === id);
    if (item) {
      item.qty += delta;
      if (item.qty <= 0) {
        cart = cart.filter(i => i.id !== id);
      }
    }
    updateCartUI();
  }

  function updateCartUI() {
    let container = document.getElementById('cartItemsContainer');
    let totalPriceElem = document.getElementById('cartTotalPrice');
    let checkoutBtn = document.getElementById('checkoutBtn');
    
    container.innerHTML = '';

    if (cart.length === 0) {
      container.innerHTML = '<div style="text-align: center; color: #94a3b8; font-size: 14px; padding: 30px 0;">Keranjang masih kosong. Yuk pilih menu di samping!</div>';
      totalPriceElem.textContent = 'Rp 0';
      
      checkoutBtn.disabled = true;
      checkoutBtn.style.background = '#cbd5e1';
      checkoutBtn.style.color = '#64748b';
      checkoutBtn.style.cursor = 'not-allowed';
      return;
    }

    let totalPrice = 0;

    cart.forEach(item => {
      let subtotal = item.price * item.qty;
      totalPrice += subtotal;

      let itemHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0;">
          <div style="flex: 1; padding-right: 8px;">
            <div style="font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">${item.name}</div>
            <div style="font-size: 12px; color: #16a34a; font-weight: 700;">Rp ${item.price.toLocaleString('id-ID')}</div>
          </div>
          <div style="display: flex; align-items: center; gap: 8px;">
            <button type="button" onclick="changeQty(${item.id}, -1)" style="width: 26px; height: 26px; background: #e2e8f0; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; color: #1e293b; display: grid; place-items: center;">-</button>
            <span style="font-size: 14px; font-weight: 800; width: 20px; text-align: center;">${item.qty}</span>
            <button type="button" onclick="changeQty(${item.id}, 1)" style="width: 26px; height: 26px; background: #e2e8f0; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; color: #1e293b; display: grid; place-items: center;">+</button>
          </div>
        </div>
      `;
      container.innerHTML += itemHTML;
    });

    totalPriceElem.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
    
    checkoutBtn.disabled = false;
    checkoutBtn.style.background = '#461309';
    checkoutBtn.style.color = '#fff';
    checkoutBtn.style.cursor = 'pointer';
  }

  // Fungsi toggleFavorit() AJAX
  function toggleFavorite(menuId, btn) {
    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    if (!tokenMeta) {
      console.error('CSRF Token Meta tag tidak ditemukan!');
      return;
    }

    const token = tokenMeta.getAttribute('content');
    const heart = btn.querySelector('.heart-icon');

    fetch("{{ route('user.favorit.toggle') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
      },
      body: JSON.stringify({ id_menu: menuId })
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'added') {
        heart.textContent = '❤️';
      } else if (data.status === 'removed') {
        heart.textContent = '🤍';
      }
    })
    .catch(err => console.error(err));
  }

  document.addEventListener("DOMContentLoaded", function () {
    let searchInput = document.getElementById('userSearchInput');
    let categoryFilter = document.getElementById('userCategoryFilter');
    let cards = document.querySelectorAll('.menu-card');

    function filterMenus() {
      let query = searchInput.value.toLowerCase();
      let cat = categoryFilter.value;

      cards.forEach(card => {
        let name = card.getAttribute('data-name');
        let category = card.getAttribute('data-category');

        let matchesSearch = name.includes(query);
        let matchesCat = (cat === 'all' || category === cat);

        if (matchesSearch && matchesCat) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    }

    searchInput.addEventListener('input', filterMenus);
    categoryFilter.addEventListener('change', filterMenus);
  });
</script>
@endsection