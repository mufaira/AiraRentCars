<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manajemen Blog') }}
            </h2>
            <a href="{{ route('admin.blogs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                ➕ Artikel Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($blogs->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="border-b dark:border-gray-700">
                                    <tr>
                                        <th class="text-left py-3 px-4">Judul</th>
                                        <th class="text-left py-3 px-4">Penulis</th>
                                        <th class="text-left py-3 px-4">Status</th>
                                        <th class="text-left py-3 px-4">Tanggal</th>
                                        <th class="text-left py-3 px-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="py-3 px-4 font-semibold">{{ $blog->title }}</td>
                                            <td class="py-3 px-4">{{ $blog->user->name }}</td>
                                            <td class="py-3 px-4">
                                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $blog->is_published ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                                    {{ $blog->is_published ? '✓ Dipublikasikan' : '⏱ Draft' }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4">
                                                @if($blog->published_at)
                                                    {{ $blog->published_at->format('d M Y') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 flex gap-2">
                                                <a href="{{ route('blogs.show', $blog->slug) }}" class="text-blue-600 hover:underline">👁 Lihat</a>
                                                <a href="{{ route('admin.blogs.edit', $blog) }}" class="text-yellow-600 hover:underline">✏️ Edit</a>
                                                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:underline">🗑️ Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6">
                            {{ $blogs->links() }}
                        </div>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400 py-8">
                            Belum ada artikel blog. <a href="{{ route('admin.blogs.create') }}" class="text-blue-600 hover:underline">Buat artikel pertama Anda</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
