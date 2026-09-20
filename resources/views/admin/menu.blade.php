@extends('admin.layouts.app')

@section('title', 'Manajemen Menu — Sadena')
@section('topbar-title', 'Manajemen Menu')

@section('custom-css')
<style>
  /* ============================================================
      CSS KHUSUS HALAMAN MANAJEMEN MENU
      ============================================================ */
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

  .stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.16);
  }

  .stat-icon {
    width: 62px;
    height: 55px;
    border-radius: 8px;
    display: grid;
    place-items: center;
    flex: none;
  }

  .stat-icon svg { width: 28px; height: 28px; }

  .stat-icon.blue  { background: var(--blue-bg);  color: var(--blue); }
  .stat-icon.green { background: var(--green-bg); color: var(--green); }
  .stat-icon.red   { background: var(--red-bg);   color: var(--red); }

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

  /* ---------- Panel ---------- */
  .panel {
    background: #fff;
    border: 1px solid var(--brown);
    border-radius: var(--radius);
    box-shadow: var(--shadow-panel);
    padding: 22px;
    min-width: 0;
  }

  /* ---------- Toolbar ---------- */
  .toolbar {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
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
    color: var(--muted);
    pointer-events: none;
  }

  .search-field input {
    width: 100%;
    height: 50px;
    padding: 0 16px 0 46px;
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    background: #fff;
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
    flex: 0 0 156px;
  }

  .select-field select {
    appearance: none;
    -webkit-appearance: none;
    width: 100%;
    height: 50px;
    padding: 0 38px 0 16px;
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    background: #fff;
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
    color: var(--muted);
    pointer-events: none;
  }

  /* ---------- Table ---------- */
  .table-wrap {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    margin-top: 18px;
  }

  table {
    width: 100%;
    min-width: 900px;
    border-collapse: collapse;
    font-size: 15px;
  }

  thead th {
    text-align: left;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--muted);
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
  tbody tr:hover { background: var(--surface-row); }

  .menu-cell {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 200px;
  }

  .menu-thumb {
    width: 62px;
    height: 55px;
    border-radius: 10px;
    background: #f1f5f9;
    color: var(--brown);
    display: grid;
    place-items: center;
    flex: none;
  }

  .menu-thumb svg { width: 26px; height: 26px; }

  .menu-name { font-weight: 700; white-space: nowrap; }

  .chip {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 14px;
    border-radius: 10px;
    background: #f1f5f9;
    font-size: 14px;
    font-weight: 500;
    color: var(--muted-light);
    white-space: nowrap;
  }

  .price {
    color: var(--green);
    font-weight: 700;
    white-space: nowrap;
  }

  /* ---------- Toggle switch ---------- */
  .toggle-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .toggle {
    position: relative;
    display: inline-block;
    width: 42px;
    height: 24px;
    flex: none;
  }

  .toggle input {
    opacity: 0;
    width: 0;
    height: 0;
    position: absolute;
  }

  .toggle-slider {
    position: absolute;
    inset: 0;
    background: #cbd5e1;
    border-radius: 100px;
    transition: background 0.2s ease;
    cursor: pointer;
  }

  .toggle-slider::before {
    content: "";
    position: absolute;
    height: 18px;
    width: 18px;
    left: 3px;
    top: 3px;
    background: #fff;
    border-radius: 50%;
    transition: transform 0.2s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
  }

  .toggle input:checked + .toggle-slider { background: var(--green); }
  .toggle input:checked + .toggle-slider::before { transform: translateX(18px); }

  .status-text {
    font-size: 14px;
    font-weight: 700;
    white-space: nowrap;
  }

  .status-text.available { color: var(--green); }
  .status-text.out       { color: var(--red); }

  .actions { display: flex; gap: 8px; }

  .action-btn {
    width: 28px;
    height: 26px;
    border-radius: 5px;
    display: grid;
    place-items: center;
    transition: filter 0.18s ease, transform 0.18s ease;
    cursor: pointer;
  }

  .action-btn:hover { filter: brightness(0.94); transform: translateY(-1px); }
  .action-btn svg { width: 16px; height: 16px; }

  .action-btn.edit   { background: var(--blue-bg); color: var(--blue); }
  .action-btn.delete { background: var(--red-bg);  color: var(--red); }

  .empty-state {
    padding: 40px 10px;
    text-align: center;
    color: var(--muted);
    font-size: 15px;
    display: none;
  }

  .empty-state.show { display: block; }

  /* Membatasi ukuran ikon di dalam tombol tambah menu */
  .btn-primary svg {
    width: 20px !important;
    height: 20px !important;
    flex: none;
  }

  /* Menyembunyikan modal secara default agar tidak tampil di bawah halaman */
  .modal {
    position: fixed;
    inset: 0;
    display: grid;
    place-items: center;
    padding: 20px;
    z-index: 90;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.22s ease, visibility 0.22s;
  }

  .modal.show {
    opacity: 1;
    visibility: visible;
  }

  .modal-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
  }

  .modal-card {
    position: relative;
    width: 100%;
    max-width: 460px;
    background: #fff;
    border-radius: var(--radius);
    box-shadow: 0 24px 60px rgba(0, 0, 0, 0.3);
    padding: 26px;
    transform: translateY(10px) scale(0.98);
    transition: transform 0.22s ease;
  }

  .modal.show .modal-card {
    transform: translateY(0) scale(1);
  }

  .modal-card-sm { max-width: 400px; }

  .btn-primary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  height: 50px;
  padding: 0 20px;
  background: var(--brown);
  color: #fff;
  border: none;
  border-radius: var(--radius-sm);
  font-size: 15px;
  font-weight: 600;
  white-space: nowrap;
  cursor: pointer;
  transition: background 0.18s ease, transform 0.18s ease;
}

