@extends('admin.layouts.app')

@section('title', 'Pengaturan — Sadena')
@section('topbar-title', 'Pengaturan Sistem')

@section('custom-css')
<!-- (Bagian style CSS tetap sama persis seperti milikmu, tidak perlu diubah) -->
<style>
  .settings-container {
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 24px;
    align-items: start;
  }

  @media (max-width: 992px) {
    .settings-container {
      grid-template-columns: 1fr;
    }
  }

  .settings-nav {
    background: #fff;
    border: 1px solid var(--brown);
    border-radius: var(--radius);
    padding: 12px;
    box-shadow: var(--shadow-panel);
  }

  .settings-nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    padding: 14px 16px;
    background: transparent;
    border: none;
    border-radius: var(--radius-sm);
    font-size: 14px;
    font-weight: 600;
    color: var(--brown);
    cursor: pointer;
    text-align: left;
    transition: all 0.2s ease;
  }

  .settings-nav-item:hover {
    background: rgba(70, 19, 0, 0.05);
  }

  .settings-nav-item.active {
    background: var(--brown);
    color: #fff;
  }

  .settings-nav-item svg {
    width: 18px;
    height: 18px;
    flex: none;
  }

  .settings-panel {
    background: #fff;
    border: 1px solid var(--brown);
    border-radius: var(--radius);
    padding: 28px;
    box-shadow: var(--shadow-panel);
    display: none;
  }

  .settings-panel.active {
    display: block;
  }

  .settings-panel h2 {
    font-size: 20px;
    font-weight: 800;
    color: var(--brown);
    margin-bottom: 6px;
  }

  .settings-panel p {
    font-size: 14px;
    color: var(--text-muted);
    margin-bottom: 24px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 8px;
    color: var(--brown);
  }

  .form-group input {
    width: 100%;
    height: 46px;
    padding: 0 16px;
    border: 1.5px solid #cbd5e1;
    border-radius: var(--radius-sm);
    font-size: 14px;
    background: #fcfdfd;
    color: var(--brown);
    transition: all 0.2s ease;
  }

  .form-group input:focus {
    outline: none;
    border-color: var(--brown);
    background: #fff;
    box-shadow: 0 0 0 4px rgba(70, 19, 0, 0.08);
  }

  .btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 46px;
    padding: 0 24px;
    background: var(--brown);
    color: #fff;
    border: none;
    border-radius: var(--radius-sm);
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .btn-primary:hover {
    background: #350e00;
    transform: translateY(-1px);
  }

  /* Style untuk Wrapper Password & Icon Mata */
  .password-wrapper {
    position: relative;
    display: flex;
    align-items: center;
  }
  
  .password-wrapper input {
    padding-right: 44px; /* Memberi ruang agar teks tidak tertutup ikon */
  }
  
  .toggle-password {
    position: absolute;
    right: 14px;
    background: none;
    border: none;
    cursor: pointer;
    color: #94a3b8;
    display: grid;
    place-items: center;
    padding: 0;
    transition: color 0.2s ease;
  }
  
  .toggle-password:hover {
    color: var(--brown);
  }
  
  .toggle-password svg {
    width: 20px;
    height: 20px;
  }
</style>
@endsection

