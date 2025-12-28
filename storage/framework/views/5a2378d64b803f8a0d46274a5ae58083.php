<section>
    <form method="post" action="<?php echo e(route('password.update')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-gray-300 mb-3">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" autocomplete="current-password" />
            <?php $__errorArgs = ['updatePassword.current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-sm mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-gray-300 mb-3">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" autocomplete="new-password" />
            <?php $__errorArgs = ['updatePassword.password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-sm mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-300 mb-3">Konfirmasi Kata Sandi</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" autocomplete="new-password" />
            <?php $__errorArgs = ['updatePassword.password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-sm mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-2.5 rounded-lg font-semibold transition transform hover:-translate-y-0.5">
                Perbarui Kata Sandi
            </button>

            <?php if(session('status') === 'password-updated'): ?>
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400 font-semibold"
                >✓ Berhasil diperbarui</p>
            <?php endif; ?>
        </div>
    </form>
</section>
<?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/profile/partials/update-password-form.blade.php ENDPATH**/ ?>