.btn-primary:hover {
  background: #5c1c05;
  transform: translateY(-1px);
}

/* Membatasi ukuran ikon plus (+) agar pas di dalam kotak tombol */
.btn-primary svg {
  width: 20px !important;
  height: 20px !important;
  flex: none;
}

/* ============================================================
      STYLING MODAL & FORM MODERN SADENA
      ============================================================ */
  .modal {
    position: fixed; inset: 0; display: flex; align-items: center; justify-content: center;
    padding: 20px; z-index: 100; opacity: 0; visibility: hidden; transition: all 0.25s ease;
  }
  .modal.show { opacity: 1; visibility: visible; }
  .modal-backdrop { position: absolute; inset: 0; background: rgba(20, 5, 0, 0.6); backdrop-filter: blur(4px); }
  
  .modal-card {
    position: relative; width: 100%; max-width: 520px; background: #fff;
    border-radius: var(--radius); box-shadow: 0 24px 60px rgba(0, 0, 0, 0.25);
    padding: 32px; transform: translateY(20px) scale(0.96); transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    max-height: 90vh; overflow-y: auto;
  }
  .modal.show .modal-card { transform: translateY(0) scale(1); }
  
  .modal-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 1px solid var(--line-soft); padding-bottom: 16px; }
  .modal-head h2 { font-size: 22px; color: var(--brown); font-weight: 800; margin: 0; }
  .modal-close { border: none; background: #f8fafc; width: 36px; height: 36px; border-radius: 50%; display: grid; place-items: center; color: var(--muted); cursor: pointer; transition: all 0.2s ease; }
  .modal-close:hover { background: #e2e8f0; color: var(--red); transform: rotate(90deg); }
  .modal-close svg { width: 18px; height: 18px; }

  /* --- Form Inputs --- */
  .modern-form .form-group { margin-bottom: 20px; }
  .modern-form label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: var(--brown); }
  
  .modern-form input:not([type="file"]), 
  .modern-form select, 
  .modern-form textarea { 
    width: 100%; padding: 14px 16px; border: 1.5px solid #cbd5e1; border-radius: var(--radius-sm);
    font-size: 15px; font-family: inherit; color: var(--brown); background: #fcfdfd; transition: all 0.2s ease;
  }
  
  .modern-form input[type="file"] { 
    width: 100%; padding: 11px; border: 1.5px dashed #cbd5e1; border-radius: var(--radius-sm);
    background: #f8fafc; cursor: pointer; font-size: 14px; color: var(--muted);
  }

  .modern-form input:focus, 
  .modern-form select:focus, 
  .modern-form textarea:focus { 
    outline: none; border-color: var(--brown); background: #fff; box-shadow: 0 0 0 4px rgba(70, 19, 0, 0.08); 
  }
  
  .modern-form .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

  /* --- Tombol Aksi --- */
  .modal-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 32px; padding-top: 20px; border-top: 1px solid var(--line-soft); }
  
  .btn-primary, .btn-secondary { 
    height: 48px; padding: 0 24px; border: none; border-radius: var(--radius-sm); font-size: 15px; font-weight: 700; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center;
  }
  .btn-primary { background: var(--brown); color: #fff; box-shadow: 0 4px 12px rgba(70, 19, 0, 0.2); }
  .btn-primary:hover { background: #350e00; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(70, 19, 0, 0.25); }
  
  .btn-secondary { background: #f1f5f9; color: #475569; }
  .btn-secondary:hover { background: #e2e8f0; color: #1e293b; }

  /* ============================================================
      PERBAIKAN KHUSUS TAMPILAN MODAL TAMBAH MENU
      ============================================================ */
  
  /* 1. Memperlebar kotak modal agar tidak terlihat kecil/sempit */
  #menuModal .modal-card {
    width: 100% !important;
    max-width: 520px !important;
    padding: 32px !important;
    border-radius: 16px !important;
    background: #ffffff !important;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2) !important;
  }

  /* 2. Merapikan bagian kepala (Judul & Tombol Close) */
  #menuModal .modal-head {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-bottom: 24px !important;
    border-bottom: 1px solid #e2e8f0 !important;
    padding-bottom: 16px !important;
  }

  #menuModal .modal-head h2 {
    font-size: 20px !important;
    font-weight: 800 !important;
    color: var(--brown) !important;
    margin: 0 !important;
  }

  /* 3. Memaksa label dan kolom input tersusun rapi ke bawah (tidak menyamping) */
  #menuModal .form-group {
    display: flex !important;
    flex-direction: column !important;
    gap: 8px !important;
    margin-bottom: 18px !important;
  }

  #menuModal .form-group label {
    font-size: 14px !important;
    font-weight: 700 !important;
    color: var(--brown) !important;
  }

  /* 4. Memperlebar kotak input teks, select, dan angka agar memenuhi lebar modal */
  #menuModal .form-group input:not([type="checkbox"]):not([type="radio"]), 
  #menuModal .form-group select {
    width: 100% !important;
    height: 48px !important;
    padding: 0 16px !important;
    border: 1.5px solid #cbd5e1 !important;
    border-radius: 10px !important;
    font-size: 15px !important;
    font-family: inherit !important;
    background-color: #fcfdfd !important;
    color: #1e293b !important;
    box-sizing: border-box !important;
  }

  /* Efek garis cokelat saat input diklik */
  #menuModal .form-group input:focus, 
  #menuModal .form-group select:focus {
    outline: none !important;
    border-color: var(--brown) !important;
    box-shadow: 0 0 0 4px rgba(70, 19, 0, 0.1) !important;
    background-color: #fff !important;
  }

  /* 5. Merapikan tombol Batal dan Simpan di bagian bawah */
  #menuModal .modal-actions {
    display: flex !important;
    justify-content: flex-end !important;
    gap: 12px !important;
    margin-top: 28px !important;
    padding-top: 20px !important;
    border-top: 1px solid #f1f5f9 !important;
  }

  #menuModal .modal-actions button {
    height: 44px !important;
    padding: 0 24px !important;
    border-radius: 8px !important;
    font-size: 15px !important;
    font-weight: 700 !important;
    cursor: pointer !important;
  }
