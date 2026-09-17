<!-- ================= GALERI ================= -->
<style>
  /* Mengatur rotasi bergantian */
  .galeri-track .kartu-galeri:nth-child(odd) {
    transform: rotate(-8deg);
  }
  .galeri-track .kartu-galeri:nth-child(even) {
    transform: rotate(8deg);
  }
  
  /* Transisi halus dan titik pusat putaran */
  .galeri-track .kartu-galeri {
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    transform-origin: center center;
    z-index: 10;
  }

  /* Efek saat di-hover */
  .galeri-track .kartu-galeri:hover {
    transform: rotate(0deg) scale(1.08) translateY(-10px);
    z-index: 50 !important;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
  }

  /* Animasi Mundur-Maju (Ping-Pong / Alternate) */
  @keyframes scroll-alternate {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
  }
  
  .galeri-track {
    width: max-content;
    animation: scroll-alternate 35s linear infinite alternate;
  }
  
  .galeri-track:hover {
    animation-play-state: paused;
  }
</style>

<section id="galeri" class="relative text-[#f2d7b6] py-[50px] lg:py-[65px] mt-[60px] lg:mt-[80px] bg-cover bg-center overflow-hidden"
         style="background-image:url('{{ asset('images/bg.jpg') }}');">
  
  <div class="text-center w-full max-w-[1200px] mx-auto relative z-10 px-4" data-reveal>
    <div class="badge-light w-max mx-auto border border-[#f2d7b6]/40 rounded-full px-5 py-1 text-[13px] mb-3">
      Manjakan Mata <b class="font-bold">Anda</b>
    </div>
    <h2 class="font-serif text-[clamp(26px,3.5vw,52px)] tracking-tight mt-1 leading-tight lg:whitespace-nowrap">
      Rasakan kehangatan suasana kami melalui galeri.
    </h2>
  </div>

  <div class="mt-[45px] lg:mt-[50px] w-full overflow-hidden relative z-10 py-6 lg:py-8">
    
    <!-- Track Berjalan: Menggunakan gap-8 hingga gap-12 agar antar foto ada jarak yang longgar dan rapi -->
    <div class="galeri-track flex items-center px-6">
      
      <!-- ================= SET FOTO ================= -->
      
      <div class="kartu-galeri relative shrink-0 bg-[#f3d9b9] p-3 pb-8 lg:p-5 lg:pb-14 rounded-xl shadow-2xl w-[240px] md:w-[320px] lg:w-[420px]">
        <div class="w-full aspect-square rounded-lg bg-cover bg-center border border-[#462311]/10" style="background-image:url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80');"></div>
        <p class="text-center text-[#462311] font-serif text-[18px] lg:text-[24px] mt-4 lg:mt-6">Iced Green Banana</p>
      </div>

      <div class="kartu-galeri relative shrink-0 bg-[#f3d9b9] p-3 pb-8 lg:p-5 lg:pb-14 rounded-xl shadow-2xl w-[240px] md:w-[320px] lg:w-[420px]">
        <div class="w-full aspect-square rounded-lg bg-cover bg-center border border-[#462311]/10" style="background-image:url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80');"></div>
        <p class="text-center text-[#462311] font-serif text-[18px] lg:text-[24px] mt-4 lg:mt-6">Fruit Ice</p>
      </div>

      <div class="kartu-galeri relative shrink-0 bg-[#f3d9b9] p-3 pb-8 lg:p-5 lg:pb-14 rounded-xl shadow-2xl w-[240px] md:w-[320px] lg:w-[420px]">
        <div class="w-full aspect-square rounded-lg bg-cover bg-center border border-[#462311]/10" style="background-image:url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=800&q=80');"></div>
        <p class="text-center text-[#462311] font-serif text-[18px] lg:text-[24px] mt-4 lg:mt-6">Cendol Dawet</p>
      </div>

      <div class="kartu-galeri relative shrink-0 bg-[#f3d9b9] p-3 pb-8 lg:p-5 lg:pb-14 rounded-xl shadow-2xl w-[240px] md:w-[320px] lg:w-[420px]">
        <div class="w-full aspect-square rounded-lg bg-cover bg-center border border-[#462311]/10" style="background-image:url('https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?auto=format&fit=crop&w=800&q=80');"></div>
        <p class="text-center text-[#462311] font-serif text-[18px] lg:text-[24px] mt-4 lg:mt-6">Nusantara Platter</p>
      </div>

      <div class="kartu-galeri relative shrink-0 bg-[#f3d9b9] p-3 pb-8 lg:p-5 lg:pb-14 rounded-xl shadow-2xl w-[240px] md:w-[320px] lg:w-[420px]">
        <div class="w-full aspect-square rounded-lg bg-cover bg-center border border-[#462311]/10" style="background-image:url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80');"></div>
        <p class="text-center text-[#462311] font-serif text-[18px] lg:text-[24px] mt-4 lg:mt-6">Sadena Signature</p>
      </div>

      <!-- ================= SET FOTO 2 (DUPLIKAT) ================= -->
      
      <div class="kartu-galeri relative shrink-0 bg-[#f3d9b9] p-3 pb-8 lg:p-5 lg:pb-14 rounded-xl shadow-2xl w-[240px] md:w-[320px] lg:w-[420px]">
        <div class="w-full aspect-square rounded-lg bg-cover bg-center border border-[#462311]/10" style="background-image:url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80');"></div>
        <p class="text-center text-[#462311] font-serif text-[18px] lg:text-[24px] mt-4 lg:mt-6">Iced Green Banana</p>
      </div>

      <div class="kartu-galeri relative shrink-0 bg-[#f3d9b9] p-3 pb-8 lg:p-5 lg:pb-14 rounded-xl shadow-2xl w-[240px] md:w-[320px] lg:w-[420px]">
        <div class="w-full aspect-square rounded-lg bg-cover bg-center border border-[#462311]/10" style="background-image:url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80');"></div>
        <p class="text-center text-[#462311] font-serif text-[18px] lg:text-[24px] mt-4 lg:mt-6">Fruit Ice</p>
      </div>

      <div class="kartu-galeri relative shrink-0 bg-[#f3d9b9] p-3 pb-8 lg:p-5 lg:pb-14 rounded-xl shadow-2xl w-[240px] md:w-[320px] lg:w-[420px]">
        <div class="w-full aspect-square rounded-lg bg-cover bg-center border border-[#462311]/10" style="background-image:url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=800&q=80');"></div>
        <p class="text-center text-[#462311] font-serif text-[18px] lg:text-[24px] mt-4 lg:mt-6">Cendol Dawet</p>
      </div>

      <div class="kartu-galeri relative shrink-0 bg-[#f3d9b9] p-3 pb-8 lg:p-5 lg:pb-14 rounded-xl shadow-2xl w-[240px] md:w-[320px] lg:w-[420px]">
        <div class="w-full aspect-square rounded-lg bg-cover bg-center border border-[#462311]/10" style="background-image:url('https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?auto=format&fit=crop&w=800&q=80');"></div>
        <p class="text-center text-[#462311] font-serif text-[18px] lg:text-[24px] mt-4 lg:mt-6">Nusantara Platter</p>
      </div>

      <div class="kartu-galeri relative shrink-0 bg-[#f3d9b9] p-3 pb-8 lg:p-5 lg:pb-14 rounded-xl shadow-2xl w-[240px] md:w-[320px] lg:w-[420px]">
        <div class="w-full aspect-square rounded-lg bg-cover bg-center border border-[#462311]/10" style="background-image:url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80');"></div>
        <p class="text-center text-[#462311] font-serif text-[18px] lg:text-[24px] mt-4 lg:mt-6">Sadena Signature</p>
      </div>

    </div>
  </div>
</section>