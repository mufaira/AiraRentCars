<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-300 mb-3">Nama Lengkap</label>
            <input id="name" name="name" type="text" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-300 mb-3">Email</label>
            <input id="email" name="email" type="email" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-yellow-500/10 border border-yellow-500/30 rounded-lg">
                    <p class="text-sm text-yellow-300">
                        Email Anda belum terverifikasi.
                        <button form="send-verification" class="underline font-semibold hover:text-yellow-200 transition">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-semibold text-sm text-green-400">
                            Email verifikasi telah dikirim ke alamat email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-gradient-to-r from-[#f53003] to-orange-600 hover:from-[#d63000] hover:to-orange-700 text-white px-6 py-2.5 rounded-lg font-semibold transition transform hover:-translate-y-0.5">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400 font-semibold"
                >✓ Berhasil disimpan</p>
            @endif
        </div>
    </form>
</section>