</style>


@endsection

@section('content')

  <!-- KOTAK STATISTIK ATAS -->
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 24px;">
  
  <!-- 1. Total Menu -->
  <div class="stat-card" style="background: #fff; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 16px;">
    <div style="background: #eff6ff; padding: 12px; border-radius: 10px; color: #2563eb; display: grid; place-items: center;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:24px;height:24px;"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
    </div>
    <div>
      <div style="color: #64748b; font-size: 13px; font-weight: 500;">Total Menu</div>
      <div style="font-size: 24px; font-weight: 700; color: #1e293b;" id="totalMenu">{{ $totalMenu ?? 0 }}</div>
    </div>
  </div>

  <!-- 2. Menu Aktif (Tersedia) -->
  <div class="stat-card" style="background: #fff; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 16px;">
    <div style="background: #f0fdf4; padding: 12px; border-radius: 10px; color: #16a34a; display: grid; place-items: center;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:24px;height:24px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg>
    </div>
    <div>
      <div style="color: #64748b; font-size: 13px; font-weight: 500;">Menu Aktif (Tersedia)</div>
      <div style="font-size: 24px; font-weight: 700; color: #1e293b;" id="menuAktif">{{ $menuAktif ?? 0 }}</div>
    </div>
  </div>

  <!-- 3. Stok Habis -->
  <div class="stat-card" style="background: #fff; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 16px;">
    <div style="background: #fef2f2; padding: 12px; border-radius: 10px; color: #dc2626; display: grid; place-items: center;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:24px;height:24px;"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
    </div>
    <div>
      <div style="color: #64748b; font-size: 13px; font-weight: 500;">Stok Habis</div>
      <div style="font-size: 24px; font-weight: 700; color: #1e293b;" id="stokHabis">{{ $stokHabis ?? 0 }}</div>
    </div>
  </div>

</div>

  <!-- Panel Menu -->
  <section class="panel" aria-label="Daftar menu">
    <div class="toolbar">
      <div class="search-field">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <circle cx="11" cy="11" r="7"/>
          <path d="M20 20l-3.5-3.5"/>
        </svg>
        <input type="search" id="searchInput" placeholder="Cari Nama Menu..." aria-label="Cari menu">
      </div>

      <div class="select-field">
        <select id="categoryFilter" aria-label="Filter kategori">
          <option value="all">Semua Kategori</option>
          <option value="Makanan Utama">Makanan Utama</option>
          <option value="Minuman">Minuman</option>
          <option value="Cemilan">Cemilan</option>
        </select>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </div>

      <!-- ================= TOMBOL BARU: ATUR LANDING PAGE ================= -->
      <button class="btn-primary" id="configLandingBtn" type="button" onclick="document.getElementById('landingConfigModal').classList.add('show'); document.body.style.overflow='hidden';">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/>
  </svg>
  Atur Landing Page
