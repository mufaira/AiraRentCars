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
        <h2 class="font-bold text-xl text-white leading-tight flex items-center gap-3">
            <div class="relative flex h-3 w-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
            </div>
            <span class="tracking-wide uppercase font-mono text-sm text-orange-500">System //</span>
            <?php echo e(__('Dashboard Infografis')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <style>
        .bg-tech-grid {
            background-size: 50px 50px;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            mask-image: radial-gradient(circle at center, black 40%, transparent 80%);
            -webkit-mask-image: radial-gradient(circle at center, black 40%, transparent 80%);
        }
        .card-hud {
            background: linear-gradient(145deg, rgba(20, 20, 20, 0.9) 0%, rgba(10, 10, 10, 0.95) 100%);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
        }
        .corner-accent::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 10px;
            height: 10px;
            border-top: 2px solid rgba(249, 115, 22, 0.5);
            border-left: 2px solid rgba(249, 115, 22, 0.5);
            border-top-left-radius: 4px;
        }
        .corner-accent::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 10px;
            height: 10px;
            border-bottom: 2px solid rgba(249, 115, 22, 0.5);
            border-right: 2px solid rgba(249, 115, 22, 0.5);
            border-bottom-right-radius: 4px;
        }
    </style>

    <div class="min-h-screen bg-[#050505] text-gray-100 py-8 relative overflow-hidden font-sans selection:bg-orange-500 selection:text-white">
        
        <div class="fixed inset-0 bg-tech-grid pointer-events-none z-0"></div>
        <div class="fixed top-0 left-1/4 w-[500px] h-[500px] bg-orange-600/10 rounded-full blur-[150px] pointer-events-none"></div>
        <div class="fixed bottom-0 right-1/4 w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[150px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <div class="mb-10 relative group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-orange-600 to-red-600 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                <div class="relative card-hud rounded-2xl p-8 border border-white/5 flex flex-col md:flex-row items-center justify-between overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10 font-mono text-xs text-right hidden md:block">
                        SYS.VER.2.4<br>STATUS: OPTIMAL
                    </div>
                    
                    <div class="z-10">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-orange-500/20 text-orange-400 border border-orange-500/30 uppercase tracking-wider">Analytics Mode</span>
                        </div>
                        <h1 class="text-4xl font-extrabold text-white tracking-tight">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">Command Center</span>
                        </h1>
                        <p class="text-gray-400 mt-2 max-w-xl">
                            Monitoring real-time armada dan performa bisnis. Data diperbarui otomatis.
                        </p>
                    </div>

                    <div class="mt-6 md:mt-0 flex gap-4">
                        <div class="bg-black/40 border border-white/10 rounded-xl px-5 py-3 text-center backdrop-blur-md">
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest">Total Aset</p>
                            <p class="text-2xl font-mono font-bold text-white"><?php echo e($totalCars); ?> <span class="text-sm text-gray-600">Unit</span></p>
                        </div>
                        <div class="bg-orange-600/10 border border-orange-500/20 rounded-xl px-5 py-3 text-center backdrop-blur-md">
                            <p class="text-[10px] text-orange-400 uppercase tracking-widest">Active</p>
                            <p class="text-2xl font-mono font-bold text-orange-500"><?php echo e($activeRentals); ?> <span class="text-sm text-orange-500/50">Sewa</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <div class="card-hud rounded-xl p-5 border border-white/5 relative group hover:-translate-y-1 transition duration-300 corner-accent">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2.5 bg-blue-500/10 rounded-lg text-blue-400 group-hover:bg-blue-500 group-hover:text-white transition shadow-[0_0_15px_rgba(59,130,246,0.2)]">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                        </div>
                        <span class="text-[10px] font-mono text-gray-500 group-hover:text-blue-400 transition">FLEET_ID_01</span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Total Armada</p>
                        <h3 class="text-3xl font-bold text-white mt-1 group-hover:text-blue-400 transition"><?php echo e($totalCars); ?></h3>
                    </div>
                </div>

                <div class="card-hud rounded-xl p-5 border border-white/5 relative group hover:-translate-y-1 transition duration-300 corner-accent">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2.5 bg-emerald-500/10 rounded-lg text-emerald-400 group-hover:bg-emerald-500 group-hover:text-white transition shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-[10px] font-mono text-gray-500 group-hover:text-emerald-400 transition">READY_STS</span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Tersedia</p>
                        <h3 class="text-3xl font-bold text-white mt-1 group-hover:text-emerald-400 transition"><?php echo e($availableCars); ?></h3>
                    </div>
                    <div class="w-full bg-gray-800 h-1 mt-3 rounded-full overflow-hidden">
                        <div class="bg-emerald-500 h-1 rounded-full" style="width: <?php echo e($availableCarsPercent); ?>%"></div>
                    </div>
                </div>

                <div class="card-hud rounded-xl p-5 border border-white/5 relative group hover:-translate-y-1 transition duration-300 corner-accent">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2.5 bg-orange-500/10 rounded-lg text-orange-400 group-hover:bg-orange-500 group-hover:text-white transition shadow-[0_0_15px_rgba(249,115,22,0.2)]">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-[10px] font-mono text-gray-500 group-hover:text-orange-400 transition">ACTIVE_OP</span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Sedang Disewa</p>
                        <h3 class="text-3xl font-bold text-white mt-1 group-hover:text-orange-400 transition"><?php echo e($rentedCars); ?></h3>
                    </div>
                    <div class="w-full bg-gray-800 h-1 mt-3 rounded-full overflow-hidden">
                        <div class="bg-orange-500 h-1 rounded-full" style="width: <?php echo e($rentedCarsPercent); ?>%"></div>
                    </div>
                </div>

                <div class="card-hud rounded-xl p-5 border border-white/5 relative group hover:-translate-y-1 transition duration-300 corner-accent">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2.5 bg-red-500/10 rounded-lg text-red-400 group-hover:bg-red-500 group-hover:text-white transition shadow-[0_0_15px_rgba(239,68,68,0.2)]">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        </div>
                        <span class="text-[10px] font-mono text-gray-500 group-hover:text-red-400 transition">ALERT_LVL</span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Tingkat Batal</p>
                        <h3 class="text-3xl font-bold text-white mt-1 group-hover:text-red-400 transition"><?php echo e($cancellationRate); ?>%</h3>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="lg:col-span-2 card-hud rounded-2xl p-6 border border-white/5">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <span class="w-1 h-5 bg-orange-500 rounded-full"></span>
                            Trafik Rental
                        </h3>
                        <div class="flex gap-2">
                             <span class="px-2 py-1 bg-white/5 rounded text-xs text-gray-400 font-mono">7 HARI</span>
                        </div>
                    </div>
                    <div class="relative h-72 w-full">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>

                <div class="lg:col-span-1 card-hud rounded-2xl p-6 border border-white/5 flex flex-col">
                    <div class="flex items-center justify-between mb-2">
                         <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <span class="w-1 h-5 bg-blue-500 rounded-full"></span>
                            Status Real-time
                        </h3>
                    </div>
                    <div class="relative flex-1 flex items-center justify-center">
                        <canvas id="statusChart"></canvas>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-2 text-xs text-gray-400">
                        <div class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Selesai</div>
                        <div class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-orange-500"></span> Berjalan</div>
                        <div class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-red-500"></span> Batal</div>
                        <div class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-yellow-500"></span> Pending</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-8">
                <div class="bg-[#0f0f0f] border border-white/5 p-4 rounded-xl text-center">
                    <p class="text-[10px] text-gray-500 uppercase">Refund Req</p>
                    <p class="text-xl font-bold text-white"><?php echo e($totalRefunds); ?></p>
                </div>
                <div class="bg-[#0f0f0f] border border-white/5 p-4 rounded-xl text-center">
                    <p class="text-[10px] text-gray-500 uppercase">Success Rate</p>
                    <p class="text-xl font-bold text-indigo-400"><?php echo e($completedRentals > 0 ? round(($completedRentals / $totalRentals) * 100) : 0); ?>%</p>
                </div>
                <div class="bg-[#0f0f0f] border border-white/5 p-4 rounded-xl text-center">
                    <p class="text-[10px] text-gray-500 uppercase">Avg/Day</p>
                    <p class="text-xl font-bold text-orange-400"><?php echo e($totalRentals > 0 ? round($totalRentals / 30, 1) : 0); ?></p>
                </div>
            </div>

            <div class="border-t border-white/5 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500 font-mono">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    SYSTEM ONLINE // DRIVEHUB ADMIN v3.0
                </div>
                <div class="mt-2 md:mt-0">
                    SECURE CONNECTION ENCRYPTED
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <script>
        // Global Chart Defaults for "Cyber" Theme
        Chart.defaults.color = '#64748b'; 
        Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.05)';
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.scale.grid.display = false; // Minimal grid lines

        // Safe JSON parsing function
        function safeJsonParse(data, defaultValue = []) {
            try {
                const parsed = typeof data === 'string' ? JSON.parse(data) : data;
                return Array.isArray(parsed) && parsed.length > 0 ? parsed : defaultValue;
            } catch (e) {
                console.error('JSON Parse Error:', e);
                return defaultValue;
            }
        }

        // 1. TREND CHART (Area Glow)
        const trendCtx = document.getElementById('trendChart');
        if (trendCtx) {
            const trendLabels = safeJsonParse('<?php echo e(json_encode($trendDates ?? [])); ?>', ['Belum Ada Data']);
            const trendData = safeJsonParse('<?php echo e(json_encode($trendCounts ?? [])); ?>', [0]);
            
            const ctx = trendCtx.getContext('2d');
            let trendGrad = ctx.createLinearGradient(0, 0, 0, 400);
            trendGrad.addColorStop(0, 'rgba(249, 115, 22, 0.4)'); // Orange glow
            trendGrad.addColorStop(1, 'rgba(249, 115, 22, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: trendLabels,
                    datasets: [{
                        label: 'Rental',
                        data: trendData,
                        borderColor: '#f97316',
                        borderWidth: 2,
                        backgroundColor: trendGrad,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#000',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { grid: { borderDash: [2, 4], color: 'rgba(255,255,255,0.05)' }, beginAtZero: true },
                        x: { grid: { display: false } }
                    }
                }
            });
        }

        // 2. STATUS CHART (Hollow Doughnut)
        const statusCtx = document.getElementById('statusChart');
        if (statusCtx) {
            const statusLabels = safeJsonParse('<?php echo e(json_encode($statusLabels ?? [])); ?>', ['Pending', 'Active', 'Completed']);
            const statusCounts = safeJsonParse('<?php echo e(json_encode($statusCounts ?? [])); ?>', [1, 1, 1]);
            
            const ctx = statusCtx.getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        data: statusCounts,
                        backgroundColor: ['#eab308', '#f97316', '#10b981', '#ef4444', '#6366f1'],
                        borderColor: '#141414', // Match card bg
                        borderWidth: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '80%', // Thinner ring
                    plugins: { legend: { display: true, position: 'bottom' } }
                }
            });
        }

        // 3. REVENUE CHART (Gradient Bars) - REMOVED
        // const revenueCtx = document.getElementById('revenueChart');

        // 4. OCCUPANCY CHART (Horizontal) - REMOVED
        // const occCtx = document.getElementById('occupancyChart');
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
<?php endif; ?><?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/dashboard/infografis.blade.php ENDPATH**/ ?>