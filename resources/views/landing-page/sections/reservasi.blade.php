<!-- ================= RESERVASI ================= -->
<style>
  /* Memperlebar kontainer utama dari 1440px menjadi 1600px agar jauh lebih lebar */
  .reservasi-container {
    max-width: 1600px;
    margin: 0 auto;
    width: 100%;
  }

  /* Mengatur grid utama dengan porsi kolom kanan (foto) yang lebih luas */
  .reservasi-grid {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 70px;
    align-items: center;
  }

  /* Pengaturan Kotak Foto Bento dengan ukuran yang lebih besar */
  .reservasi-photos-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    width: 100%;
  }

  .reservasi-photo-box {
    width: 100%;
    background-size: cover;
    background-position: center;
    border-radius: 28px;
    border: 1px solid rgba(66, 53, 39, 0.12);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
  }

  /* Memperbesar tinggi foto persegi panjang agar lebih panjang dan besar */
  .photo-landscape-sm {
    height: 290px;
  }
  .photo-landscape-lg {
    height: 604px; /* 290px + 290px (tinggi 2 foto kecil) + 24px (gap) = pas sejajar */
  }

  /* Responsif untuk layar HP/Tablet */
  @media (max-width: 1024px) {
    .reservasi-grid {
      grid-template-columns: 1fr;
      gap: 40px;
    }
    .photo-landscape-sm {
      height: 240px;
    }
    .photo-landscape-lg {
      height: 350px;
    }
  }
</style>

<section id="reservasi" class="py-[100px] lg:py-[150px] overflow-hidden text-[#423527] px-6 lg:px-16">
  
  <!-- Container Utama -->
  <div class="reservasi-container" data-reveal>
    
    <div class="reservasi-grid">
      
      <!-- KOLOM KIRI: Teks & Tombol -->
      <div class="flex flex-col items-start text-left">
        
        <!-- Badge "Pesan Meja Anda" -->
        <div class="border border-[#423527]/40 rounded-full px-5 py-1.5 text-[14px] text-[#423527] inline-block mb-6">
          Pesan Meja <b class="font-bold">Anda</b>
        </div>

        <!-- Heading Raksasa dengan Font Instrument Serif yang Lebih Besar -->
        <h2 class="font-serif font-normal text-[clamp(42px,5.2vw,70px)] leading-[1.08] tracking-tight mb-10">
          Pastikan tempat Anda! Nikmati sukacita sejati dari pengalaman bersantap yang sempurna bersama orang terkasih.
        </h2>

       <!-- Tombol CTA Khas (Diperbesar agar panjang dan megah seperti di desain) -->
       <a href="{{ route('user.login') }}" class="bg-[#AA4A27] hover:bg-[#8b3d29] text-[#fdf5eb] text-[14px] lg:text-[15px] font-bold px-10 py-5 rounded-full uppercase tracking-wider transition-colors inline-block shadow-sm no-underline">
  RESERVASI SEKARANG
</a>
        
      </div>

      <!-- KOLOM KANAN: Grid Foto yang Diperbesar -->
      <div class="reservasi-photos-grid">
        
        <!-- Kolom Kiri: Dua Foto Persegi Panjang Bertumpuk -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
          <!-- Foto Atas -->
          <div class="reservasi-photo-box photo-landscape-sm"
               style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1000&q=80');">
          </div>
          <!-- Foto Bawah -->
          <div class="reservasi-photo-box photo-landscape-sm"
               style="background-image: url('https://images.unsplash.com/photo-1544148103-0773bf10d330?auto=format&fit=crop&w=1000&q=80');">
          </div>
        </div>

        <!-- Kolom Kanan: Satu Foto Persegi Panjang Besar ke Bawah -->
        <div>
          <div class="reservasi-photo-box photo-landscape-lg"
               style="background-image: url('https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=1000&q=80');">
          </div>
        </div>
        
      </div>

    </div>

  </div>
</section>