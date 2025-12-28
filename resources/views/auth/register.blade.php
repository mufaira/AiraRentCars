<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-extrabold text-white mb-2">Buat Akun Baru</h2>
        <p class="text-gray-400">Bergabunglah dengan ribuan pengguna DriveHub</p>
    </div>

    <!-- Tab untuk memilih tipe pendaftaran -->
    <div class="flex gap-3 mb-6">
        <button type="button" id="user-tab" onclick="switchTab('user')" class="flex-1 py-2 px-4 rounded-lg font-semibold transition user-tab-btn bg-[#f53003] text-white">
            Daftar sebagai Pengguna
        </button>
        <button type="button" id="admin-tab" onclick="switchTab('admin')" class="flex-1 py-2 px-4 rounded-lg font-semibold transition admin-tab-btn bg-gray-700 text-gray-300 hover:bg-gray-600">
            Daftar sebagai Admin
        </button>
    </div>

    <!-- Form User Biasa -->
    <form method="POST" action="{{ route('register') }}" id="user-form">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" placeholder="Nama lengkap" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" placeholder="Email Anda" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-2 w-full"
                            type="password"
                            name="password"
                            placeholder="Buat password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input id="password_confirmation" class="block mt-2 w-full"
                            type="password"
                            name="password_confirmation" placeholder="Ulangi password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-[#f53003] hover:text-[#ff8c00] transition" href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button>
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Form Admin -->
    <form method="POST" action="{{ route('register.admin') }}" id="admin-form" style="display: none;">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="admin_name" :value="__('Nama Lengkap')" />
            <x-text-input id="admin_name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" placeholder="Nama lengkap" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="admin_email" :value="__('Email')" />
            <x-text-input id="admin_email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" placeholder="Email Anda" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="admin_password" :value="__('Password')" />

            <x-text-input id="admin_password" class="block mt-2 w-full"
                            type="password"
                            name="password"
                            placeholder="Buat password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <x-input-label for="admin_password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input id="admin_password_confirmation" class="block mt-2 w-full"
                            type="password"
                            name="password_confirmation" placeholder="Ulangi password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Info Admin -->
        <div class="mb-6 p-4 bg-yellow-900 border border-yellow-700 rounded-lg">
            <p class="text-yellow-200 text-sm">
                <strong>Catatan:</strong> Akun admin memiliki akses penuh ke sistem termasuk manajemen pengguna, mobil, dan laporan.
            </p>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-[#f53003] hover:text-[#ff8c00] transition" href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button>
                {{ __('Daftar sebagai Admin') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function switchTab(tab) {
            const userForm = document.getElementById('user-form');
            const adminForm = document.getElementById('admin-form');
            const userTabBtn = document.getElementById('user-tab');
            const adminTabBtn = document.getElementById('admin-tab');

            if (tab === 'user') {
                userForm.style.display = 'block';
                adminForm.style.display = 'none';
                userTabBtn.classList.remove('bg-gray-700', 'text-gray-300', 'hover:bg-gray-600');
                userTabBtn.classList.add('bg-[#f53003]', 'text-white');
                adminTabBtn.classList.remove('bg-[#f53003]', 'text-white');
                adminTabBtn.classList.add('bg-gray-700', 'text-gray-300', 'hover:bg-gray-600');
            } else if (tab === 'admin') {
                userForm.style.display = 'none';
                adminForm.style.display = 'block';
                adminTabBtn.classList.remove('bg-gray-700', 'text-gray-300', 'hover:bg-gray-600');
                adminTabBtn.classList.add('bg-[#f53003]', 'text-white');
                userTabBtn.classList.remove('bg-[#f53003]', 'text-white');
                userTabBtn.classList.add('bg-gray-700', 'text-gray-300', 'hover:bg-gray-600');
            }
        }
    </script>
</x-guest-layout>
