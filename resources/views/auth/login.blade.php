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

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Error Alert untuk Login Gagal -->
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-900/20 border border-red-500/50 rounded-lg shadow-lg">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <div class="flex-1">
                    <h3 class="text-sm font-bold text-red-400 mb-1">Login Gagal</h3>
                    <p class="text-xs text-red-300">Email atau password yang Anda masukkan salah. Silakan coba lagi.</p>
                </div>
            </div>
        </div>
    @endif

    <div class="mb-4 sm:mb-6 text-center">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-1 sm:mb-2">Selamat Datang</h2>
        <p class="text-xs sm:text-sm text-gray-400">Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-xs sm:text-sm" />
            <x-text-input id="email" class="block mt-2 w-full text-sm" type="email" name="email" :value="old('email')" placeholder="Email Anda" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-xs sm:text-sm" />

            <div class="relative">
                <x-text-input id="password" class="block mt-2 w-full pr-10 sm:pr-12 text-sm"
                                type="password"
                                name="password"
                                placeholder="Masukkan password"
                                required autocomplete="current-password" />
                <button type="button" id="togglePassword" class="absolute right-2 sm:right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition p-1">
                    <svg id="eyeIcon" class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center gap-2">
                <input id="remember_me" type="checkbox" class="rounded bg-[#1a1a1a] border-white/20 text-[#f53003] shadow-sm focus:ring-[#f53003]" name="remember">
                <span class="text-xs sm:text-sm text-gray-400">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="flex flex-col items-center justify-center gap-3 mt-6 sm:mt-8">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs sm:text-sm text-[#f53003] hover:text-[#ff8c00] transition font-medium">
                    {{ __('Lupa password?') }}
                </a>
            @endif

            <x-primary-button class="w-full">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>

    <div class="flex flex-col sm:flex-row items-center justify-center gap-2 mt-5 sm:mt-6 pt-5 sm:pt-6 border-t border-white/10">
        <span class="text-xs sm:text-sm text-gray-400">{{ __('Belum punya akun?') }}</span>
        <a class="text-xs sm:text-sm text-[#f53003] hover:text-[#ff8c00] transition font-medium" href="{{ route('register') }}">
            {{ __('Daftar sekarang') }}
        </a>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        });
    </script>
</x-guest-layout>
