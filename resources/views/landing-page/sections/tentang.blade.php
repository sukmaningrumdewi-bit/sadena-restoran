<!-- ================= TENTANG KAMI ================= -->
<section id="tentang"
         class="w-full mx-auto px-6 lg:px-[72px] pt-[100px] lg:pt-[140px] pb-[80px] lg:pb-[100px]
                grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-[60px] lg:gap-[80px] items-center text-[#423527]">

  <!-- KOLOM KIRI: Badge, Judul Besar, Tombol, & Ulasan Pelanggan -->
  <div class="flex flex-col items-start" data-reveal>
    
    <!-- Badge Outline dengan warna #423527 -->
    <div class="border border-[#423527]/40 rounded-full px-5 py-1.5 text-[13.5px] text-[#423527] inline-block mb-6">
      Kenali Kami Lebih Dekat
    </div>

    <!-- Judul Besar dengan Font Instrument Serif -->
    <h2 class="font-serif font-normal text-[clamp(34px,4.2vw,56px)] leading-[1.1] tracking-tight mb-8">
      Memadukan resep warisan leluhur Nusantara dengan sentuhan modern untuk menciptakan pengalaman bersantap yang tak terlupakan.
    </h2>

    <!-- Tombol & Bagian Customer Review Bawah -->
    <div class="flex items-center gap-[30px] flex-wrap mt-2">
      
      <!-- Tombol Khas (Warna Terracotta/Cokelat Kopi) -->
      <a href="#menu" class="bg-[#AA4A27] hover:bg-[#8b3d29] text-[#fdf5eb] text-[13px] font-bold px-8 py-4 rounded-full uppercase tracking-wider transition-colors inline-block shadow-sm no-underline">
        BACA KISAH KAMI
      </a>

      <!-- Avatar & Teks Pelanggan -->
      <div class="flex items-center gap-3">
        <div class="flex">
          <div class="w-[42px] h-[42px] rounded-full border-2 border-[#fdf5eb] bg-cover bg-center shadow-sm"
               style="background-image:url('https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80');"></div>
          <div class="w-[42px] h-[42px] rounded-full border-2 border-[#fdf5eb] bg-cover bg-center -ml-[15px] shadow-sm"
               style="background-image:url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80');"></div>
          <div class="w-[42px] h-[42px] rounded-full border-2 border-[#fdf5eb] bg-cover bg-center -ml-[15px] shadow-sm"
               style="background-image:url('https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80');"></div>
        </div>
        <div class="flex flex-col">
          <strong class="text-[14.5px] leading-tight font-bold">Satisfied Customers</strong>
          <span class="text-[11px] text-[#423527]/70 font-medium tracking-tight">
            Thousands of reviews from customers
          </span>
        </div>
      </div>

    </div>
  </div>

  <!-- KOLOM KANAN: Teks Pendukung & Gambar Estetik -->
  <div class="flex flex-col lg:items-end gap-4" data-reveal>
    
    <!-- Teks kecil di atas gambar -->
    <p class="font-serif text-[24px] lg:text-[28px] tracking-tight">
      Rasakan harmoni rasa yang <b class="font-bold">sempurna</b>.
    </p>

    <!-- Kotak Gambar dengan Sudut Melengkung Elegan (rounded-3xl) -->
    <div class="w-full max-w-[440px] h-[340px] lg:h-[400px] rounded-3xl bg-cover bg-center shadow-lg border border-[#423527]/10"
         style="background-image:url('{{ asset('images/about.jpg') }}');"
         role="img"
         aria-label="Hidangan spesial dan suasana restoran Sadena"></div>
         
  </div>
</section>