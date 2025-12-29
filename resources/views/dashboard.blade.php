<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DriveHub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            font-family: 'Outfit', sans-serif;
        }
        html {
            color-scheme: dark;
        }
    </style>
</head>
<body class="bg-black text-white dark:bg-black dark:text-white">
    <script>
        document.documentElement.classList.add('dark');
    </script>

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-black/80 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="text-2xl font-bold">
                    <span class="text-white">Drive</span><span class="text-[#f53003]">Hub</span>
                </div>
                <div class="hidden md:flex gap-8">
                    <a href="/" class="text-gray-400 hover:text-white transition">Beranda</a>
                    <a href="{{ route('cars.catalog') }}" class="text-gray-400 hover:text-white transition">Katalog</a>
                    <a href="{{ route('rentals.index') }}" class="text-gray-400 hover:text-white transition">Rental Saya</a>
                    <a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-white transition">Profil</a>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-[#f53003] hover:bg-[#d63000] text-white px-6 py-2.5 rounded-lg font-bold transition">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Welcome Section -->
    <section class="w-full bg-gradient-to-r from-black via-black to-[#1a1a1a] py-24 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-6">
                    Selamat Datang, {{ Auth::user()->name }}!
                </h1>
                <p class="text-lg text-gray-400 mb-8">
                    Nikmati pengalaman rental mobil terbaik dengan platform DriveHub
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="w-full bg-black py-24 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Quick Menu -->
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-8">
                    <h2 class="text-3xl font-bold text-white">Menu Cepat</h2>
                    <div class="flex-1 h-1 bg-gradient-to-r from-[#f53003] to-transparent rounded-full"></div>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    <!-- Admin Panel -->
                    @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-4 sm:p-6 md:p-8 hover:border-[#f53003] transition duration-300">
                        <!-- Animated Background Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#f53003]/10 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        
                        <div class="relative z-10">
                            <!-- Icon Container -->
                            <div class="w-12 sm:w-14 md:w-16 h-12 sm:h-14 md:h-16 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition duration-300">
                                <svg class="w-6 sm:w-7 md:w-8 h-6 sm:h-7 md:h-8 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-white mb-2 sm:mb-2 group-hover:text-[#f53003] transition">Admin Panel</h3>
                            <p class="text-gray-400 text-xs sm:text-sm mb-4 sm:mb-6 leading-relaxed">Kelola semua aspek aplikasi dengan statistik dan menu management.</p>
                            <div class="flex items-center gap-2 text-[#f53003] font-bold text-xs sm:text-sm group-hover:gap-3 transition">
                                <span>Ke Admin Panel</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                    @endif

                    <!-- Katalog Mobil -->
                    <a href="{{ route('cars.catalog') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-4 sm:p-6 md:p-8 hover:border-[#f53003] transition duration-300">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#f53003]/10 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        
                        <div class="relative z-10">
                            <div class="w-12 sm:w-14 md:w-16 h-12 sm:h-14 md:h-16 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition duration-300">
                                <svg class="w-6 sm:w-7 md:w-8 h-6 sm:h-7 md:h-8 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.5 3.5a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zm4 8a2 2 0 11-4 0 2 2 0 014 0zM3 13a2 2 0 100-4 2 2 0 000 4z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-white mb-2 sm:mb-2 group-hover:text-[#f53003] transition">Katalog Mobil</h3>
                            <p class="text-gray-400 text-xs sm:text-sm mb-4 sm:mb-6 leading-relaxed">Lihat semua mobil yang tersedia dengan berbagai filter pencarian.</p>
                            <div class="flex items-center gap-2 text-[#f53003] font-bold text-xs sm:text-sm group-hover:gap-3 transition">
                                <span>Lihat Katalog</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Riwayat Sewa -->
                    <a href="{{ route('rentals.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-4 sm:p-6 md:p-8 hover:border-[#f53003] transition duration-300">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#f53003]/10 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        
                        <div class="relative z-10">
                            <div class="w-12 sm:w-14 md:w-16 h-12 sm:h-14 md:h-16 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition duration-300">
                                <svg class="w-6 sm:w-7 md:w-8 h-6 sm:h-7 md:h-8 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm0 4a1 1 0 000 2h6a1 1 0 100-2H7zm0 4a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-white mb-2 sm:mb-2 group-hover:text-[#f53003] transition">Riwayat Sewa</h3>
                            <p class="text-gray-400 text-xs sm:text-sm mb-4 sm:mb-6 leading-relaxed">Lihat daftar sewa Anda dan status pembayaran dengan detail.</p>
                            <div class="flex items-center gap-2 text-[#f53003] font-bold text-xs sm:text-sm group-hover:gap-3 transition">
                                <span>Lihat Riwayat</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Profil Saya -->
                    <a href="{{ route('profile.edit') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-4 sm:p-6 md:p-8 hover:border-[#f53003] transition duration-300">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#f53003]/10 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        
                        <div class="relative z-10">
                            <div class="w-12 sm:w-14 md:w-16 h-12 sm:h-14 md:h-16 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition duration-300">
                                <svg class="w-6 sm:w-7 md:w-8 h-6 sm:h-7 md:h-8 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-white mb-2 sm:mb-2 group-hover:text-[#f53003] transition">Profil Saya</h3>
                            <p class="text-gray-400 text-xs sm:text-sm mb-4 sm:mb-6 leading-relaxed">Kelola informasi profil dan pengaturan keamanan akun Anda.</p>
                            <div class="flex items-center gap-2 text-[#f53003] font-bold text-xs sm:text-sm group-hover:gap-3 transition">
                                <span>Edit Profil</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Blog & Tips -->
                    <a href="{{ route('blogs.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-4 sm:p-6 md:p-8 hover:border-[#f53003] transition duration-300">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#f53003]/10 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        
                        <div class="relative z-10">
                            <div class="w-12 sm:w-14 md:w-16 h-12 sm:h-14 md:h-16 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition duration-300">
                                <svg class="w-6 sm:w-7 md:w-8 h-6 sm:h-7 md:h-8 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                                    <path fill-rule="evenodd" d="M3 8a1 1 0 100 2h12a1 1 0 100-2H3zm0 4a1 1 0 100 2h8a1 1 0 100-2H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-white mb-2 sm:mb-2 group-hover:text-[#f53003] transition">Blog & Tips</h3>
                            <p class="text-gray-400 text-xs sm:text-sm mb-4 sm:mb-6 leading-relaxed">Pelajari tips berkendara, berita, dan panduan lengkap dari kami.</p>
                            <div class="flex items-center gap-2 text-[#f53003] font-bold text-xs sm:text-sm group-hover:gap-3 transition">
                                <span>Baca Blog</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Featured Cars Section -->
            @php
                $featuredCars = \App\Models\Car::where('is_featured', true)
                    ->where('is_active', true)
                    ->limit(4)
                    ->get();
                $availableCars = \App\Models\Car::where('status', 'Tersedia')
                    ->where('is_active', true)
                    ->where('is_featured', false)
                    ->limit(4)
                    ->get();
                $unavailableCars = \App\Models\Car::where('status', 'Disewa')
                    ->where('is_active', true)
                    ->limit(4)
                    ->get();
            @endphp

            @if ($featuredCars->count() > 0)
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-8">
                        <span class="text-3xl">⭐</span>
                        <h2 class="text-3xl font-bold text-white">Mobil Unggulan</h2>
                        <div class="flex-1 h-1 bg-gradient-to-r from-yellow-500/50 to-transparent rounded-full"></div>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                        @foreach ($featuredCars as $car)
                            <a href="{{ route('cars.detail', $car) }}" class="group relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-yellow-500/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition duration-300 blur-xl"></div>
                                
                                <div class="relative bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 group-hover:border-yellow-500 rounded-2xl overflow-hidden transition duration-300">
                                    <!-- Image Container -->
                                    <div class="relative h-40 sm:h-48 md:h-56 overflow-hidden bg-gradient-to-br from-gray-800 to-gray-900">
                                        @if ($car->featured_photo)
                                            <img src="{{ asset('storage/' . $car->featured_photo->photo_path) }}" 
                                                 alt="{{ $car->name }}" class="w-full h-full object-cover group-hover:scale-125 transition duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-600">No Image</div>
                                        @endif
                                        
                                        <!-- Overlay Gradient -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="p-3 sm:p-4 md:p-6 relative z-10">
                                        <div class="flex items-start justify-between mb-2 sm:mb-3">
                                            <h3 class="text-sm sm:text-base md:text-lg font-bold text-white group-hover:text-yellow-500 transition flex-1">{{ $car->name }}</h3>
                                            <div class="ml-2 flex-shrink-0">
                                                <div class="w-6 sm:w-7 md:w-8 h-6 sm:h-7 md:h-8 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                                                    <svg class="w-4 sm:w-4 md:w-5 h-4 sm:h-4 md:h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center gap-2 text-gray-400 text-xs sm:text-sm mb-3 sm:mb-4">
                                            <svg class="w-3 sm:w-4 h-3 sm:h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a1 1 0 011-1h8a1 1 0 011 1v2M5 9c0 1.657-.895 3.146-2.219 3.958A2.968 2.968 0 001 15v3a1 1 0 001 1h16a1 1 0 001-1v-3c0-.839-.27-1.616-.719-2.264A4 4 0 0015 9M7 13a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            <span>{{ $car->capacity }} penumpang</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ $car->transmission }}</span>
                                        </div>
                                        
                                        <!-- Price -->
                                        <div class="mb-3 sm:mb-4 pb-3 sm:pb-4 border-b border-white/10">
                                            <p class="text-gray-400 text-xs uppercase tracking-wide mb-1">Harga sewa per hari</p>
                                            <p class="text-lg sm:text-xl md:text-2xl font-bold bg-gradient-to-r from-yellow-500 to-orange-500 bg-clip-text text-transparent">
                                                Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        
                                        <!-- CTA Button -->
                                        <div class="flex items-center gap-2 text-yellow-500 font-bold text-xs sm:text-sm group-hover:gap-3 transition">
                                            <span>Lihat Detail</span>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Available Cars Section -->
            @if ($availableCars->count() > 0)
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-8">
                        <span class="text-3xl">✅</span>
                        <h2 class="text-3xl font-bold text-white">Mobil Tersedia</h2>
                        <div class="flex-1 h-1 bg-gradient-to-r from-green-500/50 to-transparent rounded-full"></div>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                        @foreach ($availableCars as $car)
                            <a href="{{ route('cars.detail', $car) }}" class="group relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-green-500/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition duration-300 blur-xl"></div>
                                
                                <div class="relative bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 group-hover:border-green-500 rounded-2xl overflow-hidden transition duration-300">
                                    <!-- Image Container -->
                                    <div class="relative h-40 sm:h-48 md:h-56 overflow-hidden bg-gradient-to-br from-gray-800 to-gray-900">
                                        @if ($car->featured_photo)
                                            <img src="{{ asset('storage/' . $car->featured_photo->photo_path) }}" 
                                                 alt="{{ $car->name }}" class="w-full h-full object-cover group-hover:scale-125 transition duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-600">No Image</div>
                                        @endif
                                        
                                        <!-- Overlay Gradient -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="p-3 sm:p-4 md:p-6 relative z-10">
                                        <div class="flex items-start justify-between mb-2 sm:mb-3">
                                            <h3 class="text-sm sm:text-base md:text-lg font-bold text-white group-hover:text-green-500 transition flex-1">{{ $car->name }}</h3>
                                            <div class="ml-2 flex-shrink-0">
                                                <div class="w-6 sm:w-7 md:w-8 h-6 sm:h-7 md:h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                                                    <svg class="w-4 sm:w-4 md:w-5 h-4 sm:h-4 md:h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center gap-2 text-gray-400 text-xs sm:text-sm mb-3 sm:mb-4">
                                            <svg class="w-3 sm:w-4 h-3 sm:h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a1 1 0 011-1h8a1 1 0 011 1v2M5 9c0 1.657-.895 3.146-2.219 3.958A2.968 2.968 0 001 15v3a1 1 0 001 1h16a1 1 0 001-1v-3c0-.839-.27-1.616-.719-2.264A4 4 0 0015 9M7 13a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            <span>{{ $car->capacity }} penumpang</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ $car->transmission }}</span>
                                        </div>
                                        
                                        <!-- Price -->
                                        <div class="mb-3 sm:mb-4 pb-3 sm:pb-4 border-b border-white/10">
                                            <p class="text-gray-400 text-xs uppercase tracking-wide mb-1">Harga sewa per hari</p>
                                            <p class="text-lg sm:text-xl md:text-2xl font-bold bg-gradient-to-r from-green-500 to-emerald-500 bg-clip-text text-transparent">
                                                Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        
                                        <!-- CTA Button -->
                                        <div class="flex items-center gap-2 text-green-500 font-bold text-xs sm:text-sm group-hover:gap-3 transition">
                                            <span>Pesan Sekarang</span>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Unavailable Cars Section -->
            @if ($unavailableCars->count() > 0)
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-8">❌ Mobil Sedang Disewa</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                        @foreach ($unavailableCars as $car)
                            <div class="group bg-[#1a1a1a] border border-white/10 rounded-xl overflow-hidden opacity-60">
                                <div class="relative h-40 sm:h-44 md:h-48 overflow-hidden bg-gray-800">
                                    @if ($car->featured_photo)
                                        <img src="{{ asset('storage/' . $car->featured_photo->photo_path) }}" 
                                             alt="{{ $car->name }}" class="w-full h-full object-cover">
                                    @endif
                                    <div class="absolute top-2 sm:top-3 right-2 sm:right-3">
                                        <span class="bg-red-500 text-white px-2 sm:px-3 py-1 rounded-lg text-xs font-bold">Disewa</span>
                                    </div>
                                </div>
                                <div class="p-3 sm:p-4">
                                    <h3 class="text-sm sm:text-base md:text-lg font-bold text-white mb-2">{{ $car->name }}</h3>
                                    <p class="text-gray-400 text-xs sm:text-sm mb-2 sm:mb-3">{{ $car->transmission }} • {{ $car->capacity }} orang</p>
                                    <p class="text-[#f53003] font-bold text-sm sm:text-base md:text-lg">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}/hari</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="w-full bg-black border-t border-white/10 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold text-white mb-4">
                        <span class="text-white">Drive</span><span class="text-[#f53003]">Hub</span>
                    </h3>
                    <p class="text-gray-400">Platform rental mobil terpercaya dengan layanan terbaik.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Navigasi</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-[#f53003] transition">Beranda</a></li>
                        <li><a href="{{ route('cars.catalog') }}" class="text-gray-400 hover:text-[#f53003] transition">Katalog</a></li>
                        <li><a href="{{ route('rentals.index') }}" class="text-gray-400 hover:text-[#f53003] transition">Rental Saya</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Bantuan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-[#f53003] transition">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-[#f53003] transition">Hubungi Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-[#f53003] transition">Kebijakan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Kontak</h4>
                    <p class="text-gray-400 text-sm">Email: info@drivehub.com</p>
                    <p class="text-gray-400 text-sm">Telepon: +62 812-3456-7890</p>
                </div>
            </div>
            <div class="border-t border-white/10 pt-8">
                <p class="text-center text-gray-400">© 2025 DriveHub. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>
