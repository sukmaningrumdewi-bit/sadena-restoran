@extends('user.layouts.app')

@section('title', 'Profil Saya — Sadena')

@section('custom-css')
<style>
  .profile-container {
    max-width: 700px; /* Lebar dibatasi agar form tidak terlalu melar di layar besar */
    margin: 0 auto; /* Posisi di tengah */
  }

  .card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #461309;
    margin-bottom: 8px;
  }

  .form-group input, .form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid #cbd5e1;
    border-radius: 10px;
    font-size: 15px;
    font-family: inherit;
    color: #1e293b;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: #fff;
  }

  .form-group input:focus, .form-group textarea:focus {
    border-color: #461309;
    box-shadow: 0 0 0 3px rgba(70, 19, 9, 0.1);
  }

  /* Styling khusus untuk input yang dinonaktifkan (Email) */
  .form-group input[readonly] {
    background: #f1f5f9;
    color: #64748b;
    cursor: not-allowed;
    border-color: #e2e8f0;
  }

  .btn-submit {
    height: 48px;
    padding: 0 32px;
    background: #461309;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .btn-submit:hover {
    background: #350e06;
    transform: translateY(-1px);
  }

  .alert-success {
    background: #f0fdf4;
    color: #16a34a;
    padding: 16px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 24px;
    border: 1px solid #4ade80;
    display: flex;
    align-items: center;
    gap: 10px;
  }
</style>
@endsection

@section('content')
<div class="profile-container">
  <div style="margin-bottom: 24px;">
    <h1 style="margin: 0; font-size: 28px; font-weight: 800; color: #461309;">Pengaturan Profil</h1>
    <p style="margin: 6px 0 0; font-size: 15px; color: #7a5c50;">Perbarui data diri dan kata sandi Anda di sini.</p>
  </div>

  <div class="card">
    @if(session('success'))
      <div class="alert-success">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('user.profile.update') }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="email">Alamat Email</label>
        <!-- Diberi atribut readonly agar tidak bisa diubah user -->
        <input type="email" id="email" value="{{ $user->email }}" readonly title="Email tidak dapat diubah">
        <div style="font-size: 12px; color: #64748b; margin-top: 6px;">Email digunakan untuk login dan tidak dapat diubah.</div>
      </div>

      <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required autocomplete="off">
      </div>

      <div class="form-group">
        <label for="no_telp">Nomor Telepon (WhatsApp)</label>
        <input type="tel" id="no_telp" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" placeholder="Contoh: 081234567890">
      </div>

      <div class="form-group">
        <label for="alamat">Alamat Lengkap</label>
        <textarea id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap pengiriman...">{{ old('alamat', $user->alamat) }}</textarea>
      </div>

      <hr style="border: 0; border-top: 1px dashed #cbd5e1; margin: 32px 0;">

      <h3 style="font-size: 18px; font-weight: 800; color: #461309; margin: 0 0 16px 0;">Keamanan</h3>

      <div class="form-group">
        <label for="password">Kata Sandi Baru</label>
        <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah kata sandi">
        <div style="font-size: 12px; color: #94a3b8; margin-top: 6px;">Minimal 8 karakter. Biarkan kosong jika tidak ada perubahan.</div>
      </div>

      <div style="text-align: right; margin-top: 32px;">
        <button type="submit" class="btn-submit">Simpan Perubahan Profil</button>
      </div>
    </form>
  </div>
</div>
@endsection