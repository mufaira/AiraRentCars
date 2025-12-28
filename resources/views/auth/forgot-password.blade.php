<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-extrabold text-white mb-2">Lupa Password?</h2>
        <p class="text-gray-400 text-sm">Kami akan mengirimkan link reset password ke email Anda</p>
    </div>

    <div class="mb-4 text-sm text-gray-300 bg-blue-400/10 border border-blue-400/20 rounded-lg px-4 py-3">
        {{ __('Masukkan email Anda dan kami akan mengirimkan link untuk reset password.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-[#f53003] hover:text-[#ff8c00] transition" href="{{ route('login') }}">
                {{ __('Kembali ke login') }}
            </a>
            <x-primary-button>
                {{ __('Kirim Link Reset') }}
        </div>
    </form>
</x-guest-layout>
