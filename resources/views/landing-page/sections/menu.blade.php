<style>
  /* Efek Animasi Muncul */
  @keyframes fade-in-up {
    0% { opacity: 0; transform: translateY(10px); }
    100% { opacity: 1; transform: translateY(0); }
  }

  /* ==================================================
     BASE CARD STYLE (Agar Semua Kartu Sama Ukurannya)
     ================================================== */
  .menu-card {
    height: 480px; /* TINGGI DIBUAT SAMA PERSIS UNTUK SEMUA KARTU */
    border-radius: 16px;
    display: flex;
    flex-direction: column;
    animation: fade-in-up 0.4s ease-out;
    transition: background-color 0.3s;
  }

  .menu-card-header { 
    padding: 32px 24px 20px; 
    flex-grow: 1; 
    display: flex; 
    flex-direction: column;
  }
  
  /* Ukuran Font Disamakan untuk Aktif dan Tidak Aktif */
  .menu-card-title { 
    font-family: 'Playfair Display', serif; 
    font-size: 28px; 
    margin-top: 24px; 
    margin-bottom: 12px; 
    line-height: 1.1; 
  }
  
  .menu-card-desc { 
    font-size: 14px; 
    line-height: 1.5; 
  }
  
  .menu-card-list { 
    display: flex; 
    flex-direction: column; 
    margin-top: auto; /* Mendorong list ke bagian paling bawah kartu */
  }
  
  .menu-card-list li { 
    padding: 14px 24px; 
    font-size: 14px; 
    font-weight: 500; 
  }

  /* ==================================================
     1. KARTU AKTIF (Slot Kiri)
     ================================================== */
  #active-card-slot .menu-card {
    background-color: #3b170b;
    color: #fdf5eb;
    width: 100%; /* Menyesuaikan lebar kolom kiri (340px) */
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  }
  #active-card-slot .menu-card-desc { opacity: 0.85; }
  #active-card-slot .menu-card-list li { border-top: 1px solid rgba(253, 245, 235, 0.2); }

  /* ==================================================
     2. KARTU TIDAK AKTIF (Slot Kanan)
     ================================================== */
  #inactive-cards-slot .menu-card {
    background-color: transparent;
    color: #462311;
    border: 1px solid rgba(70, 35, 17, 0.4);
    min-width: 380px; /* UBAH DI SINI JADI 380px */
    width: 380px;
    flex-shrink: 0;
    cursor: pointer;
  }
  #inactive-cards-slot .menu-card:hover { background-color: rgba(70, 35, 17, 0.05); }
  #inactive-cards-slot .menu-card-desc { opacity: 0.8; }
  #inactive-cards-slot .menu-card-list li { border-top: 1px solid rgba(70, 35, 17, 0.4); }
</style>

<section id="menu" class="w-full mx-auto px-6 lg:px-[72px] py-[80px] lg:py-[100px] text-[#462311]">
  
  <div class="grid grid-cols-1 lg:grid-cols-[380px_minmax(0,1fr)] gap-x-[60px] gap-y-[40px]">

    <!-- ================= KOLOM KIRI (Aktif) ================= -->
    <div class="order-2 lg:order-none lg:col-start-1 lg:row-start-1 lg:row-span-2 flex flex-col gap-8" data-reveal>
      
      <!-- Slot Utama Kiri -->
      <div id="active-card-slot" class="w-full">
        <!-- Kartu 1 (Default Aktif) -->
        <div class="menu-card" data-index="0">
          <div class="menu-card-header">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 10h16v2a8 8 0 0 1-16 0v-2z"/><path d="M8 10V6a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v4"/>
            </svg>
            <h3 class="menu-card-title">Hidangan Utama</h3>
            <p class="menu-card-desc">Mahakarya kuliner tradisional yang kaya akan rempah pilihan.</p>
          </div>
          <ul class="menu-card-list">
            @forelse($hidanganUtama as $index => $menu)
    <li>{{ $index + 1 }}. {{ $menu->nama_menu }}</li>
  @empty
    <li class="text-sm opacity-60">Belum ada menu tersedia</li>
  @endforelse
