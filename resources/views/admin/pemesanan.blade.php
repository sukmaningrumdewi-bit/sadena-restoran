@extends('admin.layouts.app')

@section('title', 'Semua Pesanan — Sadena')
@section('topbar-title', 'Semua Pesanan')

@section('custom-css')
<style>
  /* ============ CUSTOM STYLING HALAMAN PEMESANAN ============ */
  .stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 22px;
  }

  .stat-card {
    display: flex;
    align-items: center;
    gap: 16px;
    background: #fff;
    border: 1px solid var(--brown);
    border-radius: var(--radius);
    box-shadow: var(--shadow-card);
    padding: 20px 22px;
    min-width: 0;
    transition: transform 0.18s ease, box-shadow 0.18s ease;
  }
  .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 18px rgba(0, 0, 0, 0.16); }

  .stat-icon {
    width: 56px;
    height: 52px;
    border-radius: 8px;
    display: grid;
    place-items: center;
    flex: none;
  }
  .stat-icon svg { width: 28px; height: 28px; }
  .stat-icon.orange { background: #fff3e0; color: #ea6915; }
  .stat-icon.blue   { background: #e3f2fd; color: #2472c4; }
  .stat-icon.green  { background: #e8f5e9; color: #559147; }

  .stat-text { min-width: 0; }
  .stat-label {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .stat-value { font-size: 20px; font-weight: 800; letter-spacing: -0.01em; }

  /* ---- Panel & Toolbar ---- */
  .panel {
    background: #fff;
    border: 1px solid var(--brown);
    border-radius: var(--radius);
    box-shadow: var(--shadow-panel);
    padding: 22px;
    min-width: 0;
  }

  .toolbar {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 6px;
  }

  .search-field { position: relative; flex: 1 1 280px; min-width: 0; }
  .search-field svg {
    position: absolute; top: 50%; left: 14px; transform: translateY(-50%);
    width: 22px; height: 22px; color: var(--muted); pointer-events: none;
  }
  .search-field input {
    width: 100%; height: 50px; padding: 0 16px 0 46px;
    border: 1px solid rgba(70, 19, 0, 0.25); border-radius: var(--radius-sm);
    background: #fff; font-size: 15px; font-family: inherit;
    transition: border-color 0.18s ease, box-shadow 0.18s ease;
  }
  .search-field input:focus {
    outline: none; border-color: var(--brown); box-shadow: 0 0 0 3px rgba(70, 19, 0, 0.1);
  }

  .select-field { position: relative; flex: 0 0 156px; }
  .select-field select {
    appearance: none; width: 100%; height: 50px; padding: 0 38px 0 16px;
    border: 1px solid rgba(70, 19, 0, 0.25); border-radius: var(--radius-sm);
    background: #fff; font-size: 15px; font-weight: 500; font-family: inherit; cursor: pointer;
  }
  .select-field select:focus {
    outline: none; border-color: var(--brown); box-shadow: 0 0 0 3px rgba(70, 19, 0, 0.1);
  }
  .select-field svg {
    position: absolute; top: 50%; right: 12px; transform: translateY(-50%);
    width: 18px; height: 18px; color: var(--muted); pointer-events: none;
  }

  .btn-primary {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    height: 50px; padding: 0 20px; background: var(--brown); color: #fff;
    border-radius: var(--radius-sm); font-size: 15px; font-weight: 600; cursor: pointer;
    white-space: nowrap; transition: background 0.18s ease, transform 0.18s ease;
  }
  .btn-primary:hover { background: #5c1c05; transform: translateY(-1px); }
  .btn-primary svg { width: 20px; height: 20px; }

  /* ---- Table ---- */
  .table-wrap { overflow-x: auto; margin-top: 18px; }
  table { width: 100%; min-width: 960px; border-collapse: collapse; font-size: 15px; }
  thead th {
    text-align: left; font-size: 12px; font-weight: 700; letter-spacing: 0.07em;
    text-transform: uppercase; color: var(--muted); padding: 16px 10px;
    border-bottom: 1px solid var(--brown); white-space: nowrap;
  }
  tbody td { padding: 16px 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.08); vertical-align: middle; }
  tbody tr:last-child td { border-bottom: 0; }
  tbody tr:hover { background: #fdf8f4; }

  .order-id { font-weight: 700; white-space: nowrap; }
  .cell-muted { color: rgba(0, 0, 0, 0.45); }
  .cell-total { color: rgba(0, 0, 0, 0.45); white-space: nowrap; font-weight: 600; }

  .badge {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 110px; padding: 8px 14px; border-radius: var(--radius-sm);
    font-size: 14px; font-weight: 700; white-space: nowrap;
  }
  .badge.waiting  { background: #fff3e0; color: #ea6915; }
  .badge.process  { background: #e3f2fd; color: #2472c4; }
  .badge.shipped  { background: #f3e5f5; color: #8533a3; }
  .badge.done     { background: #e8f5e9; color: #559147; }

  .type-chip {
    display: inline-flex; align-items: center; justify-content: center;
    padding: 8px 14px; border-radius: var(--radius-sm); background: #f1f5f9;
    font-size: 14px; font-weight: 600; color: rgba(0, 0, 0, 0.45); white-space: nowrap;
  }

  .actions { display: flex; gap: 8px; }
  .action-btn {
    width: 32px; height: 30px; border-radius: 6px; display: grid; place-items: center; cursor: pointer;
  }
  .action-btn svg { width: 16px; height: 16px; }
  .action-btn.detail { background: #e8f5e9; color: #559147; }
  .action-btn.edit   { background: #e3f2fd; color: #2472c4; }
  .action-btn.delete { background: #ffebee; color: #c62828; }

  .empty-state { padding: 40px 10px; text-align: center; color: var(--muted); font-size: 15px; display: none; }
  .empty-state.show { display: block; }

  /* ============ MODAL STYLES ============ */
  .modal {
    position: fixed; inset: 0; display: grid; place-items: center; padding: 20px;
    z-index: 90; opacity: 0; visibility: hidden; transition: opacity 0.22s ease, visibility 0.22s;
  }
  .modal.show { opacity: 1; visibility: visible; }
  .modal-backdrop { position: absolute; inset: 0; background: rgba(0, 0, 0, 0.5); }
  .modal-card {
    position: relative; width: 100%; max-width: 480px; background: #fff;
    border-radius: 20px; box-shadow: 0 24px 60px rgba(0, 0, 0, 0.3); padding: 26px;
    transform: translateY(10px) scale(0.98); transition: transform 0.22s ease; max-height: 92vh; overflow-y: auto;
  }
  .modal.show .modal-card { transform: translateY(0) scale(1); }
  .modal-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 18px; }
  .modal-head h2 { font-size: 20px; font-weight: 800; }
  .modal-close {
    width: 34px; height: 34px; display: grid; place-items: center; border-radius: 50%; color: var(--brown); cursor: pointer;
  }
  .modal-close:hover { background: #f7f1ec; }
  .modal-close svg { width: 20px; height: 20px; }

  .form-group { margin-bottom: 14px; }
  .form-group label { display: block; font-size: 13px; font-weight: 700; margin-bottom: 6px; color: var(--brown); }
  .form-group input, .form-group select {
    width: 100%; height: 46px; padding: 0 14px; border: 1px solid rgba(70, 19, 0, 0.25);
    border-radius: 10px; background: #fff; font-size: 15px; font-family: inherit;
  }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
  .detail-list { font-size: 15px; line-height: 2; }
  .detail-list strong { display: inline-block; min-width: 130px; color: var(--brown); }
  .modal-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
  .btn-secondary {
    display: inline-flex; align-items: center; justify-content: center; height: 46px; padding: 0 20px;
    background: #f1f5f9; color: var(--brown); border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer;
  }
  .btn-danger {
    display: inline-flex; align-items: center; justify-content: center; height: 46px; padding: 0 20px;
    background: #c62828; color: #fff; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer;
  }

  @media (max-width: 640px) {
    .stats { grid-template-columns: minmax(0, 1fr); }
    .form-row { grid-template-columns: 1fr; }
  }
</style>
@endsection

@section('content')

  <!-- Statistik Ringkasan Status -->
  <section class="stats" aria-label="Ringkasan status pesanan">
    <article class="stat-card">
      <span class="stat-icon orange" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 8h14l1 12H4z"/>
          <path d="M9 8V6a3 3 0 0 1 6 0v2"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Pesanan Masuk Baru</p>
        <p class="stat-value" id="statNew">0</p>
      </div>
    </article>

    <article class="stat-card">
      <span class="stat-icon blue" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="9"/>
          <path d="M12 7v5l3.5 2"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Sedang Diproses</p>
        <p class="stat-value" id="statProcess">0</p>
      </div>
    </article>

    <article class="stat-card">
      <span class="stat-icon green" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="9"/>
          <path d="M8.5 12.5l2.5 2.5 4.5-5"/>
        </svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Selesai Hari Ini</p>
        <p class="stat-value" id="statDone">0</p>
      </div>
    </article>
  </section>

  <!-- Panel Utama Tabel Pesanan -->
  <section class="panel">
    <div class="toolbar">
      <div class="search-field">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <circle cx="11" cy="11" r="7"/>
          <path d="M20 20l-3.5-3.5"/>
        </svg>
        <input type="search" id="searchInput" placeholder="Cari ID / Nama Pelanggan..." aria-label="Cari pesanan">
      </div>

      <div class="select-field">
        <select id="typeFilter" aria-label="Filter tipe pesanan">
          <option value="all">Semua Tipe</option>
          <option value="Delivery">Delivery</option>
          <option value="Dine-in">Dine-in</option>
          <option value="Takeaway">Takeaway</option>
        </select>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </div>

      <div class="select-field">
        <select id="statusFilter" aria-label="Filter status pesanan">
          <option value="all">Semua Status</option>
          <option value="Menunggu">Menunggu</option>
          <option value="Diproses">Diproses</option>
          <option value="Dikirim">Dikirim</option>
          <option value="Selesai">Selesai</option>
        </select>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </div>

      <button class="btn-primary" id="addOrderBtn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M12 5v14M5 12h14"/>
        </svg>
        Pesanan Baru
      </button>
    </div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Pelanggan</th>
            <th scope="col">Tipe</th>
            <th scope="col">Total Pembayaran</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody id="orderTableBody">
          <!-- Diisi JavaScript -->
        </tbody>
      </table>
      <p class="empty-state" id="emptyState">Tidak ada pesanan yang cocok dengan filter.</p>
    </div>
  </section>

  <!-- ================= MODAL DETAIL ================= -->
  <div class="modal" id="detailModal" role="dialog" aria-modal="true" aria-labelledby="detailTitle">
    <div class="modal-backdrop" data-close-detail></div>
    <div class="modal-card">
      <div class="modal-head">
        <h2 id="detailTitle">Detail Pesanan</h2>
        <button class="modal-close" type="button" aria-label="Tutup dialog" data-close-detail>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 6l12 12M18 6L6 18"/>
          </svg>
        </button>
      </div>
      <div class="detail-list" id="detailBody"></div>
      <div class="modal-actions">
        <button type="button" class="btn-secondary" data-close-detail>Tutup</button>
      </div>
    </div>
  </div>

  <!-- ================= MODAL EDIT / TAMBAH ================= -->
  <div class="modal" id="editModal" role="dialog" aria-modal="true" aria-labelledby="editTitle">
    <div class="modal-backdrop" data-close-edit></div>
    <div class="modal-card">
      <div class="modal-head">
        <h2 id="editTitle">Ubah Pesanan</h2>
        <button class="modal-close" type="button" aria-label="Tutup dialog" data-close-edit>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 6l12 12M18 6L6 18"/>
          </svg>
        </button>
      </div>
      <form id="editForm" novalidate>
        <div class="form-group">
          <label for="fieldId">Order ID</label>
          <input type="text" id="fieldId" required placeholder="Contoh: #ORD-0910-001">
        </div>
        <div class="form-group">
          <label for="fieldCustomer">Nama Pelanggan</label>
          <input type="text" id="fieldCustomer" required placeholder="Nama pelanggan">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="fieldType">Tipe</label>
            <select id="fieldType" required>
              <option value="Delivery">Delivery</option>
              <option value="Dine-in">Dine-in</option>
              <option value="Takeaway">Takeaway</option>
            </select>
          </div>
          <div class="form-group">
            <label for="fieldStatus">Status</label>
            <select id="fieldStatus" required>
              <option value="Menunggu">Menunggu</option>
              <option value="Diproses">Diproses</option>
              <option value="Dikirim">Dikirim</option>
              <option value="Selesai">Selesai</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="fieldTotal">Total Pembayaran (Rp)</label>
          <input type="number" id="fieldTotal" required min="0" step="1000" placeholder="125000">
        </div>

        <div class="modal-actions">
          <button type="button" class="btn-secondary" data-close-edit>Batal</button>
          <button type="submit" class="btn-primary" id="editSubmit">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ================= MODAL KONFIRMASI HAPUS ================= -->
  <div class="modal" id="deleteModal" role="dialog" aria-modal="true" aria-labelledby="deleteTitle">
    <div class="modal-backdrop" data-close-delete></div>
    <div class="modal-card" style="max-width: 400px;">
      <div class="modal-head">
        <h2 id="deleteTitle">Hapus Pesanan?</h2>
        <button class="modal-close" type="button" aria-label="Tutup dialog" data-close-delete>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 6l12 12M18 6L6 18"/>
          </svg>
        </button>
      </div>
      <p id="deleteBody" style="font-size: 15px; color: var(--muted);">
        Pesanan ini akan dihapus permanen.
      </p>
      <div class="modal-actions">
        <button type="button" class="btn-secondary" data-close-delete>Batal</button>
        <button type="button" class="btn-danger" id="confirmDelete">Hapus</button>
      </div>
    </div>
  </div>

@endsection

@section('custom-js')
<script>
  (function () {
    'use strict';

    var orders = [
      { id: '#ORD-0910-001', customer: 'Budi Santoso',   type: 'Delivery', total: 125000, status: 'Menunggu' },
      { id: '#ORD-0910-002', customer: 'Siti Aminah',    type: 'Dine-in',  total: 45000,  status: 'Diproses' },
      { id: '#ORD-0909-0043', customer: 'Agus Setiawan', type: 'Delivery', total: 88000,  status: 'Dikirim' },
      { id: '#ORD-0909-044', customer: 'Rina Melati',    type: 'Takeaway', total: 55000,  status: 'Selesai' }
    ];

    var toastEl = document.getElementById('toast');
    var toastTimer = null;

    function showToast(message, type) {
      if (!toastEl) return;
      toastEl.textContent = message;
      toastEl.className = 'toast show' + (type ? ' ' + type : '');
      clearTimeout(toastTimer);
      toastTimer = setTimeout(function () {
        toastEl.classList.remove('show');
      }, 2400);
    }

    function escapeHtml(str) {
      return String(str).replace(/[&<>"']/g, function (ch) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[ch];
      });
    }

    function formatRupiah(num) {
      return 'Rp ' + Number(num).toLocaleString('id-ID');
    }

    function statusClass(status) {
      switch (status) {
        case 'Menunggu': return 'waiting';
        case 'Diproses': return 'process';
        case 'Dikirim':  return 'shipped';
        case 'Selesai':  return 'done';
        default:         return 'process';
      }
    }

    var tbody = document.getElementById('orderTableBody');
    var emptyState = document.getElementById('emptyState');
    var searchInput = document.getElementById('searchInput');
    var typeFilter = document.getElementById('typeFilter');
    var statusFilter = document.getElementById('statusFilter');
    var statNew = document.getElementById('statNew');
    var statProcess = document.getElementById('statProcess');
    var statDone = document.getElementById('statDone');

    function updateStats() {
      if (!statNew) return;
      statNew.textContent = orders.filter(function (o) { return o.status === 'Menunggu'; }).length;
      statProcess.textContent = orders.filter(function (o) { return o.status === 'Diproses'; }).length;
      statDone.textContent = orders.filter(function (o) { return o.status === 'Selesai'; }).length;
    }

    function renderTable() {
      if (!tbody) return;
      var query = searchInput.value.trim().toLowerCase();
      var typeVal = typeFilter.value;
      var statusVal = statusFilter.value;

      var filtered = orders.filter(function (order) {
        var matchQuery = !query ||
          order.id.toLowerCase().indexOf(query) !== -1 ||
          order.customer.toLowerCase().indexOf(query) !== -1;
        var matchType = typeVal === 'all' || order.type === typeVal;
        var matchStatus = statusVal === 'all' || order.status === statusVal;
        return matchQuery && matchType && matchStatus;
      });

      tbody.innerHTML = '';
      updateStats();

      if (filtered.length === 0) {
        emptyState.classList.add('show');
        return;
      }
      emptyState.classList.remove('show');

      filtered.forEach(function (order) {
        var tr = document.createElement('tr');
        tr.innerHTML =
          '<td class="order-id">' + escapeHtml(order.id) + '</td>' +
          '<td class="cell-muted">' + escapeHtml(order.customer) + '</td>' +
          '<td><span class="type-chip">' + escapeHtml(order.type) + '</span></td>' +
          '<td class="cell-total">' + formatRupiah(order.total) + '</td>' +
          '<td><span class="badge ' + statusClass(order.status) + '">' + escapeHtml(order.status) + '</span></td>' +
          '<td>' +
            '<div class="actions">' +
              '<button class="action-btn detail" data-action="detail" data-id="' + escapeHtml(order.id) + '" aria-label="Lihat detail">' +
                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>' +
              '</button>' +
              '<button class="action-btn edit" data-action="edit" data-id="' + escapeHtml(order.id) + '" aria-label="Ubah">' +
                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>' +
              '</button>' +
              '<button class="action-btn delete" data-action="delete" data-id="' + escapeHtml(order.id) + '" aria-label="Hapus">' +
                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>' +
              '</button>' +
            '</div>' +
          '</td>';
        tbody.appendChild(tr);
      });

      Array.prototype.forEach.call(tbody.querySelectorAll('[data-action]'), function (btn) {
        btn.addEventListener('click', function () {
          var action = btn.getAttribute('data-action');
          var id = btn.getAttribute('data-id');
          var order = orders.find(function (o) { return o.id === id; });
          if (!order) return;

          if (action === 'detail')      openDetailModal(order);
          else if (action === 'edit')   openEditModal(order);
          else if (action === 'delete') openDeleteModal(order);
        });
      });
    }

    if (searchInput) searchInput.addEventListener('input', renderTable);
    if (typeFilter) typeFilter.addEventListener('change', renderTable);
    if (statusFilter) statusFilter.addEventListener('change', renderTable);

    /* Modal Detail */
    var detailModal = document.getElementById('detailModal');
    var detailBody = document.getElementById('detailBody');

    function openDetailModal(order) {
      detailBody.innerHTML =
        '<p><strong>Order ID:</strong> ' + escapeHtml(order.id) + '</p>' +
        '<p><strong>Pelanggan:</strong> ' + escapeHtml(order.customer) + '</p>' +
        '<p><strong>Tipe:</strong> ' + escapeHtml(order.type) + '</p>' +
        '<p><strong>Total:</strong> ' + formatRupiah(order.total) + '</p>' +
        '<p><strong>Status:</strong> <span class="badge ' + statusClass(order.status) + '" style="vertical-align: middle;">' + escapeHtml(order.status) + '</span></p>';
      detailModal.classList.add('show');
      document.body.style.overflow = 'hidden';
    }

    function closeDetailModal() {
      detailModal.classList.remove('show');
      document.body.style.overflow = '';
    }

    Array.prototype.forEach.call(detailModal.querySelectorAll('[data-close-detail]'), function (el) {
      el.addEventListener('click', closeDetailModal);
    });

    /* Modal Edit / Tambah */
    var editModal = document.getElementById('editModal');
    var editTitle = document.getElementById('editTitle');
    var editForm = document.getElementById('editForm');
    var fieldId = document.getElementById('fieldId');
    var fieldCustomer = document.getElementById('fieldCustomer');
    var fieldType = document.getElementById('fieldType');
    var fieldStatus = document.getElementById('fieldStatus');
    var fieldTotal = document.getElementById('fieldTotal');
    var editingId = null;

    function openEditModal(order) {
      if (order) {
        editingId = order.id;
        editTitle.textContent = 'Ubah Pesanan';
        fieldId.value = order.id;
        fieldId.readOnly = true;
        fieldId.style.background = '#f1f5f9';
        fieldCustomer.value = order.customer;
        fieldType.value = order.type;
        fieldStatus.value = order.status;
        fieldTotal.value = order.total;
      } else {
        editingId = null;
        editTitle.textContent = 'Pesanan Baru';
        editForm.reset();
        fieldId.readOnly = false;
        fieldId.style.background = '';
        var d = new Date();
        var yyyy = d.getFullYear();
        var mm = String(d.getMonth() + 1).padStart(2, '0');
        var dd = String(d.getDate()).padStart(2, '0');
        var seq = String(orders.length + 1).padStart(3, '0');
        fieldId.value = '#ORD-' + yyyy + mm + dd + '-' + seq;
        fieldStatus.value = 'Menunggu';
        fieldType.value = 'Delivery';
      }
      editModal.classList.add('show');
      document.body.style.overflow = 'hidden';
      setTimeout(function () { fieldCustomer.focus(); }, 100);
    }

    function closeEditModal() {
      editModal.classList.remove('show');
      document.body.style.overflow = '';
      editingId = null;
    }

    var addBtn = document.getElementById('addOrderBtn');
    if (addBtn) addBtn.addEventListener('click', function () { openEditModal(null); });

    Array.prototype.forEach.call(editModal.querySelectorAll('[data-close-edit]'), function (el) {
      el.addEventListener('click', closeEditModal);
    });

    editForm.addEventListener('submit', function (event) {
      event.preventDefault();
      var id = fieldId.value.trim();
      var customer = fieldCustomer.value.trim();
      var type = fieldType.value;
      var status = fieldStatus.value;
      var total = parseInt(fieldTotal.value, 10);

      if (!id) { showToast('Order ID wajib diisi.', 'error'); fieldId.focus(); return; }
      if (!customer) { showToast('Nama pelanggan wajib diisi.', 'error'); fieldCustomer.focus(); return; }
      if (!total || total <= 0) { showToast('Total pembayaran harus lebih dari 0.', 'error'); fieldTotal.focus(); return; }

      if (editingId === null) {
        var exists = orders.some(function (o) { return o.id.toLowerCase() === id.toLowerCase(); });
        if (exists) { showToast('Order ID sudah digunakan.', 'error'); fieldId.focus(); return; }
        orders.unshift({ id: id, customer: customer, type: type, total: total, status: status });
        showToast('Pesanan ' + id + ' ditambahkan.', 'success');
      } else {
        var target = orders.find(function (o) { return o.id === editingId; });
        if (target) {
          target.customer = customer;
          target.type = type;
          target.total = total;
          target.status = status;
          showToast('Pesanan ' + editingId + ' diperbarui.', 'success');
        }
      }

      closeEditModal();
      renderTable();
    });

    /* Modal Hapus */
    var deleteModal = document.getElementById('deleteModal');
    var deleteBody = document.getElementById('deleteBody');
    var confirmDelete = document.getElementById('confirmDelete');
    var deletingId = null;

    function openDeleteModal(order) {
      deletingId = order.id;
      deleteBody.innerHTML = 'Pesanan <strong>' + escapeHtml(order.id) + '</strong> (' + escapeHtml(order.customer) + ') akan dihapus permanen.';
      deleteModal.classList.add('show');
      document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
      deleteModal.classList.remove('show');
      document.body.style.overflow = '';
      deletingId = null;
    }

    Array.prototype.forEach.call(deleteModal.querySelectorAll('[data-close-delete]'), function (el) {
      el.addEventListener('click', closeDeleteModal);
    });

    confirmDelete.addEventListener('click', function () {
      if (deletingId === null) return;
      var idx = orders.findIndex(function (o) { return o.id === deletingId; });
      if (idx !== -1) {
        var removed = orders[idx];
        orders.splice(idx, 1);
        renderTable();
        showToast('Pesanan ' + removed.id + ' dihapus.', 'success');
      }
      closeDeleteModal();
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') {
        if (detailModal.classList.contains('show')) closeDetailModal();
        if (editModal.classList.contains('show'))   closeEditModal();
        if (deleteModal.classList.contains('show')) closeDeleteModal();
      }
    });

    renderTable();
  })();
</script>
@endsection