</button>

      <button class="btn-primary" id="addMenuBtn" type="button" onclick="document.getElementById('menuModal').classList.add('show'); document.body.style.overflow='hidden';">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    <path d="M12 5v14M5 12h14"/>
  </svg>
  Tambah Menu
</button>
    </div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th scope="col">Menu</th>
            <th scope="col">Kategori</th>
            <th scope="col">Harga</th>
            <th scope="col">Ketersediaan (Stok)</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody id="menuTableBody">
  @foreach($menus as $menu)
    <tr>
      <td>
        <div class="menu-cell" style="display: flex; align-items: center; gap: 14px;">
          @if($menu->gambar)
            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" style="width: 55px; height: 50px; border-radius: 10px; object-fit: cover;">
          @else
            <div style="width: 55px; height: 50px; border-radius: 10px; background: #f1f5f9; display: grid; place-items: center; font-size: 18px;">🍽️</div>
          @endif
          <span class="menu-name" style="font-weight: 700;">{{ $menu->nama_menu }}</span>
        </div>
      </td>
      <td>
        <span class="chip">{{ $menu->kategori }}</span>
      </td>
      <td class="price">
        Rp {{ number_format($menu->harga, 0, ',', '.') }}
      </td>
      <td>
        @if($menu->stok > 0)
          <span style="color: var(--green); font-weight: 700;">Tersedia (Stok: {{ $menu->stok }})</span>
        @else
          <span style="color: var(--red); font-weight: 700;">Habis (Stok: 0)</span>
        @endif
      </td>
      <td>
        <div class="actions" style="display: flex; gap: 8px; align-items: center;">
          <!-- Tombol Edit -->
          <button type="button" class="action-btn edit" onclick="alert('Fitur edit menu')" style="background: #e0f2fe; color: #0284c7; border: none; width: 32px; height: 32px; border-radius: 6px; cursor: pointer; display: grid; place-items: center;" title="Ubah Menu">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
          </button>

          <!-- Tombol Hapus -->
          <form action="{{ route('admin.menu.destroy', $menu->id_menu) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');" style="margin: 0;">
            @csrf
            @method('DELETE')
            <button type="submit" class="action-btn delete" style="background: #fee2e2; color: #ef4444; border: none; width: 32px; height: 32px; border-radius: 6px; cursor: pointer; display: grid; place-items: center;" title="Hapus Menu">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;"><path d="M3 6h18"/><path d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
            </button>
          </form>
        </div>
      </td>
    </tr>
  @endforeach
</tbody>
      </table>
      <p class="empty-state" id="emptyState">Tidak ada menu yang cocok dengan filter.</p>
    </div>
  </section>

  <!-- ================= MODAL: Tambah / Edit Menu ================= -->
  <div class="modal" id="menuModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-backdrop" data-close-modal></div>
    
    <!-- Kotak Modal Card -->
    <div class="modal-card">
      <div class="modal-head">
        <h2 id="modalTitle">Tambah Menu</h2>
        <button class="modal-close" type="button" aria-label="Tutup dialog" data-close-modal onclick="document.getElementById('menuModal').classList.remove('show'); document.body.style.overflow='';">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
