<x-app-layout>
    <div class="min-h-screen bg-black text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header Section -->
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-4">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-[#f53003] transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>
                
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm0 4a1 1 0 000 2h6a1 1 0 100-2H7zm0 4a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-white">Riwayat Sewa Saya</h1>
                        <p class="text-gray-400 mt-2">Kelola dan pantau semua rental mobil Anda</p>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-500/20 border border-green-500/50 text-green-400 px-6 py-4 rounded-xl flex items-start gap-3">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Content -->
            @if ($rentals->count() > 0)
                <div class="space-y-6">
                    @foreach ($rentals as $rental)
                        <div class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 hover:border-[#f53003] rounded-2xl transition duration-300">
                            <!-- Animated Background -->
                            <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                            
                            <div class="relative z-10 p-6 md:p-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">
                                    <!-- Car Info -->
                                    <div class="md:col-span-2">
                                        <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Mobil</p>
                                        <h3 class="text-xl font-bold text-white group-hover:text-[#f53003] transition mb-3">{{ $rental->car->name }}</h3>
                                        <div class="flex items-center gap-3 text-gray-400 text-sm">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a1 1 0 011-1h8a1 1 0 011 1v2M5 9c0 1.657-.895 3.146-2.219 3.958A2.968 2.968 0 001 15v3a1 1 0 001 1h16a1 1 0 001-1v-3c0-.839-.27-1.616-.719-2.264A4 4 0 0015 9M7 13a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            <span>{{ $rental->car->capacity }} penumpang • {{ $rental->car->transmission }}</span>
                                        </div>
                                    </div>

                                    <!-- Dates -->
                                    <div>
                                        <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Periode Sewa</p>
                                        <p class="text-white font-semibold mb-1">{{ $rental->rental_date->format('d M Y') }}</p>
                                        <p class="text-gray-400 text-sm">{{ $rental->duration_days }} hari</p>
                                    </div>

                                    <!-- Price -->
                                    <div>
                                        <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Total Harga</p>
                                        <p class="text-2xl font-bold bg-gradient-to-r from-[#f53003] to-orange-500 bg-clip-text text-transparent">
                                            Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Status</p>
                                        <div class="space-y-2">
                                            <div>
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold transition
                                                    @if($rental->status === 'Pending') bg-yellow-500/20 text-yellow-400 border border-yellow-500/50
                                                    @elseif($rental->status === 'Paid') bg-blue-500/20 text-blue-400 border border-blue-500/50
                                                    @elseif($rental->status === 'Active') bg-green-500/20 text-green-400 border border-green-500/50
                                                    @elseif($rental->status === 'Completed') bg-purple-500/20 text-purple-400 border border-purple-500/50
                                                    @else bg-red-500/20 text-red-400 border border-red-500/50
                                                    @endif">
                                                    <span class="w-2 h-2 rounded-full @if($rental->status === 'Pending') bg-yellow-400 @elseif($rental->status === 'Paid') bg-blue-400 @elseif($rental->status === 'Active') bg-green-400 @elseif($rental->status === 'Completed') bg-purple-400 @else bg-red-400 @endif"></span>
                                                    {{ $rental->status }}
                                                </span>
                                            </div>
                                            @if ($rental->payment)
                                                <div>
                                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold
                                                        @if($rental->payment->status === 'Pending') bg-yellow-500/20 text-yellow-400 border border-yellow-500/50
                                                        @elseif($rental->payment->status === 'Verified') bg-green-500/20 text-green-400 border border-green-500/50
                                                        @else bg-red-500/20 text-red-400 border border-red-500/50
                                                        @endif">
                                                        <span class="w-2 h-2 rounded-full @if($rental->payment->status === 'Pending') bg-yellow-400 @elseif($rental->payment->status === 'Verified') bg-green-400 @else bg-red-400 @endif"></span>
                                                        {{ $rental->payment->status }}
                                                    </span>
                                                </div>
                                            @else
                                                <div>
                                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold bg-gray-500/20 text-gray-400 border border-gray-500/50">
                                                        <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                                                        Belum Dibayar
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-wrap gap-3 pt-6 border-t border-white/10">
                                    <a href="{{ route('rentals.show', $rental) }}" class="inline-flex items-center gap-2 bg-[#f53003] hover:bg-[#d63000] text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Detail Lengkap
                                    </a>
                                    
                                    @if($rental->status !== 'Completed' && !$rental->payment)
                                        <a href="{{ route('rentals.payment', $rental) }}" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                                            </svg>
                                            Bayar Sekarang
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $rentals->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-24">
                    <div class="w-20 h-20 bg-gradient-to-br from-[#f53003]/20 to-[#f53003]/5 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-[#f53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Belum Ada Rental</h3>
                    <p class="text-gray-400 mb-8 max-w-md mx-auto">Anda belum memiliki riwayat rental. Jelajahi katalog mobil kami dan mulai petualangan Anda sekarang!</p>
                    <a href="{{ route('cars.catalog') }}" class="inline-flex items-center gap-2 bg-[#f53003] hover:bg-[#d63000] text-white px-6 py-3 rounded-lg font-bold transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Jelajahi Katalog Mobil
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
