<aside class="sidebar">
  <div class="sidebar-art" aria-hidden="true"></div>

  <!-- Logo / Brand -->
  <div class="brand">
    <svg class="brand-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <path d="M7 2v8a2 2 0 0 0 4 0V2" />
      <path d="M9 12v10" />
      <path d="M17 2c-1.4 1.6-2 3.2-2 5s.6 3 2 3 2-1.2 2-3-.6-3.4-2-5Z" />
      <path d="M17 10v12" />
    </svg>
    <div class="brand-text">
      <div class="brand-name">SADENA</div>
      <div class="brand-role">Pelanggan</div>
    </div>
  </div>

  <!-- Menu Navigasi -->
  <nav class="nav">
    <a class="nav-item {{ request()->routeIs('user.dashboard') ? 'is-active' : '' }}" href="{{ route('user.dashboard') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" aria-hidden="true">
        <path d="M12 3a9 9 0 1 0 9 9h-9V3Z" />
      </svg>
      Dashboard
    </a>

    <a class="nav-item {{ request()->routeIs('user.pesanan') ? 'is-active' : '' }}" href="{{ route('user.pesanan') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M6 3h12v18l-3-2-3 2-3-2-3 2V3Z" />
        <path d="M9 8h6M9 12h4" />
      </svg>
      Pesanan Saya
    </a>

    <a class="nav-item {{ request()->routeIs('user.favorit') ? 'is-active' : '' }}" href="{{ route('user.favorit') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" aria-hidden="true">
        <path d="m12 3 2.7 5.6 6.1.9-4.4 4.3 1 6.1-5.4-2.9-5.4 2.9 1-6.1L3.2 9.5l6.1-.9L12 3Z" />
      </svg>
      Menu Favorit
    </a>

    <a class="nav-item" href="#">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
        <circle cx="12" cy="8" r="4" />
        <path d="M4.5 20.5c.9-3.6 3.8-5.5 7.5-5.5s6.6 1.9 7.5 5.5" />
      </svg>
      Profile
    </a>

    <a class="nav-item" href="#">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <circle cx="12" cy="12" r="3.2" />
        <path d="M12 2.5v2.6M12 18.9v2.6M21.5 12h-2.6M5.1 12H2.5" />
        <path d="M18.7 5.3 17 7.1M7.1 16.9l-1.8 1.8M18.7 18.7 17 16.9M7.1 7.1 5.3 5.3" />
      </svg>
      Pengaturan
    </a>

    <!-- Tombol Logout -->
    <div class="sidebar-footer" style="margin-top: auto; padding: 20px 0;">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="nav-item logout-btn" style="width: 100%; display: flex; align-items: center; gap: 12px; background: none; border: none; cursor: pointer; color: inherit; text-align: left; padding: 10px 16px;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:24px; height:24px;">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
          </svg>
          <span>Keluar</span>
        </button>
      </form>
    </div>

  </nav>
</aside>