</button>
      </div>

      <!-- FORM HARUS BERADA DI DALAM MODAL CARD INI -->
      <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data" class="modern-form">
        @csrf
        
        <div class="form-group">
          <label for="fieldName">Nama Menu</label>
          <input type="text" id="fieldName" name="nama_menu" required placeholder="Contoh: Nasi Goreng Spesial" autocomplete="off">
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="fieldCategory">Kategori</label>
            <select id="fieldCategory" name="kategori" required>
              <option value="Makanan Utama">Makanan Utama</option>
              <option value="Minuman">Minuman</option>
              <option value="Cemilan">Cemilan</option>
            </select>
          </div>

          <div class="form-group">
            <label for="fieldPrice">Harga (Rp)</label>
            <input type="number" id="fieldPrice" name="harga" required min="0" step="1000" placeholder="22000" inputmode="numeric">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="fieldStock">Stok Awal</label>
            <input type="number" id="fieldStock" name="stok" required min="0" value="10">
          </div>

          <div class="form-group">
            <label>Upload Foto (.PNG, .JPG)</label>
            <input type="file" id="fieldFoto" name="gambar" accept=".png, .jpg, .jpeg" required style="width: 100% !important; padding: 11px !important; border: 1.5px dashed #94a3b8 !important; border-radius: 10px !important; font-size: 14px !important; background: #f8fafc !important; color: #475569 !important; cursor: pointer !important; box-sizing: border-box !important;">
          </div>
        </div>

        <div class="form-group">
          <label>Deskripsi Singkat</label>
          <textarea name="deskripsi" rows="2" placeholder="Deskripsi menarik tentang menu..."></textarea>
        </div>

        <div class="modal-actions">
          <button type="button" class="btn-secondary" data-close-modal onclick="document.getElementById('menuModal').classList.remove('show'); document.body.style.overflow='';">Batal</button>
          <button type="submit" class="btn-primary" id="submitBtn">Simpan</button>
        </div>
      </form>
      <!-- PENUTUP FORM DAN MODAL CARD YANG BENAR -->
    </div>
  </div>

  <!-- ================= MODAL: Konfirmasi Hapus ================= -->
  <div class="modal" id="confirmModal" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">
    <div class="modal-backdrop" data-close-confirm></div>
    <div class="modal-card modal-card-sm">
      <div class="modal-head">
        <h2 id="confirmTitle">Hapus Menu</h2>
        <button class="modal-close" type="button" aria-label="Tutup dialog" data-close-confirm>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 6l12 12M18 6L6 18"/>
          </svg>
        </button>
      </div>

      <p class="confirm-text" id="confirmText">Apakah Anda yakin ingin menghapus menu ini?</p>

      <div class="modal-actions">
        <button type="button" class="btn-secondary" data-close-confirm>Batal</button>
        <button type="button" class="btn-danger" id="confirmDeleteBtn">Hapus</button>
      </div>
    </div>
  </div>

 <!-- ================= MODAL: Atur Landing Page ================= -->
