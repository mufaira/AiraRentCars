<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akses User</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Akses User: <strong>{{ $user->name }}</strong>
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded">
                            <p class="text-sm"><strong>Email:</strong> {{ $user->email }}</p>
                            <p class="text-sm"><strong>Bergabung:</strong> {{ $user->created_at->format('d M Y') }}</p>
                        </div>

                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="flex items-center">
                                    <input type="hidden" name="is_admin" value="0">
                                    <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }} class="w-5 h-5 text-red-600 rounded cursor-pointer">
                                    <span class="ms-3 text-sm font-medium">
                                        <span class="text-red-600">👨‍💼 Admin</span>
                                        <span class="text-gray-600 dark:text-gray-400 text-xs block">Akses penuh ke semua fitur. Bisa kelola user, mobil, blog, rental.</span>
                                    </span>
                                </label>
                            </div>

                            <div>
                                <label class="flex items-center">
                                    <input type="hidden" name="is_staff" value="0">
                                    <input type="checkbox" name="is_staff" value="1" {{ $user->is_staff ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                                    <span class="ms-3 text-sm font-medium">
                                        <span class="text-blue-600">👨‍🔧 Staff</span>
                                        <span class="text-gray-600 dark:text-gray-400 text-xs block">Akses untuk kelola mobil (tambah, edit, hapus). Tidak bisa kelola user atau blog.</span>
                                    </span>
                                </label>
                            </div>

                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <p class="text-xs text-gray-600 dark:text-gray-400 mb-4">
                                    💡 <strong>Catatan:</strong>
                                    <ul class="list-disc list-inside ml-2">
                                        <li>Admin mendapat semua hak akses</li>
                                        <li>Staff hanya bisa kelola mobil (create, edit, delete)</li>
                                        <li>User biasa hanya bisa rental dan lihat blog</li>
                                    </ul>
                                </p>
                            </div>

                            <div class="flex gap-3">
                                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                                    💾 Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.users.index') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 font-medium">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
