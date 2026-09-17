<style>
    /* ---------- Sidebar ---------- */
  .sidebar {
    width: 260px;
    flex-shrink: 0;
    background: #462311;
    color: #fff;
    display: flex;
    flex-direction: column;
    padding: 24px 16px;
    position: sticky;
    top: 0;
    height: 100vh;
  }

  .sidebar__brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 10px 22px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    margin-bottom: 20px;
  }

  .brand-logo {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: #c2593b;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    flex-shrink: 0;
  }
  .brand-logo svg { width: 22px; height: 22px; }

  .brand-name {
    font-size: 18px;
    font-weight: 800;
    letter-spacing: 1.5px;
    color: #f6c691;
    line-height: 1;
  }
  .brand-sub {
    font-size: 11px;
    color: rgba(255,255,255,0.5);
    margin-top: 4px;
  }

  .sidebar__nav {
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1;
  }

  .nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    border-radius: 10px;
    color: rgba(255,255,255,0.75);
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.18s ease;
    position: relative;
  }
  .nav-item:hover { background: rgba(255,255,255,0.06); color: #fff; }
  .nav-item.is-active {
    background: #c2593b;
    color: #fff;
    box-shadow: 0 8px 20px -8px rgba(194,89,59,0.6);
  }
  .nav-item svg { width: 20px; height: 20px; flex-shrink: 0; }

  .nav-item__badge {
    margin-left: auto;
    background: rgba(255,255,255,0.15);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 20px;
    min-width: 22px;
    text-align: center;
  }
  .nav-item.is-active .nav-item__badge { background: rgba(255,255,255,0.25); }

  .sidebar__footer {
    border-top: 1px solid rgba(255,255,255,0.1);
    padding-top: 16px;
    margin-top: 16px;
  }

  .user-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px;
    border-radius: 12px;
    background: rgba(255,255,255,0.05);
  }
  .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #c2593b;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 15px;
    flex-shrink: 0;
  }
  .user-info__name { font-size: 13.5px; font-weight: 700; color: #fff; }
  .user-info__role { font-size: 11.5px; color: rgba(255,255,255,0.55); margin-top: 1px; }
</style>
<aside class="sidebar">
    <div class="sidebar__brand">
      <div class="brand-logo">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M5 3v7a3 3 0 0 0 3 3h0a3 3 0 0 0 3-3V3"/>
          <path d="M8 3v18"/>
          <path d="M17 3c-1.5 2-2 4-2 6 0 1.5.7 2.5 2 3v9"/>
        </svg>
      </div>
      <div>
        <div class="brand-name">SADENA</div>
        <div class="brand-sub">Kasir Panel</div>
      </div>
    </div>

    <nav class="sidebar__nav">
      <a class="nav-item is-active" href="#">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M4 4h16v12H7l-3 3z"/>
          <path d="M8 9h8M8 12h5"/>
        </svg>
        <span>Pesan Aktif</span>
        <span class="nav-item__badge">3</span>
      </a>
      <a class="nav-item" href="#">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <rect x="2" y="5" width="20" height="14" rx="2"/>
          <path d="M2 10h20"/>
        </svg>
        <span>Transaksi</span>
        <span class="nav-item__badge">1</span>
      </a>
      <a class="nav-item" href="#">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M3 12a9 9 0 1 0 3-6.7"/>
          <path d="M3 3v6h6"/>
          <path d="M12 7v5l3 2"/>
        </svg>
        <span>Riwayat</span>
      </a>
    </nav>

    <div class="sidebar__footer">
      <div class="user-card">
        <div class="user-avatar">B</div>
        <div class="user-info">
          <div class="user-info__name">Budi</div>
          <div class="user-info__role">Kasir Shift Pagi</div>
        </div>
      </div>
    </div>
  </aside>