<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login Admin — Sadena</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
  
  <!-- Link ke file CSS Terpisah -->
    <style>
        /* =========================================================
   SADENA — Admin Login (Berdasarkan Referensi Visual)
   ========================================================= */

:root {
  --ink:        #1f140d;
  --ink-soft:   #4a3a30;
  --muted:      #7a6a5f;
  --line:       #d8cfc6;
  --surface:    #ffffff;
  --white:      #ffffff;

  /* Palette baru yang disesuaikan dengan referensi gambar */
  --brand-dark: #371a06; 
  --brand-light:#fad5b6;
  --brand-soft: rgba(250, 213, 182, 0.4);

  --danger:     #e5484d;
  --success:    #0f9d58;

  --r-sm: 8px;
  --r-md: 12px;
  --r-lg: 18px;

  --ease: cubic-bezier(.22, .8, .3, 1);
  --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

* { box-sizing: border-box; }

html, body { height: 100%; }

body {
  margin: 0;
  font-family: var(--font);
  color: var(--ink);
  background: var(--white);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* =========================================================
   LAYOUT
   ========================================================= */
.login-page {
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: 100vh;
  min-height: 100dvh;
}

/* =========================================================
   PANEL KIRI — BRANDING
   ========================================================= */
.brand-panel {
  position: relative;
  isolation: isolate;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: clamp(36px, 5vw, 60px);

  /* Placeholder gambar background. (Ganti jika ada aset aslinya) */
  background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1600&q=80');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  color: #fff;
}

/* Overlay kecoklatan sesuai gambar referensi */
.brand-overlay {
  position: absolute;
  inset: 0;
  z-index: 0;
  background: linear-gradient(180deg, 
    rgba(55, 26, 6, 0.6) 0%, 
    rgba(55, 26, 6, 0.4) 40%, 
    rgba(55, 26, 6, 0.8) 100%);
}

.brand-header, .brand-text-content {
  position: relative;
  z-index: 1;
}

/* Header kiri atas (Logo + Nama) */
.brand-header {
  display: flex;
  align-items: center;
  gap: 16px;
  animation: fadeUp .8s var(--ease) both;
}

.brand-logo {
  width: 52px;
  height: 52px;
  border-radius: 12px;
  display: grid;
  place-items: center;
  color: var(--brand-light);
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  border: 1px solid rgba(255,255,255,0.2);
}

.brand-logo svg { width: 28px; height: 28px; }

.brand-name {
  font-size: 20px;
  font-weight: 700;
  letter-spacing: .05em;
  color: #fff;
}

/* Teks Bawah */
.brand-headline {
  margin: 0 0 16px;
  font-size: clamp(32px, 3.6vw, 48px);
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -.02em;
  color: #fff;
  animation: fadeUp .8s .16s var(--ease) both;
}

.brand-sub {
  margin: 0;
  max-width: 44ch;
  font-size: 15.5px;
  line-height: 1.6;
  color: rgba(255, 255, 255, .85);
  animation: fadeUp .8s .24s var(--ease) both;
}

/* =========================================================
   PANEL KANAN — FORM
   ========================================================= */
.form-panel {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: clamp(28px, 4vw, 60px);
  background: var(--white);
}

.form-card {
  width: 100%;
  max-width: 380px;
  animation: fadeUp .75s .1s var(--ease) both;
}

.form-title {
  margin: 0 0 6px;
  font-size: clamp(24px, 2.2vw, 28px);
  font-weight: 800;
  letter-spacing: -.02em;
  color: var(--brand-dark);
}

.form-subtitle {
  margin: 0 0 32px;
  font-size: 14px;
  color: var(--muted);
}

/* =========================================================
   ROLE TABS (Bentuk Outline/Pisah)
   ========================================================= */
.role-tabs {
  display: flex;
  gap: 12px;
  margin-bottom: 24px;
}

.role-tab {
  flex: 1;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 12px;
  border: 1px solid var(--line);
  border-radius: var(--r-md);
  background: transparent;
  font: inherit;
  font-size: 14px;
  font-weight: 600;
  color: var(--ink-soft);
  cursor: pointer;
  transition: all .2s var(--ease);
}

.role-tab svg { width: 16px; height: 16px; }

.role-tab:hover { border-color: var(--muted); }

.role-tab.active {
  background: var(--brand-light);
  border-color: var(--brand-light);
  color: var(--brand-dark);
}

.role-tab.active svg { color: var(--brand-dark); }

/* =========================================================
   FIELDS
   ========================================================= */
.field { margin-bottom: 16px; }

.field-input-wrap {
  position: relative;
  display: flex;
  align-items: center;
}

.field-icon {
  position: absolute;
  left: 16px;
  width: 18px;
  height: 18px;
  color: #a39b95;
  pointer-events: none;
  transition: color .22s;
}

.field-input {
  width: 100%;
  height: 52px;
  padding: 0 48px 0 46px;
  border: 1px solid var(--line);
  border-radius: var(--r-md);
  background: var(--surface);
  font: inherit;
  font-size: 14.5px;
  color: var(--ink);
  outline: none;
  transition: border-color .2s;
}

.field-input::placeholder { color: #a39b95; }

.field-input:focus {
  border-color: var(--brand-dark);
  box-shadow: 0 0 0 3px var(--brand-soft);
}

.field-input-wrap:focus-within .field-icon { color: var(--brand-dark); }

.toggle-password {
  position: absolute;
  right: 7px;
  width: 40px;
  height: 40px;
  display: grid;
  place-items: center;
  border: 0;
  border-radius: var(--r-sm);
  background: transparent;
  color: #a39b95;
  cursor: pointer;
}

.toggle-password svg { width: 18px; height: 18px; }

.toggle-password:hover { color: var(--ink); }

/* Error state */
.field-error {
  margin: 0 0 0 4px;
  max-height: 0;
  overflow: hidden;
  font-size: 12.5px;
  font-weight: 500;
  color: var(--danger);
  opacity: 0;
  transform: translateY(-4px);
  transition: all .22s;
}

.field.error .field-error {
  margin-top: 6px;
  max-height: 30px;
  opacity: 1;
  transform: none;
}

.field.error .field-input { border-color: var(--danger); }

/* =========================================================
   OPTIONS ROW
   ========================================================= */
.options-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 8px 0 24px;
}

.checkbox {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 13.5px;
  color: var(--muted);
  cursor: pointer;
  user-select: none;
}

.checkbox input {
  position: absolute;
  opacity: 0;
}

.checkbox-box {
  width: 18px;
  height: 18px;
  display: grid;
  place-items: center;
  border: 1px solid var(--line);
  border-radius: 4px;
  background: var(--white);
  transition: all .2s;
}

.checkbox-box svg {
  width: 12px;
  height: 12px;
  color: var(--brand-dark);
  opacity: 0;
  transform: scale(.5);
  transition: all .2s;
}

.checkbox input:checked + .checkbox-box {
  border-color: var(--brand-dark);
}

.checkbox input:checked + .checkbox-box svg {
  opacity: 1;
  transform: scale(1);
}

.forgot-link {
  border: 0;
  background: none;
  font: inherit;
  font-size: 13.5px;
  font-weight: 500;
  color: var(--ink-soft);
  cursor: pointer;
}

.forgot-link:hover { text-decoration: underline; color: var(--brand-dark); }

/* =========================================================
   SUBMIT BUTTON
   ========================================================= */
.btn-submit {
  position: relative;
  width: 100%;
  height: 52px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 0;
  border-radius: var(--r-md);
  font: inherit;
  font-size: 15px;
  font-weight: 700;
  color: #fff;
  cursor: pointer;
  background: var(--brand-dark); /* Menggunakan warna coklat solid */
  transition: transform .2s var(--ease), opacity .2s;
}

.btn-submit:hover:not(:disabled) {
  opacity: 0.9;
  transform: translateY(-1px);
}

.btn-submit:active:not(:disabled) {
  transform: scale(.99);
}

.spinner {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 18px;
  height: 18px;
  margin: -9px 0 0 -9px;
  border: 2px solid rgba(255, 255, 255, .3);
  border-top-color: #fff;
  border-radius: 50%;
  opacity: 0;
  animation: spin .7s linear infinite;
  animation-play-state: paused;
}

.btn-submit.loading .spinner {
  opacity: 1;
  animation-play-state: running;
}

.btn-submit.loading .btn-text { opacity: 0; }

/* =========================================================
   TOAST
   ========================================================= */
.toast {
  position: fixed;
  left: 50%;
  bottom: 30px;
  z-index: 90;
  max-width: min(90vw, 400px);
  padding: 12px 20px;
  border-radius: var(--r-sm);
  background: var(--brand-dark);
  color: #fff;
  font-size: 14px;
  text-align: center;
  opacity: 0;
  pointer-events: none;
  transform: translate(-50%, 20px);
  transition: all .3s var(--ease);
}

.toast.show {
  opacity: 1;
  transform: translate(-50%, 0);
}

/* =========================================================
   ANIMATIONS & RESPONSIVE
   ========================================================= */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(12px); }
  to   { opacity: 1; transform: none; }
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

@media (max-width: 900px) {
  .login-page { grid-template-columns: 1fr; }

  .brand-panel {
    padding: 32px;
    min-height: 40vh;
  }

  .brand-logo { width: 42px; height: 42px; border-radius: 10px; }
  .brand-logo svg { width: 22px; height: 22px; }
  .brand-name { font-size: 16px; }

  .brand-headline { font-size: 28px; }
  .brand-headline br { display: none; }
  
  .form-panel { padding: 40px 24px; }
}

@media (max-width: 420px) {
  .role-tabs { flex-direction: column; }
}
    </style>

</head>

<body>
  <main class="login-page">
    <!-- ================= PANEL KIRI — BRANDING ================= -->
    <section class="brand-panel" aria-label="Informasi Sadena">
      <!-- Overlay warna warm/kecoklatan -->
      <div class="brand-overlay"></div>

      <!-- Header Logo (Kiri Atas) -->
      <div class="brand-header">
        <div class="brand-logo">
          <!-- Ikon Garpu & Pisau -->
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/>
            <path d="M7 2v20"/>
            <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
          </svg>
        </div>
        <div class="brand-name">SADENA</div>
      </div>

      <!-- Teks Utama (Kiri Bawah) -->
      <div class="brand-text-content">
        <h2 class="brand-headline">Manajemen<br>Restoran Modern.</h2>
        <p class="brand-sub">
          Kelola pesanan, pantau laporan keuangan,<br>
          dan maksimalkan layanan restoran Anda<br>
          dalam satu sentuhan.
        </p>
      </div>
    </section>

    <!-- ================= PANEL KANAN — FORM ================= -->
    <section class="form-panel" aria-label="Form login">
      <div class="form-card">
        <h1 class="form-title">Selamat Datang!</h1>
        <p class="form-subtitle">Silahkan masuk ke panel kontrol Anda.</p>

        

        <!-- Form login -->
        <form id="loginForm" novalidate>
          <!-- Email -->
          <div class="field" id="emailField">
            <div class="field-input-wrap">
              <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="5" width="18" height="14" rx="2"/>
                <path d="M3 7l9 6 9-6"/>
              </svg>
              <input type="text" id="loginEmail" class="field-input" name="email"
                     placeholder="Email atau Username"
                     autocomplete="username" required aria-required="true"
                     aria-label="Email atau Username">
            </div>
            <p class="field-error" id="emailError">Email atau username wajib diisi.</p>
          </div>

          <!-- Password -->
          <div class="field" id="passwordField">
            <div class="field-input-wrap">
              <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="4" y="10" width="16" height="11" rx="2"/>
                <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
              </svg>
              <input type="password" id="loginPassword" class="field-input" name="password"
                     placeholder="Kata Sandi"
                     autocomplete="current-password" required aria-required="true"
                     aria-label="Kata Sandi">
              <button type="button" class="toggle-password" id="togglePassword"
                      aria-label="Tampilkan kata sandi" aria-pressed="false">
                <svg id="eyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
            <p class="field-error" id="passwordError">Kata sandi minimal 4 karakter.</p>
          </div>

          <!-- Options -->
          <div class="options-row">
            <label class="checkbox">
              <input type="checkbox" id="rememberMe">
              <span class="checkbox-box" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                     stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12.5l4.5 4.5L19 7"/>
                </svg>
              </span>
              <span>Ingat Saya</span>
            </label>

            <button type="button" class="forgot-link" id="forgotLink">Lupa Sandi?</button>
          </div>

          <!-- Submit -->
          <button type="submit" class="btn-submit" id="submitBtn">
            <span class="spinner" aria-hidden="true"></span>
            <span class="btn-text">Masuk Sekarang &rarr;</span>
          </button>
        </form>
      </div>
    </section>
  </main>

  <!-- Toast -->
  <div class="toast" id="toast" role="status" aria-live="polite"></div>

  <script>
    (function () {
      'use strict';
      var toastEl = document.getElementById('toast');
      var toastTimer = null;

      function showToast(message, type) {
        toastEl.textContent = message;
        toastEl.className = 'toast show' + (type ? ' ' + type : '');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () {
          toastEl.classList.remove('show');
        }, 2600);
      }

      var roleTabs = document.querySelectorAll('.role-tab');
var selectedRole = 'admin'; // Diubah menjadi huruf kecil agar sinkron
      roleTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
          roleTabs.forEach(function (other) {
            other.classList.remove('active');
            other.setAttribute('aria-selected', 'false');
          });
          tab.classList.add('active');
          tab.setAttribute('aria-selected', 'true');
          selectedRole = tab.getAttribute('data-role');
        });
      });

      var passwordInput = document.getElementById('loginPassword');
      var toggleBtn = document.getElementById('togglePassword');
      var eyeIcon = document.getElementById('eyeIcon');
      var eyeOpen = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/>';
      var eyeClosed = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';

      toggleBtn.addEventListener('click', function () {
        var isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        eyeIcon.innerHTML = isPassword ? eyeClosed : eyeOpen;
        toggleBtn.setAttribute('aria-pressed', String(isPassword));
        toggleBtn.setAttribute('aria-label', isPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
        passwordInput.focus();
      });

      var form = document.getElementById('loginForm');
      var emailInput = document.getElementById('loginEmail');
      var emailField = document.getElementById('emailField');
      var passwordField = document.getElementById('passwordField');
      var submitBtn = document.getElementById('submitBtn');

      function validateEmail() {
        var value = emailInput.value.trim();
        var valid = value.length > 0;
        emailField.classList.toggle('error', !valid);
        return valid;
      }

      function validatePassword() {
        var value = passwordInput.value;
        var valid = value.length >= 4;
        passwordField.classList.toggle('error', !valid);
        return valid;
      }

      emailInput.addEventListener('blur', validateEmail);
      passwordInput.addEventListener('blur', validatePassword);
      emailInput.addEventListener('input', function () { if (emailField.classList.contains('error')) validateEmail(); });
      passwordInput.addEventListener('input', function () { if (passwordField.classList.contains('error')) validatePassword(); });

      form.addEventListener('submit', function (event) {
        event.preventDefault();
        var okEmail = validateEmail();
        var okPassword = validatePassword();

        if (!okEmail) {
          emailInput.focus();
          return;
        }
        if (!okPassword) {
          passwordInput.focus();
          return;
        }

        submitBtn.classList.add('loading');
        submitBtn.disabled = true;

        // Mengirim data email, password, dan role yang dipilih ke backend Laravel
        fetch('/login-proses', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : ''
          },
          body: JSON.stringify({
  email: emailInput.value,
  password: passwordInput.value,
  role: selectedRole.toLowerCase()
})
        })
        .then(response => response.json())
        .then(data => {
          submitBtn.classList.remove('loading');
          submitBtn.disabled = false;
          
          if (data.status === 'success') {
            showToast(data.message, 'success');
            setTimeout(() => { 
              window.location.href = data.redirect; 
            }, 1500);
          } else {
            showToast(data.message, 'error');
          }
        })
        .catch(error => {
          submitBtn.classList.remove('loading');
          submitBtn.disabled = false;
          showToast('Terjadi kesalahan pada server.', 'error');
        });
      });
    })();
  </script>
</body>
</html>