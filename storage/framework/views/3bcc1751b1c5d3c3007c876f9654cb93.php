<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Katalog Mobil - DriveHub</title>

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
    <body class="bg-black dark:bg-black text-white dark:text-white antialiased selection:bg-[#f53003] selection:text-white">

        <header class="fixed top-0 z-50 w-full glass-nav border-b border-gray-200/50 dark:border-white/10 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <a href="/" class="flex items-center gap-2 group cursor-pointer">
                        <div class="bg-[#f53003] text-white p-2 rounded-lg transform group-hover:rotate-12 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-extrabold tracking-tight">Drive<span class="text-[#f53003]">Hub</span></span>
                    </a>

                    <nav class="hidden md:flex items-center gap-8">
                        <a href="/" class="text-sm font-medium hover:text-[#f53003] transition">Beranda</a>
                        <a href="<?php echo e(route('cars.catalog')); ?>" class="text-sm font-medium text-[#f53003]">Katalog</a>
                        <a href="/#reservasi" class="text-sm font-medium hover:text-[#f53003] transition">Cara Pesan</a>
                    </nav>

                    <div class="flex items-center gap-4">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(url('/dashboard')); ?>" class="px-5 py-2.5 text-sm font-bold text-white bg-[#f53003] rounded-full hover:bg-[#d63000] hover:shadow-lg hover:shadow-orange-500/30 transition transform hover:-translate-y-0.5">
                                Dashboard
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="hidden sm:block text-sm font-bold hover:text-[#f53003] transition">
                                Masuk
                            </a>
                            <?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>" class="px-5 py-2.5 text-sm font-bold text-black bg-white rounded-full hover:bg-gray-200 hover:shadow-lg transition transform hover:-translate-y-0.5">
                                    Daftar Sekarang
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>

        <main class="pt-32 pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Breadcrumb -->
                <div class="mb-8">
                    <a href="/" class="text-[#f53003] hover:text-[#ff8c00] font-medium text-sm">← Kembali ke Beranda</a>
                </div>

                <!-- Header -->
                <div class="mb-12">
                    <h1 class="text-5xl lg:text-6xl font-extrabold text-white mb-4">Katalog <span class="text-gradient">Mobil</span></h1>
                    <p class="text-gray-300 text-lg max-w-2xl">Temukan kendaraan impian Anda dari armada premium kami. Filter berdasarkan kebutuhan dan budget Anda.</p>
                </div>

                <!-- Filter Section -->
                <div class="bg-black dark:bg-[#1a1a1a] rounded-2xl border border-white/10 p-8 mb-12">
                    <h2 class="text-xl font-bold text-white mb-6">Filter Mobil</h2>
                    <form action="<?php echo e(route('cars.catalog')); ?>" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">Status</label>
                            <select name="status" class="w-full bg-[#1a1a1a] border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition">
                                <option value="" class="bg-black">Semua Status</option>
                                <option value="Tersedia" <?php echo e(request('status') === 'Tersedia' ? 'selected' : ''); ?> class="bg-black">Tersedia</option>
                                <option value="Disewa" <?php echo e(request('status') === 'Disewa' ? 'selected' : ''); ?> class="bg-black">Disewa</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">Transmisi</label>
                            <select name="type" class="w-full bg-[#1a1a1a] border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition">
                                <option value="" class="bg-black">Semua Tipe</option>
                                <option value="Manual" <?php echo e(request('type') === 'Manual' ? 'selected' : ''); ?> class="bg-black">Manual</option>
                                <option value="Matic" <?php echo e(request('type') === 'Matic' ? 'selected' : ''); ?> class="bg-black">Matic</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">Harga Min (Rp)</label>
                            <input type="number" name="min_price" class="w-full bg-[#1a1a1a] border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" 
                                   value="<?php echo e(request('min_price')); ?>" placeholder="0">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">Harga Max (Rp)</label>
                            <input type="number" name="max_price" class="w-full bg-[#1a1a1a] border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" 
                                   value="<?php echo e(request('max_price')); ?>" placeholder="999999999">
                        </div>

                        <div class="flex gap-3 items-end">
                            <button type="submit" class="flex-1 bg-[#f53003] hover:bg-[#d63000] text-white font-bold px-4 py-2.5 rounded-lg transition transform hover:-translate-y-0.5 shadow-lg">
                                Filter
                            </button>
                            <?php if(request()->filled('status') || request()->filled('type') || request()->filled('min_price') || request()->filled('max_price')): ?>
                                <a href="<?php echo e(route('cars.catalog')); ?>" class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-bold px-4 py-2.5 rounded-lg transition text-center">
                                    Reset
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

                <!-- Cars Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mb-12">
                    <?php $__empty_1 = true; $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="group relative bg-[#1a1a1a] rounded-2xl overflow-hidden hover:shadow-2xl hover:shadow-orange-500/10 transition-all duration-300 hover:-translate-y-2 border border-white/5 dark:hover:border-[#f53003]/30">
                            <div class="relative overflow-hidden bg-gray-800 h-48">
                                <?php if($car->featured_photo): ?>
                                    <img src="<?php echo e(asset('storage/' . $car->featured_photo->photo_path)); ?>" 
                                         alt="<?php echo e($car->name); ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-gray-500 bg-gradient-to-br from-gray-700 to-gray-900">
                                        <span>Tidak ada foto</span>
                                    </div>
                                <?php endif; ?>

                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 rounded-lg text-xs font-bold <?php echo e($car->status === 'Tersedia' ? 'bg-green-500/80 text-white' : 'bg-red-500/80 text-white'); ?> backdrop-blur-sm">
                                        <?php echo e($car->status); ?>

                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-lg font-bold text-white mb-3"><?php echo e($car->name); ?></h3>

                                <div class="space-y-2 text-sm text-gray-400 mb-6">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                                        <span><?php echo e($car->transmission); ?></span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        <span><?php echo e($car->capacity); ?> orang</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase">Harga/Hari</p>
                                        <p class="text-xl font-extrabold text-[#f53003]">Rp <?php echo e(number_format($car->price_per_day, 0, ',', '.')); ?></p>
                                    </div>
                                    <a href="<?php echo e(route('cars.detail', $car)); ?>" class="p-3 bg-[#f53003] hover:bg-[#d63000] text-white rounded-xl transition shadow-lg transform hover:-translate-y-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-span-full text-center py-20">
                            <div class="text-gray-500 text-lg mb-2">🚗 Mobil tidak ditemukan</div>
                            <p class="text-gray-400">Coba ubah filter dan cari lagi</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <?php echo e($cars->appends(request()->query())->links()); ?>

                </div>
            </div>
        </main>

        <footer class="bg-black text-gray-400 py-16 lg:py-20 border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                    <div>
                        <div class="text-2xl font-extrabold text-white mb-6">Drive<span class="text-[#f53003]">Hub</span></div>
                        <p class="mb-6 leading-relaxed text-gray-400">Platform penyewaan mobil paling inovatif di Indonesia. Kami mengutamakan kenyamanan, keamanan, dan kepuasan pelanggan di setiap kilometer.</p>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Navigasi</h4>
                        <ul class="space-y-3">
                            <li><a href="/" class="text-gray-400 hover:text-[#f53003] transition">Beranda</a></li>
                            <li><a href="<?php echo e(route('cars.catalog')); ?>" class="text-gray-400 hover:text-[#f53003] transition">Katalog</a></li>
                            <li><a href="/#reservasi" class="text-gray-400 hover:text-[#f53003] transition">Cara Sewa</a></li>
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
</html>
<?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/cars/index.blade.php ENDPATH**/ ?>