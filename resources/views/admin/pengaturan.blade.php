@extends('admin.layouts.app')

@section('title', 'Pengaturan — Sadena')
@section('topbar-title', 'Pengaturan Sistem')

@section('custom-css')
<style>
  /* =========================================================
     CSS KHUSUS HALAMAN PENGATURAN
     ========================================================= */
  .settings-container {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  @media (min-width: 992px) {
    .settings-container {
      flex-direction: row;
      align-items: flex-start;
    }
  }

  .settings-sidebar {
    flex: 0 0 280px;
    background: var(--surface);
    border: 1px solid var(--brown);
    border-radius: var(--radius);
    padding: 16px;
    box-shadow: var(--shadow-card);
  }

  .tab-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    padding: 14px 16px;
    background: transparent;
    border: none;
    border-radius: var(--radius-sm);
    font-size: 15px;
    font-weight: 600;
    color: var(--text-muted);
    text-align: left;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-bottom: 6px;
  }

  .tab-btn:last-child { margin-bottom: 0; }
  
  .tab-btn:hover { background: var(--surface-hover); color: var(--brown); }
  
  .tab-btn.active {
    background: var(--brown);
    color: #fff;
  }
  
  .tab-btn svg { width: 20px; height: 20px; flex: none; }

  .settings-content {
    flex: 1;
    background: var(--surface);
    border: 1px solid var(--brown);
    border-radius: var(--radius);
    padding: 30px;
    box-shadow: var(--shadow-card);
    min-width: 0;
  }

  .tab-pane { display: none; animation: fadeIn 0.3s ease; }
  .tab-pane.active { display: block; }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .pane-header {
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--line);
  }

  .pane-header h3 { font-size: 20px; font-weight: 700; color: var(--brown); margin-bottom: 4px; }
  .pane-header p { font-size: 14px; color: var(--text-muted); }

  .form-group { margin-bottom: 20px; }
  .form-group label {
    display: block;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 8px;
    color: var(--brown);
  }
  
  .form-group input, .form-group textarea {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    background: var(--surface);
    font-size: 15px;
    font-family: inherit;
    transition: border-color 0.2s ease;
  }

  .form-group textarea { resize: vertical; min-height: 100px; }
  
  .form-group input:focus, .form-group textarea:focus {
    outline: none;
    border-color: var(--brown);
    box-shadow: 0 0 0 3px rgba(70, 19, 0, 0.1);
  }

  .form-row {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
  }

  @media (min-width: 640px) {
    .form-row { grid-template-columns: 1fr 1fr; }
  }

  .btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 50px;
    padding: 0 24px;
    background: var(--brown) !important;
    color: #fff !important;
    border: none;
    border-radius: var(--radius-sm);
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: none !important;
    outline: none !important;
    transition: transform 0.2s ease;
  }

  .btn-primary:hover, .btn-primary:focus {
    transform: translateY(-1px);
  }

  .btn-primary svg { width: 18px; height: 18px; }
  
  .form-actions {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid var(--line);
    text-align: right;
  }
</style>
@endsection

@section('content')

  <div class="settings-container">
    
    <!-- Sidebar Tabs -->
    <aside class="settings-sidebar">
      <button type="button" class="tab-btn active" data-target="tab-toko">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        Profil Toko
      </button>
      
      <button type="button" class="tab-btn" data-target="tab-akun">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
          <circle cx="12" cy="7" r="4"/>
        </svg>
        Akun Admin
      </button>

      <button type="button" class="tab-btn" data-target="tab-keamanan">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>
        Keamanan
      </button>
    </aside>

    <!-- Konten Settings -->
    <section class="settings-content">
      
      <!-- Tab: Profil Toko -->
      <div class="tab-pane active" id="tab-toko">
        <div class="pane-header">
          <h3>Profil Toko</h3>
          <p>Kelola informasi dasar restoran atau toko Anda.</p>
        </div>
        <form id="formToko">
          <div class="form-group">
            <label for="tokoNama">Nama Toko</label>
            <input type="text" id="tokoNama" value="Sadena Coffee & Eatery" required>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="tokoTelp">Nomor Telepon Publik</label>
              <input type="tel" id="tokoTelp" value="+62 811-2233-4455" required>
            </div>
            <div class="form-group">
              <label for="tokoEmail">Email Publik</label>
              <input type="email" id="tokoEmail" value="hello@sadena.com" required>
            </div>
          </div>
          <div class="form-group">
            <label for="tokoAlamat">Alamat Lengkap</label>
            <textarea id="tokoAlamat" required>Jl. Merdeka No. 45, Kecamatan Sidoarjo, Jawa Timur 61211</textarea>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn-primary">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
              Simpan Perubahan
            </button>
          </div>
        </form>
      </div>

      <!-- Tab: Akun Admin -->
      <div class="tab-pane" id="tab-akun">
        <div class="pane-header">
          <h3>Akun Admin</h3>
          <p>Perbarui informasi profil dan kontak akun Anda.</p>
        </div>
        <form id="formAkun">
          <div class="form-group">
            <label for="adminNama">Nama Lengkap</label>
            <input type="text" id="adminNama" value="Administrator" required>
          </div>
          <div class="form-group">
            <label for="adminEmail">Email Login</label>
            <input type="email" id="adminEmail" value="admin@sadena.com" required>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn-primary">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
              Simpan Profil
            </button>
          </div>
        </form>
      </div>

      <!-- Tab: Keamanan -->
      <div class="tab-pane" id="tab-keamanan">
        <div class="pane-header">
          <h3>Keamanan Kata Sandi</h3>
          <p>Ganti kata sandi untuk menjaga keamanan akun Anda.</p>
        </div>
        <form id="formKeamanan">
          <div class="form-group">
            <label for="passLama">Kata Sandi Saat Ini</label>
            <input type="password" id="passLama" placeholder="Masukkan sandi saat ini" required>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="passBaru">Kata Sandi Baru</label>
              <input type="password" id="passBaru" placeholder="Minimal 8 karakter" required>
            </div>
            <div class="form-group">
              <label for="passKonfirm">Konfirmasi Sandi Baru</label>
              <input type="password" id="passKonfirm" placeholder="Ketik ulang sandi baru" required>
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn-primary">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              Perbarui Sandi
            </button>
          </div>
        </form>
      </div>

    </section>
  </div>

@endsection

@section('custom-js')
<script>
  (function() {
    'use strict';

    // Logika Navigasi Tab
    var tabBtns = document.querySelectorAll('.tab-btn');
    var tabPanes = document.querySelectorAll('.tab-pane');

    tabBtns.forEach(function(btn) {
      btn.addEventListener('click', function() {
        var targetId = this.getAttribute('data-target');
        
        // Hapus class active dari semua tombol dan panel
        tabBtns.forEach(function(b) { b.classList.remove('active'); });
        tabPanes.forEach(function(p) { p.classList.remove('active'); });
        
        // Tambahkan class active ke elemen yang dipilih
        this.classList.add('active');
        document.getElementById(targetId).classList.add('active');
      });
    });

    // Simulasi Submit Form (Agar tidak me-reload halaman)
    var forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Asumsi fungsi showToast sudah ada di app.blade.php utama
        if (typeof showToast === 'function') {
          showToast('Perubahan berhasil disimpan!');
        } else {
          alert('Perubahan berhasil disimpan!');
        }
        
        // Kosongkan form password jika itu tab keamanan
        if (this.id === 'formKeamanan') {
          this.reset();
        }
      });
    });
  })();
</script>
@endsection