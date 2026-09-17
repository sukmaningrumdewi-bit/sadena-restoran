<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, width=device-width">
<!-- @yield('title') agar judul tab browser bisa diganti-ganti per halaman -->
<title>@yield('title') - SADENA</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
<style>
  /* ---------- Reset & Base ---------- */
  * { margin: 0; padding: 0; box-sizing: border-box; }
  html, body { height: 100%; }

  body {
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    background: #fdf5eb;
    color: #1c1917;
    -webkit-font-smoothing: antialiased;
  }

  button { font-family: inherit; cursor: pointer; border: none; background: none; }
  svg { display: block; }

  /* ---------- App Layout ---------- */
  .app {
    display: flex;
    min-height: 100vh;
  }

  

  /* ---------- Main ---------- */
  .main {
    flex: 1;
    padding: 32px 40px 48px;
    min-width: 0;
  }

  .topbar {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 28px;
    flex-wrap: wrap;
  }
  .topbar__title {
    font-size: 28px;
    font-weight: 800;
    color: #1c1917;
    letter-spacing: -0.02em;
  }
  .topbar__desc {
    font-size: 14px;
    color: rgba(28,25,23,0.55);
    margin-top: 4px;
  }
  .topbar__time {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    padding: 10px 16px;
    border-radius: 12px;
    border: 1px solid rgba(70,19,0,0.08);
    box-shadow: 0 2px 8px -4px rgba(70,19,0,0.1);
    color: #462311;
    font-weight: 600;
    font-size: 14px;
    flex-shrink: 0;
  }
  .topbar__time svg { width: 18px; height: 18px; color: #c2593b; }

  /* ---------- Stats ---------- */
  .stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 28px;
  }

  .stat {
    background: #fff;
    border-radius: 16px;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    border: 1px solid rgba(70,19,0,0.06);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .stat:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px -16px rgba(70,19,0,0.25);
  }

  .stat__icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .stat__icon svg { width: 22px; height: 22px; }
  .stat__icon--amber { background: #fef3c7; color: #b45309; }
  .stat__icon--orange { background: #ffedd5; color: #c2593b; }
  .stat__icon--green { background: #dcfce7; color: #15803d; }
  .stat__icon--blue { background: #dbeafe; color: #1d4ed8; }

  .stat__label {
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    color: rgba(28,25,23,0.55);
  }
  .stat__value {
    font-size: 26px;
    font-weight: 800;
    color: #1c1917;
    margin-top: 2px;
    line-height: 1;
  }
  .stat__sub {
    font-size: 12px;
    color: rgba(28,25,23,0.5);
    margin-top: 4px;
  }

  /* ---------- Filters ---------- */
  .filters {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    flex-wrap: wrap;
  }

  .chip {
    padding: 10px 18px;
    border-radius: 999px;
    background: #fff;
    color: rgba(28,25,23,0.7);
    font-size: 13.5px;
    font-weight: 600;
    border: 1px solid rgba(70,19,0,0.08);
    transition: all 0.18s ease;
  }
  .chip:hover { border-color: rgba(70,19,0,0.2); color: #1c1917; }
  .chip.is-active {
    background: #462311;
    color: #fad1a3;
    border-color: #462311;
  }

  /* ---------- Order Grid ---------- */
  .orders {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
  }

  .order {
    background: #fff;
    border-radius: 16px;
    border: 1px solid rgba(70,19,0,0.07);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.2s ease;
  }
  .order:hover { box-shadow: 0 18px 40px -22px rgba(70,19,0,0.35); }
  .order.is-hidden { display: none; }

  .order__head {
    padding: 16px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    border-bottom: 1px solid rgba(70,19,0,0.06);
  }
  .order__id { display: flex; flex-direction: column; gap: 2px; }
  .order__id-num { font-size: 15px; font-weight: 800; color: #1c1917; letter-spacing: -0.01em; }
  .order__id-time { font-size: 12px; font-weight: 500; color: rgba(28,25,23,0.5); }

  .order__status {
    padding: 5px 11px;
    border-radius: 20px;
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    white-space: nowrap;
  }
  .order__status--pending { background: #fef3c7; color: #b45309; }
  .order__status--cooking { background: #ffe4d6; color: #c2593b; }
  .order__status--done { background: #dcfce7; color: #15803d; }

  .order__meta {
    padding: 12px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    background: #fdfbf7;
    border-bottom: 1px solid rgba(70,19,0,0.06);
  }

  .order__type {
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.4px;
    background: #462311;
    color: #fad1a3;
  }
  .order__type--takeaway { background: #4b5563; color: #fff; }

  .order__customer { font-size: 13px; font-weight: 700; color: #462311; }

  .order__items {
    padding: 14px 18px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    flex: 1;
  }
  .order__item {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 14px;
    font-size: 13.5px;
  }
  .order__item-name { color: #1c1917; font-weight: 600; line-height: 1.4; }
  .order__item-qty { color: #c2593b; font-weight: 800; margin-right: 4px; }
  .order__item-price { color: #1c1917; font-weight: 700; white-space: nowrap; flex-shrink: 0; }

  .order__total {
    padding: 12px 18px;
    background: #fdfbf7;
    border-top: 1px solid rgba(70,19,0,0.06);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .order__total-label { font-size: 12px; font-weight: 600; color: rgba(28,25,23,0.55); }
  .order__total-value { font-size: 17px; font-weight: 800; color: #462311; }

  .order__actions {
    padding: 14px 18px;
    display: flex;
    gap: 8px;
  }

  .btn {
    flex: 1;
    padding: 11px 14px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.2px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: all 0.18s ease;
    white-space: nowrap;
  }
  .btn svg { width: 16px; height: 16px; }

  .btn--primary { background: #462311; color: #fad1a3; }
  .btn--primary:hover {
    background: #5c1a02;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px -8px rgba(70,19,0,0.5);
  }
  .btn--accent { background: #c2593b; color: #fff; }
  .btn--accent:hover {
    background: #a94a30;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px -8px rgba(194,89,59,0.5);
  }
  .btn--success { background: #15803d; color: #fff; }
  .btn--success:hover {
    background: #136c34;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px -8px rgba(21,128,61,0.5);
  }

  .orders__empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    color: rgba(28,25,23,0.5);
    font-size: 14px;
    font-weight: 500;
  }

  /* ---------- Responsive ---------- */
  @media (max-width: 1200px) {
    .stats { grid-template-columns: repeat(2, 1fr); }
    .orders { grid-template-columns: 1fr; }
  }

  @media (max-width: 900px) {
    .sidebar { width: 76px; padding: 20px 10px; }
    .brand-name,
    .brand-sub,
    .nav-item span:not(.nav-item__badge),
    .user-info { display: none; }
    .nav-item { justify-content: center; padding: 12px; }
    .nav-item__badge {
      position: absolute;
      top: 4px;
      right: 4px;
      margin: 0;
      font-size: 10px;
      padding: 1px 6px;
      min-width: 16px;
    }
    .brand-logo { margin: 0 auto; }
    .user-card { justify-content: center; padding: 8px; }
    .main { padding: 24px 20px 40px; }
  }

  @media (max-width: 640px) {
    .app { flex-direction: column; }
    .sidebar {
      width: 100%;
      height: auto;
      flex-direction: row;
      align-items: center;
      padding: 10px 12px;
      position: sticky;
      top: 0;
      z-index: 50;
      gap: 8px;
    }
    .sidebar__brand { display: none; }
    .sidebar__nav { flex-direction: row; gap: 4px; flex: 1; }
    .nav-item { flex: 1; padding: 10px 8px; justify-content: center; }
    .nav-item__badge { top: 4px; right: 8px; }
    .sidebar__footer { display: none; }

    .main { padding: 20px 14px 32px; }
    .topbar { flex-direction: column; align-items: stretch; gap: 12px; }
    .topbar__title { font-size: 22px; }
    .topbar__time { align-self: flex-start; }

    .stats { grid-template-columns: 1fr 1fr; gap: 10px; }
    .stat { padding: 14px; gap: 10px; border-radius: 12px; }
    .stat__icon { width: 38px; height: 38px; border-radius: 10px; }
    .stat__icon svg { width: 18px; height: 18px; }
    .stat__value { font-size: 20px; }
    .stat__label { font-size: 10px; }
    .stat__sub { font-size: 11px; }

    .chip { padding: 8px 14px; font-size: 12.5px; }

    .order__head,
    .order__meta,
    .order__items,
    .order__total,
    .order__actions { padding-left: 14px; padding-right: 14px; }
  }

  @media (max-width: 380px) {
    .stats { grid-template-columns: 1fr; }
  }
</style>
</head>
<body>

<div class="app">

  <!-- Memanggil file sidebar dari folder partials menggunakan INCLUDE -->
  @include('kasir.partials.sidebar')

  <!-- ============= MAIN ============= -->
  <main class="main">
    
    <!-- YIELD 'content' adalah ruang kosong yang akan diisi oleh file dashboard.blade.php -->
    @yield('content')

  </main>
</div>

<script>
(function () {
  // ---------- Live Clock ----------
  const clockEl = document.getElementById('clock');
  function updateClock() {
    if(!clockEl) return; // Mencegah error jika id clock tidak ada di halaman tertentu
    const now = new Date();
    const hh = String(now.getHours()).padStart(2, '0');
    const mm = String(now.getMinutes()).padStart(2, '0');
    clockEl.textContent = hh + ':' + mm + ' WIB';
  }
  updateClock();
  setInterval(updateClock, 30000);

  // ---------- Navigasi Sidebar (opsional) ----------
  document.querySelectorAll('.nav-item').forEach((item) => {
    item.addEventListener('click', (e) => {
      // e.preventDefault(); (Sebaiknya dihilangkan jika href sudah berisi link asli)
      document.querySelectorAll('.nav-item').forEach((n) => n.classList.remove('is-active'));
      item.classList.add('is-active');
    });
  });

  // Letakkan script JS umum lainnya di sini...
})();
</script>

</body>
</html>