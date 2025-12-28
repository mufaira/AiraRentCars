<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-bold text-xl text-white leading-tight flex items-center gap-2">
            <span class="bg-orange-600 w-2 h-6 rounded-full shadow-[0_0_10px_#ea580c]"></span>
            <?php echo e(__('Dashboard Saya')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="min-h-screen bg-[#050505] text-gray-100 py-8 relative overflow-hidden font-sans">
        
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-600/20 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] translate-x-1/2 translate-y-1/2 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <div class="mb-10 relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-orange-600 to-red-600 rounded-3xl blur-xl opacity-20 group-hover:opacity-30 transition duration-1000"></div>
                
                <div class="relative bg-[#121212] border border-orange-500/30 rounded-3xl p-8 shadow-[0_0_30px_rgba(234,88,12,0.15)] overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-5 text-9xl transform rotate-12 select-none grayscale">🏎️</div>
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <div class="relative">
                            <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-4xl shadow-lg shadow-orange-500/40 ring-2 ring-white/10">
                                👋
                            </div>
                        </div>
                        <div class="text-center md:text-left flex-1">
                            <h1 class="text-4xl font-extrabold text-white mb-2 tracking-tight">
                                Hai, <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-red-500"><?php echo e(Auth::user()->name); ?></span> 🚀
                            </h1>
                            <p class="text-gray-400 text-lg max-w-2xl">
                                Siap menjelajah hari ini? Cek status rental dan performa armada Anda di sini.
                            </p>
                        </div>
                        <div class="bg-orange-500/10 border border-orange-500/20 rounded-xl px-5 py-3 text-right backdrop-blur-sm">
                            <p class="text-xs text-orange-400 uppercase tracking-wider mb-1 font-bold">Terakhir Update</p>
                            <p class="font-mono font-semibold text-white"><?php echo e(now()->format('d M Y H:i')); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="group bg-[#121212] border border-orange-500/20 rounded-2xl p-6 hover:bg-[#1a1a1a] transition duration-300 shadow-[0_0_15px_rgba(234,88,12,0.05)] hover:shadow-[0_0_25px_rgba(234,88,12,0.3)] hover:border-orange-500/50">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-gray-800 rounded-xl text-gray-400 group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        </div>
                        <span class="text-xs font-bold px-2 py-1 rounded bg-orange-500/10 text-orange-500 border border-orange-500/20">Total</span>
                    </div>
                    <p class="text-gray-500 text-sm font-medium group-hover:text-gray-300 transition-colors">Semua Transaksi</p>
                    <h3 class="text-3xl font-bold text-white mt-1 group-hover:text-orange-400 transition-colors"><?php echo e($totalRentals ?? 0); ?></h3>
                </div>

                <div class="group bg-[#121212] border border-orange-500/20 rounded-2xl p-6 hover:bg-[#1a1a1a] transition duration-300 shadow-[0_0_15px_rgba(234,88,12,0.05)] hover:shadow-[0_0_25px_rgba(234,88,12,0.3)] hover:border-orange-500/50">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-gray-800 rounded-xl text-gray-400 group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                        </div>
                        <span class="text-xs font-bold px-2 py-1 rounded bg-orange-500/10 text-orange-500 border border-orange-500/20">Aktif</span>
                    </div>
                    <p class="text-gray-500 text-sm font-medium group-hover:text-gray-300 transition-colors">Sedang Berjalan</p>
                    <h3 class="text-3xl font-bold text-white mt-1 group-hover:text-orange-400 transition-colors"><?php echo e($activeRentals ?? 0); ?></h3>
                </div>

                <div class="group bg-[#121212] border border-orange-500/20 rounded-2xl p-6 hover:bg-[#1a1a1a] transition duration-300 shadow-[0_0_15px_rgba(234,88,12,0.05)] hover:shadow-[0_0_25px_rgba(234,88,12,0.3)] hover:border-orange-500/50">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-gray-800 rounded-xl text-gray-400 group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-xs font-bold px-2 py-1 rounded bg-orange-500/10 text-orange-500 border border-orange-500/20">Selesai</span>
                    </div>
                    <p class="text-gray-500 text-sm font-medium group-hover:text-gray-300 transition-colors">Riwayat Sukses</p>
                    <h3 class="text-3xl font-bold text-white mt-1 group-hover:text-orange-400 transition-colors"><?php echo e($completedRentals ?? 0); ?></h3>
                </div>

                <div class="group bg-[#121212] border border-orange-500/20 rounded-2xl p-6 hover:bg-[#1a1a1a] transition duration-300 shadow-[0_0_15px_rgba(234,88,12,0.05)] hover:shadow-[0_0_25px_rgba(234,88,12,0.3)] hover:border-orange-500/50">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-gray-800 rounded-xl text-gray-400 group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-xs font-bold px-2 py-1 rounded bg-orange-500/10 text-orange-500 border border-orange-500/20">Biaya</span>
                    </div>
                    <p class="text-gray-500 text-sm font-medium group-hover:text-gray-300 transition-colors">Total Pengeluaran</p>
                    <h3 class="text-2xl font-bold text-white mt-1 group-hover:text-orange-400 transition-colors">Rp <?php echo e(number_format($totalSpent ?? 0, 0, ',', '.')); ?></h3>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-[#121212] border border-orange-500/20 rounded-2xl p-6 relative overflow-hidden shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-orange-600/10 rounded-full blur-2xl -mr-10 -mt-10"></div>
                    <h4 class="text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-orange-500"></span> Refund
                    </h4>
                    <p class="text-4xl font-extrabold text-white mb-4"><?php echo e($totalRefunds); ?></p>
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm items-center">
                            <span class="text-gray-500">Disetujui</span>
                            <span class="font-bold text-orange-400 bg-orange-500/10 px-2 py-0.5 rounded border border-orange-500/20"><?php echo e($approvedRefunds); ?></span>
                        </div>
                        <div class="w-full bg-gray-800 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-gradient-to-r from-orange-600 to-yellow-500 h-1.5 rounded-full shadow-[0_0_10px_#ea580c]" style="width: <?php echo e($refundApprovedPercent); ?>%"></div>
                        </div>
                        <div class="flex justify-between text-sm items-center">
                            <span class="text-gray-500">Pending</span>
                            <span class="font-bold text-gray-300"><?php echo e($pendingRefunds); ?></span>
                        </div>
                    </div>
                </div>

                <div class="bg-[#121212] border border-orange-500/20 rounded-2xl p-6 relative overflow-hidden shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-red-600/10 rounded-full blur-2xl -mr-10 -mt-10"></div>
                    <h4 class="text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-red-500"></span> Dibatalkan
                    </h4>
                    <p class="text-4xl font-extrabold text-white mb-4"><?php echo e($cancelledRentals); ?></p>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Total pembatalan dalam riwayat Anda. <br>
                        <a href="#" class="text-orange-500 hover:text-orange-400 underline decoration-orange-500/30">Cek Kebijakan</a>
                    </p>
                </div>

                <div class="bg-[#121212] border border-orange-500/20 rounded-2xl p-6 relative shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                    <h4 class="text-gray-400 text-sm font-semibold uppercase tracking-wider mb-4 border-b border-gray-800 pb-2">Statistik Cepat</h4>
                    
                    <div class="space-y-5">
                        <div>
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-400">Success Rate</span>
                                <span class="text-orange-500 font-bold"><?php echo e($totalRentals > 0 ? round(($completedRentals / $totalRentals) * 100, 1) : 0); ?>%</span>
                            </div>
                            <div class="w-full bg-gray-800 h-2 rounded-full overflow-hidden">
                                <div class="bg-gradient-to-r from-orange-600 to-red-600 h-2 rounded-full shadow-[0_0_10px_#ea580c]" style="width: <?php echo e($rentalSuccessPercent); ?>%"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-xs uppercase font-bold">Rata-rata / Sewa</span>
                            <span class="text-xl font-bold text-white">Rp <?php echo e($completedRentals > 0 ? number_format($totalSpent / $completedRentals, 0, ',', '.') : 0); ?></span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2 mt-2">
                             <button class="bg-orange-600 hover:bg-orange-500 text-white text-xs font-bold py-2 px-3 rounded-lg transition shadow-lg shadow-orange-600/20">Lihat Katalog</button>
                             <button class="bg-transparent border border-gray-700 hover:border-orange-500 text-gray-300 hover:text-white text-xs font-bold py-2 px-3 rounded-lg transition">Cara Pesan</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div class="bg-[#121212] border border-orange-500/20 rounded-2xl p-6 shadow-xl">
                    <div class="flex items-center justify-between mb-6 border-b border-gray-800 pb-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            Tren Rental
                        </h3>
                        <span class="text-xs font-mono text-orange-500 border border-orange-500/30 px-2 py-1 rounded bg-orange-500/5">7 HARI TERAKHIR</span>
                    </div>
                    <?php
                        $trendCountsArray = [];
                        if (!empty($trendCounts)) {
                            if (is_array($trendCounts)) {
                                $trendCountsArray = $trendCounts;
                            } elseif ($trendCounts instanceof \Illuminate\Support\Collection) {
                                $trendCountsArray = $trendCounts->toArray();
                            }
                        }
                    ?>
                    <?php if(empty($trendCountsArray) || array_sum($trendCountsArray) == 0): ?>
                        <div class="flex flex-col items-center justify-center h-64 text-gray-600 gap-2">
                            <span>Belum ada data tren.</span>
                        </div>
                    <?php else: ?>
                        <div class="relative h-64 w-full">
                            <canvas id="trendChart"></canvas>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="bg-[#121212] border border-orange-500/20 rounded-2xl p-6 shadow-xl">
                    <div class="flex items-center justify-between mb-6 border-b border-gray-800 pb-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            Pengeluaran Bulanan
                        </h3>
                         <span class="text-xs font-mono text-orange-500 border border-orange-500/30 px-2 py-1 rounded bg-orange-500/5">IDR</span>
                    </div>
                    <?php if(empty($monthlyLabels)): ?>
                         <div class="flex flex-col items-center justify-center h-64 text-gray-600 gap-2">
                            <span>Belum ada data pengeluaran.</span>
                        </div>
                    <?php else: ?>
                        <div class="relative h-64 w-full">
                            <canvas id="spendingChart"></canvas>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="md:col-span-1 bg-[#121212] border border-orange-500/20 rounded-2xl p-6 shadow-xl">
                     <div class="flex items-center justify-between mb-4 border-b border-gray-800 pb-4">
                        <h3 class="text-lg font-bold text-white">Status Rental</h3>
                    </div>
                    <?php if(empty($statusLabels)): ?>
                        <div class="flex flex-col items-center justify-center h-48 text-gray-600 gap-2">
                            <span>Belum ada data status.</span>
                        </div>
                    <?php else: ?>
                        <div class="relative h-48 w-full flex justify-center">
                            <canvas id="statusChart"></canvas>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="md:col-span-2 bg-gradient-to-r from-[#1a1a1a] to-[#121212] border border-gray-800 rounded-2xl p-6 flex flex-col justify-center">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-orange-600 rounded-lg text-white shrink-0 shadow-[0_0_15px_#ea580c]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-lg mb-1">DriveHub Dashboard</h4>
                            <p class="text-gray-400 text-sm mb-4 leading-relaxed">
                                Ini adalah ringkasan pribadi aktivitas Anda. Semua data disajikan secara <i>real-time</i>. 
                                Jika ada ketidaksesuaian data pembayaran, segera hubungi dukungan pelanggan kami yang tersedia 24/7.
                            </p>
                            <a href="<?php echo e(route('rentals.index')); ?>" class="inline-flex items-center text-sm font-bold text-orange-500 hover:text-orange-400 transition gap-1">
                                Lihat Riwayat Lengkap &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <script>
        // --- Dark & Orange Theme Configuration ---
        Chart.defaults.color = '#6b7280'; // gray-500
        Chart.defaults.borderColor = '#262626'; // neutral-800
        Chart.defaults.font.family = "'Inter', sans-serif";

        // 1. Trend Chart (Line)
        const trendCanvas = document.getElementById('trendChart');
        if (trendCanvas) {
            const trendCtx = trendCanvas.getContext('2d');
            const trendLabels = <?php echo json_encode($trendDates ?? []); ?>;
            const trendData = <?php echo json_encode($trendCounts ?? []); ?>;
            
            // Orange Gradient
            let gradient = trendCtx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(234, 88, 12, 0.5)'); // Orange-600
            gradient.addColorStop(1, 'rgba(234, 88, 12, 0.0)');

            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: trendLabels,
                    datasets: [{
                        label: 'Jumlah Rental',
                        data: trendData,
                        borderColor: '#ea580c', // Orange-600
                        backgroundColor: gradient,
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#000',
                        pointBorderColor: '#ea580c',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#171717',
                            titleColor: '#fff',
                            bodyColor: '#fb923c', // orange-300
                            borderColor: '#ea580c',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [4, 4], color: '#333' },
                            ticks: { stepSize: 1, color: '#9ca3af' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#9ca3af' }
                        }
                    }
                }
            });
        }

        // 2. Status Chart (Doughnut)
        const statusCanvas = document.getElementById('statusChart');
        if (statusCanvas) {
            const statusCtx = statusCanvas.getContext('2d');
            const statusLabels = <?php echo json_encode($statusLabels ?? []); ?>;
            const statusCounts = <?php echo json_encode($statusCounts ?? []); ?>;
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        data: statusCounts,
                        backgroundColor: [
                            '#ea580c', // Orange-600 (Main)
                            '#22c55e', // Green-500 (Success)
                            '#ef4444', // Red-500 (Fail)
                            '#eab308', // Yellow-500 (Pending)
                            '#64748b'  // Slate-500 (Other)
                        ],
                        borderColor: '#121212', // Match card bg
                        borderWidth: 4,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: { 
                                usePointStyle: true, 
                                padding: 15,
                                color: '#d1d5db' // gray-300
                            }
                        }
                    },
                    cutout: '75%',
                }
            });
        }

        // 3. Spending Chart (Bar)
        const spendingCanvas = document.getElementById('spendingChart');
        if (spendingCanvas) {
            const spendingCtx = spendingCanvas.getContext('2d');
            const monthlyLabels = <?php echo json_encode($monthlyLabels ?? []); ?>;
            const monthlyValues = <?php echo json_encode($monthlyValues ?? []); ?>;
            
            new Chart(spendingCtx, {
                type: 'bar',
                data: {
                    labels: monthlyLabels,
                    datasets: [{
                        label: 'Pengeluaran',
                        data: monthlyValues,
                        backgroundColor: '#ea580c', // Orange-600
                        borderRadius: 4,
                        hoverBackgroundColor: '#f97316', // Orange-500
                        barThickness: 20
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#171717',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#ea580c',
                            borderWidth: 1,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) { label += ': '; }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [4, 4], color: '#333' },
                            ticks: {
                                color: '#9ca3af',
                                callback: function(value) {
                                    return 'Rp ' + (value/1000).toLocaleString('id-ID') + 'k';
                                }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#9ca3af' }
                        }
                    }
                }
            });
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/dashboard/user-dashboard.blade.php ENDPATH**/ ?>