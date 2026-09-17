<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin Panel — Sadena')</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">

  <style>
    /* ============ TOKENS ============ */
    :root {
      --brown: #461300;
      --brown-soft: #7f4326;
      --cream: #f6c691;
      --muted: rgba(70, 19, 0, 0.5);
      --green: #70a37a;
      --green-soft: #4f8a5b;
      --blue: #1565c0;
      --blue-soft: #6fa1da;
      --orange: #f0a06c;
      --line: rgba(0, 0, 0, 0.12);
      --line-soft: rgba(0, 0, 0, 0.07);
      --shadow-card: 0 4px 10px rgba(0, 0, 0, 0.12);
      --shadow-panel: 0 5px 12px rgba(0, 0, 0, 0.12);
      --radius: 20px;
      --radius-sm: 10px;
      --sidebar-w: 227px;
    }

    *, *::before, *::after { box-sizing: border-box; }
    html, body { margin: 0; padding: 0; }
    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      font-size: 16px;
      line-height: 1.45;
      color: var(--brown);
      background: #fff;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
    }

    h1, h2, h3, p, ul { margin: 0; }
    ul { padding: 0; list-style: none; }
    svg { display: block; }
    img { max-width: 100%; display: block; }
    button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }

    /* ============ LAYOUT ============ */
    .layout { display: flex; min-height: 100vh; width: 100%; }

    /* ============ SIDEBAR ============ */
    .sidebar {
      flex: 0 0 var(--sidebar-w); width: var(--sidebar-w); background: var(--brown); color: #fff;
      padding: 28px 16px 24px; display: flex; flex-direction: column; position: sticky; top: 0; height: 100vh; overflow-y: auto; z-index: 60;
    }
    .brand { display: flex; align-items: center; gap: 10px; padding: 0 8px; }
    .brand-icon { width: 28px; height: 28px; color: var(--cream); flex: none; }
    .brand-name { font-size: 24px; font-weight: 800; letter-spacing: 0.5px; color: var(--cream); }
    .brand-sub { font-size: 13px; font-weight: 400; color: rgba(255, 255, 255, 0.62); padding: 4px 8px 0; }
    .nav { display: flex; flex-direction: column; gap: 6px; margin-top: 28px; flex-grow: 1; }
    .nav-item {
      display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--radius-sm);
      color: #fff; font-size: 16px; text-decoration: none; transition: background 0.2s ease, color 0.2s ease;
    }
    .nav-item svg { width: 18px; height: 18px; flex: none; }
    .nav-item:hover { background: rgba(246, 198, 145, 0.14); }
    .nav-item.active { background: var(--cream); color: var(--brown); font-weight: 700; }

    /* ============ MAIN & TOPBAR ============ */
    .main { flex: 1 1 auto; min-width: 0; display: flex; flex-direction: column; }
    .topbar {
      position: sticky; top: 0; z-index: 30; display: flex; align-items: center; justify-content: space-between;
      gap: 16px; padding: 18px 28px; background: #fff; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.15);
    }
    .topbar-left { display: flex; align-items: center; gap: 12px; min-width: 0; }
    .topbar h1 { font-size: 24px; font-weight: 800; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .topbar-right { display: flex; align-items: center; gap: 10px; flex: none; }
    .icon-btn {
      position: relative; width: 40px; height: 40px; display: grid; place-items: center;
      border-radius: 50%; color: var(--brown); transition: background 0.2s ease;
    }
    .icon-btn:hover { background: #f7f1ec; }
    .icon-btn svg { width: 24px; height: 24px; }
    .icon-btn .dot { position: absolute; top: 8px; right: 9px; width: 8px; height: 8px; border-radius: 50%; background: #e2574c; border: 2px solid #fff; }
    .menu-toggle { display: none; }
    .user { display: flex; align-items: center; gap: 10px; padding: 4px 8px 4px 4px; border-radius: 100px; transition: background 0.2s ease; }
    .user:hover { background: #f7f1ec; }
    .avatar { width: 40px; height: 40px; border-radius: 50%; background: var(--brown); color: #dbc099; display: grid; place-items: center; font-size: 20px; font-weight: 800; flex: none; }
    .user-name { font-weight: 500; white-space: nowrap; }

    /* ============ KONTEN & KOMPONEN DASHBOARD ============ */
    .content { padding: 24px 28px 40px; display: flex; flex-direction: column; gap: 22px; }

    .welcome {
      background: var(--brown);
      border: 1px solid var(--brown); /* Memastikan border tegas */
      border-radius: var(--radius);
      padding: 24px 28px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      flex-wrap: wrap;
      color: #fff;
    }
    .welcome h2 { font-size: 24px; font-weight: 800; color: var(--cream); margin-bottom: 6px; }
    .welcome p { font-size: 15px; color: rgba(255, 255, 255, 0.85); }

    .date-chip {
      display: inline-flex; align-items: center; gap: 10px; background: var(--brown-soft);
      border-radius: var(--radius-sm); padding: 11px 18px; font-size: 15px; font-weight: 500; color: #fff; white-space: nowrap;
    }

    .stats {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 20px;
    }

    .stat-card {
      display: flex; align-items: center; gap: 14px; background: #fff;
      border: 1px solid var(--brown); /* Garis tepi tegas warna coklat khas */
      border-radius: var(--radius);
      box-shadow: var(--shadow-card);
      padding: 18px; min-width: 0;
    }
    .stat-icon { width: 50px; height: 47px; border-radius: var(--radius-sm); display: grid; place-items: center; flex: none; }
    .stat-icon.green  { background: #e8f5e9; color: var(--green-soft); }
    .stat-icon.blue   { background: #e7f4fd; color: #3b82c4; }
    .stat-icon.orange { background: #fff3e0; color: #e08b4f; }
    .stat-icon.purple { background: #f3e5f5; color: #9b59b6; }
    .stat-text { min-width: 0; }
    .stat-label { font-size: 15px; font-weight: 600; margin-bottom: 2px; }
    .stat-value { font-size: 20px; font-weight: 800; }

    .panels {
      display: grid;
      grid-template-columns: minmax(0, 1.9fr) minmax(0, 1fr);
      gap: 22px;
      align-items: start;
    }

    .panel {
      background: #fff;
      border: 1px solid var(--brown); /* Garis tepi tegas pada panel */
      border-radius: var(--radius);
      box-shadow: var(--shadow-panel);
      padding: 22px; min-width: 0;
    }
    .panel-head {
      display: flex; align-items: center; justify-content: space-between; gap: 12px;
      padding-bottom: 14px; margin-bottom: 6px; border-bottom: 1px solid var(--line);
    }
    .panel-head h3 { font-size: 20px; font-weight: 700; }
    .link { color: var(--blue); font-size: 15px; font-weight: 600; cursor: pointer; }
    .link:hover { text-decoration: underline; }

    .table-wrap { overflow-x: auto; }
    table { width: 100%; min-width: 560px; border-collapse: collapse; font-size: 15px; }
    th { text-align: left; font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--muted); padding: 14px 10px; border-bottom: 1px solid var(--line); }
    td { padding: 15px 10px; border-bottom: 1px solid var(--line-soft); vertical-align: middle; }
    
    .order-id { font-weight: 700; }
    .cell-muted { color: var(--muted); }
    .cell-total { color: var(--muted); }

    .badge {
      display: inline-flex; align-items: center; justify-content: center; min-width: 102px;
      padding: 7px 14px; border-radius: 20px; font-size: 14px; font-weight: 700;
    }
    .badge.waiting { background: #fff3e0; color: var(--orange); }
    .badge.process { background: #e3f2fd; color: var(--blue-soft); }
    .badge.done    { background: #e3efdd; color: var(--green); }

    .menu-list { display: flex; flex-direction: column; }
    .menu-item { display: flex; align-items: center; gap: 14px; padding: 16px 0; border-bottom: 1px solid var(--line-soft); }
    .menu-item:last-child { border-bottom: 0; padding-bottom: 0; }
    .menu-icon { width: 48px; height: 45px; border-radius: var(--radius-sm); background: #f1f5f9; color: var(--brown); display: grid; place-items: center; flex: none; }
    .menu-info { flex: 1 1 auto; min-width: 0; }
    .menu-name { font-size: 15px; font-weight: 700; }
    .menu-cat { font-size: 13px; color: var(--muted); }
    .menu-qty { font-size: 14px; font-weight: 600; color: var(--green); }

    /* Overlay & Toast */
    .overlay { position: fixed; inset: 0; background: rgba(0, 0, 0, 0.45); opacity: 0; visibility: hidden; transition: 0.25s ease; z-index: 50; }
    .overlay.show { opacity: 1; visibility: visible; }
    .toast { position: fixed; left: 50%; bottom: 28px; transform: translate(-50%, 20px); background: var(--brown); color: #fff; padding: 12px 22px; border-radius: 12px; font-size: 14px; font-weight: 500; opacity: 0; pointer-events: none; transition: 0.25s ease; z-index: 100; }
    .toast.show { opacity: 1; transform: translate(-50%, 0); }

    @media (max-width: 900px) {
      .sidebar { position: fixed; left: 0; transform: translateX(-100%); transition: 0.25s ease; }
      .sidebar.open { transform: translateX(0); }
      .menu-toggle { display: grid; }
    }

    /* ============ DROPDOWN (Diperbaiki agar tersembunyi rapi) ============ */
    .notif-wrap, .user-wrap { 
      position: relative; 
    }

    .dropdown {
      position: absolute;
      top: calc(100% + 12px);
      right: 0;
      min-width: 260px;
      background: #fff;
      border: 1px solid rgba(70, 19, 0, 0.15);
      border-radius: 14px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.16);
      padding: 12px;
      
      /* WAJIB ADA: Agar tertutup secara default */
      display: none; 
      opacity: 0;
      visibility: hidden;
      transform: translateY(-6px);
      transition: opacity 0.18s ease, transform 0.18s ease, visibility 0.18s;
      z-index: 45;
    }

    /* Kelas .show yang dipicu oleh JavaScript saat tombol diklik */
    .dropdown.show {
      display: block;
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .dropdown-title {
      margin: 4px 8px 8px;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      color: var(--muted);
    }

    .dropdown li {
      padding: 10px;
      font-size: 14px;
      color: var(--muted);
      border-radius: 8px;
    }

    .dropdown li + li { 
      border-top: 1px solid var(--line-soft); 
    }

    .dropdown-item {
      display: block;
      width: 100%;
      text-align: left;
      padding: 10px 12px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 500;
      color: var(--brown);
      transition: background 0.18s ease;
    }

    .dropdown-item:hover { 
      background: #f7f1ec; 
    }
  </style>

  @yield('custom-css')
</head>
<body>
  <div class="layout">
    
    <div class="overlay" id="overlay"></div>

    <!-- PARTIAL: Sidebar -->
    @include('admin.partials.sidebar')

    <div class="main">
      <!-- PARTIAL: Topbar -->
      @include('admin.partials.topbar')

      <!-- YIELD KONTEN -->
      <main class="content">
        @yield('content')
      </main>
    </div>

  </div>

  <div class="toast" id="toast" role="status" aria-live="polite"></div>

  <script>
    (function () {
      'use strict';
      var toastEl = document.getElementById('toast');
      var toastTimer = null;
      window.showToast = function(message) {
        if (!toastEl) return;
        toastEl.textContent = message;
        toastEl.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () { toastEl.classList.remove('show'); }, 2200);
      }

      var sidebar = document.getElementById('sidebar');
      var overlay = document.getElementById('overlay');
      var menuToggle = document.getElementById('menuToggle');

      function openSidebar() { if(sidebar) sidebar.classList.add('open'); if(overlay) overlay.classList.add('show'); }
      function closeSidebar() { if(sidebar) sidebar.classList.remove('open'); if(overlay) overlay.classList.remove('show'); }
      if (menuToggle) { menuToggle.addEventListener('click', function () { if (sidebar && sidebar.classList.contains('open')) { closeSidebar(); } else { openSidebar(); } }); }
      if (overlay) overlay.addEventListener('click', closeSidebar);

      function closeAllDropdowns() { document.querySelectorAll('.dropdown.show').forEach(function (menu) { menu.classList.remove('show'); }); }
      function setupDropdown(buttonId, menuId) {
        var button = document.getElementById(buttonId);
        var menu = document.getElementById(menuId);
        if (!button || !menu) return;
        button.addEventListener('click', function (event) { event.stopPropagation(); var isOpen = menu.classList.contains('show'); closeAllDropdowns(); if (!isOpen) menu.classList.add('show'); });
        menu.addEventListener('click', function (event) { event.stopPropagation(); });
      }
      setupDropdown('notifBtn', 'notifMenu');
      setupDropdown('userBtn', 'userMenu');
      document.addEventListener('click', closeAllDropdowns);
      
      document.querySelectorAll('[data-toast]').forEach(function (el) {
        el.addEventListener('click', function () { window.showToast(el.dataset.toast); });
      });
    })();
  </script>

  @yield('custom-js')
</body>
</html>