<x-guest-layout>
    <!-- Back Button di Atas -->
    <div class="mb-4 sm:mb-6 flex items-center justify-start">
        <a href="/" class="inline-flex items-center gap-1 px-3 py-2 text-xs sm:text-sm font-bold text-gray-300 bg-gray-700 hover:bg-gray-600 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="mb-4 sm:mb-6 text-center">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-1 sm:mb-2">Buat Akun Baru</h2>
        <p class="text-xs sm:text-sm text-gray-400">Bergabunglah dengan ribuan pengguna DriveHub</p>
    </div>

    <!-- Form User Biasa -->
    <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs sm:text-sm" />
            <x-text-input id="name" class="block mt-2 w-full text-sm" type="text" name="name" :value="old('name')" placeholder="Nama lengkap" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-xs sm:text-sm" />
            <x-text-input id="email" class="block mt-2 w-full text-sm" type="email" name="email" :value="old('email')" placeholder="Email Anda" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-xs sm:text-sm" />

            <x-text-input id="password" class="block mt-2 w-full text-sm"
                            type="password"
                            name="password"
                            placeholder="Buat password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-xs sm:text-sm" />

            <x-text-input id="password_confirmation" class="block mt-2 w-full text-sm"
                            type="password"
                            name="password_confirmation" placeholder="Ulangi password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
        </div>

        <div class="flex flex-col items-center justify-center gap-3 mt-6 sm:mt-8">
            <x-primary-button class="w-full">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>

    <div class="flex flex-col sm:flex-row items-center justify-center gap-2 mt-5 sm:mt-6 pt-5 sm:pt-6 border-t border-white/10">
        <span class="text-xs sm:text-sm text-gray-400">{{ __('Sudah punya akun?') }}</span>
        <a class="text-xs sm:text-sm text-[#f53003] hover:text-[#ff8c00] transition font-medium" href="{{ route('login') }}">
            {{ __('Masuk sekarang') }}
        </a>
    </div>
</x-guest-layout>
