<section>
    <form id="send-verification" method="post" action="<?php echo e(route('verification.send')); ?>">
        <?php echo csrf_field(); ?>
    </form>

    <form method="post" action="<?php echo e(route('profile.update')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('patch'); ?>

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-300 mb-3">Nama Lengkap</label>
            <input id="name" name="name" type="text" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" value="<?php echo e(old('name', $user->name)); ?>" required autofocus autocomplete="name" />
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-sm mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-300 mb-3">Email</label>
            <input id="email" name="email" type="email" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" value="<?php echo e(old('email', $user->email)); ?>" required autocomplete="username" />
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-sm mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()): ?>
                <div class="mt-4 p-4 bg-yellow-500/10 border border-yellow-500/30 rounded-lg">
                    <p class="text-sm text-yellow-300">
                        Email Anda belum terverifikasi.
                        <button form="send-verification" class="underline font-semibold hover:text-yellow-200 transition">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    <?php if(session('status') === 'verification-link-sent'): ?>
                        <p class="mt-2 font-semibold text-sm text-green-400">
                            Email verifikasi telah dikirim ke alamat email Anda.
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-gradient-to-r from-[#f53003] to-orange-600 hover:from-[#d63000] hover:to-orange-700 text-white px-6 py-2.5 rounded-lg font-semibold transition transform hover:-translate-y-0.5">
                Simpan Perubahan
            </button>

            <?php if(session('status') === 'profile-updated'): ?>
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400 font-semibold"
                >✓ Berhasil disimpan</p>
            <?php endif; ?>
        </div>
    </form>
</section>
<?php /**PATH D:\UAS PEMWEB\Part 3\resources\views/profile/partials/update-profile-information-form.blade.php ENDPATH**/ ?>