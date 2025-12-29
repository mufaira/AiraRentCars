<nav x-data="{ open: false }" class="fixed top-0 z-50 w-full bg-black/95 backdrop-blur-md border-b border-white/10 transition-all duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 sm:h-20">
            <!-- Logo - Left Side -->
            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->is_admin): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-1.5 sm:gap-2 group flex-shrink-0">
                <?php else: ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-1.5 sm:gap-2 group flex-shrink-0">
                <?php endif; ?>
            <?php else: ?>
                <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-1.5 sm:gap-2 group flex-shrink-0">
            <?php endif; ?>
                <div class="bg-[#f53003] text-white p-1.5 sm:p-2 rounded-lg transform group-hover:rotate-12 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-sm sm:text-xl font-extrabold tracking-tight hidden sm:inline whitespace-nowrap">
                    <span class="text-white">Drive</span><span class="text-[#f53003]">Hub</span>
                </span>
            </a>

            <!-- Centered Navigation Links -->
            <div class="hidden md:flex items-center gap-8">
                <?php if(request()->routeIs('admin.dashboard')): ?>
                    <!-- Admin Dashboard Navigation -->
                    <a href="/" class="text-sm font-medium text-gray-400 hover:text-white transition <?php echo e(request()->url() === url('/') ? 'text-white' : ''); ?>">
                        Beranda
                    </a>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sm font-medium text-gray-400 hover:text-white transition <?php echo e(request()->routeIs('admin.dashboard') ? 'text-white' : ''); ?>">
                        Dashboard
                    </a>
                    <a href="<?php echo e(route('blogs.index')); ?>" class="text-sm font-medium text-gray-400 hover:text-white transition <?php echo e(request()->routeIs('blogs.index', 'blogs.show') ? 'text-white' : ''); ?>">
                        Blog
                    </a>
                <?php else: ?>
                    <!-- Regular Navigation -->
                    <a href="/" class="text-sm font-medium text-gray-400 hover:text-white transition <?php echo e(request()->url() === url('/') ? 'text-white' : ''); ?>">
                        Beranda
                    </a>
                    <a href="<?php echo e(route('cars.catalog')); ?>" class="text-sm font-medium text-gray-400 hover:text-white transition <?php echo e(request()->routeIs('cars.catalog', 'cars.detail') ? 'text-white' : ''); ?>">
                        Katalog
                    </a>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->is_admin): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sm font-medium text-gray-400 hover:text-white transition <?php echo e(request()->routeIs('admin.dashboard') ? 'text-white' : ''); ?>">
                                Panel Admin
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('rentals.index')); ?>" class="text-sm font-medium text-gray-400 hover:text-white transition <?php echo e(request()->routeIs('rentals.index', 'rentals.show') ? 'text-white' : ''); ?>">
                                Sewa Saya
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a href="<?php echo e(route('blogs.index')); ?>" class="text-sm font-medium text-gray-400 hover:text-white transition <?php echo e(request()->routeIs('blogs.index', 'blogs.show') ? 'text-white' : ''); ?>">
                        Blog
                    </a>
                <?php endif; ?>
            </div>

            <!-- Right Side: Buttons & Menus -->
            <div class="flex items-center gap-2 sm:gap-3 lg:gap-4">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(!request()->routeIs('admin.dashboard')): ?>
                        <?php if(Auth::user()->is_admin || Auth::user()->is_staff): ?>
                            <a href="<?php echo e(route('cars.admin.index')); ?>" class="hidden lg:inline-flex px-3 py-2 text-sm font-medium text-gray-400 hover:text-white transition">
                                Kelola
                            </a>
                        <?php endif; ?>
                        <?php if(Auth::user()->is_admin): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="hidden lg:inline-flex px-3 py-2 text-sm font-medium text-gray-400 hover:text-white transition">
                                Admin
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- User Dropdown -->
                    <div x-data="{ dropdownOpen: false }" class="relative hidden sm:block">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="flex items-center gap-2 px-3 py-2.5 rounded-full text-gray-300 hover:text-white hover:bg-white/5 transition">
                            <div class="w-8 h-8 bg-gradient-to-br from-[#f53003] to-orange-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold hidden md:inline whitespace-nowrap"><?php echo e(Auth::user()->name); ?></span>
                            <svg :class="dropdownOpen ? 'rotate-180' : ''" class="w-4 h-4 transition hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="dropdownOpen" x-transition class="absolute right-0 mt-2 w-56 rounded-2xl bg-gradient-to-br from-[#1a1a1a] to-[#0a0a0a] border border-white/10 shadow-xl z-50">
                            <div class="px-4 py-3 border-b border-white/10">
                                <p class="text-sm font-semibold text-white"><?php echo e(Auth::user()->name); ?></p>
                                <p class="text-xs text-gray-400"><?php echo e(Auth::user()->email); ?></p>
                            </div>

                            <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-2 px-4 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition text-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                Profile
                            </a>

                            <?php if(Auth::user()->is_admin || Auth::user()->is_staff): ?>
                                <div class="border-t border-white/10">
                                    <a href="<?php echo e(route('cars.admin.index')); ?>" class="flex items-center gap-2 px-4 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition text-sm lg:hidden">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 012-2h6a2 2 0 012 2v2h2a2 2 0 012 2v11a2 2 0 01-2 2H3a2 2 0 01-2-2V7a2 2 0 012-2h2V3z"></path></svg>
                                        Kelola Mobil
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <?php if(Auth::user()->is_admin): ?>
                                <div class="border-t border-white/10">
                                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-2 px-4 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition text-sm lg:hidden">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM2 8a2 2 0 11-4 0 2 2 0 014 0zM18 15v2H0v-2a4 4 0 018-0v2a4 4 0 008 0z"></path></svg>
                                        Admin Panel
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="border-t border-white/10">
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-3 text-red-400 hover:text-red-300 hover:bg-red-500/10 transition text-sm rounded-b-2xl">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="hidden sm:inline-block text-sm font-semibold text-white hover:text-[#f53003] transition">
                        Masuk
                    </a>
                    <?php if(Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>" class="px-3 sm:px-5 py-2 sm:py-2.5 text-xs sm:text-sm font-bold text-white bg-[#f53003] rounded-full hover:bg-[#d63000] hover:shadow-lg hover:shadow-orange-500/30 transition transform hover:-translate-y-0.5">
                            Daftar
                        </a>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Mobile menu button - Only on Mobile -->
                <button @click="open = !open" class="md:hidden p-2 rounded-lg text-gray-900 dark:text-white hover:text-[#f53003] hover:bg-white/5 transition flex-shrink-0">
                    <svg :class="open ? 'hidden' : 'block'" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 6a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V6zM3 12a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zM3 18a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" />
                    </svg>
                    <svg :class="open ? 'block' : 'hidden'" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.293 4.293a1 1 0 011.414 0L12 10.586l6.293-6.293a1 1 0 111.414 1.414L13.414 12l6.293 6.293a1 1 0 01-1.414 1.414L12 13.414l-6.293 6.293a1 1 0 01-1.414-1.414L10.586 12 4.293 5.707a1 1 0 010-1.414z" />
                    </svg>
                </button>

                <!-- Mobile User Icon only on Mobile -->
                <?php if(auth()->guard()->check()): ?>
                    <div x-data="{ dropdownOpen: false }" class="relative sm:hidden">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="w-8 h-8 bg-gradient-to-br from-[#f53003] to-orange-600 rounded-full flex items-center justify-center hover:shadow-lg transition flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Mobile User Dropdown Menu -->
                        <div x-show="dropdownOpen" x-transition class="absolute right-0 mt-2 w-48 rounded-2xl bg-gradient-to-br from-[#1a1a1a] to-[#0a0a0a] border border-white/10 shadow-xl z-50">
                            <div class="px-3 py-2 border-b border-white/10">
                                <p class="text-xs font-semibold text-white truncate"><?php echo e(Auth::user()->name); ?></p>
                                <p class="text-xs text-gray-400 truncate"><?php echo e(Auth::user()->email); ?></p>
                            </div>

                            <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-2 px-3 py-2 text-gray-400 hover:text-white hover:bg-white/5 transition text-xs">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                Profile
                            </a>

                            <?php if(Auth::user()->is_admin || Auth::user()->is_staff): ?>
                                <div class="border-t border-white/10">
                                    <a href="<?php echo e(route('cars.admin.index')); ?>" class="flex items-center gap-2 px-3 py-2 text-gray-400 hover:text-white hover:bg-white/5 transition text-xs">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 012-2h6a2 2 0 012 2v2h2a2 2 0 012 2v11a2 2 0 01-2 2H3a2 2 0 01-2-2V7a2 2 0 012-2h2V3z"></path></svg>
                                        Kelola Mobil
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <?php if(Auth::user()->is_admin): ?>
                                <div class="border-t border-white/10">
                                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-2 px-3 py-2 text-gray-400 hover:text-white hover:bg-white/5 transition text-xs">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM2 8a2 2 0 11-4 0 2 2 0 014 0zM18 15v2H0v-2a4 4 0 018-0v2a4 4 0 008 0z"></path></svg>
                                        Admin Panel
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="border-t border-white/10">
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-red-400 hover:text-red-300 hover:bg-red-500/10 transition text-xs rounded-b-2xl">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div :class="open ? 'block' : 'hidden'" class="md:hidden border-t border-white/10 pb-4 space-y-1">
            <a href="/" class="block px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition <?php echo e(request()->url() === url('/') ? 'text-white bg-white/10' : ''); ?>">
                Beranda
            </a>
            <a href="<?php echo e(route('cars.catalog')); ?>" class="block px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition <?php echo e(request()->routeIs('cars.catalog', 'cars.detail') ? 'text-white bg-white/10' : ''); ?>">
                Katalog
            </a>
            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->is_admin): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition <?php echo e(request()->routeIs('admin.dashboard') ? 'text-white bg-white/10' : ''); ?>">
                        Panel Admin
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('rentals.index')); ?>" class="block px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition <?php echo e(request()->routeIs('rentals.index', 'rentals.show') ? 'text-white bg-white/10' : ''); ?>">
                        Sewa Saya
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <a href="<?php echo e(route('blogs.index')); ?>" class="block px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition <?php echo e(request()->routeIs('blogs.index', 'blogs.show') ? 'text-white bg-white/10' : ''); ?>">
                Blog
            </a>
            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->is_admin || Auth::user()->is_staff): ?>
                    <a href="<?php echo e(route('cars.admin.index')); ?>" class="block px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition">
                        Kelola Mobil
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Add padding to body to account for fixed navbar -->
<div class="pt-16 sm:pt-20"></div>
<?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>