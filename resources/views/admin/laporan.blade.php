@extends('admin.layouts.app')

@section('title', 'Laporan — Sadena')
@section('topbar-title', 'Laporan Pendapatan & Performa')

@section('custom-css')
<style>
  .report-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 24px;
  }

  .report-title h2 {
    font-size: 22px;
    font-weight: 700;
    color: var(--brown);
    margin-bottom: 4px;
  }

  .report-title p {
    font-size: 14px;
    color: var(--text-muted);
  }

  /* Tombol Filter Periode (Hari Ini, Minggu Ini, Bulan Ini) */
  .filter-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }

  .filter-btn {
    padding: 10px 18px;
    background: #fff;
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    font-size: 14px;
    font-weight: 600;
    color: var(--text-muted);
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .filter-btn:hover {
    background: #f8fafc;
    border-color: var(--brown);
  }

  .filter-btn.active {
    background: var(--brown);
    color: #fff;
    border-color: var(--brown);
  }

  .stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 22px;
    margin-bottom: 24px;
  }

  @media (max-width: 992px) {
    .stats { grid-template-columns: 1fr; }
  }

  .stat-card {
    display: flex;
    align-items: center;
    gap: 18px;
    background: var(--surface);
    border: 1px solid var(--brown);
    border-radius: var(--radius);
    padding: 24px;
    box-shadow: var(--shadow-card);
  }

  .stat-icon {
    width: 54px;
    height: 54px;
    border-radius: 12px;
    display: grid;
    place-items: center;
    flex: none;
  }

  .stat-icon svg { width: 28px; height: 28px; }
  .stat-icon.blue { background: var(--blue-bg); color: var(--blue); }
  .stat-icon.green { background: var(--green-soft-bg); color: var(--green); }
  .stat-icon.orange { background: var(--orange-bg); color: var(--orange); }

  .stat-text { min-width: 0; }
  .stat-label { font-size: 14px; font-weight: 600; color: var(--text-muted); margin-bottom: 6px; }
  .stat-value { font-size: 24px; font-weight: 800; color: var(--brown); transition: opacity 0.2s ease; }

  .panel-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 16px;
  }

  .panel-head h3 { font-size: 18px; font-weight: 700; }

  /* Dropdown Unduh CSV (Harian, Mingguan, Bulanan) */
  .dropdown-csv {
    position: relative;
    display: inline-block;
  }

  .btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    background: var(--brown);
    color: #fff;
    border: none;
    border-radius: var(--radius-sm);
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .btn-outline:hover {
    background: #350e00;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    top: calc(100% + 6px);
    background-color: #ffffff;
    min-width: 160px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    border-radius: var(--radius-sm);
    border: 1.5px solid #e2e8f0;
    z-index: 9999;
    overflow: hidden;
  }

  .dropdown-content a {
    color: var(--brown);
    padding: 12px 18px;
    text-decoration: none;
    display: block;
    font-size: 14px;
    font-weight: 600;
    border-bottom: 1px solid #f1f5f9;
    cursor: pointer;
  }

  .dropdown-content a:last-child {
    border-bottom: none;
  }

  .dropdown-content a:hover {
    background-color: #f8fafc;
    color: #000;
  }

  .dropdown-csv.show .dropdown-content {
    display: block !important;
  }

  .table-wrap { overflow-x: auto; }
  table { width: 100%; min-width: 750px; border-collapse: collapse; font-size: 15px; }
  thead th {
    text-align: left; font-size: 12px; font-weight: 700;
    text-transform: uppercase; color: var(--text-muted); padding: 16px 12px;
    border-bottom: 2px solid var(--line);
  }
  tbody td { padding: 16px 12px; border-bottom: 1px solid var(--line-soft); }
  
  .product-cell { display: flex; align-items: center; gap: 12px; }
  .product-img { width: 48px; height: 48px; border-radius: 8px; background: var(--line-soft); object-fit: cover; }
  .product-name { font-weight: 700; color: var(--brown); }
  .product-category { font-size: 13px; color: var(--text-muted); }
  .fw-bold { font-weight: 700; }

  @media print {
    .dropdown-csv, .filter-group, aside, header {
      display: none !important;
    }
  }
