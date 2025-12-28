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
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="<?php echo e(route('rentals.show', $rental)); ?>" class="inline-flex items-center gap-2 text-gray-400 hover:text-[#f53003] transition mb-8">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>

        <h1 class="text-4xl font-bold mb-8">Verifikasi <span class="text-[#f53003]">Pembayaran</span></h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Rental Info -->
            <div class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-6">
                <h3 class="text-2xl font-bold mb-6 text-white">Detail Rental</h3>
                
                <div class="space-y-4">
                    <div class="pb-4 border-b border-white/10">
                        <span class="text-gray-400 text-sm">Mobil:</span>
                        <p class="font-semibold text-white text-lg mt-1"><?php echo e($rental->car->name); ?></p>
                    </div>
                    <div class="pb-4 border-b border-white/10">
                        <span class="text-gray-400 text-sm">Tanggal Sewa:</span>
                        <p class="font-semibold text-white text-lg mt-1"><?php echo e($rental->rental_date->format('d M Y')); ?></p>
                    </div>
                    <div class="pb-4 border-b border-white/10">
                        <span class="text-gray-400 text-sm">Durasi:</span>
                        <p class="font-semibold text-white text-lg mt-1"><?php echo e($rental->duration_days); ?> hari</p>
                    </div>
                    <div class="pt-2">
                        <span class="text-gray-400 text-sm">Total Harga:</span>
                        <p class="font-bold text-2xl bg-gradient-to-r from-[#f53003] to-orange-500 bg-clip-text text-transparent mt-1">Rp <?php echo e(number_format($rental->total_price, 0, ',', '.')); ?></p>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-6">
                <h3 class="text-2xl font-bold mb-6 text-white">Upload Bukti Pembayaran</h3>

                <form action="<?php echo e(route('rentals.storePayment', $rental)); ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
                    <?php echo csrf_field(); ?>

                    <div class="bg-[#f53003]/10 border border-[#f53003]/50 rounded-lg p-4">
                        <p class="font-semibold text-[#f53003] mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2z" clip-rule="evenodd"></path></svg>
                            Panduan Pembayaran
                        </p>
                        <ul class="text-gray-300 space-y-2 text-sm list-disc list-inside">
                            <li>Transfer ke rekening yang telah disediakan</li>
                            <li>Jumlah transfer: <span class="font-bold text-[#f53003]">Rp <?php echo e(number_format($rental->total_price, 0, ',', '.')); ?></span></li>
                            <li>Upload screenshot/foto bukti transfer</li>
                            <li>Tunggu verifikasi dari admin (1-2 jam)</li>
                        </ul>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-3">Upload Foto Bukti Pembayaran</label>
                        <div class="relative">
                            <input type="file" name="payment_proof" accept="image/*" 
                                   class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#f53003]/20 file:text-[#f53003] hover:file:bg-[#f53003]/30 <?php $__errorArgs = ['payment_proof'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500/50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        </div>
                        <small class="text-gray-400 text-xs mt-2 block">Format: JPG, PNG, GIF (max 2MB)</small>
                        <?php $__errorArgs = ['payment_proof'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-sm mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-[#f53003] to-orange-600 hover:from-[#d63000] hover:to-orange-700 text-white px-4 py-3 rounded-lg font-bold transition transform hover:-translate-y-0.5 shadow-lg">
                        Kirim Bukti Pembayaran
                    </button>
                </form>
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
<?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/rentals/payment.blade.php ENDPATH**/ ?>