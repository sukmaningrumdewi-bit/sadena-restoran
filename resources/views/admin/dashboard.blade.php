@extends('admin.layouts.app')

@section('title', 'Dashboard Overview — Sadena')
@section('topbar-title', 'Dashboard Overview')

@section('custom-css')
<style>
  input[type="date"] {
    color-scheme: dark;
  }
  input[type="date"]::-webkit-calendar-picker-indicator {
    cursor: pointer;
    filter: invert(1) brightness(2);
    transform: scale(1.3);
    padding-left: 10px;
  }
</style>
@endsection

@section('content')
  <!-- Welcome -->
  <section class="welcome">
    <div>
      <h2>Selamat Datang, Admin!</h2>
      <p>Sadena Restauran dalam kondisi siap melayani.</p>
    </div>
    <div class="date-chip" style="position: relative; display: inline-flex; align-items: center; padding: 11px 18px;">
      <input type="date" id="filterTanggal" 
             style="background: transparent; border: none; color: #fff; font-family: inherit; font-size: 15px; font-weight: 500; cursor: pointer; outline: none;"
             value="{{ date('Y-m-d') }}">
    </div>
  </section>

  <!-- Statistik -->
  <section class="stats" aria-label="Ringkasan statistik">
    <article class="stat-card">
      <span class="stat-icon green" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="6" width="18" height="13" rx="2.5"/>
          <path d="M3 10h18"/>
          <circle cx="16.5" cy="14.5" r="1.2"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Pendapatan Hari Ini</p>
        <p class="stat-value">Rp 1.450.000</p>
      </div>
    </article>

    <article class="stat-card">
      <span class="stat-icon blue" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 8h14l1 12H4z"/>
          <path d="M9 8V6a3 3 0 0 1 6 0v2"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Total Pesanan</p>
        <p class="stat-value">50</p>
      </div>
    </article>

    <article class="stat-card">
      <span class="stat-icon orange" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 9a8 8 0 0 1 16 0H4z"/>
          <rect x="3" y="11" width="18" height="3" rx="1.5"/>
          <path d="M4 16h16v1a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4v-1z"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Menu Tersedia</p>
        <p class="stat-value">42</p>
      </div>
    </article>

    <article class="stat-card">
      <span class="stat-icon purple" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="10" cy="8" r="4"/>
          <path d="M3 21a7 7 0 0 1 14 0"/>
          <path d="M19 7v6M16 10h6"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Pelanggan Baru</p>
        <p class="stat-value">18</p>
      </div>
    </article>
  </section>

  <!-- Panels -->
  <div class="panels">
    <section class="panel">
      <div class="panel-head">
        <h3>Pesanan Terbaru Masuk</h3>
        <button class="link" data-toast="Menampilkan seluruh daftar pesanan">Lihat Semua</button>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th scope="col">Order ID</th>
              <th scope="col">Pelanggan</th>
              <th scope="col">Total</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="order-id">#ORD-001</td>
              <td class="cell-muted">Budi Santoso</td>
              <td class="cell-total">Rp 125.000</td>
              <td><span class="badge waiting">Menunggu</span></td>
            </tr>
            <tr>
              <td class="order-id">#ORD-002</td>
              <td class="cell-muted">Siti Aminah</td>
              <td class="cell-total">Rp 45.000</td>
              <td><span class="badge process">Diproses</span></td>
            </tr>
            <tr>
              <td class="order-id">#ORD-003</td>
              <td class="cell-muted">Agus Setiawan</td>
              <td class="cell-total">Rp 88.000</td>
              <td><span class="badge process">Diproses</span></td>
            </tr>
            <tr>
              <td class="order-id">#ORD-004</td>
              <td class="cell-muted">Rina Melati</td>
              <td class="cell-total">Rp 55.000</td>
              <td><span class="badge done">Selesai</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Menu terlaris -->
    <section class="panel">
      <div class="panel-head">
        <h3>Menu Terlaris</h3>
        <button class="link" data-toast="Menampilkan detail menu terlaris">Detail</button>
      </div>
      <ul class="menu-list">
        <li class="menu-item">
          <span class="menu-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 11h18a9 9 0 0 1-9 9 9 9 0 0 1-9-9z"/>
              <path d="M8 8c0-1.6 1-2.6 2-3.2M12 7.5c0-2 1.5-3 2.5-3.5"/>
            </svg>
          </span>
          <div class="menu-info">
            <p class="menu-name">Nasi Goreng Spesial</p>
            <p class="menu-cat">Makanan Utama</p>
          </div>
          <span class="menu-qty">24 Porsi</span>
        </li>

        <li class="menu-item">
          <span class="menu-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M15.5 3a5.5 5.5 0 0 0-5.2 7.3l-5 5a2.5 2.5 0 1 0 3.4 3.4l5-5A5.5 5.5 0 1 0 15.5 3z"/>
              <circle cx="15.5" cy="8.5" r="1.2"/>
            </svg>
          </span>
          <div class="menu-info">
            <p class="menu-name">Ayam Bakar Madu</p>
            <p class="menu-cat">Makanan Utama</p>
          </div>
          <span class="menu-qty">19 Porsi</span>
        </li>

        <li class="menu-item">
          <span class="menu-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 5h12l-1.4 8.2a4 4 0 0 1-3.9 3.3h-1.4a4 4 0 0 1-3.9-3.3z"/>
              <path d="M12 16.5V21M9 21h6"/>
            </svg>
          </span>
          <div class="menu-info">
            <p class="menu-name">Jus Alpukat</p>
            <p class="menu-cat">Minuman</p>
          </div>
          <span class="menu-qty">15 Porsi</span>
        </li>

        <li class="menu-item">
          <span class="menu-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 10h12l-1 11H7z"/>
              <path d="M9 10V5M12 10V4M15 10V6"/>
            </svg>
          </span>
          <div class="menu-info">
            <p class="menu-name">Kentang Goreng Keju</p>
            <p class="menu-cat">Cemilan</p>
          </div>
          <span class="menu-qty">12 Porsi</span>
        </li>
      </ul>
    </section>
  </div>
@endsection