@section('content')

  <!-- Notifikasi Sukses/Error -->
  @if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 8px; margin-bottom: 16px;">
        {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 8px; margin-bottom: 16px;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <div class="settings-container">
    
    <!-- Navigasi Kiri (Hanya Akun Admin & Keamanan) -->
    <div class="settings-nav">
      <button type="button" class="settings-nav-item active" data-target="panel-admin">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
        </svg>
        Akun Admin
      </button>

      <button type="button" class="settings-nav-item" data-target="panel-security">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>
        Keamanan
      </button>
    </div>

    <!-- Konten Kanan -->
    <div>
      
      <!-- Panel 1: Akun Admin -->
      <section class="settings-panel active" id="panel-admin">
        <h2>Akun Admin</h2>
        <p>Perbarui informasi profil dan kredensial akun Anda.</p>

        <!-- MENGHUBUNGKAN ACTION KE ROUTE UPDATE PROFIL -->
        <form action="{{ route('admin.pengaturan.updateProfile') }}" method="POST">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label for="adminName">Nama Lengkap</label>
            <!-- Mengambil nama otomatis dari database menggunakan Auth::user()->nama -->
            <input type="text" id="adminName" name="name" value="{{ Auth::user()->nama }}" required>
          </div>

          <div class="form-group">
            <label for="adminEmail">Email Login</label>
            <!-- Mengambil email otomatis dari database menggunakan Auth::user()->email -->
            <input type="email" id="adminEmail" name="email" value="{{ Auth::user()->email }}" required>
          </div>

          <div style="margin-top: 24px; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn-primary">
              Simpan Profil
            </button>
          </div>
        </form>
      </section>

      <!-- Panel 2: Keamanan / Perubahan Password -->
      <section class="settings-panel" id="panel-security">
        <h2>Keamanan Akun</h2>
        <p>Ubah kata sandi secara berkala untuk menjaga keamanan akun Anda.</p>

        <!-- MENGHUBUNGKAN ACTION KE ROUTE UPDATE PASSWORD -->
        <form action="{{ route('admin.pengaturan.updatePassword') }}" method="POST">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label for="currentPassword">Kata Sandi Saat Ini</label>
            <div class="password-wrapper">
              <input type="password" id="currentPassword" name="current_password" placeholder="Masukkan kata sandi lama..." required>
              <button type="button" class="toggle-password" title="Lihat/Sembunyikan">
                <!-- Ikon Mata Tertutup -->
                <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
              </button>
            </div>
          </div>

          <div class="form-group">
            <label for="newPassword">Kata Sandi Baru</label>
            <div class="password-wrapper">
              <input type="password" id="newPassword" name="new_password" placeholder="Masukkan kata sandi baru..." required>
              <button type="button" class="toggle-password" title="Lihat/Sembunyikan">
                <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
              </button>
            </div>
          </div>

          <div class="form-group">
            <label for="confirmPassword">Konfirmasi Kata Sandi Baru</label>
            <div class="password-wrapper">
              <input type="password" id="confirmPassword" name="new_password_confirmation" placeholder="Ulangi kata sandi baru..." required>
              <button type="button" class="toggle-password" title="Lihat/Sembunyikan">
                <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
              </button>
            </div>
          </div>

          <div style="margin-top: 24px; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn-primary">
              Perbarui Kata Sandi
            </button>
          </div>
        </form>
      </section>

    </div>

  </div>

@endsection

@section('custom-js')
<!-- (Bagian JS tetap sama persis seperti milikmu, tidak perlu diubah) -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const navItems = document.querySelectorAll(".settings-nav-item");
    const panels = document.querySelectorAll(".settings-panel");

    navItems.forEach(function (item) {
      item.addEventListener("click", function () {
        navItems.forEach(function (nav) { nav.classList.remove("active"); });
        this.classList.add("active");

        panels.forEach(function (panel) { panel.classList.remove("active"); });

        const targetId = this.getAttribute("data-target");
        document.getElementById(targetId).classList.add("active");
      });
    });
  });

  // Logika Toggle Password Visibility
    const togglePasswordBtns = document.querySelectorAll('.toggle-password');
    
    togglePasswordBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        // Cari input yang posisinya persis sebelum tombol mata ini
        const input = this.previousElementSibling;
        const icon = this.querySelector('.eye-icon');
        
        if (input.type === 'password') {
          input.type = 'text';
          // Ubah ikon menjadi mata terbuka
          icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
        } else {
          input.type = 'password';
          // Ubah ikon menjadi mata tertutup (tercoret)
          icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
        }
      });
    });
</script>
@endsection