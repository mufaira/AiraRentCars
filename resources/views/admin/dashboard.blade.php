<x-app-layout>
<div class="min-h-screen bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex items-center gap-3 mb-12">
            <h1 class="text-4xl font-bold text-white">Panel Admin</h1>
            <div class="flex-1 h-1 bg-gradient-to-r from-[#f53003] to-transparent rounded-full"></div>
        </div>

        <!-- Admin Menu Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
            <!-- Infografis -->
            <a href="{{ route('dashboard.infografis') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-8 hover:border-[#f53003] transition duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#f53003]/10 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-[#f53003] transition">Infografis</h3>
                    <p class="text-gray-400 text-sm mb-6 leading-relaxed">Lihat statistik dan analitik lengkap tentang penjualan, rental, dan pendapatan aplikasi.</p>
                    <div class="flex items-center gap-2 text-[#f53003] font-bold group-hover:gap-3 transition">
                        <span>Lihat Infografis</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Kelola Mobil -->
            <a href="{{ route('cars.admin.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-8 hover:border-[#f53003] transition duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#f53003]/10 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0015.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-[#f53003] transition">Kelola Mobil</h3>
                    <p class="text-gray-400 text-sm mb-6 leading-relaxed">Edit, hapus, atau kelola semua data mobil yang terdaftar di platform.</p>
                    <div class="flex items-center gap-2 text-[#f53003] font-bold group-hover:gap-3 transition">
                        <span>Kelola Mobil</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Tambah Mobil -->
            <a href="{{ route('cars.admin.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-8 hover:border-[#f53003] transition duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#f53003]/10 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8 text-[#f53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-[#f53003] transition">Tambah Mobil</h3>
                    <p class="text-gray-400 text-sm mb-6 leading-relaxed">Tambahkan mobil baru ke katalog dengan foto, spesifikasi, dan harga sewa.</p>
                    <div class="flex items-center gap-2 text-[#f53003] font-bold group-hover:gap-3 transition">
                        <span>Tambah Mobil</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Kelola Rental -->
            <a href="{{ route('rentals.admin.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-8 hover:border-[#f53003] transition duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#f53003]/10 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-[#f53003] transition">Kelola Rental</h3>
                    <p class="text-gray-400 text-sm mb-6 leading-relaxed">Verifikasi pembayaran, kelola pemesanan rental, dan pantau status penyewaan.</p>
                    <div class="flex items-center gap-2 text-[#f53003] font-bold group-hover:gap-3 transition">
                        <span>Kelola Rental</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Kelola Refund -->
            <a href="{{ route('refunds.admin.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-8 hover:border-[#f53003] transition duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#f53003]/10 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.16 2.75a.75.75 0 00-.328 1.464l.003.002a49.255 49.255 0 0113.849 3.276.75.75 0 10.57-1.388A50.747 50.747 0 008.16 2.75z"></path>
                            <path d="M2.332 7.75a.75.75 0 00-.339 1.465c.217.117.452.232.714.347a49.422 49.422 0 006.738 2.341.75.75 0 10.464-1.428 47.927 47.927 0 00-6.59-2.289A.75.75 0 002.332 7.75zm10.338 4.516a.75.75 0 00-.52 1.422 49.04 49.04 0 006.343 3.964.75.75 0 10.896-1.23 47.54 47.54 0 00-6.219-3.856.75.75 0 00-.9.7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-[#f53003] transition">Kelola Refund</h3>
                    <p class="text-gray-400 text-sm mb-6 leading-relaxed">Proses dan kelola semua permintaan refund dari pengguna dengan approval system.</p>
                    <div class="flex items-center gap-2 text-[#f53003] font-bold group-hover:gap-3 transition">
                        <span>Kelola Refund</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Manajemen User -->
            <a href="{{ route('admin.users.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-8 hover:border-[#f53003] transition duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 6A9 9 0 1021 15a.75.75 0 00-1.5 0A7.5 7.5 0 119 6z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-[#f53003] transition">Manajemen User</h3>
                    <p class="text-gray-400 text-sm mb-6 leading-relaxed">Kelola data user, permission, dan role di sistem aplikasi.</p>
                    <div class="flex items-center gap-2 text-[#f53003] font-bold group-hover:gap-3 transition">
                        <span>Kelola User</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <!-- Stats Section -->
        <div class="flex items-center gap-3 mb-8">
            <h2 class="text-2xl font-bold text-white">Statistik</h2>
            <div class="flex-1 h-1 bg-gradient-to-r from-[#f53003] to-transparent rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wide mb-1">Total Mobil</p>
                        <p class="text-3xl font-bold text-white">{{ $stats['total_cars'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500/30 to-blue-500/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0015.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wide mb-1">Total Rental</p>
                        <p class="text-3xl font-bold text-white">{{ $stats['total_rentals'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500/30 to-green-500/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wide mb-1">Total Pengguna</p>
                        <p class="text-3xl font-bold text-white">{{ $stats['total_users'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500/30 to-purple-500/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 6A9 9 0 1021 15a.75.75 0 00-1.5 0A7.5 7.5 0 119 6z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wide mb-1">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-[#f53003]">Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.16 2.75a.75.75 0 00-.328 1.464l.003.002a49.255 49.255 0 0113.849 3.276.75.75 0 10.57-1.388A50.747 50.747 0 008.16 2.75z"></path>
                            <path d="M2.332 7.75a.75.75 0 00-.339 1.465c.217.117.452.232.714.347a49.422 49.422 0 006.738 2.341.75.75 0 10.464-1.428 47.927 47.927 0 00-6.59-2.289A.75.75 0 002.332 7.75zm10.338 4.516a.75.75 0 00-.52 1.422 49.04 49.04 0 006.343 3.964.75.75 0 10.896-1.23 47.54 47.54 0 00-6.219-3.856.75.75 0 00-.9.7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>