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
<div class="min-h-screen bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <a href="<?php echo e(route('rentals.index')); ?>" class="inline-flex items-center gap-2 text-gray-400 hover:text-[#f53003] transition mb-8">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Sewa
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Rental Info -->
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-8 mb-6">
                    <h2 class="text-3xl font-bold text-white mb-6">Detail Rental #<?php echo e($rental->id); ?></h2>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Status Rental</p>
                            <p class="font-bold text-lg">
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold
                                    <?php if($rental->status === 'Pending'): ?> bg-yellow-500/20 text-yellow-400 border border-yellow-500/50
                                    <?php elseif($rental->status === 'Paid'): ?> bg-blue-500/20 text-blue-400 border border-blue-500/50
                                    <?php elseif($rental->status === 'Active'): ?> bg-green-500/20 text-green-400 border border-green-500/50
                                    <?php elseif($rental->status === 'Completed'): ?> bg-gray-500/20 text-gray-400 border border-gray-500/50
                                    <?php else: ?> bg-red-500/20 text-red-400 border border-red-500/50
                                    <?php endif; ?>">
                                    <span class="w-2 h-2 rounded-full
                                        <?php if($rental->status === 'Pending'): ?> bg-yellow-400
                                        <?php elseif($rental->status === 'Paid'): ?> bg-blue-400
                                        <?php elseif($rental->status === 'Active'): ?> bg-green-400
                                        <?php elseif($rental->status === 'Completed'): ?> bg-gray-400
                                        <?php else: ?> bg-red-400
                                        <?php endif; ?>"></span>
                                    <?php echo e($rental->status); ?>

                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Mobil</p>
                            <p class="font-bold text-lg text-white"><?php echo e($rental->car->name); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Tanggal Sewa</p>
                            <p class="font-bold text-white"><?php echo e($rental->rental_date->format('d M Y')); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Tanggal Kembali</p>
                            <p class="font-bold text-white"><?php echo e($rental->return_date->format('d M Y')); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Durasi</p>
                            <p class="font-bold text-white"><?php echo e($rental->duration_days); ?> hari</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Total Harga</p>
                            <p class="font-bold text-lg bg-gradient-to-r from-[#f53003] to-orange-500 bg-clip-text text-transparent">Rp <?php echo e(number_format($rental->total_price, 0, ',', '.')); ?></p>
                        </div>
                    </div>

                    <?php if($rental->notes): ?>
                        <div class="border-t border-white/10 pt-6">
                            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Catatan</p>
                            <p class="text-gray-300"><?php echo e($rental->notes); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Payment & Refund Status -->
            <div>
                <!-- Payment Card -->
                <div class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-8 mb-6">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                        </svg>
                        Status Pembayaran
                    </h3>

                    <?php if($rental->payment): ?>
                        <div class="space-y-4">
                            <div>
                                <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Status</p>
                                <p class="font-bold">
                                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold
                                        <?php if($rental->payment->status === 'Pending'): ?> bg-yellow-500/20 text-yellow-400 border border-yellow-500/50
                                        <?php elseif($rental->payment->status === 'Verified'): ?> bg-green-500/20 text-green-400 border border-green-500/50
                                        <?php else: ?> bg-red-500/20 text-red-400 border border-red-500/50
                                        <?php endif; ?>">
                                        <span class="w-2 h-2 rounded-full
                                            <?php if($rental->payment->status === 'Pending'): ?> bg-yellow-400
                                            <?php elseif($rental->payment->status === 'Verified'): ?> bg-green-400
                                            <?php else: ?> bg-red-400
                                            <?php endif; ?>"></span>
                                        <?php echo e($rental->payment->status); ?>

                                    </span>
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Jumlah Pembayaran</p>
                                <p class="font-bold text-lg text-white">Rp <?php echo e(number_format($rental->payment->amount, 0, ',', '.')); ?></p>
                            </div>

                            <div>
                                <p class="text-gray-400 text-sm uppercase tracking-wide mb-3">Bukti Pembayaran</p>
                                <img src="<?php echo e(asset('storage/' . $rental->payment->payment_proof_path)); ?>" 
                                     alt="Bukti pembayaran" class="w-full rounded-lg border border-white/10 hover:border-[#f53003]/50 transition">
                            </div>

                            <?php if($rental->payment->admin_notes): ?>
                                <div class="bg-white/5 border border-white/10 p-4 rounded-lg">
                                    <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Catatan Admin</p>
                                    <p class="text-gray-300 text-sm"><?php echo e($rental->payment->admin_notes); ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if($rental->payment->status === 'Pending'): ?>
                                <a href="<?php echo e(route('rentals.payment', $rental)); ?>" class="block text-center bg-[#f53003] hover:bg-[#d63000] text-white px-4 py-3 rounded-lg font-bold transition transform hover:-translate-y-0.5 mt-4">
                                    Update Pembayaran
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="bg-yellow-500/20 border border-yellow-500/50 rounded-lg p-4 mb-4">
                            <p class="text-yellow-400 text-sm mb-4">Belum ada pembayaran</p>
                            <a href="<?php echo e(route('rentals.payment', $rental)); ?>" class="block text-center bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg font-bold transition">
                                Lakukan Pembayaran
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Refund Section -->
                <div class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-8">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#f53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Refund / Pembatalan
                    </h3>

                    <?php if($rental->refundRequest): ?>
                        <div class="bg-blue-500/20 border border-blue-500/50 rounded-lg p-4 mb-4">
                            <div class="mb-4">
                                <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Status Refund</p>
                                <p class="font-bold">
                                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold
                                        <?php if($rental->refundRequest->status === 'Pending'): ?> bg-yellow-500/20 text-yellow-400 border border-yellow-500/50
                                        <?php elseif($rental->refundRequest->status === 'Approved'): ?> bg-green-500/20 text-green-400 border border-green-500/50
                                        <?php else: ?> bg-red-500/20 text-red-400 border border-red-500/50
                                        <?php endif; ?>">
                                        <span class="w-2 h-2 rounded-full
                                            <?php if($rental->refundRequest->status === 'Pending'): ?> bg-yellow-400
                                            <?php elseif($rental->refundRequest->status === 'Approved'): ?> bg-green-400
                                            <?php else: ?> bg-red-400
                                            <?php endif; ?>"></span>
                                        <?php echo e($rental->refundRequest->status); ?>

                                    </span>
                                </p>
                            </div>

                            <?php if($rental->refundRequest->admin_notes): ?>
                                <div class="bg-white/5 border border-white/10 p-3 rounded text-sm">
                                    <p class="text-gray-400 mb-1"><strong>Catatan Admin:</strong></p>
                                    <p class="text-gray-300"><?php echo e($rental->refundRequest->admin_notes); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php elseif($rental->status === 'Pending' && !$rental->payment): ?>
                        <!-- Cancel untuk yang belum bayar -->
                        <form method="POST" action="<?php echo e(route('rentals.cancel', $rental)); ?>" style="display: inline; width: 100%;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg font-bold transition"
                                    onclick="return confirm('Anda yakin ingin membatalkan rental ini?')">
                                Batalkan Pesanan
                            </button>
                        </form>
                    <?php elseif(in_array($rental->status, ['Paid', 'Active'])): ?>
                        <!-- Refund untuk yang sudah bayar -->
                        <button onclick="confirmRefund()" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg font-bold transition">
                            Ajukan Refund
                        </button>

                        <script>
                            function confirmRefund() {
                                if (confirm('Anda yakin ingin melakukan refund untuk rental ini? Silakan review alasan Anda dengan hati-hati.')) {
                                    window.location.href = '<?php echo e(route('refunds.create', $rental)); ?>';
                                }
                            }
                        </script>
                    <?php else: ?>
                        <div class="bg-white/5 border border-white/10 rounded-lg p-4 text-sm text-gray-400">
                            Rental dengan status <?php echo e($rental->status); ?> tidak dapat dibatalkan atau di-refund
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/rentals/show.blade.php ENDPATH**/ ?>