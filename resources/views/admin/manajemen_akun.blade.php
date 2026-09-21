@extends('admin.layouts.app')

@section('title', 'Manajemen Akun — Sadena')
@section('topbar-title', 'Manajemen Akun')

@section('custom-css')
<style>
  .stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 16px;
    transition: all 0.3s ease;
  }
  .stats.hidden { display: none !important; }
  .stat-card {
    display: flex; align-items: center; gap: 16px; background: var(--surface);
    border: 1px solid var(--brown); border-radius: var(--radius); box-shadow: var(--shadow-card);
    padding: 16px 20px; min-width: 0; cursor: pointer; transition: transform 0.18s ease;
  }
  .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 18px rgba(0, 0, 0, 0.16); }
  .stat-card.active-filter { border-color: var(--brown); background: rgba(70, 19, 0, 0.04); box-shadow: 0 0 0 3px rgba(70, 19, 0, 0.1); }
  .stat-icon { width: 44px; height: 40px; border-radius: 8px; display: grid; place-items: center; flex: none; }
  .stat-icon svg { width: 24px; height: 24px; }
  .stat-icon.blue   { background: var(--blue-bg); color: var(--blue); }
  .stat-icon.green  { background: var(--green-soft-bg); color: var(--green); }
  .stat-icon.orange { background: var(--orange-bg); color: var(--orange); }
  .stat-text { min-width: 0; }
  .stat-label { font-size: 14px; font-weight: 600; margin-bottom: 2px; }
  .stat-value { font-size: 18px; font-weight: 800; }

  .accounts-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 16px; transition: all 0.3s ease; }
  .accounts-grid.single-mode { grid-template-columns: 1fr; }
  @media (max-width: 1024px) { .accounts-grid { grid-template-columns: 1fr; } }

  .panel { background: #fff; border: 1px solid var(--brown); border-radius: var(--radius); box-shadow: var(--shadow-panel); padding: 20px; min-width: 0; }
  .panel-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid var(--line); }
  .panel-head h3 { font-size: 18px; font-weight: 700; color: var(--brown); }

  .table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
  table { width: 100%; min-width: 380px; border-collapse: collapse; font-size: 14px; }
  thead th { text-align: left; font-size: 11px; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase; color: var(--text-muted); padding: 10px 8px; border-bottom: 1px solid var(--brown); white-space: nowrap; }
  tbody td { padding: 12px 8px; border-bottom: 1px solid var(--line-soft); vertical-align: middle; }
  tbody tr:last-child td { border-bottom: 0; }
  tbody tr:hover { background: var(--surface-hover); }

  .customer-cell { display: flex; align-items: center; gap: 10px; min-width: 160px; }
  .avatar-circle { width: 38px; height: 38px; border-radius: 50%; display: grid; place-items: center; font-size: 14px; font-weight: 800; flex: none; background: #f2f6fa; color: #4e3a36; }
  .customer-info { min-width: 0; }
  .customer-name { font-weight: 700; white-space: nowrap; }
  .customer-email { font-size: 12px; color: var(--text-email); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .cell-muted { color: var(--text-muted-light); white-space: nowrap; font-size: 13px; }

  .actions { display: flex; gap: 6px; }
  .action-btn { width: 28px; height: 26px; border-radius: 4px; display: grid; place-items: center; transition: filter 0.18s ease; cursor: pointer; }
  .action-btn.delete { background: #fee2e2; color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); }
  .action-btn:hover { filter: brightness(0.94); }
  .action-btn svg { width: 14px; height: 14px; }

  .empty-state { padding: 24px 10px; text-align: center; color: var(--text-muted); font-size: 14px; }

  .btn-primary { display: inline-flex; align-items: center; justify-content: center; gap: 6px; height: 38px; padding: 0 14px; background: var(--brown) !important; color: #fff !important; border: none; border-radius: var(--radius-sm); font-size: 13px; font-weight: 600; cursor: pointer; }
  .btn-primary:hover { opacity: 0.9; }

  .inline-form-container { display: none; background: var(--surface); border: 1px solid var(--brown); border-radius: var(--radius); padding: 24px; margin-top: 16px; box-shadow: var(--shadow-card); }
  .inline-form-container.show { display: block; }

  .form-group { margin-bottom: 16px; }
  .form-group label { display: block; font-size: 13px; font-weight: 700; margin-bottom: 6px; color: var(--brown); }
  .form-group input { width: 100%; height: 42px; padding: 0 14px; border: 1px solid var(--line); border-radius: var(--radius-sm); background: #fff; font-size: 14px; }
</style>
@endsection

@section('content')

  <!-- Statistik Ringkasan dari Database -->
  <section class="stats" aria-label="Ringkasan Akun" id="statsContainer">
    <article class="stat-card active-filter" id="filterAll" data-filter="all">
      <span class="stat-icon blue">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Total Seluruh Akun</p>
        <p class="stat-value">{{ $totalAkun }}</p>
      </div>
    </article>

    <article class="stat-card" id="filterAdmin" data-filter="admin">
      <span class="stat-icon green">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Fokus Akun Admin</p>
        <p class="stat-value">{{ $totalAdmin }}</p>
      </div>
    </article>

    <article class="stat-card" id="filterCashier" data-filter="cashier">
      <span class="stat-icon orange">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
      </span>
      <div class="stat-text">
        <p class="stat-label">Fokus Akun Kasir</p>
        <p class="stat-value">{{ $totalKasir }}</p>
      </div>
    </article>
  </section>

  <!-- Form Tambah Akun (Koneksi ke Database via POST) -->
  <div class="inline-form-container" id="inlineFormCard">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h2 id="formCardTitle" style="font-size: 18px; font-weight: 700; color: var(--brown);">Tambah Akun</h2>
      <button type="button" id="closeFormCardBtn" style="background: none; border: none; cursor: pointer; font-size: 18px; color: var(--brown);">✕</button>
    </div>

    <form action="{{ route('admin.manajemen-akun.store') }}" method="POST">
      @csrf
      <input type="hidden" id="fieldRole" name="role">

      <div class="form-group">
        <label for="fieldName">Nama Lengkap</label>
        <input type="text" id="fieldName" name="name" required placeholder="Contoh: Budi Santoso">
      </div>

      <div class="form-group">
        <label for="fieldEmail">Email</label>
        <input type="email" id="fieldEmail" name="email" required placeholder="nama@sadena.com">
      </div>

      <div class="form-group">
        <label for="fieldPhone">Nomor Telepon</label>
        <input type="text" id="fieldPhone" name="phone" required placeholder="+62 812-xxxx-xxxx">
      </div>

      <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
        <button type="button" class="btn-secondary" id="cancelFormBtn" style="padding: 0 18px; height: 40px; border: 1px solid var(--line); background: #fff; border-radius: var(--radius-sm); font-weight: 600; cursor: pointer;">Batal</button>
        <button type="submit" class="btn-primary" style="height: 40px;">Simpan Akun</button>
      </div>
    </form>
  </div>

  <!-- Layout Tabel Data dari Database -->
  <div class="accounts-grid" id="accountsGrid">
    
    <!-- Kolom 1: Panel Admin -->
    <section class="panel" id="adminPanel">
      <div class="panel-head">
        <h3>Daftar Akun Admin</h3>
        <button type="button" id="addAdminBtn" style="background-color: #421e0f; color: #ffffff; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 8px 16px; border-radius: 8px; border: none; font-size: 14px; font-weight: bold; cursor: pointer; white-space: nowrap; width: max-content;">
    <span style="font-size: 18px; line-height: 1;">+</span>
    <span>Tambah Admin</span>
</button>
      </div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Nama & Email</th>
              <th>Telepon</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($admins as $admin)
              <tr>
                <td>
                  <div class="customer-cell">
                    <span class="avatar-circle">{{ strtoupper(substr($admin->nama, 0, 2)) }}</span>
                    <div class="customer-info">
                      <div class="customer-name">{{ $admin->nama }}</div>
                      <div class="customer-email">{{ $admin->email }}</div>
                    </div>
                  </div>
                </td>
                <td class="cell-muted">{{ $admin->no_telp ?? '-' }}</td>
                <td>
                  <div class="actions">
                    <form action="{{ route('admin.manajemen-akun.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');" style="margin: 0;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="action-btn delete" title="Hapus Akun">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr><td colspan="3" class="empty-state">Tidak ada akun admin.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </section>

    <!-- Kolom 2: Panel Kasir -->
    <section class="panel" id="cashierPanel">
      <div class="panel-head">
        <h3>Daftar Akun Kasir</h3>
        <button type="button" id="addCashierBtn" style="background-color: #421e0f; color: #ffffff; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 8px 16px; border-radius: 8px; border: none; font-size: 14px; font-weight: bold; cursor: pointer; white-space: nowrap; width: max-content;">
    <span style="font-size: 18px; line-height: 1;">+</span>
    <span>Tambah Kasir</span>
</button>
      </div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Nama & Email</th>
              <th>Telepon</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($cashiers as $cashier)
              <tr>
                <td>
                  <div class="customer-cell">
                    <span class="avatar-circle">{{ strtoupper(substr($cashier->nama, 0, 2)) }}</span>
                    <div class="customer-info">
                      <div class="customer-name">{{ $cashier->nama }}</div>
                      <div class="customer-email">{{ $cashier->email }}</div>
                    </div>
                  </div>
                </td>
                <td class="cell-muted">{{ $cashier->no_telp ?? '-' }}</td>
                <td>
                  <div class="actions">
                    <form action="{{ route('admin.manajemen-akun.destroy', $cashier->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');" style="margin: 0;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="action-btn delete" title="Hapus Akun">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr><td colspan="3" class="empty-state">Tidak ada akun kasir.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </section>

  </div>

@endsection

@section('custom-js')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var statsContainer = document.getElementById('statsContainer');
    var inlineFormCard = document.getElementById('inlineFormCard');
    var formCardTitle  = document.getElementById('formCardTitle');
    var fieldRole      = document.getElementById('fieldRole');
    var adminPanel     = document.getElementById('adminPanel');
    var cashierPanel   = document.getElementById('cashierPanel');
    var accountsGrid   = document.getElementById('accountsGrid');

    var filterAll      = document.getElementById('filterAll');
    var filterAdmin    = document.getElementById('filterAdmin');
    var filterCashier  = document.getElementById('filterCashier');

    var addAdminBtn    = document.getElementById('addAdminBtn');
    var addCashierBtn  = document.getElementById('addCashierBtn');
    var closeFormBtn   = document.getElementById('closeFormCardBtn');
    var cancelFormBtn  = document.getElementById('cancelFormBtn');

    function openForm(role) {
      statsContainer.classList.add('hidden');
      adminPanel.style.display = 'none';
      cashierPanel.style.display = 'none';
      inlineFormCard.classList.add('show');
      formCardTitle.textContent = 'Tambah Akun ' + role;
      fieldRole.value = role;
    }

    function closeForm() {
      inlineFormCard.classList.remove('show');
      statsContainer.classList.remove('hidden');
      setFilter('all');
    }

    if(addAdminBtn) addAdminBtn.addEventListener('click', function() { openForm('Admin'); });
    if(addCashierBtn) addCashierBtn.addEventListener('click', function() { openForm('Kasir'); });
    if(closeFormBtn) closeFormBtn.addEventListener('click', closeForm);
    if(cancelFormBtn) cancelFormBtn.addEventListener('click', closeForm);

    function setFilter(type) {
      [filterAll, filterAdmin, filterCashier].forEach(function(card) {
        card.classList.remove('active-filter');
      });

      if (type === 'all') {
        filterAll.classList.add('active-filter');
        adminPanel.style.display = 'block';
        cashierPanel.style.display = 'block';
        accountsGrid.classList.remove('single-mode');
      } else if (type === 'admin') {
        filterAdmin.classList.add('active-filter');
        adminPanel.style.display = 'block';
        cashierPanel.style.display = 'none';
        accountsGrid.classList.add('single-mode');
      } else if (type === 'cashier') {
        filterCashier.classList.add('active-filter');
        adminPanel.style.display = 'none';
        cashierPanel.style.display = 'block';
        accountsGrid.classList.add('single-mode');
      }
    }

    if(filterAll) filterAll.addEventListener('click', function() { setFilter('all'); });
    if(filterAdmin) filterAdmin.addEventListener('click', function() { setFilter('admin'); });
    if(filterCashier) filterCashier.addEventListener('click', function() { setFilter('cashier'); });
  });
</script>
@endsection