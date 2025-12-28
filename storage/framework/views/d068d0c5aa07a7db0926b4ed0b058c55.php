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
    input[type="text"], input[type="number"], textarea, select {
        color: #1f2937 !important;
        font-size: 16px;
        font-weight: 500;
    }
    input::placeholder, textarea::placeholder {
        color: #9ca3af !important;
        font-weight: 400;
    }
    select option {
        color: #1f2937 !important;
        background: white !important;
    }
</style>
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <a href="<?php echo e(route('cars.admin.index')); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base mb-8 transition group">
        <span class="mr-2 group-hover:-translate-x-1 transition">←</span> Kembali ke Daftar Mobil
    </a>
    
    <div class="mb-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 shadow-lg">
        <h1 class="text-4xl font-bold text-white">Edit Mobil: <?php echo e($car->name); ?></h1>
        <p class="text-blue-100 font-medium mt-2">Ubah informasi kendaraan sesuai kebutuhan</p>
    </div>

    <!-- Success Message -->
    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            ✓ <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- FORM EDIT MOBIL -->
    <form id="editForm" method="POST" action="<?php echo e(route('cars.admin.update', $car)); ?>" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-xl p-10 space-y-8">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <!-- Nama Mobil -->
        <div>
            <label class="block text-sm font-semibold mb-3 text-gray-900">🚗 Nama Mobil</label>
            <input type="text" name="name" class="w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-50 <?php else: ?> focus:border-blue-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> focus:outline-none focus:ring-2 focus:ring-blue-100 transition" 
                   value="<?php echo e(old('name', $car->name)); ?>" required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block text-sm font-semibold mb-3 text-gray-900">📝 Deskripsi</label>
            <textarea name="description" class="w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" rows="5"><?php echo e(old('description', $car->description)); ?></textarea>
        </div>

        <!-- Harga per Hari -->
        <div>
            <label class="block text-sm font-semibold mb-3 text-gray-900">💰 Harga per Hari (Rp)</label>
            <input type="number" name="price_per_day" class="w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 <?php $__errorArgs = ['price_per_day'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-50 <?php else: ?> focus:border-blue-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> focus:outline-none focus:ring-2 focus:ring-blue-100 transition" 
                   value="<?php echo e(old('price_per_day', $car->price_per_day)); ?>" step="0.01" required>
            <?php $__errorArgs = ['price_per_day'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Transmisi dan Kapasitas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-sm font-semibold mb-3 text-gray-900">⚙️ Transmisi</label>
                <select name="transmission" class="w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 <?php $__errorArgs = ['transmission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-50 <?php else: ?> focus:border-blue-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                    <option value="">-- Pilih Transmisi --</option>
                    <option value="Manual" <?php echo e(old('transmission', $car->transmission) === 'Manual' ? 'selected' : ''); ?>>Manual</option>
                    <option value="Matic" <?php echo e(old('transmission', $car->transmission) === 'Matic' ? 'selected' : ''); ?>>Matic</option>
                </select>
                <?php $__errorArgs = ['transmission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-3 text-gray-900">👥 Kapasitas Penumpang</label>
                <input type="number" name="capacity" class="w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 <?php $__errorArgs = ['capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-50 <?php else: ?> focus:border-blue-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> focus:outline-none focus:ring-2 focus:ring-blue-100 transition" 
                       value="<?php echo e(old('capacity', $car->capacity)); ?>" min="1" required>
                <?php $__errorArgs = ['capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-sm font-semibold mb-3 text-gray-900">📌 Status</label>
                <select name="status" class="w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-50 <?php else: ?> focus:border-blue-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Tersedia" <?php echo e(old('status', $car->status) === 'Tersedia' ? 'selected' : ''); ?>>Tersedia</option>
                    <option value="Disewa" <?php echo e(old('status', $car->status) === 'Disewa' ? 'selected' : ''); ?>>Disewa</option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-3 text-gray-900">✅ Aktif</label>
                <select name="is_active" class="w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition">
                    <option value="1" <?php echo e(old('is_active', $car->is_active) ? 'selected' : ''); ?>>Ya</option>
                    <option value="0" <?php echo e(!old('is_active', $car->is_active) ? 'selected' : ''); ?>>Tidak</option>
                </select>
            </div>
        </div>

        <!-- Featured Checkbox -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-2xl p-6">
            <div class="flex items-center gap-4">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                       <?php echo e(old('is_featured', $car->is_featured) ? 'checked' : ''); ?> class="h-6 w-6 text-blue-600 rounded focus:ring-2 focus:ring-blue-500 cursor-pointer">
                <label for="is_featured" class="text-sm font-semibold text-gray-900 cursor-pointer">⭐ Jadikan Mobil Unggulan (Featured)</label>
            </div>
            <p class="text-sm text-gray-600 mt-3 ml-10 font-medium">Mobil unggulan akan ditampilkan di halaman utama dengan prioritas lebih tinggi</p>
        </div>

        <!-- Foto Existing -->
        <?php if($car->photos->count() > 0): ?>
            <div>
                <label class="block text-sm font-semibold mb-4 text-gray-900">📸 Foto Existing</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <?php $__currentLoopData = $car->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="relative bg-gray-100 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition">
                            <img src="<?php echo e(asset('storage/' . $photo->photo_path)); ?>" alt="Car photo" class="w-full h-32 object-cover">
                            <form action="<?php echo e(route('photos.delete', $photo)); ?>" method="POST" class="absolute top-2 right-2" onsubmit="return confirm('Hapus foto ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition shadow-md">✕</button>
                            </form>
                            <?php if($photo->is_featured): ?>
                                <span class="absolute bottom-2 left-2 bg-yellow-500 text-white text-xs px-3 py-1 rounded-full font-semibold">⭐ Utama</span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Upload Foto Baru -->
        <div>
            <label class="block text-sm font-semibold mb-3 text-gray-900">🖼️ Tambah Foto (Multiple)</label>
            <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer group">
                <input type="file" name="photos[]" multiple accept="image/*" 
                       class="w-full <?php $__errorArgs = ['photos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> cursor-pointer" id="photoInput">
                <p class="text-gray-700 font-semibold mt-3 group-hover:text-blue-600 transition">Klik untuk memilih foto atau drag & drop di sini</p>
                <small class="text-gray-500 text-sm block mt-2 font-medium">Format: JPG, PNG, GIF (max 2MB per foto)</small>
            </div>
            <?php $__errorArgs = ['photos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t-2 border-gray-100">
            <button type="button" onclick="submitEditForm()" class="flex-1 bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-4 rounded-xl hover:from-green-700 hover:to-green-800 font-bold text-base transition shadow-lg hover:shadow-xl transform hover:scale-105">
                💾 Simpan Perubahan
            </button>
            <a href="<?php echo e(route('cars.admin.index')); ?>" class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 text-white px-8 py-4 rounded-xl hover:from-gray-600 hover:to-gray-700 font-bold text-base transition shadow-lg hover:shadow-xl text-center transform hover:scale-105">
                ✕ Batal
            </a>
        </div>
    </form>
    
    <script>
        function submitEditForm() {
            const form = document.getElementById('editForm');
            const carName = form.querySelector('input[name="name"]').value;
            
            if (confirm(`Apakah Anda yakin ingin menyimpan perubahan untuk mobil "${carName}"?`)) {
                form.submit();
            }
        }
    </script>
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
<?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/admin/cars/edit.blade.php ENDPATH**/ ?>