<nav x-data="{ open: false }" class="fixed top-0 z-50 w-full bg-black/95 backdrop-blur-md border-b border-white/10 transition-all duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 sm:h-20">
            <!-- Logo - Left Side -->
            @auth
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-1.5 sm:gap-2 group flex-shrink-0">
                @else
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-1.5 sm:gap-2 group flex-shrink-0">
                @endif
            @else
                <a href="{{ route('dashboard') }}" class="flex items-center gap-1.5 sm:gap-2 group flex-shrink-0">
            @endauth
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
                @if(request()->routeIs('admin.dashboard'))
                    <!-- Admin Dashboard Navigation -->
                    <a href="/" class="text-sm font-medium text-gray-400 hover:text-white transition {{ request()->url() === url('/') ? 'text-white' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-400 hover:text-white transition {{ request()->routeIs('admin.dashboard') ? 'text-white' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('blogs.index') }}" class="text-sm font-medium text-gray-400 hover:text-white transition {{ request()->routeIs('blogs.index', 'blogs.show') ? 'text-white' : '' }}">
                        Blog
                    </a>
                @else
                    <!-- Regular Navigation -->
                    <a href="/" class="text-sm font-medium text-gray-400 hover:text-white transition {{ request()->url() === url('/') ? 'text-white' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('cars.catalog') }}" class="text-sm font-medium text-gray-400 hover:text-white transition {{ request()->routeIs('cars.catalog', 'cars.detail') ? 'text-white' : '' }}">
                        Katalog
                    </a>
                    @auth
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-400 hover:text-white transition {{ request()->routeIs('admin.dashboard') ? 'text-white' : '' }}">
                                Panel Admin
                            </a>
                        @else
                            <a href="{{ route('rentals.index') }}" class="text-sm font-medium text-gray-400 hover:text-white transition {{ request()->routeIs('rentals.index', 'rentals.show') ? 'text-white' : '' }}">
                                Sewa Saya
                            </a>
                        @endif
                    @endauth
                    <a href="{{ route('blogs.index') }}" class="text-sm font-medium text-gray-400 hover:text-white transition {{ request()->routeIs('blogs.index', 'blogs.show') ? 'text-white' : '' }}">
                        Blog
                    </a>
                @endif
            </div>

            <!-- Right Side: Buttons & Menus -->
            <div class="flex items-center gap-2 sm:gap-3 lg:gap-4">
                @auth
                    @if(!request()->routeIs('admin.dashboard'))
                        @if(Auth::user()->is_admin || Auth::user()->is_staff)
                            <a href="{{ route('cars.admin.index') }}" class="hidden lg:inline-flex px-3 py-2 text-sm font-medium text-gray-400 hover:text-white transition">
                                Kelola
                            </a>
                        @endif
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="hidden lg:inline-flex px-3 py-2 text-sm font-medium text-gray-400 hover:text-white transition">
                                Admin
                            </a>
                        @endif
                    @endif

                    <!-- User Dropdown -->
                    <div x-data="{ dropdownOpen: false }" class="relative hidden sm:block">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="flex items-center gap-2 px-3 py-2.5 rounded-full text-gray-300 hover:text-white hover:bg-white/5 transition">
                            <div class="w-8 h-8 bg-gradient-to-br from-[#f53003] to-orange-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold hidden md:inline whitespace-nowrap">{{ Auth::user()->name }}</span>
                            <svg :class="dropdownOpen ? 'rotate-180' : ''" class="w-4 h-4 transition hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="dropdownOpen" x-transition class="absolute right-0 mt-2 w-56 rounded-2xl bg-gradient-to-br from-[#1a1a1a] to-[#0a0a0a] border border-white/10 shadow-xl z-50">
                            <div class="px-4 py-3 border-b border-white/10">
                                <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition text-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                Profile
                            </a>

                            @if(Auth::user()->is_admin || Auth::user()->is_staff)
                                <div class="border-t border-white/10">
                                    <a href="{{ route('cars.admin.index') }}" class="flex items-center gap-2 px-4 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition text-sm lg:hidden">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 012-2h6a2 2 0 012 2v2h2a2 2 0 012 2v11a2 2 0 01-2 2H3a2 2 0 01-2-2V7a2 2 0 012-2h2V3z"></path></svg>
                                        Kelola Mobil
                                    </a>
                                </div>
                            @endif
                            
                            @if(Auth::user()->is_admin)
                                <div class="border-t border-white/10">
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition text-sm lg:hidden">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM2 8a2 2 0 11-4 0 2 2 0 014 0zM18 15v2H0v-2a4 4 0 018-0v2a4 4 0 008 0z"></path></svg>
                                        Admin Panel
                                    </a>
                                </div>
                            @endif

                            <div class="border-t border-white/10">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-3 text-red-400 hover:text-red-300 hover:bg-red-500/10 transition text-sm rounded-b-2xl">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-block text-sm font-semibold text-white hover:text-[#f53003] transition">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-3 sm:px-5 py-2 sm:py-2.5 text-xs sm:text-sm font-bold text-white bg-[#f53003] rounded-full hover:bg-[#d63000] hover:shadow-lg hover:shadow-orange-500/30 transition transform hover:-translate-y-0.5">
                            Daftar
                        </a>
                    @endif
                @endauth

                <!-- Mobile menu button - Only on Mobile -->
                <button @click="open = !open" class="md:hidden p-2 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition flex-shrink-0">
                    <svg :class="open ? 'hidden' : 'block'" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg :class="open ? 'block' : 'hidden'" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Mobile User Icon only on Mobile -->
                @auth
                    <div x-data="{ dropdownOpen: false }" class="relative sm:hidden">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="w-8 h-8 bg-gradient-to-br from-[#f53003] to-orange-600 rounded-full flex items-center justify-center hover:shadow-lg transition flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Mobile User Dropdown Menu -->
                        <div x-show="dropdownOpen" x-transition class="absolute right-0 mt-2 w-48 rounded-2xl bg-gradient-to-br from-[#1a1a1a] to-[#0a0a0a] border border-white/10 shadow-xl z-50">
                            <div class="px-3 py-2 border-b border-white/10">
                                <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-2 text-gray-400 hover:text-white hover:bg-white/5 transition text-xs">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                Profile
                            </a>

                            @if(Auth::user()->is_admin || Auth::user()->is_staff)
                                <div class="border-t border-white/10">
                                    <a href="{{ route('cars.admin.index') }}" class="flex items-center gap-2 px-3 py-2 text-gray-400 hover:text-white hover:bg-white/5 transition text-xs">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 012-2h6a2 2 0 012 2v2h2a2 2 0 012 2v11a2 2 0 01-2 2H3a2 2 0 01-2-2V7a2 2 0 012-2h2V3z"></path></svg>
                                        Kelola Mobil
                                    </a>
                                </div>
                            @endif
                            
                            @if(Auth::user()->is_admin)
                                <div class="border-t border-white/10">
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 text-gray-400 hover:text-white hover:bg-white/5 transition text-xs">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM2 8a2 2 0 11-4 0 2 2 0 014 0zM18 15v2H0v-2a4 4 0 018-0v2a4 4 0 008 0z"></path></svg>
                                        Admin Panel
                                    </a>
                                </div>
                            @endif

                            <div class="border-t border-white/10">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-red-400 hover:text-red-300 hover:bg-red-500/10 transition text-xs rounded-b-2xl">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div :class="open ? 'block' : 'hidden'" class="md:hidden border-t border-white/10 pb-4 space-y-1">
            <a href="/" class="block px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition {{ request()->url() === url('/') ? 'text-white bg-white/10' : '' }}">
                Beranda
            </a>
            <a href="{{ route('cars.catalog') }}" class="block px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition {{ request()->routeIs('cars.catalog', 'cars.detail') ? 'text-white bg-white/10' : '' }}">
                Katalog
            </a>
            @auth
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'text-white bg-white/10' : '' }}">
                        Panel Admin
                    </a>
                @else
                    <a href="{{ route('rentals.index') }}" class="block px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition {{ request()->routeIs('rentals.index', 'rentals.show') ? 'text-white bg-white/10' : '' }}">
                        Sewa Saya
                    </a>
                @endif
            @endauth
            <a href="{{ route('blogs.index') }}" class="block px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition {{ request()->routeIs('blogs.index', 'blogs.show') ? 'text-white bg-white/10' : '' }}">
                Blog
            </a>
            @auth
                @if(Auth::user()->is_admin || Auth::user()->is_staff)
                    <a href="{{ route('cars.admin.index') }}" class="block px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition">
                        Kelola Mobil
                    </a>
                @endif
            @endauth
        </div>
    </div>
</nav>

<!-- Add padding to body to account for fixed navbar -->
<div class="pt-16 sm:pt-20"></div>
