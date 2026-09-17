@extends('kasir.layouts.app')

@section('title', 'Dashboard Kasir')

@section('content')
    <!-- ============= KONTEN KHUSUS DASHBOARD ============= -->
    <header class="topbar">
      <div>
        <h1 class="topbar__title">Pesan Aktif</h1>
        <p class="topbar__desc">Pantau dan kelola pesanan yang sedang berjalan</p>
      </div>
      <div class="topbar__time">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <circle cx="12" cy="12" r="9"/>
          <path d="M12 7v5l3 2"/>
        </svg>
        <span id="clock">--:-- WIB</span>
      </div>
    </header>

    <!-- ---------- Stats ---------- -->
    <section class="stats">
      <div class="stat">
        <div class="stat__icon stat__icon--amber">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
               stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M22 12h-6l-2 3h-4l-2-3H2"/>
            <path d="M5.5 5h13l2.5 7v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6z"/>
          </svg>
        </div>
        <div>
          <div class="stat__label">Menunggu Diterima</div>
          <div class="stat__value" id="stat-pending">2</div>
          <div class="stat__sub">Pesanan baru masuk</div>
        </div>
      </div>

      <div class="stat">
        <div class="stat__icon stat__icon--orange">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
               stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12 3c-1.5 2-2 4-2 6 0 1.5.7 2.5 2 3v9"/>
            <path d="M8 21h8"/>
          </svg>
        </div>
        <div>
          <div class="stat__label">Sedang Dimasak</div>
          <div class="stat__value" id="stat-cooking">1</div>
          <div class="stat__sub">Diproses dapur</div>
        </div>
      </div>

      <div class="stat">
        <div class="stat__icon stat__icon--blue">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
               stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="2" y="6" width="20" height="12" rx="2"/>
            <path d="M2 11h20"/>
            <circle cx="17" cy="15" r="1.2" fill="currentColor"/>
          </svg>
        </div>
        <div>
          <div class="stat__label">Siap Dibayar</div>
          <div class="stat__value" id="stat-ready">1</div>
          <div class="stat__sub">Menunggu kasir</div>
        </div>
      </div>

      <div class="stat">
        <div class="stat__icon stat__icon--green">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
               stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20 6 9 17l-5-5"/>
          </svg>
        </div>
        <div>
          <div class="stat__label">Transaksi Hari Ini</div>
          <div class="stat__value" id="stat-done">2</div>
          <div class="stat__sub">Sudah lunas</div>
        </div>
      </div>
    </section>

    <!-- ---------- Filters ---------- -->
    <div class="filters" id="filters">
      <button class="chip is-active" data-filter="all">Semua</button>
      <button class="chip" data-filter="pending">Belum Diterima</button>
      <button class="chip" data-filter="cooking">Sedang Dimasak</button>
      <button class="chip" data-filter="done">Selesai</button>
    </div>

    <!-- ---------- Orders ---------- -->
    <section class="orders" id="orders">

      <!-- Order 1 — Pending Dine-in -->
      <article class="order" data-status="pending">
        <div class="order__head">
          <div class="order__id">
            <span class="order__id-num">ORD-001</span>
            <span class="order__id-time">10:15 WIB</span>
          </div>
          <span class="order__status order__status--pending">Belum Diterima</span>
        </div>
        <div class="order__meta">
          <span class="order__type">DINE-IN</span>
          <span class="order__customer">Meja 07</span>
        </div>
        <div class="order__items">
          <div class="order__item">
            <span class="order__item-name"><span class="order__item-qty">2x</span>Nasi Kuning Spesial</span>
            <span class="order__item-price">Rp. 70.000</span>
          </div>
          <div class="order__item">
            <span class="order__item-name"><span class="order__item-qty">1x</span>Rendang Daging</span>
            <span class="order__item-price">Rp. 45.000</span>
          </div>
          <div class="order__item">
            <span class="order__item-name"><span class="order__item-qty">3x</span>Es Teh Manis</span>
            <span class="order__item-price">Rp. 15.000</span>
          </div>
        </div>
        <div class="order__total">
          <span class="order__total-label">Total Harga</span>
          <span class="order__total-value">Rp. 130.000</span>
        </div>
        <div class="order__actions">
          <button class="btn btn--accent" data-action="accept">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M20 6 9 17l-5-5"/>
            </svg>
            Terima Pesanan
          </button>
        </div>
      </article>

      <!-- Order 2 — Pending Takeaway -->
      <article class="order" data-status="pending">
        <div class="order__head">
          <div class="order__id">
            <span class="order__id-num">ORD-002</span>
            <span class="order__id-time">10:20 WIB</span>
          </div>
          <span class="order__status order__status--pending">Belum Diterima</span>
        </div>
        <div class="order__meta">
          <span class="order__type order__type--takeaway">TAKEAWAY</span>
          <span class="order__customer">A/N Rina</span>
        </div>
        <div class="order__items">
          <div class="order__item">
            <span class="order__item-name"><span class="order__item-qty">1x</span>Nusantara Platter</span>
            <span class="order__item-price">Rp. 85.000</span>
          </div>
          <div class="order__item">
            <span class="order__item-name"><span class="order__item-qty">1x</span>Iced Green Banana</span>
            <span class="order__item-price">Rp. 25.000</span>
          </div>
        </div>
        <div class="order__total">
          <span class="order__total-label">Total Harga</span>
          <span class="order__total-value">Rp. 110.000</span>
        </div>
        <div class="order__actions">
          <button class="btn btn--accent" data-action="accept">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M20 6 9 17l-5-5"/>
            </svg>
            Terima Pesanan
          </button>
        </div>
      </article>

      <!-- Order 3 — Cooking Dine-in -->
      <article class="order" data-status="cooking">
        <div class="order__head">
          <div class="order__id">
            <span class="order__id-num">ORD-003</span>
            <span class="order__id-time">09:52 WIB</span>
          </div>
          <span class="order__status order__status--cooking">Sedang Dimasak</span>
        </div>
        <div class="order__meta">
          <span class="order__type">DINE-IN</span>
          <span class="order__customer">Meja 04</span>
        </div>
        <div class="order__items">
          <div class="order__item">
            <span class="order__item-name"><span class="order__item-qty">2x</span>Ayam Bakar Sambel Ijo</span>
            <span class="order__item-price">Rp. 80.000</span>
          </div>
          <div class="order__item">
            <span class="order__item-name"><span class="order__item-qty">2x</span>Kopi Susu Sadena</span>
            <span class="order__item-price">Rp. 44.000</span>
          </div>
        </div>
        <div class="order__total">
          <span class="order__total-label">Total Harga</span>
          <span class="order__total-value">Rp. 124.000</span>
        </div>
        <div class="order__actions">
          <button class="btn btn--primary" data-action="ready">
            Selesai / Siap Saji
          </button>
        </div>
      </article>

      <!-- Order 4 — Done Takeaway -->
      <article class="order" data-status="done">
        <div class="order__head">
          <div class="order__id">
            <span class="order__id-num">ORD-004</span>
            <span class="order__id-time">09:47 WIB</span>
          </div>
          <span class="order__status order__status--done">Selesai</span>
        </div>
        <div class="order__meta">
          <span class="order__type order__type--takeaway">TAKEAWAY</span>
          <span class="order__customer">A/N Dimas</span>
        </div>
        <div class="order__items">
          <div class="order__item">
            <span class="order__item-name"><span class="order__item-qty">1x</span>Nasi Kuning Spesial</span>
            <span class="order__item-price">Rp. 35.000</span>
          </div>
          <div class="order__item">
            <span class="order__item-name"><span class="order__item-qty">1x</span>Pisang Goreng Keju</span>
            <span class="order__item-price">Rp. 18.000</span>
          </div>
        </div>
        <div class="order__total">
          <span class="order__total-label">Total Harga</span>
          <span class="order__total-value">Rp. 124.000</span>
        </div>
        <div class="order__actions">
          <button class="btn btn--success" data-action="pay">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <rect x="2" y="6" width="20" height="12" rx="2"/>
              <path d="M2 11h20"/>
            </svg>
            Proses ke Pembayaran
          </button>
        </div>
      </article>

    </section>

    <!-- ---------- SCRIPT KHUSUS DASHBOARD ---------- -->
    <!-- Letakkan script di sini agar fungsi klik order & filter berjalan -->
    <script>
    (function () {
      // ---------- Live Clock ----------
      const clockEl = document.getElementById('clock');
      function updateClock() {
        if (!clockEl) return;
        const now = new Date();
        const hh = String(now.getHours()).padStart(2, '0');
        const mm = String(now.getMinutes()).padStart(2, '0');
        clockEl.textContent = hh + ':' + mm + ' WIB';
      }
      updateClock();
      setInterval(updateClock, 30000);

      // ---------- Filter chips ----------
      const chips = document.querySelectorAll('.chip');
      const ordersWrap = document.getElementById('orders');

      chips.forEach((chip) => {
        chip.addEventListener('click', () => {
          chips.forEach((c) => c.classList.remove('is-active'));
          chip.classList.add('is-active');
          applyFilter(chip.dataset.filter);
        });
      });

      function applyFilter(filter) {
        if (!ordersWrap) return;
        const cards = ordersWrap.querySelectorAll('.order');
        let visible = 0;
        cards.forEach((card) => {
          const match = filter === 'all' || card.dataset.status === filter;
          card.classList.toggle('is-hidden', !match);
          if (match) visible++;
        });
        renderEmptyState(visible === 0);
      }

      function renderEmptyState(show) {
        if (!ordersWrap) return;
        let empty = ordersWrap.querySelector('.orders__empty');
        if (show && !empty) {
          empty = document.createElement('div');
          empty.className = 'orders__empty';
          empty.textContent = 'Tidak ada pesanan pada kategori ini.';
          ordersWrap.appendChild(empty);
        } else if (!show && empty) {
          empty.remove();
        }
      }

      // ---------- Order actions ----------
      if (ordersWrap) {
          ordersWrap.addEventListener('click', (e) => {
            const btn = e.target.closest('.order__actions .btn');
            if (!btn) return;
            const card = btn.closest('.order');
            const action = btn.dataset.action;

            if (action === 'accept') {
              setStatus(card, 'cooking');
              renderActions(card, 'cooking');
              updateStats();
            } else if (action === 'ready') {
              setStatus(card, 'done');
              renderActions(card, 'done');
              updateStats();
            } else if (action === 'pay') {
              card.style.transition = 'opacity 0.28s ease, transform 0.28s ease';
              card.style.opacity = '0';
              card.style.transform = 'translateY(-6px)';
              setTimeout(() => {
                card.remove();
                updateStats();
                const active = document.querySelector('.chip.is-active').dataset.filter;
                applyFilter(active);
              }, 280);
            }
          });
      }

      function setStatus(card, status) {
        card.dataset.status = status;
        const el = card.querySelector('.order__status');
        el.className = 'order__status';
        if (status === 'pending') {
          el.classList.add('order__status--pending');
          el.textContent = 'Belum Diterima';
        } else if (status === 'cooking') {
          el.classList.add('order__status--cooking');
          el.textContent = 'Sedang Dimasak';
        } else if (status === 'done') {
          el.classList.add('order__status--done');
          el.textContent = 'Selesai';
        }
      }

      function renderActions(card, status) {
        const wrap = card.querySelector('.order__actions');
        if (status === 'cooking') {
          wrap.innerHTML =
            '<button class="btn btn--primary" data-action="ready">Selesai / Siap Saji</button>';
        } else if (status === 'done') {
          wrap.innerHTML =
            '<button class="btn btn--success" data-action="pay">' +
              '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" ' +
                   'stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' +
                '<rect x="2" y="6" width="20" height="12" rx="2"/>' +
                '<path d="M2 11h20"/>' +
              '</svg>' +
              'Proses ke Pembayaran' +
            '</button>';
        }
      }

      // ---------- Stats dynamic ----------
      function updateStats() {
        if (!ordersWrap) return;
        const all = ordersWrap.querySelectorAll('.order');
        let pending = 0, cooking = 0, done = 0;
        all.forEach((c) => {
          const s = c.dataset.status;
          if (s === 'pending') pending++;
          else if (s === 'cooking') cooking++;
          else if (s === 'done') done++;
        });
        
        const statPending = document.getElementById('stat-pending');
        const statCooking = document.getElementById('stat-cooking');
        const statReady = document.getElementById('stat-ready');

        if (statPending) statPending.textContent = pending;
        if (statCooking) statCooking.textContent = cooking;
        if (statReady) statReady.textContent = done;

        // Badge di sidebar "Pesan Aktif" (pending + cooking)
        const badge = document.querySelector('.nav-item.is-active .nav-item__badge');
        if (badge) badge.textContent = pending + cooking;
      }
    })();
    </script>
@endsection