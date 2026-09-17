<!-- ================= FOOTER ================= -->
<!-- Menggunakan warna latar coklat super gelap agar kontras dengan teks krem -->
<footer class="bg-[#3b170b] text-[#fdf5eb] overflow-hidden">
  
  <!-- Container Utama dengan pembagian 2 kolom di layar besar -->
  <div class="max-w-[1500px] mx-auto px-6 lg:px-12 flex flex-col lg:flex-row">
    
    <!-- KOLOM KIRI: Logo & Social Media -->
    <!-- Di desktop diberi border kanan (lg:border-r) -->
    <div class="w-full lg:w-[45%] py-16 lg:py-24 lg:border-r border-[#fdf5eb]/10 lg:pr-16 flex flex-col justify-between">
      
      <!-- Logo Sadena Raksasa -->
      <h2 class="font-serif text-[clamp(60px,12vw,150px)] leading-[0.8] tracking-tighter uppercase mb-16 lg:mb-0">
        Sadena<span class="text-[#c2593b]">.</span>
      </h2>

      <!-- Social Media -->s
      <div class="mt-auto pt-10">
        <h3 class="font-serif text-[28px] mb-6">Social Media</h3>
        <div class="flex gap-4">
          <!-- Icon Facebook -->
          <a href="#" class="w-11 h-11 rounded-full border border-[#fdf5eb]/20 flex items-center justify-center text-[#fdf5eb]/80 hover:bg-[#fdf5eb]/10 hover:text-[#fdf5eb] hover:border-[#fdf5eb] transition-all duration-300">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.597 0 0 .597 0 1.325v21.351C0 23.403.597 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.597 1.323-1.324V1.325C24 .597 23.403 0 22.675 0z"/></svg>
          </a>
          <!-- Icon Instagram -->
          <a href="#" class="w-11 h-11 rounded-full border border-[#fdf5eb]/20 flex items-center justify-center text-[#fdf5eb]/80 hover:bg-[#fdf5eb]/10 hover:text-[#fdf5eb] hover:border-[#fdf5eb] transition-all duration-300">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
          </a>
          <!-- Icon LinkedIn -->
          <a href="#" class="w-11 h-11 rounded-full border border-[#fdf5eb]/20 flex items-center justify-center text-[#fdf5eb]/80 hover:bg-[#fdf5eb]/10 hover:text-[#fdf5eb] hover:border-[#fdf5eb] transition-all duration-300">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/></svg>
          </a>
        </div>
      </div>
    </div>

    <!-- KOLOM KANAN: Newsletter & Navigasi -->
    <div class="w-full lg:w-[55%] py-16 lg:py-24 lg:pl-16 flex flex-col justify-between">
      
      <!-- Newsletter Section -->
      <div>
        <h3 class="font-serif text-[28px] lg:text-[34px] leading-tight mb-2">Get tasty news straight to your inbox</h3>
        <p class="font-sans text-[14px] text-[#fdf5eb]/60 mb-8">No spam — just fresh updates, special offers, and mouthwatering news.</p>
        
        <!-- Form Email Wrapper -->
        <form class="relative flex items-center w-full max-w-xl bg-[#fdf5eb]/5 border border-[#fdf5eb]/10 rounded-full p-1.5 focus-within:border-[#fdf5eb]/30 transition-colors">
          <input 
            type="email" 
            placeholder="Write your email ..." 
            class="flex-1 bg-transparent border-none text-[#fdf5eb] px-5 py-2 text-[15px] focus:outline-none placeholder:text-[#fdf5eb]/30 w-full"
            required
          >
          <button 
            type="submit" 
            class="bg-[#AA4A27] hover:bg-[#a54930] text-[#fdf5eb] text-[13px] font-bold px-7 py-3.5 rounded-full uppercase tracking-wider transition-colors shrink-0"
          >
            Subscribe Now
          </button>
        </form>
      </div>

      <!-- Navigasi Links (Dibatasi garis atas) -->
      <div class="mt-16 pt-12 border-t border-[#fdf5eb]/10">
        <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-y-6 gap-x-4">
          <li><a href="#" class="text-[14px] text-[#fdf5eb]/70 hover:text-[#fdf5eb] transition-colors"><span class="text-[#fdf5eb]/40 mr-1">1.</span> Home</a></li>
          <li><a href="#" class="text-[14px] text-[#fdf5eb]/70 hover:text-[#fdf5eb] transition-colors"><span class="text-[#fdf5eb]/40 mr-1">2.</span> About Us</a></li>
          <li><a href="#" class="text-[14px] text-[#fdf5eb]/70 hover:text-[#fdf5eb] transition-colors"><span class="text-[#fdf5eb]/40 mr-1">3.</span> Our Menu</a></li>
          <li><a href="#" class="text-[14px] text-[#fdf5eb]/70 hover:text-[#fdf5eb] transition-colors"><span class="text-[#fdf5eb]/40 mr-1">4.</span> Gallery</a></li>
          <li><a href="#" class="text-[14px] text-[#fdf5eb]/70 hover:text-[#fdf5eb] transition-colors"><span class="text-[#fdf5eb]/40 mr-1">5.</span> Contact</a></li>
          <li><a href="#" class="text-[14px] text-[#fdf5eb]/70 hover:text-[#fdf5eb] transition-colors"><span class="text-[#fdf5eb]/40 mr-1">6.</span> Book a Table</a></li>
          <li><a href="#" class="text-[14px] text-[#fdf5eb]/70 hover:text-[#fdf5eb] transition-colors"><span class="text-[#fdf5eb]/40 mr-1">7.</span> Events</a></li>
          <li><a href="#" class="text-[14px] text-[#fdf5eb]/70 hover:text-[#fdf5eb] transition-colors"><span class="text-[#fdf5eb]/40 mr-1">8.</span> Careers</a></li>
          <li><a href="#" class="text-[14px] text-[#fdf5eb]/70 hover:text-[#fdf5eb] transition-colors"><span class="text-[#fdf5eb]/40 mr-1">9.</span> Blogs</a></li>
        </ul>
      </div>

    </div>
  </div>

  <!-- Baris Paling Bawah (Copyright & Kebijakan) -->
  <div class="border-t border-[#fdf5eb]/10">
    <div class="max-w-[1500px] mx-auto px-6 lg:px-12 py-6 flex flex-col md:flex-row justify-between items-center gap-4 text-[13px] text-[#fdf5eb]/50">
      <p>All the rights reserved to ©Sadena 2025</p>
      <div class="flex gap-4">
        <a href="#" class="hover:text-[#fdf5eb] transition-colors">Terms & Condition</a>
        <span>•</span>
        <a href="#" class="hover:text-[#fdf5eb] transition-colors">Privacy Policy</a>
      </div>
    </div>
  </div>

</footer>