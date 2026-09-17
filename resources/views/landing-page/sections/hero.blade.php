<!-- ================= HERO ================= -->
<section id="beranda" class="pt-[140px] lg:pt-[100px]">
  
  <!-- Container Teks Utama -->
  <div class="px-4 lg:px-[5%] pb-[130px] max-w-[1300px] mx-auto text-center relative z-10" data-reveal>
    
    <!-- Badge Outline -->
    <div class="border border-[#423527]/40 rounded-full px-6 py-1.5 text-[13.5px] text-[#423527] inline-block mb-6">
      Dibuat dengan <b class="font-bold">cinta</b>, disajikan dengan <b class="font-bold">senyuman</b>
    </div>
    
    <!-- Heading Diperbesar dan Dipaksa Tepat 2 Baris -->
    <h1 class="font-serif font-normal text-[clamp(48px,5.2vw,90px)] text-[#423527] leading-[1.05] tracking-tight mx-auto">
      Pertemuan Harmoni Cita Rasa Nusantara Momen Tak Terlupakan
    </h1>
  </div>

  <div class="relative w-full">
    <!-- Tombol Reservasi Melayang -->
    <a href="#reservasi"
   class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-[40%] z-20
          w-[135px] h-[135px] lg:w-[155px] lg:h-[155px]
          bg-[#AA4A27] hover:bg-[#8b3d29] border-[6px] lg:border-8 border-[#FAD1A3]
          rounded-full flex flex-col justify-center items-center
          text-[#fdf5eb] no-underline text-[12px] lg:text-[13px]
          font-bold tracking-widest uppercase text-center
          transition-transform duration-300 hover:scale-105">
  <svg class="w-5 h-5 mb-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
       stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    <line x1="12" y1="5" x2="12" y2="19"/>
    <polyline points="19 12 12 19 5 12"/>
  </svg>
  <span>RESERVASI<br>MEJA</span>
</a>

    <!-- Gambar Hero -->
    <div class="w-full h-[46vh] min-h-[350px] lg:h-[65vh] lg:min-h-[500px]
                bg-[#2c2c2c] bg-cover bg-center"
         style="background-image:url('{{ asset('images/hero.jpg') }}');"
         role="img"
         aria-label="Suasana area makan restoran Sadena"></div>
  </div>
</section>