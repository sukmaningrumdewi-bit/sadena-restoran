<!-- ================= TOPBAR ================= -->
<header class="topbar">
  <div class="topbar-left">
    <button class="icon-btn menu-toggle" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
           stroke-linecap="round" aria-hidden="true">
        <path d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
    <h1>@yield('topbar-title', 'Dashboard')</h1>
  </div>

  <div class="topbar-right">
    <!-- Notifikasi Dropdown -->
    <div class="notif-wrap">
      <button class="icon-btn" id="notifBtn" aria-label="Notifikasi" aria-expanded="false">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M18 8a6 6 0 1 0-12 0c0 7-3 8-3 8h18s-3-1-3-8"/>
          <path d="M13.7 21a2 2 0 0 1-3.4 0"/>
        </svg>
        <span class="dot"></span>
      </button>
      <div class="dropdown" id="notifMenu">
        <p class="dropdown-title">Notifikasi</p>
        <ul>
          <li>Pesanan <strong>#ORD-001</strong> menunggu konfirmasi.</li>
          <li>Stok bahan <strong>Ayam Bakar Madu</strong> menipis.</li>
          <li>Laporan harian sudah tersedia.</li>
        </ul>
      </div>
    </div>

    <!-- Profil & Menu Akun Dropdown -->
    <div class="user-wrap">
      <button class="user" id="userBtn" aria-expanded="false">
        <span class="avatar">A</span>
        <span class="user-name">admin@sadena.com</span>
      </button>
      <div class="dropdown" id="userMenu">
        <button class="dropdown-item">Profil</button>
        <button class="dropdown-item">Pengaturan Akun</button>
      </div>
    </div>
  </div>
  
</header>