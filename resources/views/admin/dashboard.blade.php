@extends('admin.layouts.app')

@section('title', 'Dashboard Monitoring — Sadena')
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
  <section class="welcome" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
    <div>
      <h2>Selamat Datang, Admin!</h2>
      <p>Sadena Restauran dalam kondisi siap melayani (Full Monitoring).</p>
    </div>

    <!-- Tanggal Real Life (Otomatis mengikuti tanggal hari ini) -->
<div class="date-chip" style="position: relative; display: inline-flex; align-items: center; padding: 11px 18px; background: var(--brown, #461300); border-radius: 10px;">
  <span id="realtimeDate" style="color: #fff; font-family: inherit; font-size: 15px; font-weight: 500;"></span>
</div>

<!-- Script untuk mengisi tanggal otomatis sesuai waktu sistem (RL) -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const dateSpan = document.getElementById("realtimeDate");
    const today = new Date();
    
    // Format tanggal menjadi DD/MM/YYYY
    const day = String(today.getDate()).padStart(2, '0');
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const year = today.getFullYear();
    
    dateSpan.textContent = `${day}/${month}/${year}`;
  });
</script>
  </section>

  <!-- STATISTIK FULL MONITORING (Ubah grid menjadi 3 kolom) -->
  <section class="stats" aria-label="Ringkasan statistik" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 28px;">
    
    <!-- 1. Total Seluruh Pendapatan -->
    <article class="stat-card" style="background: #fff; padding: 24px; border-radius: 14px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
      <span class="stat-icon green" aria-hidden="true" style="background: #f0fdf4; padding: 16px; border-radius: 12px; color: #16a34a; display: grid; place-items: center;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:28px;height:28px;">
          <rect x="3" y="6" width="18" height="13" rx="2.5"/>
          <path d="M3 10h18"/>
          <circle cx="16.5" cy="14.5" r="1.2"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label" style="color: #64748b; font-size: 14px; font-weight: 600; margin-bottom: 4px;">Total Seluruh Pendapatan</p>
        <p class="stat-value" style="font-size: 26px; font-weight: 800; color: #1e293b;">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</p>
      </div>
    </article>

    <!-- 2. Menu Tersedia -->
    <article class="stat-card" style="background: #fff; padding: 24px; border-radius: 14px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
      <span class="stat-icon orange" aria-hidden="true" style="background: #eff6ff; padding: 16px; border-radius: 12px; color: #2563eb; display: grid; place-items: center;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:28px;height:28px;">
          <path d="M4 9a8 8 0 0 1 16 0H4z"/>
          <rect x="3" y="11" width="18" height="3" rx="1.5"/>
          <path d="M4 16h16v1a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4v-1z"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label" style="color: #64748b; font-size: 14px; font-weight: 600; margin-bottom: 4px;">Menu Aktif Tersedia</p>
        <p class="stat-value" style="font-size: 26px; font-weight: 800; color: #1e293b;">{{ $menuTersedia ?? 0 }} Menu</p>
      </div>
    </article>

    <!-- 3. KOTAK BARU: Total Pengguna Web -->
    <article class="stat-card" style="background: #fff; padding: 24px; border-radius: 14px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
      <span class="stat-icon purple" aria-hidden="true" style="background: #faf5ff; padding: 16px; border-radius: 12px; color: #9333ea; display: grid; place-items: center;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:28px;height:28px;">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="9" cy="7" r="4"></circle>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label" style="color: #64748b; font-size: 14px; font-weight: 600; margin-bottom: 4px;">Total Pengguna Web</p>
        <p class="stat-value" style="font-size: 26px; font-weight: 800; color: #1e293b;">{{ $totalPengguna ?? 0 }} User</p>
      </div>
    </article>

  </section>

  <!-- PANELS: GRAFIK MONITORING & MENU TERLARIS -->
  <div class="panels" style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
    
    <!-- Panel Grafik Statistik Penjualan -->
    <section class="panel" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
      <div class="panel-head" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="font-size: 18px; font-weight: 800; color: var(--brown, #461300); margin: 0;">Grafik Statistik Pendapatan & Penjualan</h3>
        <span style="font-size: 13px; color: #64748b; background: #f8fafc; padding: 6px 12px; border-radius: 8px; border: 1px solid #e2e8f0;">Real-time Monitoring</span>
      </div>
      
      <!-- Area Canvas untuk Chart.js -->
      <div style="position: relative; height: 300px; width: 100%;">
        <canvas id="monitoringChart"></canvas>
      </div>
    </section>

    <!-- Panel Menu Terlaris -->
    <section class="panel" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
      <div class="panel-head" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="font-size: 18px; font-weight: 800; color: var(--brown, #461300); margin: 0;">Menu Terlaris</h3>
        <button class="link" data-toast="Menampilkan detail menu terlaris" style="background: none; border: none; color: #2563eb; font-weight: 600; cursor: pointer;">Detail</button>
      </div>
      
      <ul class="menu-list" style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 16px;">
        <li class="menu-item" style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
          <div class="menu-info">
            <p class="menu-name" style="font-weight: 700; font-size: 14px; color: #1e293b; margin: 0;">Nasi Goreng Spesial</p>
            <p class="menu-cat" style="font-size: 12px; color: #64748b; margin: 2px 0 0 0;">Makanan Utama</p>
          </div>
          <span class="menu-qty" style="font-weight: 700; color: #16a34a; background: #f0fdf4; padding: 4px 10px; border-radius: 6px; font-size: 12px;">24 Porsi</span>
        </li>

        <li class="menu-item" style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
          <div class="menu-info">
            <p class="menu-name" style="font-weight: 700; font-size: 14px; color: #1e293b; margin: 0;">Ayam Bakar Madu</p>
            <p class="menu-cat" style="font-size: 12px; color: #64748b; margin: 2px 0 0 0;">Makanan Utama</p>
          </div>
          <span class="menu-qty" style="font-weight: 700; color: #16a34a; background: #f0fdf4; padding: 4px 10px; border-radius: 6px; font-size: 12px;">19 Porsi</span>
        </li>

        <li class="menu-item" style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
          <div class="menu-info">
            <p class="menu-name" style="font-weight: 700; font-size: 14px; color: #1e293b; margin: 0;">Jus Alpukat</p>
            <p class="menu-cat" style="font-size: 12px; color: #64748b; margin: 2px 0 0 0;">Minuman</p>
          </div>
          <span class="menu-qty" style="font-weight: 700; color: #16a34a; background: #f0fdf4; padding: 4px 10px; border-radius: 6px; font-size: 12px;">15 Porsi</span>
        </li>

        <li class="menu-item" style="display: flex; justify-content: space-between; align-items: center;">
          <div class="menu-info">
            <p class="menu-name" style="font-weight: 700; font-size: 14px; color: #1e293b; margin: 0;">Kentang Goreng Keju</p>
            <p class="menu-cat" style="font-size: 12px; color: #64748b; margin: 2px 0 0 0;">Cemilan</p>
          </div>
          <span class="menu-qty" style="font-weight: 700; color: #16a34a; background: #f0fdf4; padding: 4px 10px; border-radius: 6px; font-size: 12px;">12 Porsi</span>
        </li>
      </ul>
    </section>

  </div>
@endsection

@section('custom-js')
<!-- Library Chart.js untuk Grafik Monitoring -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('monitoringChart').getContext('2d');
    const monitoringChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        datasets: [{
          label: 'Pendapatan (Rp)',
          data: [250000, 450000, 300000, 600000, 750000, 1100000, 1450000],
          borderColor: '#461300',
          backgroundColor: 'rgba(70, 19, 0, 0.05)',
          borderWidth: 3,
          fill: true,
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: { 
            beginAtZero: true,
            grid: { color: '#f1f5f9' }
          },
          x: {
            grid: { display: false }
          }
        }
      }
    });
  });
</script>
@endsection