<div class="modal" id="landingConfigModal" role="dialog" aria-modal="true" aria-labelledby="landingModalTitle">
  <div class="modal-backdrop" onclick="document.getElementById('landingConfigModal').classList.remove('show'); document.body.style.overflow='';"></div>
  
  <div class="modal-card" style="max-width: 560px !important; padding: 32px !important;">
    <div class="modal-head">
      <h2 id="landingModalTitle">Atur Menu Landing Page (Maks. 4)</h2>
      <button class="modal-close" type="button" aria-label="Tutup dialog" onclick="document.getElementById('landingConfigModal').classList.remove('show'); document.body.style.overflow='';">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
      </button>
    </div>

    <!-- Form Tambah ke Landing Page -->
    <form action="{{ route('admin.landing.store') }}" method="POST" class="modern-form">
      @csrf

      <!-- PEMBERITAHUAN JIKA SUDAH MELEBIHI BATAS MAKSIMAL -->
    @if(session('error'))
      <div style="background: #fee2e2; color: #dc2626; padding: 12px 16px; border-radius: 8px; font-size: 14px; margin-bottom: 16px; font-weight: 600; border: 1px solid #f87171;">
        ⚠️ {{ session('error') }}
      </div>
    @endif

    @if(session('success'))
      <div style="background: #f0fdf4; color: #16a34a; padding: 12px 16px; border-radius: 8px; font-size: 14px; margin-bottom: 16px; font-weight: 600; border: 1px solid #4ade80;">
        ✅ {{ session('success') }}
      </div>
    @endif
      
      <div class="form-row">
        <div class="form-group" style="flex: 1;">
          <label for="selectMenuLanding">Pilih Menu</label>
          <select id="selectMenuLanding" name="id_menu" required>
            <option value="" disabled selected>Pilih menu...</option>
            @foreach($menus ?? [] as $m)
              <option value="{{ $m->id_menu }}">{{ $m->nama_menu }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group" style="flex: 1;">
          <label for="selectKategoriLanding">Kategori Landing Page</label>
          <select id="selectKategoriLanding" name="kategori_beranda" required>
            <option value="Hidangan Utama">Hidangan Utama</option>
            <option value="Sajian Berkuah">Sajian Berkuah</option>
            <option value="Pencuci Mulut">Pencuci Mulut</option>
            <option value="Minuman Segar">Minuman Segar</option>
          </select>
        </div>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 10px; margin-bottom: 20px;">
        <button type="submit" class="btn-primary" style="height: 40px; padding: 0 16px; font-size: 14px;">+ Masukkan ke Landing Page</button>
      </div>
    </form>

    <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;">

    <!-- Daftar Makanan yang Sudah Ada di Landing Page -->
    <div style="font-size: 14px; font-weight: 700; color: var(--brown); margin-bottom: 12px;">
      Daftar Menu Aktif di Landing Page
    </div>
    
    <div style="max-height: 180px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 8px;">
      <table style="width: 100%; font-size: 13px; border-collapse: collapse;">
        <thead>
          <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
            <th style="padding: 10px; text-align: left;">Nama Menu</th>
            <th style="padding: 10px; text-align: left;">Kategori</th>
            <th style="padding: 10px; text-align: center;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse(($menus ?? [])->where('is_active', 1) as $activeMenu)
            <tr style="border-bottom: 1px solid #f1f5f9;">
              <td style="padding: 10px; font-weight: 600;">{{ $activeMenu->nama_menu }}</td>
              <td style="padding: 10px;"><span class="chip" style="padding: 4px 8px; font-size: 12px;">{{ $activeMenu->kategori }}</span></td>
              <td style="padding: 10px; text-align: center;">
                <form action="{{ route('admin.landing.remove', $activeMenu->id_menu) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Hapus menu ini dari landing page?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" style="background: #fee2e2; color: #ef4444; border: none; padding: 6px 10px; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" style="padding: 20px; text-align: center; color: #64748b;">Belum ada menu aktif di landing page.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="modal-actions" style="margin-top: 24px;">
      <button type="button" class="btn-secondary" onclick="document.getElementById('landingConfigModal').classList.remove('show'); document.body.style.overflow='';">Tutup</button>
    </div>
  </div>
</div>
@endsection

@section('custom-js')
<script>
  (function () {
    'use strict';

    var STORAGE_KEY = 'sadena.menus.v1';

    var DEFAULT_MENUS = [
      { id: 1, name: 'Nasi Goreng Spesial', category: 'Makanan Utama', price: 22000, stok: 10, gambar: null },
      { id: 2, name: 'Ayam Bakar Madu',     category: 'Makanan Utama', price: 28000, stok: 0,  gambar: null },
      { id: 3, name: 'Jus Alpukat',         category: 'Minuman',       price: 12000, stok: 15, gambar: null },
      { id: 4, name: 'Kentang Goreng Keju', category: 'Cemilan',       price: 15000, stok: 8,  gambar: null }
    ];

    var ICON_BY_CATEGORY = {
      'Makanan Utama': 'rice',
      'Minuman': 'juice',
      'Cemilan': 'fries'
    };

    function loadMenus() {
      try {
        var raw = window.localStorage.getItem(STORAGE_KEY);
        if (!raw) return DEFAULT_MENUS.slice();
        var parsed = JSON.parse(raw);
        if (!Array.isArray(parsed)) return DEFAULT_MENUS.slice();
        return parsed.filter(function (m) {
          return m && typeof m.id === 'number' && typeof m.name === 'string' &&
                 typeof m.category === 'string' && typeof m.price === 'number';
        });
      } catch (err) {
        return DEFAULT_MENUS.slice();
      }
    }

    function saveMenus() {
      try {
        window.localStorage.setItem(STORAGE_KEY, JSON.stringify(menus));
      } catch (err) {}
    }

    var menus = loadMenus();

    var toastEl = document.getElementById('toast');
    var toastTimer = null;

    function showToast(message) {
      if (!toastEl) return;
      toastEl.textContent = message;
      toastEl.classList.add('show');
      window.clearTimeout(toastTimer);
      toastTimer = window.setTimeout(function () {
        toastEl.classList.remove('show');
      }, 2200);
    }

    function escapeHtml(str) {
      return String(str).replace(/[&<>"']/g, function (ch) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[ch];
      });
    }

    function formatRupiah(num) {
      return 'Rp ' + Number(num).toLocaleString('id-ID');
    }

    function iconSvg(type) {
      switch (type) {
        case 'rice':
          return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11h18a9 9 0 0 1-9 9 9 9 0 0 1-9-9z"/><path d="M8 8c0-1.6 1-2.6 2-3.2M12 7.5c0-2 1.5-3 2.5-3.5"/></svg>';
        case 'chicken':
          return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15.5 3a5.5 5.5 0 0 0-5.2 7.3l-5 5a2.5 2.5 0 1 0 3.4 3.4l5-5A5.5 5.5 0 1 0 15.5 3z"/><circle cx="15.5" cy="8.5" r="1.2"/></svg>';
        case 'juice':
          return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 5h12l-1.4 8.2a4 4 0 0 1-3.9 3.3h-1.4a4 4 0 0 1-3.9-3.3z"/><path d="M12 16.5V21M9 21h6"/></svg>';
        case 'fries':
          return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 10h12l-1 11H7z"/><path d="M9 10V5M12 10V4M15 10V6"/></svg>';
        default:
          return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/></svg>';
      }
    }

    var tbody = document.getElementById('menuTableBody');
    var emptyState = document.getElementById('emptyState');
    var searchInput = document.getElementById('searchInput');
    var categoryFilter = document.getElementById('categoryFilter');
    var totalMenuEl = document.getElementById('totalMenu');
    var menuAktifEl = document.getElementById('menuAktif');
    var stokHabisEl = document.getElementById('stokHabis');

    function updateStats() {
      if (!totalMenuEl) return;
      var total = menus.length;
      var aktif = menus.filter(function (m) { return m.available; }).length;
      totalMenuEl.textContent = total;
      menuAktifEl.textContent = aktif;
      stokHabisEl.textContent = total - aktif;
    }

    function renderTable() {
      if (!tbody) return;
      var query = searchInput.value.trim().toLowerCase();
      var catVal = categoryFilter.value;

      var filtered = menus.filter(function (m) {
        var matchQuery = !query || m.name.toLowerCase().indexOf(query) !== -1;
        var matchCat = catVal === 'all' || m.category === catVal;
        return matchQuery && matchCat;
      });

      tbody.innerHTML = '';
      updateStats();

      if (filtered.length === 0) {
        emptyState.classList.add('show');
        return;
      }
      emptyState.classList.remove('show');

      var html = filtered.map(function (menu) {
        var safeName = escapeHtml(menu.name);
        
        // Menentukan tampilan stok berupa angka sesuai permintaan ketua tim
        var stokVal = menu.stok !== undefined ? menu.stok : 10; 
        var stokText = stokVal > 0 ? 'Tersedia (Stok: ' + stokVal + ')' : 'Habis (Stok: 0)';
        var stokColor = stokVal > 0 ? 'color: var(--green); font-weight: 700;' : 'color: var(--red); font-weight: 700;';

        // Mengganti total ikon SVG dengan foto asli dari folder storage
        var thumbHtml = menu.gambar 
          ? '<img src="/storage/' + menu.gambar + '" alt="' + safeName + '" style="width: 55px; height: 50px; border-radius: 10px; object-fit: cover;">'
          : '<div style="width: 55px; height: 50px; border-radius: 10px; background: #f1f5f9; display: grid; place-items: center; font-size: 20px;">🍽️</div>';

        return '<tr>' +
          '<td><div class="menu-cell">' + thumbHtml + '<span class="menu-name">' + safeName + '</span></div></td>' +
          '<td><span class="chip">' + escapeHtml(menu.category) + '</span></td>' +
          '<td class="price">' + formatRupiah(menu.price) + '</td>' +
          '<td><span style="' + stokColor + '">' + stokText + '</span></td>' +
          '<td>' +
            '<div class="actions">' +
              '<button type="button" class="action-btn edit" data-action="edit" data-id="' + menu.id + '" aria-label="Ubah ' + safeName + '">' +
                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>' +
              '</button>' +
              '<button type="button" class="action-btn delete" data-action="delete" data-id="' + menu.id + '" aria-label="Hapus ' + safeName + '">' +
                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>' +
              '</button>' +
            '</div>' +
          '</td>' +
        '</tr>';
      }).join('');

      tbody.innerHTML = html;
    }

    if (tbody) {
      tbody.addEventListener('change', function (event) {
        var input = event.target.closest('[data-toggle]');
        if (!input) return;

        var id = parseInt(input.getAttribute('data-toggle'), 10);
        var menu = menus.find(function (m) { return m.id === id; });
        if (!menu) return;

        menu.available = input.checked;

        var label = tbody.querySelector('[data-status="' + id + '"]');
        if (label) {
          label.textContent = menu.available ? 'Tersedia' : 'Habis';
          label.classList.toggle('available', menu.available);
          label.classList.toggle('out', !menu.available);
        }

        updateStats();
        saveMenus();
        showToast(menu.name + ' — ' + (menu.available ? 'Tersedia' : 'Habis'));
      });

      tbody.addEventListener('click', function (event) {
        var btn = event.target.closest('[data-action]');
        if (!btn) return;

        var action = btn.getAttribute('data-action');
        var id = parseInt(btn.getAttribute('data-id'), 10);
        var menu = menus.find(function (m) { return m.id === id; });
        if (!menu) return;

        if (action === 'edit') {
          openModal(menu);
        } else if (action === 'delete') {
          openConfirm(menu);
        }
      });
    }

    if (searchInput) searchInput.addEventListener('input', renderTable);
    if (categoryFilter) categoryFilter.addEventListener('change', renderTable);

    /* Modal Tambah/Edit */
    var modal = document.getElementById('menuModal');
    var modalTitle = document.getElementById('modalTitle');
    var form = document.getElementById('menuForm');
    var fieldName = document.getElementById('fieldName');
    var fieldCategory = document.getElementById('fieldCategory');
    var fieldPrice = document.getElementById('fieldPrice');
    var fieldStock = document.getElementById('fieldStock');
    var addMenuBtn = document.getElementById('addMenuBtn');
    var editingId = null;
    var lastFocused = null;

    function syncBodyScroll() {
      var anyOpen = document.querySelector('.modal.show');
      document.body.style.overflow = anyOpen ? 'hidden' : '';
    }

    function openModal(menu) {
      lastFocused = document.activeElement;

      if (menu) {
        editingId = menu.id;
        modalTitle.textContent = 'Ubah Menu';
        fieldName.value = menu.name;
        fieldCategory.value = menu.category;
        fieldPrice.value = menu.price;
        fieldStock.value = menu.available ? 'true' : 'false';
      } else {
        editingId = null;
        modalTitle.textContent = 'Tambah Menu';
        form.reset();
        fieldStock.value = 'true';
      }

      fieldName.classList.remove('invalid');
      fieldPrice.classList.remove('invalid');

      modal.classList.add('show');
      syncBodyScroll();
      window.setTimeout(function () { fieldName.focus(); }, 100);
    }

    function closeModal() {

      modal.classList.remove('show');
      editingId = null;
      syncBodyScroll();
      if (lastFocused && typeof lastFocused.focus === 'function') lastFocused.focus();
    }

    if (addMenuBtn) addMenuBtn.addEventListener('click', function () { openModal(null); });

    Array.prototype.forEach.call(modal.querySelectorAll('[data-close-modal]'), function (el) {
      el.addEventListener('click', closeModal);
    });

    [fieldName, fieldPrice].forEach(function (input) {
      input.addEventListener('input', function () { input.classList.remove('invalid'); });
    });

    form.addEventListener('submit', function (event) {
      event.preventDefault();

      var name = fieldName.value.trim();
      var category = fieldCategory.value;
      var price = parseInt(fieldPrice.value, 10);
      var available = fieldStock.value === 'true';

      if (!name) {
        fieldName.classList.add('invalid');
        fieldName.focus();
        showToast('Nama menu wajib diisi');
        return;
      }

      if (!price || price <= 0 || isNaN(price)) {
        fieldPrice.classList.add('invalid');
        fieldPrice.focus();
        showToast('Harga harus lebih dari 0');
        return;
      }

      if (editingId === null) {
        var newId = menus.length
          ? Math.max.apply(null, menus.map(function (m) { return m.id; })) + 1
          : 1;

        menus.push({
          id: newId,
          name: name,
          category: category,
          price: price,
          available: available,
          icon: ICON_BY_CATEGORY[category] || 'rice'
        });
        showToast('Menu "' + name + '" ditambahkan');
      } else {
        var target = menus.find(function (m) { return m.id === editingId; });
        if (target) {
          target.name = name;
          target.category = category;
          target.price = price;
          target.available = available;
          target.icon = ICON_BY_CATEGORY[category] || target.icon;
          showToast('Menu "' + name + '" diperbarui');
        }
      }

      saveMenus();
      closeModal();
      renderTable();
    });

    /* Modal Hapus */
    var confirmModal = document.getElementById('confirmModal');
    var confirmText = document.getElementById('confirmText');
    var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    var pendingDeleteId = null;

    function openConfirm(menu) {
      pendingDeleteId = menu.id;
      confirmText.innerHTML = 'Apakah Anda yakin ingin menghapus menu <strong>' +
        escapeHtml(menu.name) + '</strong>? Tindakan ini tidak dapat dibatalkan.';
      confirmModal.classList.add('show');
      syncBodyScroll();
      window.setTimeout(function () { confirmDeleteBtn.focus(); }, 100);
    }

    function closeConfirm() {
      confirmModal.classList.remove('show');
      pendingDeleteId = null;
      syncBodyScroll();
    }

    Array.prototype.forEach.call(confirmModal.querySelectorAll('[data-close-confirm]'), function (el) {
      el.addEventListener('click', closeConfirm);
    });

    confirmDeleteBtn.addEventListener('click', function () {
      var menu = menus.find(function (m) { return m.id === pendingDeleteId; });
      if (!menu) { closeConfirm(); return; }

      menus = menus.filter(function (m) { return m.id !== menu.id; });
      saveMenus();
      closeConfirm();
      renderTable();
      showToast('Menu "' + menu.name + '" dihapus');
    });

    document.addEventListener('keydown', function (event) {
      if (event.key !== 'Escape') return;

      if (confirmModal.classList.contains('show')) {
        closeConfirm();
      } else if (modal.classList.contains('show')) {
        closeModal();
      }
    });

    var modal = document.getElementById('menuModal');
    var addMenuBtn = document.getElementById('addMenuBtn');
    
    if (addMenuBtn) {
      addMenuBtn.addEventListener('click', function () {
        if (modal) {
          modal.classList.add('show');
          document.body.style.overflow = 'hidden';
        }
      });
    }

    // Tombol tutup modal (Batal / ikon X / klik luar)
    var closeElements = document.querySelectorAll('[data-close-modal], .modal-backdrop');
    closeElements.forEach(function (el) {
      el.addEventListener('click', function () {
        if (modal) {
          modal.classList.remove('show');
          document.body.style.overflow = '';
        }
      });
    });

    / Tombol Escape di keyboard untuk menutup modal
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && modal) {
        modal.classList.remove('show');
        document.body.style.overflow = '';
      }
    });
  })();
</script>
@endsection