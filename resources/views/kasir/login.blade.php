<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1, width=device-width">
  <title>SADENA - Login Kasir</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">

  <style>
    /* ---------- Reset & Base ---------- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      color: #461300;
      background-color: #fff;
      -webkit-font-smoothing: antialiased;
    }

    button,
    input {
      font-family: inherit;
    }

    svg {
      display: block;
    }

    /* ---------- Layout ---------- */
    .login-page {
      display: flex;
      min-height: 100vh;
      width: 100%;
    }

    /* ---------- Left Panel: Branding ---------- */
    .brand-panel {
      position: relative;
      flex: 1 1 45%;
      max-width: 760px;
      min-height: 100vh;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 60px 64px;
      color: #fff;
      background-color: #461300;
    }

    .brand-panel__bg {
      position: absolute;
      inset: 0;
      background-image: url("https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1600&q=80");
      background-size: cover;
      background-position: center;
      transform: scale(1.02);
    }

    .brand-panel__overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(
        160deg,
        rgba(70, 19, 0, 0.55) 0%,
        rgba(70, 19, 0, 0.82) 100%
      );
    }

    .brand-header,
    .brand-content {
      position: relative;
      z-index: 1;
    }

    .brand-header {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .brand-logo {
      width: 68px;
      height: 68px;
      border-radius: 18px;
      background-color: rgba(104, 61, 39, 0.85);
      backdrop-filter: blur(6px);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #f6c691;
    }

    .brand-logo svg {
      width: 32px;
      height: 32px;
    }

    .brand-name {
      font-size: 30px;
      font-weight: 800;
      letter-spacing: 2px;
      color: #f6c691;
    }

    .brand-content {
      max-width: 560px;
    }

    .brand-title {
      font-size: clamp(32px, 3.4vw, 52px);
      font-weight: 800;
      line-height: 1.15;
      margin-bottom: 28px;
      color: #fff;
    }

    .brand-subtitle {
      font-size: clamp(15px, 1.2vw, 18px);
      font-weight: 500;
      line-height: 1.7;
      color: rgba(255, 255, 255, 0.88);
    }

    /* ---------- Right Panel: Form ---------- */
    .form-panel {
      flex: 1 1 55%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 60px 40px;
      background-color: #fff;
    }

    .form-wrapper {
      width: 100%;
      max-width: 400px;
    }

    .form-header {
      margin-bottom: 36px;
    }

    .form-title {
      font-size: 34px;
      font-weight: 800;
      color: #461300;
      margin-bottom: 8px;
    }

    .form-desc {
      font-size: 15px;
      font-weight: 500;
      color: rgba(70, 19, 0, 0.65);
    }

    /* ---------- Form Fields ---------- */
    .login-form {
      display: flex;
      flex-direction: column;
      gap: 22px;
    }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .field__label {
      font-size: 14px;
      font-weight: 600;
      color: #461300;
    }

    .field__input-wrap {
      position: relative;
      display: flex;
      align-items: center;
    }

    .field__icon {
      position: absolute;
      left: 16px;
      width: 20px;
      height: 20px;
      color: rgba(70, 19, 0, 0.55);
      pointer-events: none;
    }

    .field__input {
      width: 100%;
      height: 52px;
      padding: 0 16px 0 48px;
      border-radius: 12px;
      border: 1px solid rgba(70, 19, 0, 0.18);
      background-color: #f8fafc;
      font-size: 15px;
      font-weight: 500;
      color: #461300;
      transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    }

    .field__input::placeholder {
      color: rgba(70, 19, 0, 0.4);
      font-weight: 400;
    }

    .field__input:hover {
      border-color: rgba(70, 19, 0, 0.35);
    }

    .field__input:focus {
      outline: none;
      border-color: #461300;
      background-color: #fff;
      box-shadow: 0 0 0 4px rgba(70, 19, 0, 0.08);
    }

    /* ---------- 6-Digit Access Code ---------- */
    .code-input {
      display: flex;
      gap: 10px;
      justify-content: space-between;
    }

    .code-input__box {
      flex: 1 1 0;
      min-width: 0;
      height: 58px;
      text-align: center;
      font-size: 22px;
      font-weight: 700;
      color: #461300;
      border-radius: 12px;
      border: 1.5px solid rgba(70, 19, 0, 0.18);
      background-color: #f8fafc;
      caret-color: #461300;
      transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease, transform 0.1s ease;
      -moz-appearance: textfield;
    }

    .code-input__box::-webkit-outer-spin-button,
    .code-input__box::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .code-input__box:hover {
      border-color: rgba(70, 19, 0, 0.35);
    }

    .code-input__box:focus {
      outline: none;
      border-color: #461300;
      background-color: #fff;
      box-shadow: 0 0 0 4px rgba(70, 19, 0, 0.08);
      transform: translateY(-1px);
    }

    .code-input__box.is-filled {
      border-color: #461300;
      background-color: #fff;
    }

    .code-hint {
      font-size: 12.5px;
      font-weight: 500;
      color: rgba(70, 19, 0, 0.55);
      margin-top: 2px;
    }

    /* ---------- Options Row ---------- */
    .form-options {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: -4px;
    }

    .checkbox {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      user-select: none;
    }

    .checkbox input {
      position: absolute;
      opacity: 0;
      pointer-events: none;
    }

    .checkbox__box {
      width: 18px;
      height: 18px;
      border-radius: 5px;
      border: 1.5px solid rgba(70, 19, 0, 0.45);
      background-color: #fff;
      position: relative;
      transition: all 0.2s ease;
      flex-shrink: 0;
    }

    .checkbox__box::after {
      content: "";
      position: absolute;
      top: 3px;
      left: 6px;
      width: 4px;
      height: 9px;
      border: solid #fff;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg) scale(0);
      transition: transform 0.15s ease;
    }

    .checkbox input:checked + .checkbox__box {
      background-color: #461300;
      border-color: #461300;
    }

    .checkbox input:checked + .checkbox__box::after {
      transform: rotate(45deg) scale(1);
    }

    .checkbox__label {
      font-size: 14px;
      font-weight: 500;
      color: rgba(70, 19, 0, 0.75);
    }

    .forgot-link {
      font-size: 14px;
      font-weight: 600;
      color: #461300;
      text-decoration: none;
      transition: opacity 0.2s ease;
    }

    .forgot-link:hover {
      opacity: 0.65;
    }

    /* ---------- Submit Button ---------- */
    .submit-btn {
      width: 100%;
      height: 54px;
      margin-top: 8px;
      border: none;
      border-radius: 12px;
      background-color: #461300;
      color: #fad1a3;
      font-size: 15px;
      font-weight: 700;
      letter-spacing: 0.4px;
      cursor: pointer;
      transition: transform 0.15s ease, box-shadow 0.2s ease, background-color 0.2s ease;
      box-shadow: 0 10px 24px -12px rgba(70, 19, 0, 0.6);
    }

    .submit-btn:hover {
      background-color: #5c1a02;
      box-shadow: 0 14px 30px -12px rgba(70, 19, 0, 0.7);
    }

    .submit-btn:active {
      transform: translateY(1px);
    }

    .submit-btn:focus-visible {
      outline: 2px solid #461300;
      outline-offset: 3px;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 1024px) {
      .brand-panel {
        padding: 44px 40px;
      }
      .form-panel {
        padding: 44px 32px;
      }
    }

    @media (max-width: 860px) {
      .login-page {
        flex-direction: column;
      }

      .brand-panel {
        flex: none;
        max-width: none;
        min-height: 340px;
        padding: 36px 32px;
        justify-content: flex-start;
        gap: 40px;
      }

      .brand-content {
        margin-top: auto;
      }

      .brand-title {
        font-size: 32px;
        margin-bottom: 16px;
      }

      .brand-subtitle br {
        display: none;
      }

      .form-panel {
        flex: 1;
        padding: 40px 24px 56px;
      }

      .form-wrapper {
        max-width: 480px;
      }
    }

    @media (max-width: 480px) {
      .brand-panel {
        min-height: 280px;
        padding: 28px 22px;
      }

      .brand-logo {
        width: 56px;
        height: 56px;
        border-radius: 14px;
      }

      .brand-logo svg {
        width: 26px;
        height: 26px;
      }

      .brand-name {
        font-size: 24px;
      }

      .brand-title {
        font-size: 26px;
      }

      .form-panel {
        padding: 32px 20px 44px;
      }

      .form-title {
        font-size: 28px;
      }

      .code-input {
        gap: 8px;
      }

      .code-input__box {
        height: 52px;
        font-size: 20px;
        border-radius: 10px;
      }
    }
  </style>
</head>
<body>

  <div class="login-page">

    <!-- ================= LEFT: BRANDING ================= -->
    <section class="brand-panel">
      <div class="brand-panel__bg"></div>
      <div class="brand-panel__overlay"></div>

      <div class="brand-header">
        <div class="brand-logo">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
               aria-hidden="true">
            <path d="M5 3v7a3 3 0 0 0 3 3h0a3 3 0 0 0 3-3V3"/>
            <path d="M8 3v18"/>
            <path d="M17 3c-1.5 2-2 4-2 6 0 1.5.7 2.5 2 3v9"/>
          </svg>
        </div>
        <span class="brand-name">SADENA</span>
      </div>

      <div class="brand-content">
        <h1 class="brand-title">Manajemen<br>Restoran Modern.</h1>
        <p class="brand-subtitle">
          Kelola pesanan, pantau laporan keuangan,<br>
          dan maksimalkan layanan restoran Anda<br>
          dalam satu sentuhan.
        </p>
      </div>
    </section>

    <!-- ================= RIGHT: LOGIN FORM ================= -->
    <section class="form-panel">
      <div class="form-wrapper">
        <header class="form-header">
          <h2 class="form-title">Selamat Datang!</h2>
          <p class="form-desc">Silakan masuk ke panel kasir Anda.</p>
        </header>

        @if ($errors->any())
    <div style="color: red; margin-bottom: 15px; font-size: 14px; font-weight: 600;">
        {{ $errors->first() }}
    </div>
@endif

<form class="login-form" method="POST" action="{{ route('kasir.login.post') }}" onsubmit="handleLogin(event, this)">
    @csrf
    
    <!-- Input hidden untuk mengirim 6 digit PIN -->
    <input type="hidden" name="pin" id="real-pin">

          <!-- Nama Kasir -->
          <div class="field">
            <label class="field__label" for="nama">Nama Kasir</label>
            <div class="field__input-wrap">
              <!-- Ikon user (SVG inline) -->
              <svg class="field__icon" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="1.8"
                   stroke-linecap="round" stroke-linejoin="round"
                   aria-hidden="true">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 20c0-4 4-6 8-6s8 2 8 6"/>
              </svg>
              <input
    id="nama"
    name="nama" 
    type="text"
    class="field__input"
    placeholder="Masukkan nama Anda"
    autocomplete="name"
    value="{{ old('nama') }}"
>
            </div>
          </div>

          <!-- Kode Akses 6 Digit -->
          <div class="field">
            <label class="field__label" for="pin-1">Kode Akses Kasir</label>
            <div class="code-input" id="codeInput">
              <input class="code-input__box" type="text" inputmode="numeric" maxlength="1" autocomplete="off" id="pin-1" aria-label="Digit 1">
              <input class="code-input__box" type="text" inputmode="numeric" maxlength="1" autocomplete="off" id="pin-2" aria-label="Digit 2">
              <input class="code-input__box" type="text" inputmode="numeric" maxlength="1" autocomplete="off" id="pin-3" aria-label="Digit 3">
              <input class="code-input__box" type="text" inputmode="numeric" maxlength="1" autocomplete="off" id="pin-4" aria-label="Digit 4">
              <input class="code-input__box" type="text" inputmode="numeric" maxlength="1" autocomplete="off" id="pin-5" aria-label="Digit 5">
              <input class="code-input__box" type="text" inputmode="numeric" maxlength="1" autocomplete="off" id="pin-6" aria-label="Digit 6">
            </div>
            <p class="code-hint">Masukkan 6 digit kode akses Anda</p>
          </div>

          <!-- Remember + Forgot -->
          <div class="form-options">
            <label class="checkbox">
              <input type="checkbox" id="remember">
              <span class="checkbox__box"></span>
              <span class="checkbox__label">Ingat Saya</span>
            </label>
            <a href="#" class="forgot-link">Lupa Kode?</a>
          </div>

          <button type="submit" class="submit-btn">Masuk Sekarang</button>
        </form>
      </div>
    </section>

  </div>

  <script>
    (function () {
      const boxes = Array.from(document.querySelectorAll('.code-input__box'));

      function updateFilledState(el) {
        if (el.value.trim() !== '') {
          el.classList.add('is-filled');
        } else {
          el.classList.remove('is-filled');
        }
      }

      boxes.forEach((box, index) => {
        // Saat mengetik: hanya angka, auto lanjut ke kotak berikutnya
        box.addEventListener('input', (e) => {
          let value = e.target.value.replace(/\D/g, ''); // buang non-digit

          // Kalau user paste banyak digit sekaligus ke satu kotak
          if (value.length > 1) {
            const digits = value.split('');
            digits.forEach((d, i) => {
              if (boxes[index + i]) {
                boxes[index + i].value = d;
                updateFilledState(boxes[index + i]);
              }
            });
            const nextEmpty = boxes.findIndex((b, i) => i > index && b.value === '');
            const focusIndex = nextEmpty === -1 ? boxes.length - 1 : nextEmpty;
            boxes[focusIndex].focus();
            return;
          }

          e.target.value = value;
          updateFilledState(e.target);

          if (value !== '' && index < boxes.length - 1) {
            boxes[index + 1].focus();
          }
        });

        // Backspace: kalau kosong, mundur ke kotak sebelumnya
        box.addEventListener('keydown', (e) => {
          if (e.key === 'Backspace') {
            if (box.value === '' && index > 0) {
              e.preventDefault();
              boxes[index - 1].focus();
              boxes[index - 1].value = '';
              updateFilledState(boxes[index - 1]);
            }
          }

          // Navigasi panah
          if (e.key === 'ArrowLeft' && index > 0) {
            e.preventDefault();
            boxes[index - 1].focus();
          }
          if (e.key === 'ArrowRight' && index < boxes.length - 1) {
            e.preventDefault();
            boxes[index + 1].focus();
          }
        });

        // Kalau user klik kotak yang kosong, fokuskan ke kotak kosong pertama
        box.addEventListener('focus', () => {
          const firstEmpty = boxes.findIndex((b) => b.value === '');
          if (firstEmpty !== -1 && index > firstEmpty) {
            boxes[firstEmpty].focus();
          }
        });

        // Handle paste (Ctrl+V) — isi banyak kotak sekaligus
        box.addEventListener('paste', (e) => {
          e.preventDefault();
          const pasted = (e.clipboardData || window.clipboardData).getData('text');
          const digits = pasted.replace(/\D/g, '').slice(0, 6).split('');
          digits.forEach((d, i) => {
            if (boxes[i]) {
              boxes[i].value = d;
              updateFilledState(boxes[i]);
            }
          });
          const nextEmpty = boxes.findIndex((b) => b.value === '');
          boxes[nextEmpty === -1 ? boxes.length - 1 : nextEmpty].focus();
        });
      });
    })();
    
    function handleLogin(event, form) {
    event.preventDefault(); 

    const namaInput = document.getElementById('nama').value;
    
    let pin = '';
    for (let i = 1; i <= 6; i++) {
        pin += document.getElementById('pin-' + i).value;
    }

    if (namaInput.trim() === '') {
        alert('Mohon masukkan Nama Kasir.');
        return;
    }

    if (pin.length < 6) {
        alert('Mohon lengkapi 6 digit Kode Akses.');
        return;
    }

    // Masukkan gabungan PIN ke input hidden
    document.getElementById('real-pin').value = pin;
    
    // Submit form secara nyata ke backend
    form.submit(); 
}
  </script>

</body>
</html>