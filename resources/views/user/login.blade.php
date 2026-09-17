<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sadena</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* =========================================
           RESET & BASE
           ========================================= */
        :root {
            --bg-cream: #fef2e5;
            --dark-brown: #340e00;
            --primary-brown: #461300;
            --accent-gold: #f5c081;
            --light-gold: #fad1a3;
            --text-muted: rgba(0, 0, 0, 0.45);
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-cream);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* =========================================
           LAYOUT UTAMA (CARD)
           ========================================= */
        .login-container {
            display: flex;
            width: 100%;
            max-width: 1050px;
            background-color: var(--white);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            min-height: 746px;
        }

        /* =========================================
           PANEL KIRI (INFORMASI)
           ========================================= */
        .info-panel {
            flex: 1;
            background-color: var(--dark-brown);
            color: var(--white);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .brand svg {
            width: 32px;
            height: 41px;
            color: var(--accent-gold);
        }

        .brand h1 {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .brand h1 span {
            color: var(--accent-gold);
        }

        .welcome-badge {
            display: inline-block;
            background-color: rgba(93, 39, 16, 0.46);
            border: 1px solid rgba(0, 0, 0, 0.43);
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 25px;
            width: fit-content;
        }

        .info-panel h2 {
            font-size: 40px;
            line-height: 1.2;
            margin-bottom: 20px;
            font-weight: 800;
        }

        .info-panel h2 span {
            color: var(--accent-gold);
        }

        .info-panel p {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.5;
            margin-bottom: 40px;
        }

        /* List Fitur */
        .features-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .features-list li {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .features-list li strong {
            font-size: 24px;
            font-weight: 800;
        }

        .features-list li span {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Footer Info (Jam Operasional) */
        .info-footer {
            margin-top: auto;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            display: flex;
            justify-content: flex-end;
        }

        .operating-hours {
            display: flex;
            align-items: center;
            gap: 8px;
            background-color: #72462d;
            border: 1px solid #000;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            color: var(--accent-gold);
        }

        /* =========================================
           PANEL KANAN (FORM)
           ========================================= */
        .form-panel {
            flex: 1;
            background-color: var(--white);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
        }

        /* Tab Masuk / Daftar */
        .tabs {
            display: flex;
            background-color: #f7f1eb;
            border-radius: 10px;
            padding: 5px;
            margin-bottom: 30px;
            position: relative;
        }

        .tab-btn {
            flex: 1;
            padding: 12px;
            border: none;
            background: none;
            font-size: 16px;
            font-weight: 800;
            color: #b0a49c;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .tab-btn.active {
            background-color: var(--white);
            color: #5b1d05;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Header Form */
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h3 {
            font-size: 24px;
            font-weight: 600;
            color: #72462d;
            margin-bottom: 8px;
        }

        .form-header p {
            font-size: 16px;
            font-weight: 500;
            color: var(--text-muted);
        }

        /* Input Group */
        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            background-color: #fffcfc;
            border: 1px solid rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            padding: 0 16px;
            height: 66px;
            transition: border-color 0.3s ease;
        }

        .input-wrapper:focus-within {
            border-color: var(--primary-brown);
        }

        .input-wrapper svg {
            width: 24px;
            height: 24px;
            color: var(--text-muted);
            margin-right: 12px;
            flex-shrink: 0;
        }

        .input-wrapper input {
            border: none;
            background: none;
            outline: none;
            width: 100%;
            height: 100%;
            font-size: 16px;
            color: #333;
        }

        .input-wrapper input::placeholder {
            color: rgba(0, 0, 0, 0.3);
        }

        /* Toggle Password */
        .toggle-password {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            color: var(--text-muted);
        }

        /* Opsi Tambahan (Ingat Saya & Lupa Sandi) */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 15px;
            font-weight: 500;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            cursor: pointer;
        }

        .remember-me input {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-brown);
            cursor: pointer;
        }

        .forgot-password {
            color: var(--primary-brown);
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        /* Tombol Submit */
        .btn-submit {
            width: 100%;
            height: 66px;
            background-color: var(--primary-brown);
            color: var(--light-gold);
            border: 1px solid #000;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 800;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 30px;
        }

        .btn-submit:hover {
            background-color: #5d2109;
        }

        .btn-submit svg {
            width: 20px;
            height: 20px;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--text-muted);
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 30px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid rgba(0, 0, 0, 0.15);
        }

        .divider span {
            padding: 0 15px;
        }

        /* Social Login */
        .social-login {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .social-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 45px;
            background-color: var(--white);
            border: 1px solid var(--primary-brown);
            border-radius: 10px;
            color: var(--primary-brown);
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            background-color: #fdf1e3;
        }

        .social-btn svg {
            width: 18px;
            height: 18px;
        }

        /* =========================================
           RESPONSIVE (MOBILE & TABLET)
           ========================================= */
        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
                min-height: auto;
            }

            .info-panel {
                padding: 40px 30px;
                text-align: center;
                align-items: center;
            }

            .brand {
                justify-content: center;
            }

            .info-panel p {
                margin-bottom: 20px;
            }

            .features-list {
                display: none; /* Sembunyikan fitur di mobile agar tidak terlalu panjang */
            }

            .info-footer {
                width: 100%;
                justify-content: center;
                margin-top: 20px;
            }

            .form-panel {
                padding: 40px 30px;
            }
        }

        @media (max-width: 480px) {
            .social-login {
                flex-direction: column;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- ================= PANEL KIRI ================= -->
        <aside class="info-panel">
            <div class="brand">
                <!-- SVG Garpu & Sendok -->
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M7 2v8a2 2 0 0 0 4 0V2" />
                    <path d="M9 12v10" />
                    <path d="M17 2c-1.4 1.6-2 3.2-2 5s.6 3 2 3 2-1.2 2-3-.6-3.4-2-5Z" />
                    <path d="M17 10v12" />
                </svg>
                <h1>SAD<span>ENA</span></h1>
            </div>

            <div class="welcome-badge">Selamat Datang Kembali</div>

            <h2>Hidangan Istimewa, <br><span>siap dalam hitungan menit.</span></h2>
            
            <p>Masuk untuk melanjutkan pesanan favorit, menyimpan alamat pengiriman, dan menikmati promo khusus pelanggan setia SADENA.</p>

            <ul class="features-list">
                <li>
                    <strong>Pengiriman Cepat</strong>
                    <span>Rata-rata tiba dalam 25 menit</span>
                </li>
                <li>
                    <strong>Pembayaran Aman</strong>
                    <span>Transaksi terenkripsi & terverifikasi</span>
                </li>
                <li>
                    <strong>Point & Promo Eksklusif</strong>
                    <span>Kumpulkan poin setiap pemesanan</span>
                </li>
            </ul>

            <div class="info-footer">
                <div class="operating-hours">
                    <!-- SVG Jam -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    08.00 - 23.00
                </div>
            </div>
        </aside>

        <!-- ================= PANEL KANAN ================= -->
        <main class="form-panel">
            <!-- Tab Navigation -->
            <div class="tabs">
                <button class="tab-btn active" id="btn-tab-login" type="button" onclick="switchTab('login')">Masuk</button>
                <button class="tab-btn" id="btn-tab-register" type="button" onclick="switchTab('register')">Daftar</button>
            </div>

            <div class="form-header">
                <h3 id="form-title">Masuk ke Akun Anda</h3>
                <p id="form-subtitle">Gunakan email dan kata sandi yang terdaftar</p>
            </div>

            <!-- FORM LOGIN -->
            <form id="form-login" action="{{ route('user.login.post') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email_login">Alamat Email</label>
                    <div class="input-wrapper">
                        <!-- SVG Email -->
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <!-- Tambahkan atribut name="email" -->
                        <input type="email" id="email_login" name="email" placeholder="Alamat Email" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password_login">Kata Sandi</label>
                    <div class="input-wrapper">
                        <!-- SVG Lock -->
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <!-- Tambahkan atribut name="password" -->
                        <input type="password" id="password_login" name="password" placeholder="Kata Sandi" required>
                        <button type="button" class="toggle-password" onclick="togglePassword('password_login', 'eye-icon-login')">
                            <svg id="eye-icon-login" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Ingat Saya
                    </label>
                    <a href="#" class="forgot-password">Lupa Sandi?</a>
                </div>

                <button type="submit" class="btn-submit">
                    Masuk Sekarang
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </button>
            </form>

            <!-- FORM DAFTAR (Awalnya Disembunyikan) -->
            <form id="form-register" action="{{ route('register.proses') }}" method="POST" style="display: none;">
                @csrf
                <div class="input-group">
    <label for="name_register">Nama Lengkap</label>
    <div class="input-wrapper">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        <!-- Ganti name="name" menjadi name="nama" -->
        <input type="text" id="name_register" name="nama" placeholder="Nama Lengkap" required>
    </div>
</div>

                <div class="input-group">
                    <label for="email_register">Alamat Email</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <input type="email" id="email_register" name="email" placeholder="Alamat Email" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password_register">Kata Sandi</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input type="password" id="password_register" name="password" placeholder="Buat Kata Sandi" required minlength="8">
                        <button type="button" class="toggle-password" onclick="togglePassword('password_register', 'eye-icon-register')">
                            <svg id="eye-icon-register" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Daftar Sekarang
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </button>
            </form>

            <!-- Divider -->
            <div class="divider">
                <span>atau lanjutkan dengan</span>
            </div>

            <!-- Social Login -->
            <div class="social-login">
                <button type="button" class="social-btn">
                    <!-- SVG Google -->
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .533 5.347.533 12S5.867 24 12.48 24c3.44 0 6.013-1.133 8.027-3.24 2.08-2.08 2.733-5.013 2.733-7.387 0-.507-.053-1.013-.133-1.453H12.48z"/>
                    </svg>
                    Google
                </button>
                <button type="button" class="social-btn">
                    <!-- SVG Facebook -->
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Facebook
                </button>
                <button type="button" class="social-btn">
                    <!-- SVG Apple -->
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                    </svg>
                    Apple
                </button>
            </div>
        </main>
    </div>

    <script>
        // Fungsi untuk menampilkan/menyembunyikan password
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Ubah ikon menjadi mata terbuka (opsional, bisa diganti SVG lain)
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            } else {
                passwordInput.type = 'password';
                // Kembalikan ke ikon mata tertutup
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        }

        function switchTab(tab) {
            const loginForm = document.getElementById('form-login');
            const registerForm = document.getElementById('form-register');
            const btnLogin = document.getElementById('btn-tab-login');
            const btnRegister = document.getElementById('btn-tab-register');
            const title = document.getElementById('form-title');
            const subtitle = document.getElementById('form-subtitle');

            if (tab === 'login') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
                btnLogin.classList.add('active');
                btnRegister.classList.remove('active');
                title.innerText = 'Masuk ke Akun Anda';
                subtitle.innerText = 'Gunakan email dan kata sandi yang terdaftar';
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                btnLogin.classList.remove('active');
                btnRegister.classList.add('active');
                title.innerText = 'Daftar Akun Baru';
                subtitle.innerText = 'Bergabunglah untuk menikmati promo eksklusif';
            }
        }

        // Fungsi toggle password yang sudah diperbarui agar bisa banyak input
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        }

        // Cek jika URL memiliki parameter ?tab=register, otomatis buka tab daftar
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.get('tab') === 'register') {
                switchTab('register');
            }
        }

        document.getElementById('form-login').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch("{{ route('user.login.post') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    alert(data.message);
                    window.location.href = data.redirect;
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Menangani Submit Form Register via AJAX Fetch
        document.getElementById('form-register').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch("{{ route('register.proses') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    alert(data.message);
                    window.location.href = data.redirect;
                } else {
                    alert('Terjadi kesalahan saat registrasi.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>