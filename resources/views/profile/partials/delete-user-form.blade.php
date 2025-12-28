<section class="space-y-6">
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-2.5 bg-red-600/20 text-red-400 border border-red-500/30 rounded-lg font-semibold hover:bg-red-600/30 hover:border-red-500/50 transition"
    >Hapus Akun</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-white">
                    Konfirmasi Penghapusan Akun
                </h2>
            </div>

            <p class="mt-4 text-sm text-gray-400 mb-6">
                Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus secara permanen.
            </p>

            <div class="bg-red-500/10 border border-red-500/30 rounded-lg p-4 mb-6">
                <p class="text-red-300 text-sm">
                    Masukkan kata sandi Anda untuk mengkonfirmasi penghapusan akun.
                </p>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-gray-300 mb-3">Kata Sandi</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-red-500 transition"
                    placeholder="Masukkan kata sandi Anda"
                />
                @error('userDeletion.password') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-2.5 bg-gray-700/50 text-gray-300 rounded-lg font-semibold hover:bg-gray-700 transition">
                    Batal
                </button>

                <button type="submit" class="px-6 py-2.5 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition transform hover:-translate-y-0.5">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
