<!-- ================= NAVBAR ================= -->
<header>
  <!-- Background krem dan teks/border warna #423527 -->
  <nav class="fixed top-0 left-0 w-full h-[80px] bg-[#FAD1A3] border-b border-[#423527]/30 z-[1000] text-[#423527]">
    
    <!-- Desktop -->
    <div class="hidden lg:flex h-full items-stretch">
      <!-- Sisi Kiri -->
      <a href="#beranda" class="flex-1 flex justify-center items-center text-[12px] font-semibold tracking-widest uppercase hover:bg-[#423527]/5 transition-colors">Beranda</a>
      
      <a href="#menu" class="flex-1 flex justify-center items-center border-l border-[#423527]/30 text-[12px] font-semibold tracking-widest uppercase hover:bg-[#423527]/5 transition-colors">
        Menu Kita
        <svg class="ml-1.5 w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
      </a>

      <a href="#tentang" class="flex-1 flex justify-center items-center border-l border-[#423527]/30 text-[12px] font-semibold tracking-widest uppercase hover:bg-[#423527]/5 transition-colors">Tentang Kami</a>

      <!-- Bagian Tengah (Logo Raksasa) -->
      <!-- Menggunakan border kiri & kanan untuk mengurungnya -->
      <div class="flex-1 lg:flex-[2.5] flex justify-center items-center border-l border-r border-[#423527]/30">
        <span class="text-[40px] leading-none font-serif select-none tracking-tight">Sadena.</span>
      </div>

      <!-- Sisi Kanan -->
      <a href="#galeri" class="flex-1 flex justify-center items-center text-[12px] font-semibold tracking-widest uppercase hover:bg-[#423527]/5 transition-colors">Galeri</a>

      <a href="#reservasi" class="flex-1 flex justify-center items-center border-l border-[#423527]/30 text-[12px] font-semibold tracking-widest uppercase hover:bg-[#423527]/5 transition-colors">
        Reservasi
        <svg class="ml-1.5 w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
      </a>

      <a href="#kontak" class="flex-1 flex justify-center items-center border-l border-[#423527]/30 text-[12px] font-semibold tracking-widest uppercase hover:bg-[#423527]/5 transition-colors">Kontak Kami</a>
    </div>

    <!-- Mobile Toggle (Tetap dipertahankan untuk responsivitas) -->
    <div class="lg:hidden h-full flex items-center justify-between px-5">
      <button id="menu-toggle" type="button" aria-label="Buka menu navigasi" class="w-11 h-11 -ml-2 flex items-center justify-center rounded-full hover:bg-[#423527]/10 transition-colors">
        <svg id="icon-open" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        <svg id="icon-close" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
      <span class="text-[34px] leading-none font-serif select-none">Sadena.</span>
      <a href="#reservasi" class="w-11 h-11 -mr-2 flex items-center justify-center rounded-full hover:bg-[#423527]/10 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
      </a>
    </div>
  </nav>

  <!-- Panel menu mobile -->
  <div id="mobile-menu" class="fixed top-[80px] left-0 w-full z-[999] bg-[#fdf5eb] border-b border-[#423527]/30 hidden lg:hidden shadow-xl text-[#423527]">
    <nav class="flex flex-col">
      <a href="#beranda" class="px-6 py-4 border-b border-[#423527]/20 font-semibold tracking-wide uppercase text-sm hover:bg-[#423527]/5">Beranda</a>
      <a href="#menu" class="px-6 py-4 border-b border-[#423527]/20 font-semibold tracking-wide uppercase text-sm hover:bg-[#423527]/5">Menu Kita</a>
      <a href="#tentang" class="px-6 py-4 border-b border-[#423527]/20 font-semibold tracking-wide uppercase text-sm hover:bg-[#423527]/5">Tentang Kami</a>
      <a href="#galeri" class="px-6 py-4 border-b border-[#423527]/20 font-semibold tracking-wide uppercase text-sm hover:bg-[#423527]/5">Galeri</a>
      <a href="#reservasi" class="px-6 py-4 border-b border-[#423527]/20 font-semibold tracking-wide uppercase text-sm hover:bg-[#423527]/5">Reservasi</a>
      <a href="#kontak" class="px-6 py-4 font-semibold tracking-wide uppercase text-sm hover:bg-[#423527]/5">Kontak Kami</a>
    </nav>
  </div>
</header>