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
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-300 hover:underline text-sm">← Kembali ke Dashboard</a>
            </div>

            <div class="mb-6 flex items-center gap-4">
                <h1 class="text-2xl md:text-3xl font-extrabold text-white">Kelola Mobil</h1>
                <a href="<?php echo e(route('cars.admin.create')); ?>" class="ml-auto inline-flex items-center gap-2 bg-gradient-to-br from-[#ff7a59] to-[#f53003] text-white px-4 py-2 rounded-2xl shadow-lg hover:opacity-95">
                    <span class="text-lg">+</span> <span class="font-semibold">Tambah Mobil</span>
                </a>
            </div>

            <?php if(session('success')): ?>
                <div class="bg-green-900/40 border border-green-700 text-green-100 px-4 py-3 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="bg-gradient-to-br from-[#070707] to-[#091019] border border-white/6 rounded-2xl p-4 shadow-md">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="text-left text-sm text-gray-300 border-b border-white/6">
                                <th class="px-4 py-3">Foto</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Harga/Hari</th>
                                <th class="px-4 py-3">Transmisi</th>
                                <th class="px-4 py-3">Kapasitas</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Aktif</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="border-b border-white/6 hover:bg-white/2">
                                    <td class="px-4 py-3 align-middle">
                                        <?php if($car->featured_photo): ?>
                                            <img src="<?php echo e(asset('storage/' . $car->featured_photo->photo_path)); ?>" 
                                                 alt="<?php echo e($car->name); ?>" class="w-14 h-14 object-cover rounded-lg">
                                        <?php else: ?>
                                            <div class="w-14 h-14 bg-gray-800 rounded-lg flex items-center justify-center text-xs text-gray-400">No foto</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 align-middle text-white"><?php echo e($car->name); ?></td>
                                    <td class="px-4 py-3 align-middle text-gray-300">Rp <?php echo e(number_format($car->price_per_day, 0, ',', '.')); ?></td>
                                    <td class="px-4 py-3 align-middle text-gray-300"><?php echo e($car->transmission); ?></td>
                                    <td class="px-4 py-3 align-middle text-gray-300"><?php echo e($car->capacity); ?> orang</td>
                                    <td class="px-4 py-3 align-middle">
                                        <?php if($car->status === 'Tersedia'): ?>
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-emerald-900/30 text-emerald-200"><?php echo e($car->status); ?></span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-red-900/30 text-red-200"><?php echo e($car->status); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <?php if($car->is_active): ?>
                                            <span class="px-2 py-1 rounded-full text-xs bg-blue-900/30 text-blue-200">Ya</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 rounded-full text-xs bg-gray-800 text-gray-400">Tidak</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 align-middle space-x-3">
                                        <a href="<?php echo e(route('cars.admin.edit', $car)); ?>" class="inline-flex items-center gap-2 text-sm text-white/90 bg-white/6 px-3 py-1 rounded hover:bg-white/8">Edit</a>
                                        <form action="<?php echo e(route('cars.admin.destroy', $car)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="inline-flex items-center gap-2 text-sm text-red-300 bg-red-900/10 px-3 py-1 rounded hover:opacity-90">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-gray-400">Belum ada mobil</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                <?php echo e($cars->links()); ?>

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
<?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/admin/cars/index.blade.php ENDPATH**/ ?>