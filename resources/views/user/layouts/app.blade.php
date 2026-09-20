<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Sadena — Panel Pelanggan')</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" />

  <style>
    /* ============================================================
       RESET & BASE DESIGN USER PANEL
       ============================================================ */
    *, *::before, *::after { box-sizing: border-box; }
    html, body { margin: 0; padding: 0; }
    body {
      background-color: #fff8f2;
      font-family: "Inter", system-ui, -apple-system, sans-serif;
      font-size: 15px;
      color: #461309;
      -webkit-font-smoothing: antialiased;
    }
    img, svg { display: block; }
    button, input { font-family: inherit; }

    .app { display: flex; min-height: 100vh; width: 100%; }

    /* ============================================================
       SIDEBAR
       ============================================================ */
    .sidebar {
      position: relative; flex-shrink: 0; width: 227px;
      padding: 24px 0 32px; background-color: #461300; color: #ffffff;
      overflow: hidden; box-shadow: 5px 4px 4px rgba(0, 0, 0, 0.25); z-index: 2;
      display: flex; flex-direction: column; height: 100vh; position: sticky; top: 0;
    }
    .sidebar-art {
      position: absolute; left: -90px; bottom: -70px; width: 374px; height: 260px;
      border-radius: 50%; background: radial-gradient(circle at 50% 50%, rgba(246, 198, 145, 0.22) 0%, rgba(246, 198, 145, 0.08) 55%, rgba(246, 198, 145, 0) 72%);
      pointer-events: none;
    }
    .brand { position: relative; display: flex; align-items: center; gap: 15px; padding: 0 20px 0 30px; }
    .brand-icon { flex-shrink: 0; width: 32px; height: 41px; color: #f6c691; }
    .brand-name { font-size: 24px; font-weight: 800; line-height: 1.1; letter-spacing: 0.5px; color: #f6c691; }
    .brand-role { margin-top: 3px; font-size: 14px; font-weight: 400; color: #ffffff; }

    .nav {
      position: relative; display: flex; flex-direction: column; gap: 14px;
      margin-top: 35px; padding: 0 20px; flex: 1;
    }
    .nav-item {
      display: flex; align-items: center; gap: 16px; height: 40px; padding: 0 16px;
      border-radius: 10px; font-size: 16px; font-weight: 400; color: #ffffff;
      text-decoration: none; transition: background-color 0.2s ease, color 0.2s ease;
    }
    .nav-item svg { flex-shrink: 0; width: 19px; height: 19px; }
    .nav-item:hover { background-color: rgba(246, 198, 145, 0.16); }
    .nav-item.is-active { background-color: #f6c691; color: #461300; font-weight: 600; }

    /* ============================================================
       MAIN CONTENT & TOPBAR
       ============================================================ */
    .main { display: flex; flex: 1; min-width: 0; flex-direction: column; }
    
    .topbar {
      position: sticky; top: 0; z-index: 10; display: flex; align-items: center; justify-content: flex-end;
      gap: 20px; height: 77px; padding: 0 30px; background-color: #ffffff;
      box-shadow: 5px 4px 4px rgba(0, 0, 0, 0.25);
    }
    .topbar-user { font-size: 18px; font-weight: 600; color: #edb171; }
    .avatar {
      display: flex; align-items: center; justify-content: center; width: 52px; height: 52px;
      border-radius: 50%; background-color: #fad1a3; font-size: 20px; font-weight: 700; color: #552612; user-select: none;
    }

    .content {
  width: 100%; max-width: 960px; margin: 0 auto; padding: 32px 40px 60px;
}
    @media (max-width: 900px) {
      .app { flex-direction: column; }
      .sidebar { width: 100%; min-height: auto; position: relative; padding-bottom: 20px; }
      .sidebar-art { display: none; }
      .nav { flex-direction: row; gap: 10px; margin-top: 20px; overflow-x: auto; }
      .nav-item { flex-shrink: 0; }
    }
  </style>

  @yield('custom-css')
</head>
<body>
  <div class="app">
    <!-- PARTIAL: Sidebar User -->
    @include('user.partials.sidebar')

    <div class="main">
      <!-- PARTIAL: Topbar User -->
      @include('user.partials.topbar')

      <!-- KONTEN UTAMA YANG BERUBAH-RUBAH -->
      <main class="content">
        @yield('content')
      </main>
    </div>
  </div>

  @yield('custom-js')
</body>
</html>