</style>
@endsection

@section('content')
<div class="report-header">
    <div class="report-title">
      <h2>Ringkasan Performa</h2>
      <p id="subtitlePeriod">Analisis pendapatan dan penjualan produk Sadena.</p>
    </div>
    
    <div class="filter-group" id="periodFilter" style="align-items: center;">
      <button type="button" class="filter-btn active" data-period="today">Hari Ini</button>
      <button type="button" class="filter-btn" data-period="week">Minggu Ini</button>
      <button type="button" class="filter-btn" data-period="month">Bulan Ini</button>

      <!-- Garis Pemisah -->
      <span style="color: #cbd5e1; margin: 0 4px;">|</span>

      <!-- Kotak Kalender Kustom -->
      <form action="{{ route('admin.laporan') }}" method="GET" style="margin: 0; display: inline-flex;">
          <input type="date" name="tanggal_spesifik" 
                 style="padding: 8px 12px; border: 1px solid var(--line); border-radius: var(--radius-sm); color: var(--text-muted); font-size: 14px; font-weight: 600; font-family: inherit; cursor: pointer; outline: none; background-color: #fff; transition: all 0.2s ease;" 
                 title="Pilih tanggal laporan spesifik"
                 onchange="this.form.submit()">
      </form>
    </div>
  </div>

  <section class="stats" aria-label="Statistik Laporan">
    <article class="stat-card">
      <span class="stat-icon green" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="12" y1="1" x2="12" y2="23"/>
          <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Total Pendapatan</p>
        <!-- Memanggil variabel dari LaporanController -->
        <p class="stat-value" id="valPendapatan">Rp {{ number_format($todayRevenue ?? 0, 0, ',', '.') }}</p>
      </div>
    </article>

    <article class="stat-card">
      <span class="stat-icon blue" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
          <line x1="3" y1="6" x2="21" y2="6"/>
          <path d="M16 10a4 4 0 0 1-8 0"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Pesanan Selesai</p>
        <!-- Memanggil variabel dari LaporanController -->
        <p class="stat-value" id="valPesanan">{{ $todayOrders ?? 0 }}</p>
      </div>
    </article>

    <article class="stat-card">
      <span class="stat-icon orange" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
          <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
          <line x1="12" y1="22.08" x2="12" y2="12"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Produk Terjual</p>
        <p class="stat-value" id="valProduk">-</p>
      </div>
    </article>
  </section>

  <section class="panel">
    <div class="panel-head">
      <div>
        <h3 id="tableTitle">Produk Terlaris</h3>
        <p style="font-size: 13px; color: var(--text-muted); margin-top: 2px;">Daftar menu dengan penjualan tertinggi.</p>
      </div>

      <!-- Tombol Unduh CSV dengan Pilihan Harian, Mingguan, Bulanan[cite: 16] -->
      <div class="dropdown-csv" id="csvDropdown">
       <button type="button" class="btn-outline" onclick="window.print()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
          <polyline points="7 10 12 15 17 10"/>
          <line x1="12" y1="15" x2="12" y2="3"/>
        </svg>
        Cetak Laporan
      </button>
        <div class="dropdown-content">
          <a onclick="selectReportType('harian')">Harian</a>
          <a onclick="selectReportType('mingguan')">Mingguan</a>
          <a onclick="selectReportType('bulanan')">Bulanan</a>
        </div>
      </div>
    </div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th scope="col">Nama Menu</th>
            <th scope="col">Kategori</th>
            <th scope="col">Harga Satuan</th>
            <th scope="col">Terjual</th>
            <th scope="col">Total Pendapatan</th>
          </tr>
        </thead>
        <tbody id="tableBodyContent">
          @foreach($menus as $menu)
          <tr>
            <td>
              <div class="product-cell">
                @if($menu->gambar)
                  <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="product-img">
                @else
                  <div class="product-img" style="display: grid; place-items: center; font-size: 18px; background: #f1f5f9;">🍽️</div>
                @endif
                <div>
                  <div class="product-name">{{ $menu->nama_menu }}</div>
                  <div class="product-category">{{ $menu->deskripsi ?? 'Menu Sadena' }}</div>
                </div>
              </div>
            </td>
            <td>{{ $menu->kategori }}</td>
            <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
            <td class="fw-bold">{{ $menu->stok ?? 0 }}</td>
            <td class="fw-bold" style="color: var(--green);">Rp {{ number_format($menu->harga * ($menu->stok ?? 1), 0, ',', '.') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>

@endsection

@section('custom-js')
<script>
  // Fungsi untuk mengubah isi laporan berdasarkan pilihan Harian, Mingguan, Bulanan
  function selectReportType(type) {
    const valPendapatan = document.getElementById("valPendapatan");
    const valPesanan = document.getElementById("valPesanan");
    const valProduk = document.getElementById("valProduk");
    const tableTitle = document.getElementById("tableTitle");
    const tableBodyContent = document.getElementById("tableBodyContent");

    // Tutup dropdown setelah diklik
    document.getElementById("csvDropdown").classList.remove("show");

    // Efek transisi halus
    [valPendapatan, valPesanan, valProduk].forEach(el => el.style.opacity = '0.3');

    setTimeout(() => {
      if (type === 'harian') {
        tableTitle.textContent = "Produk Terlaris Harian";
        valPendapatan.textContent = "Rp 4.250.000";
        valPesanan.textContent = "128";
        valProduk.textContent = "345";
        tableBodyContent.innerHTML = `
          <tr>
            <td><div class="product-cell"><div class="product-img"></div><div><div class="product-name">Nasi Goreng Spesial</div><div class="product-category">Makanan Utama</div></div></div></td>
            <td>Makanan</td><td>Rp 35.000</td><td class="fw-bold">142</td><td class="fw-bold" style="color: var(--green);">Rp 4.970.000</td>
          </tr>
          <tr>
            <td><div class="product-cell"><div class="product-img"></div><div><div class="product-name">Es Kopi Susu Aren</div><div class="product-category">Minuman Dingin</div></div></div></td>
            <td>Minuman</td><td>Rp 22.000</td><td class="fw-bold">98</td><td class="fw-bold" style="color: var(--green);">Rp 2.156.000</td>
          </tr>
          <tr>
            <td><div class="product-cell"><div class="product-img"></div><div><div class="product-name">Sate Ayam Madura</div><div class="product-category">Makanan Utama</div></div></div></td>
            <td>Makanan</td><td>Rp 30.000</td><td class="fw-bold">75</td><td class="fw-bold" style="color: var(--green);">Rp 2.250.000</td>
          </tr>
        `;
      } else if (type === 'mingguan') {
        tableTitle.textContent = "Produk Terlaris Mingguan";
        valPendapatan.textContent = "Rp 28.500.000";
        valPesanan.textContent = "840";
        valProduk.textContent = "2.150";
        tableBodyContent.innerHTML = `
          <tr>
            <td><div class="product-cell"><div class="product-img"></div><div><div class="product-name">Ayam Bakar Madu</div><div class="product-category">Makanan Utama</div></div></div></td>
            <td>Makanan</td><td>Rp 28.000</td><td class="fw-bold">620</td><td class="fw-bold" style="color: var(--green);">Rp 17.360.000</td>
          </tr>
          <tr>
            <td><div class="product-cell"><div class="product-img"></div><div><div class="product-name">Nasi Goreng Spesial</div><div class="product-category">Makanan Utama</div></div></div></td>
            <td>Makanan</td><td>Rp 35.000</td><td class="fw-bold">510</td><td class="fw-bold" style="color: var(--green);">Rp 17.850.000</td>
          </tr>
        `;
      } else if (type === 'bulanan') {
        tableTitle.textContent = "Produk Terlaris Bulanan";
        valPendapatan.textContent = "Rp 112.400.000";
        valPesanan.textContent = "3.205";
        valProduk.textContent = "9.840";
        tableBodyContent.innerHTML = `
          <tr>
            <td><div class="product-cell"><div class="product-img"></div><div><div class="product-name">Paket Keluarga Nusantara</div><div class="product-category">Paket Spesial</div></div></div></td>
            <td>Paket</td><td>Rp 150.000</td><td class="fw-bold">1.450</td><td class="fw-bold" style="color: var(--green);">Rp 217.500.000</td>
          </tr>
          <tr>
            <td><div class="product-cell"><div class="product-img"></div><div><div class="product-name">Nasi Goreng Spesial</div><div class="product-category">Makanan Utama</div></div></div></td>
            <td>Makanan</td><td>Rp 35.000</td><td class="fw-bold">2.100</td><td class="fw-bold" style="color: var(--green);">Rp 73.500.000</td>
          </tr>
        `;
      }

      [valPendapatan, valPesanan, valProduk].forEach(el => el.style.opacity = '1');
    }, 200);
  }

  document.addEventListener("DOMContentLoaded", function () {
    // 1. Logika Tombol Filter Periode (Hari Ini, Minggu Ini, Bulan Ini)[cite: 15]
    const filterBtns = document.querySelectorAll('.filter-btn');
    const valPendapatan = document.getElementById('valPendapatan');
    const valPesanan = document.getElementById('valPesanan');
    const valProduk = document.getElementById('valProduk');

    const dynamicData = {
      'today': { 
          rev: 'Rp {{ number_format($todayRevenue ?? 0, 0, ",", ".") }}', 
          orders: '{{ $todayOrders ?? 0 }}', 
          items: '-' 
      },
      'week':  { 
          rev: 'Rp {{ number_format($weekRevenue ?? 0, 0, ",", ".") }}', 
          orders: '{{ $weekOrders ?? 0 }}', 
          items: '-' 
      },
      'month': { 
          rev: 'Rp {{ number_format($monthRevenue ?? 0, 0, ",", ".") }}', 
          orders: '{{ $monthOrders ?? 0 }}', 
          items: '-' 
      }
    };

    filterBtns.forEach(function(btn) {
      btn.addEventListener('click', function() {
        filterBtns.forEach(function(b) { b.classList.remove('active'); });
        this.classList.add('active');
        
        var period = this.getAttribute('data-period');
        var data = dynamicData[period]; // Menggunakan dynamicData
        
        [valPendapatan, valPesanan, valProduk].forEach(function(el) {
          el.style.opacity = '0.3';
        });
        
        setTimeout(function() {
          valPendapatan.textContent = data.rev;
          valPesanan.textContent = data.orders;
          // valProduk dibiarkan '-' atau bisa ditambahkan logika hitung dari detail_pesanans nanti
          valProduk.textContent = data.items; 
          
          [valPendapatan, valPesanan, valProduk].forEach(function(el) {
            el.style.opacity = '1';
          });
        }, 200);
      });
    });

    // 2. Logika Dropdown Unduh CSV
    const dropdown = document.getElementById("csvDropdown");
    const dropdownBtn = document.getElementById("csvDropdownBtn");

    if (dropdownBtn) {
      dropdownBtn.addEventListener("click", function (e) {
        e.stopPropagation();
        dropdown.classList.toggle("show");
      });
    }

    window.addEventListener("click", function () {
      if (dropdown && dropdown.classList.contains("show")) {
        dropdown.classList.remove("show");
      }
    });
  });
</script>
@endsection