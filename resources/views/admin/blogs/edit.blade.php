<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Artikel Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Judul Artikel *</label>
                            <input type="text" name="title" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600 @error('title') border-red-500 @enderror"
                                   value="{{ old('title', $blog->title) }}" required>
                            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Excerpt -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Ringkasan (Opsional)</label>
                            <textarea name="excerpt" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600" rows="2">{{ old('excerpt', $blog->excerpt) }}</textarea>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ringkasan singkat yang akan ditampilkan di halaman daftar blog</p>
                            @error('excerpt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Featured Image -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Gambar Utama (Opsional)</label>
                            @if($blog->featured_image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="max-w-xs rounded">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Gambar saat ini</p>
                                </div>
                            @endif
                            <input type="file" name="featured_image" accept="image/*" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600 @error('featured_image') border-red-500 @enderror">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                            @error('featured_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Isi Artikel *</label>
                            <textarea name="content" id="content" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600 @error('content') border-red-500 @enderror"
                                      rows="15" required>{{ old('content', $blog->content) }}</textarea>
                            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Publish Status -->
                        <div class="flex items-center">
                            <input type="checkbox" name="is_published" id="is_published" class="mr-2" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                            <label for="is_published" class="text-sm font-semibold">Publikasikan</label>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold">
                                💾 Perbarui Artikel
                            </button>
                            <a href="{{ route('admin.blogs.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500 font-semibold">
                                ❌ Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include a simple text editor -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.snow.css" rel="stylesheet">
    <script>
        const quill = new Quill('#content', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ]
            },
            placeholder: 'Tulis konten artikel di sini...'
        });

        // Set initial content
        quill.root.innerHTML = document.getElementById('content').value;

        // Sync Quill content with textarea
        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            document.getElementById('content').value = quill.root.innerHTML;
        });
    </script>
</x-app-layout>
