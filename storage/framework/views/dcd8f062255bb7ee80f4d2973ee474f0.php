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
        
        input::placeholder, textarea::placeholder, select option {
            color: #9CA3AF !important;
            opacity: 1 !important;
        }
        input[type="text"], input[type="number"], textarea, select {
            color: #1F2937 !important;
            font-family: inherit;
            font-size: 16px;
        }

        .form-label {
            font-weight: 600;
            color: #111827;
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            letter-spacing: 0.3px;
        }

        .form-input, .form-textarea, .form-select {
            font-size: 15px;
            font-weight: 500;
            letter-spacing: 0.2px;
        }

        input[type="text"]::placeholder, textarea::placeholder {
            font-weight: 400;
            font-size: 14px;
        }
    </style>
    <div class="container mx-auto px-4 py-10 max-w-4xl">
        <a href="<?php echo e(route('cars.admin.index')); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base mb-8 transition group">
            <span class="mr-2 group-hover:-translate-x-1 transition">←</span> Kembali ke Daftar Mobil
        </a>
        
        <div class="mb-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 shadow-lg">
            <h1 class="text-5xl font-bold text-white mb-3">Tambah Mobil Baru</h1>
            <p class="text-blue-100 font-medium text-base">Isi formulir di bawah untuk menambahkan kendaraan baru ke sistem rental</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6 mb-8 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <h3 class="font-bold text-lg text-red-900">Terjadi Kesalahan Validasi</h3>
                </div>
                <ul class="space-y-2 ml-9">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="text-base text-red-700 font-medium"><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

    <form action="<?php echo e(route('cars.admin.store')); ?>" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-xl p-10 space-y-8">
        <?php echo csrf_field(); ?>

        <!-- Nama Mobil -->
        <div>
            <label class="form-label">🚗 Nama Mobil *</label>
            <input type="text" name="name" class="form-input w-full border-2 rounded-xl px-5 py-3 text-gray-900 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-50 <?php else: ?> border-gray-200 focus:border-blue-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> focus:outline-none focus:ring-2 focus:ring-blue-100 transition" 
                   placeholder="Contoh: Toyota Avanza 2024" value="<?php echo e(old('name')); ?>" required>
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
            <label class="form-label">Deskripsi *</label>
            <textarea name="description" placeholder="Masukkan deskripsi lengkap tentang mobil..." class="form-textarea w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" rows="5"><?php echo e(old('description')); ?></textarea>
        </div>

        <!-- Harga per Hari -->
        <div>
            <label class="form-label">Harga per Hari (Rp) *</label>
            <input type="number" name="price_per_day" class="form-input w-full border-2 rounded-xl px-5 py-3 text-gray-900 <?php $__errorArgs = ['price_per_day'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-50 <?php else: ?> border-gray-200 focus:border-blue-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> focus:outline-none focus:ring-2 focus:ring-blue-100 transition" 
                   placeholder="Contoh: 500000" value="<?php echo e(old('price_per_day')); ?>" step="0.01" required>
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
                <label class="form-label">Transmisi *</label>
                <select name="transmission" class="form-select w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 <?php $__errorArgs = ['transmission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                    <option value="">-- Pilih Transmisi --</option>
                    <option value="Manual" <?php echo e(old('transmission') === 'Manual' ? 'selected' : ''); ?>>Manual</option>
                    <option value="Matic" <?php echo e(old('transmission') === 'Matic' ? 'selected' : ''); ?>>Matic</option>
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
                <label class="form-label">Kapasitas Penumpang *</label>
                <input type="number" name="capacity" class="form-input w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 <?php $__errorArgs = ['capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" 
                       placeholder="Contoh: 5" value="<?php echo e(old('capacity')); ?>" min="1" required>
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
        <div>
            <label class="form-label">Status *</label>
            <select name="status" class="form-select w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                <option value="">-- Pilih Status --</option>
                <option value="Tersedia" <?php echo e(old('status') === 'Tersedia' ? 'selected' : ''); ?>>Tersedia</option>
                <option value="Disewa" <?php echo e(old('status') === 'Disewa' ? 'selected' : ''); ?>>Disewa</option>
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

        <!-- Checkbox Mobil Unggulan -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-2xl p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                       <?php echo e(old('is_featured') ? 'checked' : ''); ?> class="h-6 w-6 text-blue-600 rounded focus:ring-2 focus:ring-blue-500 cursor-pointer">
                <label for="is_featured" class="form-label !mb-0 cursor-pointer">Jadikan Mobil Unggulan (Featured)</label>
            </div>
            <p class="text-sm text-gray-600 mt-3 ml-10 font-medium">Mobil unggulan akan ditampilkan di halaman utama dengan prioritas lebih tinggi</p>
        </div>

        <!-- Upload Foto -->
        <div>
            <label class="form-label">Upload Foto (Multiple) *</label>
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
                <p class="text-gray-700 font-semibold text-lg mt-3 group-hover:text-blue-600 transition">Klik untuk memilih foto atau drag & drop di sini</p>
                <small class="text-gray-500 text-base block mt-3 font-medium">Format: JPG, PNG, GIF (max 2MB per foto) • Minimal 1 foto</small>
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
            <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-4 rounded-xl hover:from-green-700 hover:to-green-800 font-bold text-base transition shadow-lg hover:shadow-xl transform hover:scale-105">
                Simpan Mobil
            </button>
            <a href="<?php echo e(route('cars.admin.index')); ?>" class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 text-white px-8 py-4 rounded-xl hover:from-gray-600 hover:to-gray-700 font-bold text-base transition shadow-lg hover:shadow-xl text-center transform hover:scale-105">
                Batal
            </a>
        </div>
    </form>
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
<?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/admin/cars/create.blade.php ENDPATH**/ ?>