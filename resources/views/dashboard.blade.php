<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-2">Selamat datang di Platform Rental Mobil!</h3>
                    <p class="text-gray-600 dark:text-gray-400">Jelajahi katalog mobil kami yang lengkap dan temukan kendaraan impian Anda.</p>
                </div>
            </div>

            <!-- Admin Section -->
            @if (auth()->user()->is_admin)
                <div class="bg-blue-50 dark:bg-blue-900 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 dark:text-blue-100 mb-4">Panel Admin</h3>
                        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                            <a href="{{ route('dashboard.infografis') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-3 rounded font-semibold text-center">
                                📊 Infografis
                            </a>
                            <a href="{{ route('cars.admin.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded font-semibold text-center">
                                🚗 Kelola Mobil
                            </a>
                            <a href="{{ route('cars.admin.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded font-semibold text-center">
                                ➕ Tambah Mobil
                            </a>
                            <a href="{{ route('rentals.admin.index') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-3 rounded font-semibold text-center">
                                📋 Kelola Rental
                            </a>
                            <a href="{{ route('refunds.admin.index') }}" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-3 rounded font-semibold text-center">
                                💰 Kelola Refund
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-3 rounded font-semibold text-center">
                                ⚙️ Dashboard Admin
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quick Links -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Personal Dashboard -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h4 class="text-lg font-bold mb-3">📊 Dashboard Pribadi</h4>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Lihat grafik rental dan pengeluaran Anda.</p>
                        <a href="{{ route('dashboard.user') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                            Lihat Dashboard
                        </a>
                    </div>
                </div>

                <!-- View Catalog -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h4 class="text-lg font-bold mb-3">🚗 Katalog Mobil</h4>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Lihat semua mobil yang tersedia dengan berbagai pilihan filter.</p>
                        <a href="{{ route('cars.catalog') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Lihat Katalog
                        </a>
                    </div>
                </div>

                <!-- Rental History -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h4 class="text-lg font-bold mb-3">📋 Riwayat Sewa</h4>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Lihat daftar sewa Anda dan status pembayaran.</p>
                        <a href="{{ route('rentals.index') }}" class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
                            Lihat Riwayat
                        </a>
                    </div>
                </div>

                <!-- My Profile -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h4 class="text-lg font-bold mb-3">👤 Profil Saya</h4>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Kelola informasi profil dan pengaturan akun Anda.</p>
                        <a href="{{ route('profile.edit') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Edit Profil
                        </a>
                    </div>
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
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">⭐ Mobil Unggulan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach ($featuredCars as $car)
                                <a href="{{ route('cars.detail', $car) }}" class="bg-gray-50 dark:bg-gray-700 rounded overflow-hidden hover:shadow-lg transition">
                                    <div class="bg-gray-200 h-40 overflow-hidden relative">
                                        @if ($car->featured_photo)
                                            <img src="{{ asset('storage/' . $car->featured_photo->photo_path) }}" 
                                                 alt="{{ $car->name }}" class="w-full h-full object-cover">
                                        @endif
                                        <div class="absolute top-2 right-2">
                                            <span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold">⭐ Unggulan</span>
                                        </div>
                                    </div>
                                    <div class="p-3">
                                        <h5 class="font-bold text-sm text-gray-900 dark:text-gray-100">{{ $car->name }}</h5>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">{{ $car->transmission }} • {{ $car->capacity }} orang</p>
                                        <p class="text-sm font-bold text-blue-600 dark:text-blue-400">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}/hari</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Available Cars Section -->
            @if ($availableCars->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">✅ Mobil Tersedia</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach ($availableCars as $car)
                                <a href="{{ route('cars.detail', $car) }}" class="bg-gray-50 dark:bg-gray-700 rounded overflow-hidden hover:shadow-lg transition">
                                    <div class="bg-gray-200 h-40 overflow-hidden relative">
                                        @if ($car->featured_photo)
                                            <img src="{{ asset('storage/' . $car->featured_photo->photo_path) }}" 
                                                 alt="{{ $car->name }}" class="w-full h-full object-cover">
                                        @endif
                                        <div class="absolute top-2 right-2">
                                            <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-semibold">Tersedia</span>
                                        </div>
                                    </div>
                                    <div class="p-3">
                                        <h5 class="font-bold text-sm text-gray-900 dark:text-gray-100">{{ $car->name }}</h5>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">{{ $car->transmission }} • {{ $car->capacity }} orang</p>
                                        <p class="text-sm font-bold text-blue-600 dark:text-blue-400">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}/hari</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Unavailable Cars Section -->
            @if ($unavailableCars->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">❌ Mobil Sedang Disewa</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach ($unavailableCars as $car)
                                <a href="{{ route('cars.detail', $car) }}" class="bg-gray-50 dark:bg-gray-700 rounded overflow-hidden opacity-70">
                                    <div class="bg-gray-200 h-40 overflow-hidden relative">
                                        @if ($car->featured_photo)
                                            <img src="{{ asset('storage/' . $car->featured_photo->photo_path) }}" 
                                                 alt="{{ $car->name }}" class="w-full h-full object-cover">
                                        @endif
                                        <div class="absolute top-2 right-2">
                                            <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-semibold">Disewa</span>
                                        </div>
                                    </div>
                                    <div class="p-3">
                                        <h5 class="font-bold text-sm text-gray-900 dark:text-gray-100">{{ $car->name }}</h5>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">{{ $car->transmission }} • {{ $car->capacity }} orang</p>
                                        <p class="text-sm font-bold text-blue-600 dark:text-blue-400">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}/hari</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