</ul>
        </div>
      </div>

      <!-- Teks & Navigasi Kiri Bawah -->
      <div>
        <p class="text-sm font-medium leading-relaxed max-w-[320px] mb-6">
          Hidangan yang diracik dengan penuh dedikasi menggunakan bahan-bahan segar berkualitas dan rempah asli Indonesia.
        </p>

        <!-- Tombol Carousel -->
        <div class="flex gap-3">
          <button id="menu-prev-btn" type="button" aria-label="Sebelumnya" 
                  class="w-12 h-12 rounded-full border border-[#462311]/40 flex items-center justify-center text-[#462311] hover:bg-[#462311] hover:text-[#fdf5eb] transition-colors">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
          </button>
          <button id="menu-next-btn" type="button" aria-label="Selanjutnya" 
                  class="w-12 h-12 rounded-full border border-[#462311]/40 flex items-center justify-center text-[#462311] hover:bg-[#462311] hover:text-[#fdf5eb] transition-colors">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
          </button>
        </div>
      </div>

    </div>

    <!-- ================= KOLOM KANAN ATAS (Judul) ================= -->
    <div class="order-1 lg:order-none lg:col-start-2 lg:row-start-1 flex flex-col justify-end pb-4" data-reveal>
      <div class="w-full flex lg:justify-end mb-6">
        <div class="border border-[#462311]/40 rounded-full px-5 py-1.5 text-sm inline-block">
          Jelajahi Menu Kami
        </div>
      </div>
      <h2 class="font-serif text-[clamp(40px,5vw,60px)] tracking-tight leading-[1] text-left lg:text-right">
        Temukan hidangan Nusantara favorit Anda
      </h2>
    </div>

    <!-- ================= KOLOM KANAN BAWAH (Carousel Tidak Aktif) ================= -->
    <div class="order-3 lg:order-none lg:col-start-2 lg:row-start-2 overflow-hidden" data-reveal>
      
      <!-- Track Kartu -->
      <div id="inactive-cards-slot" class="flex gap-6 overflow-x-auto no-scrollbar scroll-smooth pb-4">
        
        <!-- Kartu 2 -->
        <div class="menu-card" data-index="1">
          <div class="menu-card-header pointer-events-none">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 14a8 8 0 0 0 16 0"/><path d="M4 14h16"/><path d="M8 4v3"/><path d="M12 4v3"/><path d="M16 4v3"/>
            </svg>
            <h3 class="menu-card-title">Sajian Berkuah</h3>
            <p class="menu-card-desc">Kehangatan kuah kaldu tradisional yang memanjakan lidah.</p>
          </div>
          <ul class="menu-card-list pointer-events-none">
            @forelse($sajianBerkuah as $index => $menu)
    <li>{{ $index + 1 }}. {{ $menu->nama_menu }}</li>
  @empty
    <li class="text-sm opacity-60">Belum ada menu tersedia</li>
  @endforelse
</ul>
        </div>

        <!-- Kartu 3 -->
        <div class="menu-card" data-index="2">
          <div class="menu-card-header pointer-events-none">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="8"/><path d="M12 8a4 4 0 0 0 0 8 2 2 0 0 0 0-4"/>
            </svg>
            <h3 class="menu-card-title">Pencuci Mulut</h3>
            <p class="menu-card-desc">Penutup manis dari ragam jajanan khas nusantara.</p>
          </div>
          <ul class="menu-card-list pointer-events-none">
            @forelse($pencuciMulut as $index => $menu)
    <li>{{ $index + 1 }}. {{ $menu->nama_menu }}</li>
  @empty
    <li class="text-sm opacity-60">Belum ada menu tersedia</li>
  @endforelse
</ul>
        </div>

        <!-- Kartu 4 -->
        <div class="menu-card" data-index="3">
          <div class="menu-card-header pointer-events-none">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <rect x="6" y="5" width="12" height="14" rx="1"/><path d="M18 8h3a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-3"/><path d="M9 5V3"/><path d="M12 5V3"/><path d="M15 5V3"/>
            </svg>
            <h3 class="menu-card-title">Minuman Segar</h3>
            <p class="menu-card-desc">Kesegaran minuman tropis dan tradisional untuk melengkapi santapan Anda.</p>
          </div>
          <ul class="menu-card-list pointer-events-none">
            @forelse($minumanSegar as $index => $menu)
    <li>{{ $index + 1 }}. {{ $menu->nama_menu }}</li>
  @empty
    <li class="text-sm opacity-60">Belum ada menu tersedia</li>
  @endforelse
</ul>
        </div>

      </div>
    </div>

  </div>
</section>

<!-- ================= LOGIC JAVASCRIPT CAROUSEL ================= -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const activeSlot = document.getElementById('active-card-slot');
    const inactiveSlot = document.getElementById('inactive-cards-slot');
    const prevBtn = document.getElementById('menu-prev-btn');
    const nextBtn = document.getElementById('menu-next-btn');

    // Fungsi: Geser ke Kanan (Next)
    function moveNext() {
      const currentActive = activeSlot.querySelector('.menu-card');
      const firstInactive = inactiveSlot.firstElementChild;

      if (currentActive && firstInactive) {
        // Pindahkan kartu tidak aktif pertama ke slot aktif
        activeSlot.appendChild(firstInactive);
        // Pindahkan kartu aktif sebelumnya ke akhir barisan tidak aktif
        inactiveSlot.appendChild(currentActive);
        
        // Auto scroll kembali ke kiri ujung
        inactiveSlot.scrollTo({ left: 0, behavior: 'smooth' });
      }
    }

    // Fungsi: Geser ke Kiri (Prev)
    function movePrev() {
      const currentActive = activeSlot.querySelector('.menu-card');
      const lastInactive = inactiveSlot.lastElementChild;

      if (currentActive && lastInactive) {
        // Pindahkan kartu tidak aktif terakhir ke slot aktif
        activeSlot.appendChild(lastInactive);
        // Pindahkan kartu aktif sebelumnya ke awal barisan tidak aktif
        inactiveSlot.prepend(currentActive);
        
        inactiveSlot.scrollTo({ left: 0, behavior: 'smooth' });
      }
    }

    // Event Listener Tombol
    nextBtn.addEventListener('click', moveNext);
    prevBtn.addEventListener('click', movePrev);

    // Fitur Tambahan: Jika kartu tidak aktif diklik, langsung jadikan aktif
    inactiveSlot.addEventListener('click', (e) => {
      const clickedCard = e.target.closest('.menu-card');
      if (clickedCard) {
        const currentActive = activeSlot.querySelector('.menu-card');
        activeSlot.appendChild(clickedCard);
        inactiveSlot.appendChild(currentActive);
      }
    });
  });
</script>