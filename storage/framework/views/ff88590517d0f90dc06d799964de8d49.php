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
<style>
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    
    .status-badge {
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.3px;
        padding: 6px 12px;
        border-radius: 8px;
        display: inline-block;
    }

    .status-pending {
        background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 100%);
        color: #92400e;
        border: 1px solid #f59e0b;
    }

    .status-approved {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border: 1px solid #10b981;
    }

    .status-rejected {
        background: linear-gradient(135deg, #fee2e2 0%, #fca5a5 100%);
        color: #7f1d1d;
        border: 1px solid #ef4444;
    }

    table tbody tr {
        transition: all 0.3s ease;
    }

    table tbody tr:hover {
        background-color: #f9fafb;
        box-shadow: inset 0 0 0 1px #e5e7eb;
    }
</style>

<div class="container mx-auto px-4 py-10">
    <div class="mb-8">
        <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base transition group">
            <span class="mr-2 group-hover:-translate-x-1 transition">←</span> Kembali ke Dashboard
        </a>
    </div>

    <div class="mb-10 bg-gradient-to-r from-amber-600 to-amber-700 rounded-2xl p-8 shadow-lg">
        <h1 class="text-5xl font-bold text-white mb-3">Kelola Permintaan Refund</h1>
        <p class="text-amber-100 font-medium text-base">Review dan proses semua permintaan refund dari pelanggan</p>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-8 shadow-sm font-medium">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-8 shadow-sm font-medium">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <!-- Filter Status -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-200">
        <form action="<?php echo e(route('refunds.admin.index')); ?>" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
            <div class="flex-1">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Filter Status</label>
                <select name="status" class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100 transition">
                    <option value="">Semua Status</option>
                    <option value="Pending" <?php echo e(request('status') === 'Pending' ? 'selected' : ''); ?>>Pending</option>
                    <option value="Approved" <?php echo e(request('status') === 'Approved' ? 'selected' : ''); ?>>Approved</option>
                    <option value="Rejected" <?php echo e(request('status') === 'Rejected' ? 'selected' : ''); ?>>Rejected</option>
                </select>
            </div>
            <button type="submit" class="bg-gradient-to-r from-amber-600 to-amber-700 text-white px-8 py-3 rounded-xl hover:from-amber-700 hover:to-amber-800 font-bold transition shadow-lg hover:shadow-xl">Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">User</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Mobil</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Alasan</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Jumlah Refund</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Tanggal Request</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $refunds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-gray-100">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900"><?php echo e($refund->rental->user->name); ?></div>
                                <div class="text-gray-500 text-xs font-medium"><?php echo e($refund->rental->user->email); ?></div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900"><?php echo e($refund->rental->car->name); ?></td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900"><?php echo e($refund->reason_text); ?></div>
                                <?php if($refund->custom_reason): ?>
                                    <div class="text-xs text-gray-600 mt-1 font-medium"><?php echo e(Str::limit($refund->custom_reason, 50)); ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 font-bold text-amber-600">Rp <?php echo e(number_format($refund->refund_amount, 0, ',', '.')); ?></td>
                            <td class="px-6 py-4">
                                <span class="status-badge
                                    <?php if($refund->status === 'Pending'): ?> status-pending
                                    <?php elseif($refund->status === 'Approved'): ?> status-approved
                                    <?php else: ?> status-rejected
                                    <?php endif; ?>">
                                    <?php echo e($refund->status); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-700"><?php echo e($refund->created_at->format('d M Y H:i')); ?></td>
                            <td class="px-6 py-4">
                                <?php if($refund->status === 'Pending'): ?>
                                    <a href="<?php echo e(route('refunds.admin.show', $refund)); ?>" class="inline-flex items-center gap-2 text-white bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-2 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition text-sm shadow-md">
                                        Review
                                    </a>
                                <?php else: ?>
                                    <span class="text-gray-500 text-xs font-semibold bg-gray-100 px-3 py-2 rounded-lg"><?php echo e($refund->status); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <p class="text-gray-500 font-medium text-base">Tidak ada permintaan refund</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        <?php echo e($refunds->links()); ?>

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
<?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/admin/refunds/index.blade.php ENDPATH**/ ?>