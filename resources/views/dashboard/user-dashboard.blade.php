<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Saya') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mb-2">📊 Dashboard Pribadi</h1>
                <p class="text-gray-600 dark:text-gray-400">Ringkasan rental dan pembatalan Anda</p>
            </div>

            <!-- Top KPI Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Rentals -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total Rental</p>
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $totalRentals }}</p>
                        </div>
                        <div class="text-4xl">📋</div>
                    </div>
                </div>

                <!-- Active Rentals -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Sedang Aktif</p>
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $activeRentals }}</p>
                        </div>
                        <div class="text-4xl">✓</div>
                    </div>
                </div>

                <!-- Completed Rentals -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Selesai</p>
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $completedRentals }}</p>
                        </div>
                        <div class="text-4xl">✅</div>
                    </div>
                </div>

                <!-- Total Spent -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-orange-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total Pengeluaran</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-4xl">💰</div>
                    </div>
                </div>
            </div>

            <!-- Refund Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-pink-500">
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mb-2">Permintaan Refund</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $totalRefunds }}</p>
                    <div class="mt-4 text-sm">
                        <span class="text-green-600 dark:text-green-400">✓ Disetujui: {{ $approvedRefunds }}</span> | 
                        <span class="text-yellow-600 dark:text-yellow-400">Pending: {{ $pendingRefunds }}</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-red-500">
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mb-2">Dibatalkan</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $cancelledRentals }}</p>
                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        Total pembatalan dalam riwayat Anda
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-indigo-500">
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mb-2">Statistik Cepat</p>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-4">
                        <span class="font-semibold">Tingkat Keberhasilan:</span> 
                        <span class="text-indigo-600 dark:text-indigo-400">{{ $totalRentals > 0 ? round(($completedRentals / $totalRentals) * 100, 1) : 0 }}%</span>
                    </p>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">
                        <span class="font-semibold">Rata-rata per Rental:</span> 
                        <span class="text-indigo-600 dark:text-indigo-400">Rp {{ $completedRentals > 0 ? number_format($totalSpent / $completedRentals, 0, ',', '.') : 0 }}</span>
                    </p>
                </div>
            </div>

            <!-- Charts Row 1 -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Rental Trends Chart -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">📈 Tren Rental Saya (7 Hari Terakhir)</h3>
                    <canvas id="trendChart" height="80"></canvas>
                </div>

                <!-- Rental Status Chart -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">🔄 Status Rental Saya</h3>
                    <canvas id="statusChart" height="80"></canvas>
                </div>
            </div>

            <!-- Monthly Spending Chart -->
            <div class="grid grid-cols-1 gap-8 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">💸 Pengeluaran Bulanan Saya</h3>
                    <canvas id="spendingChart" height="80"></canvas>
                </div>
            </div>

            <!-- Summary Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="bg-gradient-to-br from-blue-50 dark:from-blue-900/20 to-blue-100 dark:to-blue-900/40 rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-blue-900 dark:text-blue-100 mb-3">📊 Ringkasan Rental</h3>
                    <ul class="text-sm text-blue-800 dark:text-blue-300 space-y-2">
                        <li>• Total Rental: <strong>{{ $totalRentals }}</strong></li>
                        <li>• Sedang Aktif: <strong>{{ $activeRentals }}</strong></li>
                        <li>• Selesai: <strong>{{ $completedRentals }}</strong></li>
                        <li>• Dibatalkan: <strong>{{ $cancelledRentals }}</strong></li>
                    </ul>
                </div>

                <div class="bg-gradient-to-br from-pink-50 dark:from-pink-900/20 to-pink-100 dark:to-pink-900/40 rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-pink-900 dark:text-pink-100 mb-3">⚠️ Ringkasan Pembatalan</h3>
                    <ul class="text-sm text-pink-800 dark:text-pink-300 space-y-2">
                        <li>• Total Permintaan: <strong>{{ $totalRefunds }}</strong></li>
                        <li>• Disetujui: <strong>{{ $approvedRefunds }}</strong></li>
                        <li>• Pending: <strong>{{ $pendingRefunds }}</strong></li>
                        <li>• Total Pengeluaran: <strong>Rp {{ number_format($totalSpent, 0, ',', '.') }}</strong></li>
                    </ul>
                </div>
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 p-6 rounded-lg">
                <h3 class="font-bold text-blue-900 dark:text-blue-100 mb-2">ℹ️ Tentang Dashboard Pribadi</h3>
                <p class="text-blue-800 dark:text-blue-300 text-sm">
                    Dashboard ini menampilkan data rental dan pembatalan Anda saja. Grafik menunjukkan tren 7 hari terakhir 
                    dan pengeluaran bulanan. Anda bisa melihat ringkasan lengkap di halaman <a href="{{ route('rentals.index') }}" class="underline font-semibold">Riwayat Sewa</a>.
                </p>
            </div>
        </div>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <script>
        // Trend Chart
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        const trendLabels = JSON.parse('{{ json_encode($trendDates) }}');
        const trendData = JSON.parse('{{ json_encode($trendCounts) }}');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [{
                    label: 'Jumlah Rental',
                    data: trendData,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusLabels = JSON.parse('{{ json_encode($statusLabels) }}');
        const statusCounts = JSON.parse('{{ json_encode($statusCounts) }}');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusCounts,
                    backgroundColor: [
                        '#10b981',
                        '#f59e0b',
                        '#ef4444',
                        '#8b5cf6',
                        '#06b6d4'
                    ],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Spending Chart
        const spendingCtx = document.getElementById('spendingChart').getContext('2d');
        const monthlyLabels = JSON.parse('{{ json_encode($monthlyLabels) }}');
        const monthlyValues = JSON.parse('{{ json_encode($monthlyValues) }}');
        new Chart(spendingCtx, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Pengeluaran (Rp)',
                    data: monthlyValues,
                    backgroundColor: '#f59e0b',
                    borderColor: '#d97706',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
