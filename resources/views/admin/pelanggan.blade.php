@extends('admin.layouts.app')

@section('title', 'Manajemen Pelanggan — Sadena')
@section('topbar-title', 'Manajemen Pelanggan')

@section('custom-css')
<style>
  /* =========================================================
     CSS KHUSUS HALAMAN MANAJEMEN PELANGGAN
     ========================================================= */
  .stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 22px;
  }

  .stat-card {
    display: flex;
    align-items: center;
    gap: 16px;
    background: var(--surface);
    border: 1px solid var(--brown);
    border-radius: var(--radius);
    box-shadow: var(--shadow-card);
    padding: 20px 22px;
    min-width: 0;
    transition: transform 0.18s ease, box-shadow 0.18s ease;
  }

  .stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.16);
  }

  .stat-icon {
    width: 48px;
    height: 44px;
    border-radius: 8px;
    display: grid;
    place-items: center;
    flex: none;
  }

  .stat-icon svg { width: 26px; height: 26px; }
  .stat-icon.blue   { background: var(--blue-bg);   color: var(--blue); }
  .stat-icon.green  { background: var(--green-soft-bg); color: var(--green); }
  .stat-icon.orange { background: var(--orange-bg); color: var(--orange); }

  .stat-text { min-width: 0; }

  .stat-label {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .stat-value {
    font-size: 20px;
    font-weight: 800;
    letter-spacing: -0.01em;
  }

  .panel-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 16px;
  }

  .panel-head h3 { font-size: 20px; font-weight: 700; }

  .result-info {
    font-size: 13px;
    font-weight: 500;
    color: var(--text-muted);
  }

  .toolbar {
    display: flex;
    align-items: flex-end; 
    gap: 14px;
    flex-wrap: wrap;
    margin-top: 14px;
  }

  .search-field {
    position: relative;
    flex: 1 1 280px;
    min-width: 0;
  }

  .search-field svg {
    position: absolute;
    top: 50%;
    left: 14px;
    transform: translateY(-50%);
    width: 22px;
    height: 22px;
    color: var(--text-muted);
    pointer-events: none;
  }

  .search-field input {
    width: 100%;
    height: 50px;
    padding: 0 16px 0 46px;
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    background: var(--surface);
    font-size: 15px;
    font-weight: 300;
    transition: border-color 0.18s ease, box-shadow 0.18s ease;
  }

  .search-field input::placeholder { color: rgba(0, 0, 0, 0.35); }

  .search-field input:focus {
    outline: none;
    border-color: var(--brown);
    box-shadow: 0 0 0 3px rgba(70, 19, 0, 0.1);
  }

  .select-field {
    position: relative;
    flex: 0 0 180px;
  }

  .select-field select {
    appearance: none;
    -webkit-appearance: none;
    width: 100%;
    height: 50px;
    padding: 0 38px 0 16px;
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    background: var(--surface);
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: border-color 0.18s ease, box-shadow 0.18s ease;
  }

  .select-field select:focus {
    outline: none;
    border-color: var(--brown);
    box-shadow: 0 0 0 3px rgba(70, 19, 0, 0.1);
  }

  .select-field svg {
    position: absolute;
    top: 50%;
    right: 12px;
    transform: translateY(-50%);
    width: 18px;
    height: 18px;
    color: var(--text-muted);
    pointer-events: none;
  }

  .table-wrap {
    overflow-x: auto;
    margin-top: 18px;
    -webkit-overflow-scrolling: touch;
  }

  table {
    width: 100%;
    min-width: 960px;
    border-collapse: collapse;
    font-size: 15px;
  }

  thead th {
    text-align: left;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--text-muted);
    padding: 16px 10px;
    border-bottom: 1px solid var(--brown);
    white-space: nowrap;
  }

  tbody td {
    padding: 16px 10px;
    border-bottom: 1px solid var(--line-soft);
    vertical-align: middle;
  }

  tbody tr:last-child td { border-bottom: 0; }
  tbody tr { transition: background 0.18s ease; }
  tbody tr:hover { background: var(--surface-hover); }

  .customer-cell {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 240px;
  }

  .avatar-circle {
    width: 51px;
    height: 51px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    font-size: 18px;
    font-weight: 800;
    flex: none;
  }

  .avatar-circle.c1 { background: #f2f6fa; color: #4e3a36; }
  .avatar-circle.c2 { background: #fde9f2; color: #cf5c8f; }
  .avatar-circle.c3 { background: #fef3c7; color: #d89c4f; }
  .avatar-circle.c4 { background: #ede6fe; color: #9a66da; }
  .avatar-circle.c5 { background: #fee1e1; color: #c94e56; }

  .customer-info { min-width: 0; }
  .customer-name { font-weight: 700; white-space: nowrap; }
  .customer-email {
    font-size: 14px;
    font-weight: 500;
    color: var(--text-email);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .cell-muted {
    color: var(--text-muted-light);
    white-space: nowrap;
  }

  .badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 78px;
    padding: 4px 12px;
    border-radius: var(--radius-sm);
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
  }

  .badge.active   { background: var(--green-bg); color: var(--green); }
  .badge.inactive { background: var(--red-bg);   color: var(--red); }

  .actions { display: flex; gap: 8px; }

  .action-btn {
    width: 31px;
    height: 28px;
    border-radius: 5px;
    display: grid;
    place-items: center;
    background: var(--surface);
    border: 1px solid rgba(0, 0, 0, 0.5);
    color: var(--brown);
    transition: background 0.18s ease, transform 0.18s ease;
  }

  .action-btn:hover { background: var(--surface-soft); transform: translateY(-1px); }
  .action-btn svg { width: 16px; height: 16px; }

  .empty-state {
    display: none;
    padding: 40px 10px;
    text-align: center;
    color: var(--text-muted);
    font-size: 15px;
  }
  .empty-state.show { display: block; }

  /* Tombol Utama & Perbaikan Ikon (+) */
  /* ---------- Perbaikan Tombol Utama (Warna Tetap Saat Diklik) ---------- */
  .btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 50px;
    padding: 0 20px;
    background: var(--brown) !important;
    color: #fff !important;
    border: none;
    border-radius: var(--radius-sm);
    font-size: 15px;
    font-weight: 600;
    white-space: nowrap;
    cursor: pointer;
    box-shadow: none !important;
    outline: none !important;
    transition: background 0.18s ease, transform 0.18s ease;
  }

  .btn-primary:hover,
  .btn-primary:focus,
  .btn-primary:active { 
    background: var(--brown) !important; 
    color: #fff !important;
    transform: translateY(-1px);
    box-shadow: none !important;
    outline: none !important;
  }

  .btn-primary svg { 
    width: 20px !important; 
    height: 20px !important; 
    flex: none;
    color: #fff !important;
  }

  /* ---------- Perbaikan Label Filter agar Tersembunyi Rapi ---------- */
  .select-field {
    position: relative;
    flex: 0 0 180px;
  }

  .select-field label {
    display: none !important; /* Memastikan label teks "Filter status pelanggan" benar-benar disembunyikan */
  }

  .btn-primary:hover { 
    background: var(--brown-hover); 
    transform: translateY(-1px); 
  }

  .btn-primary svg { 
    width: 20px !important; 
    height: 20px !important; 
    flex: none;
  }

  /* Style Modal & Form */
  .form-group { margin-bottom: 14px; }
  .form-group label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 6px;
    color: var(--brown);
  }
  .form-group input,
  .form-group select {
    width: 100%;
    height: 46px;
    padding: 0 14px;
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    background: var(--surface);
    font-size: 15px;
  }
  .form-group input:focus,
  .form-group select:focus {
    outline: none;
    border-color: var(--brown);
    box-shadow: 0 0 0 3px rgba(70, 19, 0, 0.1);
  }
  .form-group input.invalid,
  .form-group select.invalid {
    border-color: #c94e56;
    box-shadow: 0 0 0 3px rgba(201, 78, 86, 0.14);
  }
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  .detail-body { font-size: 15px; line-height: 1.7; }
  .detail-head {
    display: flex;
    align-items: center;
    gap: 14px;
    padding-bottom: 16px;
    margin-bottom: 14px;
    border-bottom: 1px solid var(--line-soft);
  }
  .detail-head .customer-name { font-size: 17px; }
  .detail-head .customer-email { white-space: normal; }
  .detail-row {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    padding: 8px 0;
    border-bottom: 1px dashed var(--line-soft);
  }
  .detail-row:last-child { border-bottom: 0; }
  .detail-label { font-weight: 600; color: var(--text-muted); flex: none; }
  .detail-value { text-align: right; word-break: break-word; }

  @media (max-width: 640px) {
    .form-row { grid-template-columns: 1fr; }
    .detail-row { flex-direction: column; gap: 2px; }
    .detail-value { text-align: left; }
  }
</style>
@endsection

@section('content')

  <!-- Statistik -->
  <section class="stats" aria-label="Ringkasan pelanggan">
    <article class="stat-card">
      <span class="stat-icon blue" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="8" r="4"/>
          <path d="M4 21a8 8 0 0 1 16 0"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Total Pelanggan</p>
        <p class="stat-value" id="totalPelanggan">1.280</p>
      </div>
    </article>

    <article class="stat-card">
      <span class="stat-icon green" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round">
          <circle cx="10" cy="8" r="4"/>
          <path d="M2 21a8 8 0 0 1 16 0"/>
          <path d="M16 13l2.5 2.5L23 11"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Pelanggan Aktif</p>
        <p class="stat-value" id="pelangganAktif">950</p>
      </div>
    </article>

    <article class="stat-card">
      <span class="stat-icon orange" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round">
          <circle cx="10" cy="8" r="4"/>
          <path d="M2 21a8 8 0 0 1 16 0"/>
          <path d="M19 8v6M16 11h6"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Pelanggan Baru (Bulan Ini)</p>
        <p class="stat-value" id="pelangganBaru">124</p>
      </div>
    </article>
  </section>

  <!-- Panel Pelanggan -->
  <section class="panel" aria-labelledby="panelTitle">
    <div class="panel-head">
      <div>
        <h3 id="panelTitle">Daftar Seluruh Pelanggan</h3>
        <p style="font-size: 13px; color: var(--text-muted); margin-top: 2px;">
          Kelola data kontak, status keaktifan, dan riwayat pesanan pelanggan Sadena.
        </p>
      </div>
      <p class="result-info" id="resultInfo" aria-live="polite"></p>
    </div>

    <div class="toolbar">
      <div class="search-field">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <circle cx="11" cy="11" r="7"/>
          <path d="M20 20l-3.5-3.5"/>
        </svg>
        <label class="sr-only" for="searchInput">Cari pelanggan</label>
        <input type="search" id="searchInput"
               placeholder="Cari nama / email / telepon..."
               autocomplete="off">
      </div>

      <div class="select-field">
        <label class="sr-only" for="statusFilter">Filter status pelanggan</label>
        <select id="statusFilter">
          <option value="all">Semua Status</option>
          <option value="Aktif">Aktif</option>
          <option value="Non Aktif">Non Aktif</option>
        </select>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </div>

      <button class="btn-primary" id="addCustomerBtn" type="button">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M12 5v14M5 12h14"/>
        </svg>
        Tambah Pelanggan
      </button>
    </div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th scope="col">Pelanggan</th>
            <th scope="col">Nomor Telepon</th>
            <th scope="col">Tanggal Bergabung</th>
            <th scope="col">Total Pesanan</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody id="customerTableBody">
          <!-- Diisi oleh JavaScript -->
        </tbody>
      </table>
      <p class="empty-state" id="emptyState">Tidak ada pelanggan yang cocok dengan filter.</p>
    </div>
  </section>

  <!-- ============ Modal Tambah / Ubah Pelanggan ============ -->
  <div class="modal" id="customerModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-backdrop" data-close-modal></div>
    <div class="modal-card">
      <div class="modal-head">
        <h2 id="modalTitle">Tambah Pelanggan</h2>
        <button class="modal-close" type="button" aria-label="Tutup dialog" data-close-modal>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 6l12 12M18 6L6 18"/>
          </svg>
        </button>
      </div>

      <form id="customerForm" novalidate>
        <div class="form-group">
          <label for="fieldName">Nama Lengkap</label>
          <input type="text" id="fieldName" name="name" required
                 placeholder="Contoh: Budi Santoso" autocomplete="name">
        </div>

        <div class="form-group">
          <label for="fieldEmail">Email</label>
          <input type="email" id="fieldEmail" name="email" required
                 placeholder="nama@email.com" autocomplete="email">
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="fieldPhone">Nomor Telepon</label>
            <input type="tel" id="fieldPhone" name="phone" required
                   placeholder="+62 812-3456-7890" autocomplete="tel">
          </div>

          <div class="form-group">
            <label for="fieldJoin">Tanggal Bergabung</label>
            <input type="text" id="fieldJoin" name="join" required
                   placeholder="12 Jan 2026" autocomplete="off">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="fieldOrders">Total Pesanan</label>
            <input type="number" id="fieldOrders" name="orders" required
                   min="0" step="1" placeholder="0" inputmode="numeric">
          </div>

          <div class="form-group">
            <label for="fieldStatus">Status</label>
            <select id="fieldStatus" name="status">
              <option value="Aktif">Aktif</option>
              <option value="Non Aktif">Non Aktif</option>
            </select>
          </div>
        </div>

        <div class="modal-actions">
          <button type="button" class="btn-secondary" data-close-modal>Batal</button>
          <button type="submit" class="btn-primary" id="submitBtn">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ============ Modal Detail Pelanggan ============ -->
  <div class="modal" id="detailModal" role="dialog" aria-modal="true" aria-labelledby="detailTitle">
    <div class="modal-backdrop" data-close-detail></div>
    <div class="modal-card">
      <div class="modal-head">
        <h2 id="detailTitle">Detail Pelanggan</h2>
        <button class="modal-close" type="button" aria-label="Tutup dialog" data-close-detail>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 6l12 12M18 6L6 18"/>
          </svg>
        </button>
      </div>
      <div class="detail-body" id="detailBody"></div>
      <div class="modal-actions">
        <button type="button" class="btn-secondary" data-close-detail>Tutup</button>
      </div>
    </div>
  </div>

@endsection

@section('custom-js')
<script>
  (function () {
    'use strict';

    var customers = [
      { id: 1, name: 'Budi Santoso',  email: 'budi.santoso@email.com',  phone: '+62 812-3456-5785', join: '12 Jan 2026', orders: 14, status: 'Aktif',     color: 'c1' },
      { id: 2, name: 'Siti Aminah',   email: 'siti.aminah@email.com',   phone: '+62 813-2246-9867', join: '24 Feb 2026', orders: 8,  status: 'Aktif',     color: 'c2' },
      { id: 3, name: 'Agus Setiawan', email: 'agus.setiawan@email.com', phone: '+62 811-1245-6758', join: '05 Mar 2026', orders: 3,  status: 'Aktif',     color: 'c3' },
      { id: 4, name: 'Rina Melati',   email: 'rina.melati@email.com',   phone: '+62 815-0978-4769', join: '19 Jan 2025', orders: 22, status: 'Aktif',     color: 'c4' },
      { id: 5, name: 'Dedi Pratama',  email: 'dedi.pratama@email.com',  phone: '+62 816-4895-9986', join: '10 Nov 2024', orders: 1,  status: 'Non Aktif', color: 'c5' }
    ];

    var statsBase = { total: 1280, aktif: 950, baru: 124 };
    var COLOR_CYCLE = ['c1', 'c2', 'c3', 'c4', 'c5'];
    var MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    var tbody           = document.getElementById('customerTableBody');
    var emptyState      = document.getElementById('emptyState');
    var resultInfo      = document.getElementById('resultInfo');
    var searchInput     = document.getElementById('searchInput');
    var statusFilter    = document.getElementById('statusFilter');
    var totalPelangganEl= document.getElementById('totalPelanggan');
    var pelangganAktifEl= document.getElementById('pelangganAktif');
    var pelangganBaruEl = document.getElementById('pelangganBaru');

    function escapeHtml(str) {
      return String(str).replace(/[&<>"']/g, function (ch) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[ch];
      });
    }

    function initials(name) {
      return String(name).trim().split(/\s+/).slice(0, 2).map(function (w) {
        return w.charAt(0).toUpperCase();
      }).join('');
    }

    function formatNumber(n) {
      return Number(n).toLocaleString('id-ID');
    }

    function todayLabel() {
      var d = new Date();
      return String(d.getDate()).padStart(2, '0') + ' ' +
             MONTHS[d.getMonth()] + ' ' + d.getFullYear();
    }

    function updateStats() {
      totalPelangganEl.textContent = formatNumber(statsBase.total);
      pelangganAktifEl.textContent = formatNumber(statsBase.aktif);
      pelangganBaruEl.textContent  = formatNumber(statsBase.baru);
    }

    function getFiltered() {
      var query = searchInput.value.trim().toLowerCase();
      var statusVal = statusFilter.value;

      return customers.filter(function (c) {
        var matchQuery = !query ||
          c.name.toLowerCase().indexOf(query) !== -1 ||
          c.email.toLowerCase().indexOf(query) !== -1 ||
          c.phone.toLowerCase().indexOf(query) !== -1;

        var matchStatus = statusVal === 'all' || c.status === statusVal;
        return matchQuery && matchStatus;
      });
    }

    function renderTable() {
      var filtered = getFiltered();
      tbody.innerHTML = '';
      updateStats();

      resultInfo.textContent = 'Menampilkan ' + filtered.length + ' dari ' + customers.length + ' pelanggan';

      if (filtered.length === 0) {
        emptyState.classList.add('show');
        return;
      }
      emptyState.classList.remove('show');

      var fragment = document.createDocumentFragment();

      filtered.forEach(function (customer) {
        var tr = document.createElement('tr');

        var tdCustomer = document.createElement('td');
        tdCustomer.innerHTML =
          '<div class="customer-cell">' +
            '<span class="avatar-circle ' + customer.color + '" aria-hidden="true">' +
              escapeHtml(initials(customer.name)) +
            '</span>' +
            '<div class="customer-info">' +
              '<div class="customer-name">' + escapeHtml(customer.name) + '</div>' +
              '<div class="customer-email">' + escapeHtml(customer.email) + '</div>' +
            '</div>' +
          '</div>';

        var tdPhone = document.createElement('td');
        tdPhone.className = 'cell-muted';
        tdPhone.textContent = customer.phone;

        var tdJoin = document.createElement('td');
        tdJoin.className = 'cell-muted';
        tdJoin.textContent = customer.join;

        var tdOrders = document.createElement('td');
        tdOrders.className = 'cell-muted';
        tdOrders.textContent = customer.orders + ' Pesanan';

        var tdStatus = document.createElement('td');
        var badge = document.createElement('span');
        badge.className = 'badge ' + (customer.status === 'Aktif' ? 'active' : 'inactive');
        badge.textContent = customer.status;
        tdStatus.appendChild(badge);

        var tdActions = document.createElement('td');
        var actions = document.createElement('div');
        actions.className = 'actions';

        var viewBtn = document.createElement('button');
        viewBtn.type = 'button';
        viewBtn.className = 'action-btn';
        viewBtn.setAttribute('data-action', 'view');
        viewBtn.setAttribute('data-id', String(customer.id));
        viewBtn.setAttribute('aria-label', 'Lihat detail ' + customer.name);
        viewBtn.innerHTML =
          '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" ' +
          'stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' +
          '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>' +
          '<circle cx="12" cy="12" r="3"/></svg>';

        var editBtn = document.createElement('button');
        editBtn.type = 'button';
        editBtn.className = 'action-btn';
        editBtn.setAttribute('data-action', 'edit');
        editBtn.setAttribute('data-id', String(customer.id));
        editBtn.setAttribute('aria-label', 'Ubah ' + customer.name);
        editBtn.innerHTML =
          '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" ' +
          'stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' +
          '<path d="M12 20h9"/>' +
          '<path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';

        actions.appendChild(viewBtn);
        actions.appendChild(editBtn);
        tdActions.appendChild(actions);

        tr.appendChild(tdCustomer);
        tr.appendChild(tdPhone);
        tr.appendChild(tdJoin);
        tr.appendChild(tdOrders);
        tr.appendChild(tdStatus);
        tr.appendChild(tdActions);

        fragment.appendChild(tr);
      });

      tbody.appendChild(fragment);
    }

    tbody.addEventListener('click', function (event) {
      var btn = event.target.closest('[data-action]');
      if (!btn) return;

      var action = btn.getAttribute('data-action');
      var id = parseInt(btn.getAttribute('data-id'), 10);
      var customer = customers.find(function (c) { return c.id === id; });
      if (!customer) return;

      if (action === 'view') {
        openDetailModal(customer, btn);
      } else if (action === 'edit') {
        openCustomerModal(customer, btn);
      }
    });

    searchInput.addEventListener('input', renderTable);
    statusFilter.addEventListener('change', renderTable);

    // Modal Tambah/Ubah
    var customerModal = document.getElementById('customerModal');
    var modalTitle    = document.getElementById('modalTitle');
    var form          = document.getElementById('customerForm');
    var fieldName     = document.getElementById('fieldName');
    var fieldEmail    = document.getElementById('fieldEmail');
    var fieldPhone    = document.getElementById('fieldPhone');
    var fieldJoin     = document.getElementById('fieldJoin');
    var fieldOrders   = document.getElementById('fieldOrders');
    var fieldStatus   = document.getElementById('fieldStatus');
    var addCustomerBtn= document.getElementById('addCustomerBtn');
    var editingId     = null;
    var lastFocused   = null;

    function clearInvalid() {
      [fieldName, fieldEmail, fieldPhone, fieldJoin, fieldOrders].forEach(function (el) {
        el.classList.remove('invalid');
      });
    }

    function markInvalid(el) {
      el.classList.add('invalid');
      el.focus();
    }

    function openCustomerModal(customer, trigger) {
      lastFocused = trigger || document.activeElement;

      if (customer) {
        editingId = customer.id;
        modalTitle.textContent = 'Ubah Pelanggan';
        fieldName.value   = customer.name;
        fieldEmail.value  = customer.email;
        fieldPhone.value  = customer.phone;
        fieldJoin.value   = customer.join;
        fieldOrders.value = customer.orders;
        fieldStatus.value = customer.status;
      } else {
        editingId = null;
        modalTitle.textContent = 'Tambah Pelanggan';
        form.reset();
        fieldStatus.value = 'Aktif';
        fieldOrders.value = 0;
        fieldJoin.value = todayLabel();
      }

      clearInvalid();
      customerModal.classList.add('show');
      document.body.style.overflow = 'hidden';
      setTimeout(function () { fieldName.focus(); }, 80);
    }

    function closeCustomerModal() {
      customerModal.classList.remove('show');
      document.body.style.overflow = '';
      editingId = null;
      clearInvalid();
      if (lastFocused && typeof lastFocused.focus === 'function') lastFocused.focus();
    }

    addCustomerBtn.addEventListener('click', function () {
      openCustomerModal(null, addCustomerBtn);
    });

    Array.prototype.forEach.call(
      customerModal.querySelectorAll('[data-close-modal]'),
      function (el) { el.addEventListener('click', closeCustomerModal); }
    );

    form.addEventListener('submit', function (event) {
      event.preventDefault();
      clearInvalid();

      var name   = fieldName.value.trim();
      var email  = fieldEmail.value.trim();
      var phone  = fieldPhone.value.trim();
      var join   = fieldJoin.value.trim();
      var orders = parseInt(fieldOrders.value, 10);
      var status = fieldStatus.value;

      if (!name) { showToast('Nama wajib diisi'); markInvalid(fieldName); return; }
      if (!email) { showToast('Email wajib diisi'); markInvalid(fieldEmail); return; }
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        showToast('Format email tidak valid');
        markInvalid(fieldEmail);
        return;
      }
      if (!phone) { showToast('Nomor telepon wajib diisi'); markInvalid(fieldPhone); return; }
      if (!join)  { showToast('Tanggal bergabung wajib diisi'); markInvalid(fieldJoin); return; }
      if (isNaN(orders) || orders < 0) {
        showToast('Total pesanan harus berupa angka 0 atau lebih');
        markInvalid(fieldOrders);
        return;
      }

      if (editingId === null) {
        var newId = customers.length
          ? Math.max.apply(null, customers.map(function (c) { return c.id; })) + 1
          : 1;

        customers.push({
          id: newId,
          name: name,
          email: email,
          phone: phone,
          join: join,
          orders: orders,
          status: status,
          color: COLOR_CYCLE[(newId - 1) % COLOR_CYCLE.length]
        });

        statsBase.total += 1;
        statsBase.baru  += 1;
        if (status === 'Aktif') statsBase.aktif += 1;

        showToast('Pelanggan "' + name + '" berhasil ditambahkan');
      } else {
        var target = customers.find(function (c) { return c.id === editingId; });
        if (target) {
          if (target.status !== status) {
            statsBase.aktif += (status === 'Aktif' ? 1 : -1);
          }
          target.name   = name;
          target.email  = email;
          target.phone  = phone;
          target.join   = join;
          target.orders = orders;
          target.status = status;

          showToast('Pelanggan "' + name + '" berhasil diperbarui');
        }
      }

      closeCustomerModal();
      renderTable();
    });

    // Modal Detail
    var detailModal = document.getElementById('detailModal');
    var detailBody  = document.getElementById('detailBody');
    var detailLastFocused = null;

    function detailRow(label, value) {
      return '<div class="detail-row">' +
               '<span class="detail-label">' + escapeHtml(label) + '</span>' +
               '<span class="detail-value">' + value + '</span>' +
             '</div>';
    }

    function openDetailModal(customer, trigger) {
      detailLastFocused = trigger || document.activeElement;

      var statusBadge =
        '<span class="badge ' + (customer.status === 'Aktif' ? 'active' : 'inactive') + '">' +
          escapeHtml(customer.status) +
        '</span>';

      detailBody.innerHTML =
        '<div class="detail-head">' +
          '<span class="avatar-circle ' + customer.color + '" aria-hidden="true">' +
            escapeHtml(initials(customer.name)) +
          '</span>' +
          '<div class="customer-info">' +
            '<div class="customer-name">' + escapeHtml(customer.name) + '</div>' +
            '<div class="customer-email">' + escapeHtml(customer.email) + '</div>' +
          '</div>' +
        '</div>' +
        detailRow('Email', escapeHtml(customer.email)) +
        detailRow('Telepon', escapeHtml(customer.phone)) +
        detailRow('Bergabung', escapeHtml(customer.join)) +
        detailRow('Total Pesanan', customer.orders + ' Pesanan') +
        detailRow('Status', statusBadge);

      detailModal.classList.add('show');
      document.body.style.overflow = 'hidden';
      setTimeout(function () {
        var closeBtn = detailModal.querySelector('.modal-close');
        if (closeBtn) closeBtn.focus();
      }, 80);
    }

    function closeDetailModal() {
      detailModal.classList.remove('show');
      document.body.style.overflow = '';
      if (detailLastFocused && typeof detailLastFocused.focus === 'function') {
        detailLastFocused.focus();
      }
    }

    Array.prototype.forEach.call(
      detailModal.querySelectorAll('[data-close-detail]'),
      function (el) { el.addEventListener('click', closeDetailModal); }
    );

    document.addEventListener('keydown', function (event) {
      if (event.key !== 'Escape') return;
      if (customerModal.classList.contains('show')) { closeCustomerModal(); return; }
      if (detailModal.classList.contains('show')) { closeDetailModal(); return; }
    });

    renderTable();
  })();
</script>
@endsection