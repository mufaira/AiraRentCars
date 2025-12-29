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
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Back Button -->
        <a href="<?php echo e(route('rentals.show', $rental)); ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold mb-8 transition group">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-8 py-10">
                <h1 class="text-4xl font-bold text-white mb-2">Ajukan Refund</h1>
                <p class="text-red-100 text-lg">Proses permintaan pembatalan rental Anda</p>
            </div>

            <div class="px-8 py-8 space-y-8">
                <!-- Alert Box -->
                <div class="bg-amber-50 border-2 border-amber-200 rounded-xl p-5 shadow-sm">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-amber-900 font-bold text-sm mb-1">Perhatian Penting</p>
                            <p class="text-amber-800 text-sm leading-relaxed">
                                Anda sedang mengajukan refund untuk rental <span class="font-bold text-amber-900"><?php echo e($rental->car->name); ?></span>. 
                                Admin akan meninjau permintaan Anda dan menghubungi Anda dalam waktu <span class="font-bold">1-2 hari kerja</span>.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Rental Summary -->
                <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-6 border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM2 15a4 4 0 018 0v2H2v-2z"></path>
                        </svg>
                        Detail Rental
                    </h3>
                    <div class="grid grid-cols-2 gap-6 text-sm">
                        <div class="bg-white rounded-lg p-4 border border-slate-200">
                            <p class="text-slate-600 text-xs font-semibold uppercase tracking-wide mb-2">Mobil</p>
                            <p class="text-slate-900 font-bold text-base"><?php echo e($rental->car->name); ?></p>
                        </div>
                        <div class="bg-white rounded-lg p-4 border border-slate-200">
                            <p class="text-slate-600 text-xs font-semibold uppercase tracking-wide mb-2">Tanggal Sewa</p>
                            <p class="text-slate-900 font-bold text-base"><?php echo e($rental->rental_date->format('d M Y')); ?></p>
                        </div>
                        <div class="bg-white rounded-lg p-4 border border-slate-200">
                            <p class="text-slate-600 text-xs font-semibold uppercase tracking-wide mb-2">Durasi</p>
                            <p class="text-slate-900 font-bold text-base"><?php echo e($rental->duration_days); ?> hari</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 border border-slate-200">
                            <p class="text-slate-600 text-xs font-semibold uppercase tracking-wide mb-2">Total Harga</p>
                            <p class="text-red-600 font-bold text-base">Rp <?php echo e(number_format($rental->total_price, 0, ',', '.')); ?></p>
                        </div>
                        <div class="bg-white rounded-lg p-4 border border-slate-200">
                            <p class="text-slate-600 text-xs font-semibold uppercase tracking-wide mb-2">Status Rental</p>
                            <p class="text-slate-900 font-bold text-base"><?php echo e($rental->status); ?></p>
                        </div>
                        <div class="bg-white rounded-lg p-4 border border-slate-200">
                            <p class="text-slate-600 text-xs font-semibold uppercase tracking-wide mb-2">Status Pembayaran</p>
                            <?php if($rental->payment): ?>
                                <p class="text-slate-900 font-bold text-base"><?php echo e($rental->payment->status); ?></p>
                            <?php else: ?>
                                <p class="text-slate-400 font-bold text-base">-</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Refund Form -->
                <form action="<?php echo e(route('refunds.store', $rental)); ?>" method="POST" class="space-y-8">
                    <?php echo csrf_field(); ?>

                    <!-- Reason Selection -->
                    <div>
                        <label class="block text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM8 7a1 1 0 000 2h6a1 1 0 000-2H8zM8 11a1 1 0 100 2h3a1 1 0 100-2H8z" clip-rule="evenodd"></path>
                            </svg>
                            Pilih Alasan Refund
                        </label>
                        
                        <div class="space-y-3">
                            <label class="flex items-start p-4 border-2 border-slate-200 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition" onclick="selectReason('change_plan')">
                                <input type="radio" name="reason" value="change_plan" class="mt-1.5 w-5 h-5 text-blue-600 cursor-pointer" required>
                                <div class="ml-4 flex-1">
                                    <p class="font-bold text-slate-900 text-base">Saya memutuskan tidak jadi menyewa mobil ini</p>
                                    <p class="text-slate-600 text-sm mt-1">Berubah rencana atau pertimbangan</p>
                                </div>
                            </label>

                            <label class="flex items-start p-4 border-2 border-slate-200 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition" onclick="selectReason('time_issue')">
                                <input type="radio" name="reason" value="time_issue" class="mt-1.5 w-5 h-5 text-blue-600 cursor-pointer" required>
                                <div class="ml-4 flex-1">
                                    <p class="font-bold text-slate-900 text-base">Jadwal sewa saya berubah atau ada keperluan mendesak</p>
                                    <p class="text-slate-600 text-sm mt-1">Masalah waktu atau keadaan darurat</p>
                                </div>
                            </label>

                            <label class="flex items-start p-4 border-2 border-slate-200 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition" onclick="selectReason('car_issue')">
                                <input type="radio" name="reason" value="car_issue" class="mt-1.5 w-5 h-5 text-blue-600 cursor-pointer" required>
                                <div class="ml-4 flex-1">
                                    <p class="font-bold text-slate-900 text-base">Ada masalah atau ketidaksesuaian dengan kondisi mobil</p>
                                    <p class="text-slate-600 text-sm mt-1">Masalah teknis atau kondisi kendaraan</p>
                                </div>
                            </label>

                            <label class="flex items-start p-4 border-2 border-slate-200 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition" onclick="selectReason('other')">
                                <input type="radio" name="reason" value="other" class="mt-1.5 w-5 h-5 text-blue-600 cursor-pointer" required>
                                <div class="ml-4 flex-1">
                                    <p class="font-bold text-slate-900 text-base">Alasan lainnya</p>
                                    <p class="text-slate-600 text-sm mt-1">Silakan jelaskan alasan Anda di bawah</p>
                                </div>
                            </label>
                        </div>

                        <?php $__errorArgs = ['reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-600 text-sm font-semibold block mt-3 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                <?php echo e($message); ?>

                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Custom Reason -->
                    <div id="customReasonSection" class="hidden">
                        <label class="block text-lg font-bold text-slate-900 mb-3">Jelaskan Alasan Refund Anda</label>
                        <textarea name="custom_reason" rows="5" 
                                  class="w-full border-2 border-slate-300 rounded-lg px-4 py-3 text-slate-900 placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 resize-none text-base font-medium <?php $__errorArgs = ['custom_reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  placeholder="Jelaskan secara detail alasan Anda ingin melakukan refund..."></textarea>
                        <?php $__errorArgs = ['custom_reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-600 text-sm font-semibold block mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                <?php echo e($message); ?>

                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-4 px-6 rounded-lg transition transform hover:-translate-y-0.5 shadow-md flex items-center justify-center gap-2 text-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 2a1 1 0 01.82.403l1.5 2.25H17a2 2 0 012 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V6.653a2 2 0 01.82-1.6l1.5-2.25A1 1 0 016 2h6zm0 4a3 3 0 100 6 3 3 0 000-6z" clip-rule="evenodd"></path>
                            </svg>
                            Ajukan Refund
                        </button>
                        <a href="<?php echo e(route('rentals.show', $rental)); ?>" class="flex-1 bg-slate-400 hover:bg-slate-500 text-white font-bold py-4 px-6 rounded-lg transition transform hover:-translate-y-0.5 shadow-md flex items-center justify-center gap-2 text-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

<script>
    function selectReason(reason) {
        const customSection = document.getElementById('customReasonSection');
        if (reason === 'other') {
            customSection.classList.remove('hidden');
        } else {
            customSection.classList.add('hidden');
        }
    }

    // Check initial state
    window.addEventListener('load', () => {
        const selectedReason = document.querySelector('input[name="reason"]:checked')?.value;
        selectReason(selectedReason || '');
    });
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
<?php endif; ?>
<?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/refunds/create.blade.php ENDPATH**/ ?>