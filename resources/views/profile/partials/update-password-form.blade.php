<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-gray-300 mb-3">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" autocomplete="current-password" />
            @error('updatePassword.current_password') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-gray-300 mb-3">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" autocomplete="new-password" />
            @error('updatePassword.password') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-300 mb-3">Konfirmasi Kata Sandi</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" autocomplete="new-password" />
            @error('updatePassword.password_confirmation') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-2.5 rounded-lg font-semibold transition transform hover:-translate-y-0.5">
                Perbarui Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400 font-semibold"
                >✓ Berhasil diperbarui</p>
            @endif
        </div>
    </form>
</section>
