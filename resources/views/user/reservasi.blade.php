@extends('user.layouts.app')

@section('title', 'Reservasi Saya — Sadena')

@section('custom-css')
<style>
  .reservasi-layout {
    display: grid;
    grid-template-columns: 380px 1fr;
    gap: 24px;
    align-items: start;
  }

  .card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
  }

  .form-group {
    margin-bottom: 16px;
  }

  .form-group label {
    display: block;
    font-size: 13.5px;
    font-weight: 700;
    color: #461309;
    margin-bottom: 6px;
  }

  .form-group input, .form-group select {
    width: 100%;
    height: 46px;
    padding: 0 14px;
    border: 1.5px solid #cbd5e1;
    border-radius: 10px;
    font-size: 14px;
    font-family: inherit;
    color: #1e293b;
    outline: none;
    transition: border-color 0.2s;
  }

  .form-group input:focus, .form-group select:focus {
    border-color: #461309;
  }

  .btn-submit {
    width: 100%;
    height: 48px;
    background: #461309;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s;
    margin-top: 10px;
  }

  .btn-submit:hover {
    background: #350e06;
  }

  /* List Reservasi */
  .res-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .res-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    background: #fcfdfd;
  }

  .res-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
  }

  .status-pending { background: #fef3c7; color: #d97706; }
  .status-confirmed { background: #dcfce7; color: #16a34a; }

  @media (max-width: 1024px) {
    .reservasi-layout {
      grid-template-columns: 1fr;
    }
  }
</style>
@endsection

@section('content')
<div style="width: 100%; text-align: left; margin-bottom: 24px;">
  <h1 style="margin: 0; font-size: 28px; font-weight: 800; color: #461309;">Reservasi Meja</h1>
  <p style="margin: 6px 0 0; font-size: 15px; color: #7a5c50;">Pesan tempat untuk momen spesialmu di Sadena</p>
</div>

<div class="reservasi-layout">
  
  <!-- KIRI: FORM PENGAJUAN RESERVASI -->
  <div class="card">
    <h2 style="font-size: 18px; font-weight: 800; color: #461309; margin: 0 0 20px 0; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
      Buat Reservasi Baru
    </h2>
    
    <form action="#" method="POST">
      @csrf
      
      <div class="form-group">
        <label>Tanggal Kedatangan</label>
        <input type="date" name="tanggal" required>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div class="form-group">
          <label>Waktu</label>
          <input type="time" name="waktu" required>
        </div>
        <div class="form-group">
          <label>Jumlah Orang</label>
          <input type="number" name="jumlah_orang" min="1" max="20" placeholder="Misal: 4" required>
        </div>
      </div>

      <div class="form-group">
        <label>Pilihan Meja / Area</label>
        <select name="area" required>
          <option value="" disabled selected>Pilih area...</option>
          <option value="indoor_standar">Indoor Standar (2-4 Orang)</option>
          <option value="indoor_vip">Indoor VIP (Maks 10 Orang)</option>
          <option value="outdoor_balkon">Outdoor Balkon (2-4 Orang)</option>
          <option value="outdoor_taman">Outdoor Taman (Besar)</option>
        </select>
      </div>

      <div class="form-group">
        <label>Catatan Tambahan (Opsional)</label>
        <input type="text" name="catatan" placeholder="Misal: Ulang tahun, minta kursi bayi...">
      </div>

      <button type="button" class="btn-submit" onclick="alert('Fitur simpan reservasi belum dihubungkan ke database!')">
        Ajukan Reservasi
      </button>
    </form>
  </div>

  <!-- KANAN: DAFTAR RESERVASI USER -->
  <div class="card">
    <h2 style="font-size: 18px; font-weight: 800; color: #461309; margin: 0 0 20px 0; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
      Daftar Reservasi Anda
    </h2>

    <div class="res-list">
      
      <!-- Contoh Reservasi 1 (Disetujui) -->
      <div class="res-item">
        <div>
          <div style="font-size: 12px; color: #64748b; font-weight: 600; margin-bottom: 4px;">RES-00129</div>
          <div style="font-size: 16px; font-weight: 800; color: #1e293b; margin-bottom: 4px;">Besok, 19:00 WIB</div>
          <div style="font-size: 13.5px; color: #475569;">Indoor VIP • 8 Orang</div>
        </div>
        <div style="text-align: right;">
          <span class="res-status status-confirmed">Disetujui</span>
        </div>
      </div>

      <!-- Contoh Reservasi 2 (Menunggu) -->
      <div class="res-item">
        <div>
          <div style="font-size: 12px; color: #64748b; font-weight: 600; margin-bottom: 4px;">RES-00135</div>
          <div style="font-size: 16px; font-weight: 800; color: #1e293b; margin-bottom: 4px;">15 Okt 2026, 12:30 WIB</div>
          <div style="font-size: 13.5px; color: #475569;">Outdoor Taman • 4 Orang</div>
        </div>
        <div style="text-align: right;">
          <span class="res-status status-pending">Menunggu Konfirmasi</span>
        </div>
      </div>

      <!-- Pesan jika kosong (disembunyikan dulu sementara karena ada contoh di atas) -->
      <!-- <div style="text-align: center; color: #94a3b8; font-size: 14px; padding: 40px 0;">Belum ada data reservasi.</div> -->
    </div>
  </div>

</div>
@endsection