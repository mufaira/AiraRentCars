<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo e(config('app.name', 'DriveHub')); ?> - Sewa Mobil Terpercaya</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        <style>
            body { font-family: 'Outfit', sans-serif; }
            .glass-nav {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }
            .dark .glass-nav {
                background: rgba(0, 0, 0, 0.9);
            }
            .text-gradient {
                background: linear-gradient(to right, #f53003, #ff8c00);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            /* Force dark mode on all elements */
            :root.dark {
                color-scheme: dark;
            }
            
            :root.dark body {
                background-color: #000000 !important;
                color: #ffffff !important;
            }
        </style>
        <script>
            // Force dark mode always
            document.documentElement.classList.add('dark');
            document.documentElement.style.colorScheme = 'dark';
            localStorage.setItem('theme', 'dark');
        </script>
    </head>
    <body class="bg-gray-50 dark:bg-black text-[#1b1b18] dark:text-white antialiased selection:bg-[#f53003] selection:text-white">

        <header class="fixed top-0 z-50 w-full glass-nav border-b border-gray-200/50 dark:border-white/10 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 sm:h-20">
                    <a href="#home" class="flex items-center gap-2 group cursor-pointer flex-shrink-0">
                        <div class="bg-[#f53003] text-white p-1.5 sm:p-2 rounded-lg transform group-hover:rotate-12 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-lg sm:text-2xl font-extrabold tracking-tight whitespace-nowrap">Drive<span class="text-[#f53003]">Hub</span></span>
                    </a>

                    <nav class="hidden md:flex items-center gap-8">
                        <a href="#home" class="text-sm font-medium hover:text-[#f53003] transition">Beranda</a>
                        <a href="#features" class="text-sm font-medium hover:text-[#f53003] transition">Fitur</a>
                        <a href="<?php echo e(route('cars.catalog')); ?>" class="text-sm font-medium hover:text-[#f53003] transition">Katalog</a>
                        <a href="#reservasi" class="text-sm font-medium hover:text-[#f53003] transition">Cara Pesan</a>
                    </nav>

                    <div class="flex items-center gap-2 sm:gap-3">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(url('/dashboard')); ?>" class="hidden sm:block px-4 py-2.5 text-sm font-bold text-white bg-[#f53003] rounded-full hover:bg-[#d63000] hover:shadow-lg hover:shadow-orange-500/30 transition transform hover:-translate-y-0.5">
                                Dashboard
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="hidden sm:block text-sm font-bold text-gray-900 dark:text-white hover:text-[#f53003] transition">
                                Masuk
                            </a>
                            <?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>" class="hidden sm:block px-4 py-2 text-sm font-bold text-white bg-[#1b1b18] dark:bg-white dark:text-black rounded-full hover:shadow-lg transition">
                                    Daftar
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <button id="mobileMenuBtn" class="md:hidden p-2 text-gray-900 dark:text-white hover:text-[#f53003] transition rounded-lg">
                            <svg id="menuIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 6a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V6zM3 12a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zM3 18a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" />
                            </svg>
                            <svg id="closeIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.293 4.293a1 1 0 011.414 0L12 10.586l6.293-6.293a1 1 0 111.414 1.414L13.414 12l6.293 6.293a1 1 0 01-1.414 1.414L12 13.414l-6.293 6.293a1 1 0 01-1.414-1.414L10.586 12 4.293 5.707a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div id="mobileMenu" class="hidden md:hidden border-t border-gray-200/50 dark:border-white/10 py-4 space-y-3">
                    <a href="#home" class="block px-4 py-2 text-sm font-medium hover:text-[#f53003] hover:bg-gray-100/10 rounded transition">Beranda</a>
                    <a href="#features" class="block px-4 py-2 text-sm font-medium hover:text-[#f53003] hover:bg-gray-100/10 rounded transition">Fitur</a>
                    <a href="<?php echo e(route('cars.catalog')); ?>" class="block px-4 py-2 text-sm font-medium hover:text-[#f53003] hover:bg-gray-100/10 rounded transition">Katalog</a>
                    <a href="#reservasi" class="block px-4 py-2 text-sm font-medium hover:text-[#f53003] hover:bg-gray-100/10 rounded transition">Cara Pesan</a>
                    <?php if(auth()->guard()->guest()): ?>
                        <div class="border-t border-gray-200/50 dark:border-white/10 pt-3 space-y-2">
                            <a href="<?php echo e(route('login')); ?>" class="block px-4 py-2 text-sm font-bold text-gray-900 dark:text-white hover:text-[#f53003] transition">Masuk</a>
                            <?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>" class="block px-4 py-2 text-sm font-bold text-white bg-[#f53003] rounded-lg hover:bg-[#d63000] transition">Daftar</a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="border-t border-gray-200/50 dark:border-white/10 pt-3">
                            <a href="<?php echo e(url('/dashboard')); ?>" class="block px-4 py-2 text-sm font-bold text-white bg-[#f53003] rounded-lg hover:bg-[#d63000] transition">Dashboard</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <script>
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const menuIcon = document.getElementById('menuIcon');
            const closeIcon = document.getElementById('closeIcon');

            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });

            // Close menu when clicking on a link
            document.querySelectorAll('#mobileMenu a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                });
            });
        </script>

        <section id="home" class="relative w-full h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=2000&auto=format&fit=crop" alt="Luxury Car" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/60 to-transparent"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-20">
                <div class="max-w-2xl animate-fade-in-up">
                    <span class="inline-block py-1 px-3 rounded-full bg-[#f53003]/20 border border-[#f53003] text-[#f53003] font-bold text-xs mb-4 sm:mb-6 uppercase tracking-wider">
                        🚗 Rental Mobil #1 Indonesia
                    </span>
                    <h1 class="text-3xl sm:text-5xl lg:text-7xl font-extrabold text-white mb-4 sm:mb-6 leading-tight">
                        Jelajahi Dunia <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f53003] to-[#ff8c00]">Tanpa Batas.</span>
                    </h1>
                    <p class="text-base sm:text-lg text-gray-300 mb-6 sm:mb-8 leading-relaxed max-w-lg">
                        Nikmati kebebasan berkendara dengan armada premium, harga transparan, dan layanan 24/7. Perjalanan impian Anda dimulai di sini.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <a href="<?php echo e(route('cars.catalog')); ?>" class="px-6 sm:px-8 py-3 sm:py-4 bg-[#f53003] text-white font-bold rounded-xl shadow-lg shadow-orange-600/40 hover:bg-[#d63000] hover:scale-105 transition duration-300 text-center text-sm sm:text-base">
                            Lihat Katalog Mobil
                        </a>
                        <a href="#reservasi" class="px-6 sm:px-8 py-3 sm:py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white font-bold rounded-xl hover:bg-white hover:text-black transition duration-300 text-center text-sm sm:text-base">
                            Cara Pemesanan
                        </a>
                    </div>
                    
                    <div class="mt-8 sm:mt-12 flex flex-wrap items-center gap-4 sm:gap-8 border-t border-white/10 pt-6 sm:pt-8">
                        <div>
                            <p class="text-2xl sm:text-3xl font-bold text-white">500+</p>
                            <p class="text-xs sm:text-sm text-gray-400">Armada Mobil</p>
                        </div>
                        <div class="hidden sm:block w-px h-10 bg-white/20"></div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-bold text-white">24/7</p>
                            <p class="text-xs sm:text-sm text-gray-400">Support</p>
                        </div>
                        <div class="hidden sm:block w-px h-10 bg-white/20"></div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-bold text-white">10k+</p>
                            <p class="text-xs sm:text-sm text-gray-400">User Happy</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="bg-white dark:bg-[#161615] py-6 sm:py-8 border-b border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-xs sm:text-sm text-gray-500 mb-4 font-medium uppercase tracking-widest">Dipercaya oleh Brand Ternama</p>
                <div class="flex flex-wrap justify-center gap-4 sm:gap-8 lg:gap-16 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                    <span class="text-lg sm:text-xl font-black text-gray-800 dark:text-white">TOYOTA</span>
                    <span class="text-lg sm:text-xl font-black text-gray-800 dark:text-white">HONDA</span>
                    <span class="hidden sm:inline text-lg sm:text-xl font-black text-gray-800 dark:text-white">BMW</span>
                    <span class="hidden md:inline text-lg sm:text-xl font-black text-gray-800 dark:text-white">MERCEDES</span>
                    <span class="text-lg sm:text-xl font-black text-gray-800 dark:text-white">HYUNDAI</span>
                </div>
            </div>
        </div>

        <section id="features" class="py-24 lg:py-32 bg-gray-50 dark:bg-black">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-[#f53003] font-bold uppercase tracking-wider text-xs sm:text-sm mb-2">Kenapa DriveHub?</h2>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 dark:text-white mb-3 sm:mb-4">Pengalaman Sewa Terbaik</h2>
                    <p class="text-sm sm:text-base text-gray-500 dark:text-gray-300">Kami tidak hanya menyewakan mobil, kami memberikan pengalaman perjalanan yang aman dan nyaman.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                    <div class="group bg-white dark:bg-[#1a1a1a] p-6 sm:p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-white/10 hover:-translate-y-2">
                        <div class="w-12 sm:w-14 h-12 sm:h-14 bg-orange-100 dark:bg-orange-900/30 rounded-xl flex items-center justify-center mb-4 text-[#f53003] group-hover:scale-110 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 sm:h-8 w-6 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold mb-2 text-gray-900 dark:text-white">Harga Transparan</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">Tidak ada biaya tersembunyi. Harga yang Anda lihat adalah harga yang Anda bayar.</p>
                    </div>

                    <div class="group bg-white dark:bg-[#1a1a1a] p-6 sm:p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-white/10 hover:-translate-y-2">
                        <div class="w-12 sm:w-14 h-12 sm:h-14 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-4 text-blue-600 group-hover:scale-110 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 sm:h-8 w-6 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold mb-2 text-gray-900 dark:text-white">Asuransi All-Risk</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">Berkendara dengan tenang. Setiap perjalanan dilindungi asuransi komprehensif.</p>
                    </div>

                    <div class="group bg-white dark:bg-[#1a1a1a] p-6 sm:p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-white/10 hover:-translate-y-2">
                        <div class="w-12 sm:w-14 h-12 sm:h-14 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center mb-4 text-green-600 group-hover:scale-110 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 sm:h-8 w-6 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold mb-2 text-gray-900 dark:text-white">Proses Cepat</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">Booking online dalam hitungan menit. Verifikasi data otomatis dan instan.</p>
                    </div>

                    <div class="group bg-white dark:bg-[#1a1a1a] p-6 sm:p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-white/10 hover:-translate-y-2">
                        <div class="w-12 sm:w-14 h-12 sm:h-14 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mb-4 text-purple-600 group-hover:scale-110 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 sm:h-8 w-6 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold mb-2 text-gray-900 dark:text-white">Antar Jemput</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">Kami antar mobil ke lokasi Anda, baik di bandara, hotel, maupun rumah.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 sm:py-24 lg:py-32 bg-white dark:bg-black">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
                    <div class="max-w-2xl">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mb-3 sm:mb-4">Armada <span class="text-gradient">Pilihan</span></h2>
                        <p class="text-sm sm:text-base lg:text-lg text-gray-500 dark:text-gray-300">Temukan kendaraan yang sesuai dengan gaya dan kebutuhan perjalanan Anda.</p>
                    </div>
                    <a href="<?php echo e(route('cars.catalog')); ?>" class="hidden md:inline-flex items-center gap-2 text-[#f53003] font-bold hover:gap-4 transition-all">
                        Lihat Semua Mobil 
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </a>
                </div>

                <?php
                    $cars = \App\Models\Car::where('is_active', true)->inRandomOrder()->limit(6)->get();
                ?>

                <?php if($cars->count() > 0): ?>
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                        <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="group relative bg-gray-50 dark:bg-[#1a1a1a] rounded-2xl overflow-hidden hover:shadow-2xl hover:shadow-orange-500/10 transition-all duration-300 hover:-translate-y-2 border border-transparent dark:border-white/5 dark:hover:border-[#f53003]/30">
                                <div class="relative h-40 sm:h-44 md:h-48 w-full overflow-hidden bg-gray-800">
                                    <?php if($car->featured_photo): ?>
                                        <img src="<?php echo e(asset('storage/' . $car->featured_photo->photo_path)); ?>" alt="<?php echo e($car->name); ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-700 to-gray-900">
                                            <div class="text-center">
                                                <svg class="w-12 h-12 text-gray-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                <span class="text-gray-400 text-sm">Belum ada foto</span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="absolute top-4 right-4 bg-white/90 dark:bg-black/80 backdrop-blur-sm px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider text-[#1b1b18] dark:text-white shadow-sm">
                                        <?php echo e($car->brand ?? 'Premium'); ?>

                                    </div>
                                </div>
                                
                                <div class="p-3 sm:p-4 md:p-6">
                                    <h3 class="text-sm sm:text-base md:text-lg font-bold text-gray-900 dark:text-white mb-2"><?php echo e($car->name); ?></h3>
                                    <div class="flex items-center gap-2 sm:gap-4 text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-4 sm:mb-6">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            <?php echo e($car->capacity); ?> Kursi
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <?php echo e($car->transmission); ?>

                                        </span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between pt-3 sm:pt-4 border-t border-gray-200 dark:border-white/10">
                                        <div>
                                            <p class="text-xs text-gray-400 uppercase">Harga per Hari</p>
                                            <p class="text-base sm:text-lg md:text-xl font-extrabold text-[#f53003]">Rp <?php echo e(number_format($car->price_per_day, 0, ',', '.')); ?></p>
                                        </div>
                                        <a href="<?php echo e(route('cars.detail', $car->id)); ?>" class="p-3 bg-black dark:bg-white text-white dark:text-black rounded-xl hover:bg-[#f53003] hover:text-white dark:hover:bg-[#f53003] dark:hover:text-white transition shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                        <p class="text-gray-500">Belum ada armada yang tersedia saat ini.</p>
                    </div>
                <?php endif; ?>
                
                <div class="mt-12 text-center md:hidden">
                    <a href="<?php echo e(route('cars.catalog')); ?>" class="px-6 py-3 bg-[#f53003] text-white font-bold rounded-lg w-full block">
                        Lihat Semua Mobil
                    </a>
                </div>
            </div>
        </section>

        <section id="reservasi" class="py-32 lg:py-40 bg-gradient-to-br from-[#1b1b18] to-black text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#f53003] rounded-full mix-blend-multiply filter blur-[128px] opacity-20"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-extrabold mb-4">Cara Mudah Sewa Mobil</h2>
                    <p class="text-gray-400">4 Langkah sederhana menuju perjalanan impian Anda</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 relative">
                    <div class="hidden md:block absolute top-12 left-[10%] w-[80%] h-0.5 bg-gradient-to-r from-gray-800 via-[#f53003] to-gray-800 z-0"></div>

                    <div class="relative z-10 text-center">
                        <div class="w-16 sm:w-20 md:w-24 h-16 sm:h-20 md:h-24 mx-auto bg-[#1b1b18] border-4 border-[#f53003] rounded-full flex items-center justify-center text-2xl sm:text-3xl font-bold mb-3 sm:mb-4 md:mb-6 shadow-[0_0_20px_rgba(245,48,3,0.3)]">1</div>
                        <h3 class="text-base sm:text-lg md:text-xl font-bold mb-1 sm:mb-2">Pilih Mobil</h3>
                        <p class="text-xs sm:text-sm text-gray-400 px-2 sm:px-4">Telusuri katalog lengkap kami dan pilih kendaraan yang pas.</p>
                    </div>

                    <div class="relative z-10 text-center">
                        <div class="w-16 sm:w-20 md:w-24 h-16 sm:h-20 md:h-24 mx-auto bg-[#1b1b18] border-4 border-gray-700 hover:border-[#f53003] transition duration-300 rounded-full flex items-center justify-center text-2xl sm:text-3xl font-bold mb-3 sm:mb-4 md:mb-6">2</div>
                        <h3 class="text-base sm:text-lg md:text-xl font-bold mb-1 sm:mb-2">Atur Jadwal</h3>
                        <p class="text-xs sm:text-sm text-gray-400 px-2 sm:px-4">Tentukan tanggal pengambilan dan pengembalian.</p>
                    </div>

                    <div class="relative z-10 text-center">
                        <div class="w-16 sm:w-20 md:w-24 h-16 sm:h-20 md:h-24 mx-auto bg-[#1b1b18] border-4 border-gray-700 hover:border-[#f53003] transition duration-300 rounded-full flex items-center justify-center text-2xl sm:text-3xl font-bold mb-3 sm:mb-4 md:mb-6">3</div>
                        <h3 class="text-base sm:text-lg md:text-xl font-bold mb-1 sm:mb-2">Booking</h3>
                        <p class="text-xs sm:text-sm text-gray-400 px-2 sm:px-4">Isi data diri singkat dan lakukan pembayaran aman.</p>
                    </div>

                    <div class="relative z-10 text-center">
                        <div class="w-16 sm:w-20 md:w-24 h-16 sm:h-20 md:h-24 mx-auto bg-[#1b1b18] border-4 border-gray-700 hover:border-[#f53003] transition duration-300 rounded-full flex items-center justify-center text-2xl sm:text-3xl font-bold mb-3 sm:mb-4 md:mb-6">4</div>
                        <h3 class="text-base sm:text-lg md:text-xl font-bold mb-1 sm:mb-2">Jalan!</h3>
                        <p class="text-xs sm:text-sm text-gray-400 px-2 sm:px-4">Terima kunci mobil dan nikmati perjalanan Anda.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 lg:py-32 bg-gray-50 dark:bg-black">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-16">
                    <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white">Tips & Berita</h2>
                    <a href="<?php echo e(route('blogs.index')); ?>" class="text-[#f53003] font-semibold hover:underline">Lihat Semua &rarr;</a>
                </div>

                <?php
                    $latestBlogs = \App\Models\Blog::where('is_published', true)->latest('published_at')->limit(3)->get();
                ?>

                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                    <?php $__empty_1 = true; $__currentLoopData = $latestBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <article class="flex flex-col group h-full">
                            <div class="relative overflow-hidden rounded-2xl mb-4 h-40 sm:h-48 md:h-64">
                                <?php if($blog->featured_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $blog->featured_image)); ?>" alt="<?php echo e($blog->title); ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                                <?php else: ?>
                                    <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                                <?php endif; ?>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition"></div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 text-xs text-[#f53003] font-bold uppercase tracking-wider mb-2">
                                    <span>News</span>
                                    <span>&bull;</span>
                                    <span><?php echo e($blog->published_at->format('d M Y')); ?></span>
                                </div>
                                <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-[#f53003] transition">
                                    <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                </h3>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-gray-500 dark:text-gray-400 col-span-3 text-center">Belum ada artikel terbaru.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="py-24 lg:py-32 bg-[#f53003] text-white">
            <div class="max-w-5xl mx-auto px-4 text-center">
                <h2 class="text-4xl lg:text-5xl font-extrabold mb-8">Siap Memulai Petualangan?</h2>
                <p class="text-xl opacity-90 mb-10 max-w-2xl mx-auto">Jangan biarkan rencana perjalanan Anda tertunda. Dapatkan mobil terbaik dengan harga spesial hari ini.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="<?php echo e(route('cars.catalog')); ?>" class="px-10 py-4 bg-white text-[#f53003] font-bold rounded-xl shadow-xl hover:bg-gray-100 transform hover:-translate-y-1 transition">
                        Sewa Mobil Sekarang
                    </a>
                    <a href="https://wa.me/62812345678" target="_blank" class="px-10 py-4 border-2 border-white text-white font-bold rounded-xl hover:bg-white/10 transition">
                        Chat WhatsApp
                    </a>
                </div>
            </div>
        </section>

        <footer class="bg-black text-gray-400 py-16 lg:py-20 border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 lg:gap-12 mb-12">
                    <div>
                        <div class="text-lg sm:text-xl md:text-2xl font-extrabold text-white mb-4 sm:mb-6">Drive<span class="text-[#f53003]">Hub</span></div>
                        <p class="mb-4 sm:mb-6 leading-relaxed text-gray-400 text-xs sm:text-sm">Platform penyewaan mobil paling inovatif di Indonesia. Kami mengutamakan kenyamanan, keamanan, dan kepuasan pelanggan di setiap kilometer.</p>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Navigasi</h4>
                        <ul class="space-y-3">
                            <li><a href="#home" class="text-gray-400 hover:text-[#f53003] transition">Beranda</a></li>
                            <li><a href="<?php echo e(route('cars.catalog')); ?>" class="text-gray-400 hover:text-[#f53003] transition">Armada</a></li>
                            <li><a href="<?php echo e(route('blogs.index')); ?>" class="text-gray-400 hover:text-[#f53003] transition">Blog</a></li>
                            <li><a href="#reservasi" class="text-gray-400 hover:text-[#f53003] transition">Cara Sewa</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Bantuan</h4>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-400 hover:text-[#f53003] transition">FAQ</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-[#f53003] transition">Syarat & Ketentuan</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-[#f53003] transition">Kebijakan Privasi</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-[#f53003] transition">Hubungi Support</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Kontak</h4>
                        <p class="mb-2 text-white">Jakarta, Indonesia</p>
                        <p class="mb-2 text-gray-400 hover:text-[#f53003] cursor-pointer">+62 812 3456 7890</p>
                        <p class="text-gray-400 hover:text-[#f53003] cursor-pointer">hello@drivehub.com</p>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                    <p>&copy; 2024 DriveHub Indonesia. All rights reserved.</p>
                    <div class="flex gap-4 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white transition">Instagram</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">Twitter</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">LinkedIn</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html><?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/welcome.blade.php ENDPATH**/ ?>