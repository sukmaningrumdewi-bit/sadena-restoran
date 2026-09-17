<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sadena - Restoran Nusantara</title>
    
    <!-- 1. GOOGLE FONTS (Playfair Display & Inter) -->
    <!-- Google Fonts: Instrument Serif & Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- 2. TAILWIND CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- 3. TAILWIND CONFIGURATION -->
    <script>
        tailwind.config = {
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
                serif: ['Instrument Serif', 'serif'], // <--- Diubah ke Instrument Serif
            },
                    colors: {
                        brand: {
                            bg: '#FAD1A3',   /* Warna Cream */
                            text: '#423527', /* Warna Coklat Gelap */
                            accent: '#c2593b' /* Warna Terracotta/Orange */
                        }
                    }
                }
            }
        }
    </script>

    <!-- 4. CUSTOM CSS UNTUK KOMPONEN & ANIMASI -->
    <style type="text/tailwindcss">
        @layer utilities {
            /* Sembunyikan Scrollbar untuk Carousel Menu & Reviews */
            .hide-scrollbar::-webkit-scrollbar, .no-scrollbar::-webkit-scrollbar { display: none; }
            .hide-scrollbar, .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        }

        @layer components {
            /* Desain Base Body */
            body { @apply bg-brand-bg text-brand-text font-sans overflow-x-hidden; }
            
            /* Komponen Badge (Pill) */
            .badge-style { @apply border border-brand-text/40 rounded-full px-5 py-1.5 text-[14px] text-brand-text inline-block; }
            .badge-light { @apply border border-[#fdf5eb]/40 rounded-full px-5 py-1.5 text-[14px] text-[#fdf5eb] inline-block; }
            
            /* Komponen Tombol */
            .btn-primary { @apply bg-brand-accent hover:bg-[#a54930] text-[#fdf5eb] text-[13px] lg:text-[14px] font-bold px-9 py-4 rounded-full uppercase tracking-wider transition-colors inline-block shadow-sm; }
            
            /* Komponen Navbar Link */
            .nav-link { @apply flex-1 flex justify-center items-center border-l border-brand-text text-[13px] font-bold uppercase tracking-widest text-brand-text hover:bg-brand-text/5 transition-colors; }
        }

        /* ANIMASI GALERI BERJALAN */
        @keyframes scroll-left {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .galeri-track {
            width: max-content;
            animation: scroll-left 35s linear infinite;
        }
        .galeri-track:hover {
            animation-play-state: paused;
        }
    </style>
</head>
<body class="bg-brand-bg text-brand-text pt-[80px]">
    
    <!-- MEMANGGIL NAVBAR -->
    @include('landing-page.partials.navbar')

    <!-- KONTEN UTAMA (Hero, Tentang, Menu, dll) -->
    <main>
        @yield('content')
    </main>

    <!-- MEMANGGIL FOOTER -->
    @include('landing-page.partials.footer')

    <!-- 5. JAVASCRIPT INTERAKTIF -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // A. TOGGLE MENU MOBILE
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const iconOpen = document.getElementById('icon-open');
            const iconClose = document.getElementById('icon-close');

            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', () => {
                    const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
                    menuToggle.setAttribute('aria-expanded', !isExpanded);
                    mobileMenu.classList.toggle('hidden');
                    iconOpen.classList.toggle('hidden');
                    iconClose.classList.toggle('hidden');
                });
                
                // Tutup menu saat link diklik
                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                        iconOpen.classList.remove('hidden');
                        iconClose.classList.add('hidden');
                        menuToggle.setAttribute('aria-expanded', 'false');
                    });
                });
            }

            // B. ANIMASI FADE-UP SAAT SCROLL (Untuk elemen dengan data-reveal)
            const observerOptions = { root: null, rootMargin: '0px', threshold: 0.15 };
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-12');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('[data-reveal]').forEach(el => {
                // Set state awal tersembunyi
                el.classList.add('opacity-0', 'translate-y-12', 'transition-all', 'duration-[800ms]', 'ease-out');
                observer.observe(el);
            });
        });
    </script>
</body>
</html>