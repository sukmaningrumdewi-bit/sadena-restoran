<!-- ================= SIDEBAR ================= -->
<aside class="sidebar" id="sidebar">
  <div class="brand">
    <svg class="brand-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <path d="M7 3v6a2 2 0 0 0 4 0V3"/>
      <path d="M9 11v10"/>
      <path d="M17 3v18"/>
      <path d="M17 3c-2 1.6-3 3.6-3 6.5S15 13.5 17 14"/>
    </svg>
    <span class="brand-name">SADENA</span>
  </div>
  <p class="brand-sub">Admin Panel</p>

  <nav class="nav" aria-label="Navigasi utama">
    <!-- Menu Dashboard -->
    <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M12 3a9 9 0 1 0 9 9h-9V3z"/>
        <path d="M12 3v9h9"/>
      </svg>
      <span>Dashboard</span>
    </a>

    <!-- Menu Manajemen Menu -->
    <a class="nav-item {{ request()->routeIs('admin.menu*') ? 'active' : '' }}" href="{{ route('admin.menu') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M4 9a8 8 0 0 1 16 0H4z"/>
        <rect x="3" y="11" width="18" height="3" rx="1.5"/>
        <path d="M4 16h16v1a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4v-1z"/>
      </svg>
      <span>Manajemen Menu</span>
    </a>

    <!-- Menu Manajemen Akun -->
    <a class="nav-item {{ request()->routeIs('admin.manajemen-akun*') ? 'active' : '' }}" href="{{ route('admin.manajemen-akun') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
      </svg>
      <span>Manajemen Akun</span>
    </a>

    <!-- Laporan -->
    <a class="nav-item {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}" href="{{ route('admin.laporan') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
           stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"/>
        <path d="M14 3v5h5"/>
        <path d="M9 13h6M9 17h4"/>
      </svg>
      <span>Laporan</span>
    </a>

    <!-- Pengaturan -->
    <a class="nav-item {{ request()->routeIs('admin.pengaturan*') ? 'active' : '' }}" href="{{ route('admin.pengaturan') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
           stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <circle cx="12" cy="12" r="3"/>
        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.6a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9v.09a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
      </svg>
      <span>Pengaturan</span>
    </a>
  </nav>

  <!-- BAGIAN BAWAH: Tombol Keluar -->
  <div class="sidebar-footer" style="margin-top: auto; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.1);">
    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
      @csrf
      <button type="submit" class="nav-item logout-btn" style="width: 100%; background: rgba(229, 72, 77, 0.15); color: #ff8585; border: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 10px 14px; border-radius: 8px; font-weight: 500;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="width:18px; height:18px;">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
          <polyline points="16 17 21 12 16 7"/>
          <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
        <span>Keluar</span>
      </button>
    </form>
  </div>
</aside>