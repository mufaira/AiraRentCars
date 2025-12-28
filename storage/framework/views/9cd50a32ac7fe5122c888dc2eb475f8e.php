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
        <a href="<?php echo e(route('cars.catalog')); ?>" class="inline-flex items-center gap-2 text-gray-400 hover:text-[#f53003] transition mb-8">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Katalog
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Gallery -->
            <div class="lg:col-span-2">
                <!-- Main Photo -->
                <div class="relative aspect-square rounded-2xl overflow-hidden bg-gradient-to-br from-gray-800 to-gray-900 mb-6 border border-white/10">
                    <?php if($car->featured_photo): ?>
                        <img id="mainPhoto" src="<?php echo e(asset('storage/' . $car->featured_photo->photo_path)); ?>" 
                             alt="<?php echo e($car->name); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 3a2 2 0 00-2 2v2h2V5h10v2h2V5a2 2 0 00-2-2H5zm-1 8a1 1 0 100 2h.01a1 1 0 100-2H4zm4-1a2 2 0 110 4 2 2 0 010-4z"></path>
                                </svg>
                                <span class="text-gray-400">Tidak ada foto</span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Thumbnails -->
                <?php if($car->photos->count() > 1): ?>
                    <div class="grid grid-cols-5 gap-2">
                        <?php $__currentLoopData = $car->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button onclick="document.getElementById('mainPhoto').src = this.querySelector('img').src" 
                                    class="relative aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-[#f53003] transition group">
                                <img src="<?php echo e(asset('storage/' . $photo->photo_path)); ?>" 
                                     alt="<?php echo e($car->name); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Car Details -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-8">
                    <!-- Title -->
                    <h1 class="text-3xl font-bold text-white mb-4"><?php echo e($car->name); ?></h1>

                    <!-- Status -->
                    <div class="mb-6">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold
                            <?php echo e($car->status === 'Tersedia' 
                                ? 'bg-green-500/20 text-green-400 border border-green-500/50' 
                                : 'bg-red-500/20 text-red-400 border border-red-500/50'); ?>">
                            <span class="w-2 h-2 rounded-full <?php echo e($car->status === 'Tersedia' ? 'bg-green-400' : 'bg-red-400'); ?>"></span>
                            <?php echo e($car->status); ?>

                        </span>
                    </div>

                    <!-- Price -->
                    <div class="mb-6 pb-6 border-b border-white/10">
                        <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Harga sewa per hari</p>
                        <div class="text-4xl font-bold bg-gradient-to-r from-[#f53003] to-orange-500 bg-clip-text text-transparent mb-1">
                            Rp <?php echo e(number_format($car->price_per_day, 0, ',', '.')); ?>

                        </div>
                    </div>

                    <!-- Specifications -->
                    <div class="space-y-4 mb-6 pb-6 border-b border-white/10">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Transmisi</span>
                            <span class="font-semibold text-white"><?php echo e($car->transmission); ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Kapasitas</span>
                            <span class="font-semibold text-white"><?php echo e($car->capacity); ?> penumpang</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Terdaftar</span>
                            <span class="font-semibold text-white"><?php echo e($car->created_at->format('d M Y')); ?></span>
                        </div>
                    </div>

                    <!-- Description -->
                    <?php if($car->description): ?>
                        <div class="mb-6 pb-6 border-b border-white/10">
                            <h3 class="font-semibold text-white mb-3">Deskripsi</h3>
                            <p class="text-gray-400 text-sm leading-relaxed"><?php echo e($car->description); ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(auth()->user()->is_admin): ?>
                                <button disabled class="w-full bg-gray-500/20 text-gray-400 px-4 py-3 rounded-lg font-semibold cursor-not-allowed border border-gray-500/30">
                                    Admin Tidak Dapat Merental
                                </button>
                            <?php elseif($car->status === 'Tersedia'): ?>
                                <a href="<?php echo e(route('rentals.create', $car)); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#f53003] to-orange-600 hover:from-[#d63000] hover:to-orange-700 text-white px-4 py-3 rounded-lg font-bold transition duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2h2V5h10v2h2V5a2 2 0 00-2-2H5zm-1 8a1 1 0 100 2h.01a1 1 0 100-2H4zm4-1a2 2 0 110 4 2 2 0 010-4z"></path></svg>
                                    Sewa Sekarang
                                </a>
                            <?php else: ?>
                                <button disabled class="w-full bg-red-500/20 text-red-400 px-4 py-3 rounded-lg font-semibold cursor-not-allowed border border-red-500/30">
                                    Sedang Disewa
                                </button>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if($car->status === 'Tersedia'): ?>
                                <a href="<?php echo e(route('login')); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#f53003] to-orange-600 hover:from-[#d63000] hover:to-orange-700 text-white px-4 py-3 rounded-lg font-bold transition duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                                    Login untuk Sewa
                                </a>
                            <?php else: ?>
                                <button disabled class="w-full bg-red-500/20 text-red-400 px-4 py-3 rounded-lg font-semibold cursor-not-allowed border border-red-500/30">
                                    Sedang Disewa
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>

                        <a href="https://wa.me/62812345678?text=Halo%2C%20saya%20tertarik%20dengan%20<?php echo e(urlencode($car->name)); ?>%20di%20DriveHub.%20Bisakah%20Anda%20memberikan%20informasi%20lebih%20lanjut%3F" target="_blank" rel="noopener noreferrer" class="w-full border border-[#f53003]/50 text-[#f53003] hover:bg-[#f53003]/10 px-4 py-3 rounded-lg font-semibold transition duration-200 inline-flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-4.255.949c-2.652 1.26-4.412 3.889-4.412 6.748 0 1.025.167 2.023.49 2.959l-.746 2.724 2.793-.734c.896.471 1.903.727 2.966.727h.004c5.522 0 10.014-4.492 10.014-10.015 0-2.396-.934-4.665-2.639-6.365-1.705-1.7-3.974-2.634-6.371-2.634z"/></svg>
                            Hubungi Admin via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Cars -->
        <?php if($relatedCars->count() > 0): ?>
            <div class="mt-16">
                <div class="flex items-center gap-3 mb-8">
                    <h2 class="text-3xl font-bold text-white">Mobil Sejenis</h2>
                    <div class="flex-1 h-1 bg-gradient-to-r from-[#f53003]/50 to-transparent rounded-full"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php $__currentLoopData = $relatedCars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedCar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('cars.detail', $relatedCar)); ?>" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 hover:border-[#f53003] rounded-2xl transition duration-300">
                            <!-- Image -->
                            <div class="relative h-48 overflow-hidden bg-gradient-to-br from-gray-800 to-gray-900">
                                <?php if($relatedCar->featured_photo): ?>
                                    <img src="<?php echo e(asset('storage/' . $relatedCar->featured_photo->photo_path)); ?>" 
                                         alt="<?php echo e($relatedCar->name); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                <?php endif; ?>
                                
                                <!-- Status Badge -->
                                <div class="absolute top-4 right-4">
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold <?php echo e($relatedCar->status === 'Tersedia' ? 'bg-green-500/20 text-green-400 border border-green-500/50' : 'bg-red-500/20 text-red-400 border border-red-500/50'); ?>">
                                        <span class="w-2 h-2 rounded-full <?php echo e($relatedCar->status === 'Tersedia' ? 'bg-green-400' : 'bg-red-400'); ?>"></span>
                                        <?php echo e($relatedCar->status); ?>

                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-white mb-2 group-hover:text-[#f53003] transition"><?php echo e($relatedCar->name); ?></h3>
                                <div class="flex items-center gap-2 text-gray-400 text-sm mb-3">
                                    <span><?php echo e($relatedCar->transmission); ?></span>
                                    <span>•</span>
                                    <span><?php echo e($relatedCar->capacity); ?> orang</span>
                                </div>
                                <p class="text-[#f53003] font-bold text-lg">Rp <?php echo e(number_format($relatedCar->price_per_day, 0, ',', '.')); ?>/hari</p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
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
<?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/cars/show.blade.php ENDPATH**/ ?>