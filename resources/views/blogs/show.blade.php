<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('blogs.index') }}" class="text-blue-600 hover:underline">← Kembali ke Blog</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Article Header -->
            <article class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                @if($blog->featured_image)
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <span class="text-white text-6xl">📰</span>
                    </div>
                @endif

                <div class="p-8">
                    <!-- Title & Meta -->
                    <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mb-4">{{ $blog->title }}</h1>
                    
                    <div class="flex items-center gap-4 mb-8 pb-6 border-b dark:border-gray-700">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->user->name) }}&background=random" alt="{{ $blog->user->name }}" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $blog->user->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $blog->published_at->format('d F Y') }} 
                                @if($blog->published_at->diffInMinutes() < 60)
                                    ({{ $blog->published_at->diffForHumans() }})
                                @endif
                            </p>
                        </div>
                        @auth
                            @if(Auth::user()->id === $blog->user_id && Auth::user()->is_admin)
                                <div class="ml-auto flex gap-2">
                                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <!-- Content -->
                    <div class="prose dark:prose-invert max-w-none">
                        {!! $blog->content !!}
                    </div>

                    <!-- Tags/Categories (future feature) -->
                    <div class="mt-8 pt-6 border-t dark:border-gray-700">
                        <div class="flex gap-2">
                            <span class="text-sm text-gray-600 dark:text-gray-400">📌 Tags:</span>
                            <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm">Rental</span>
                            <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-sm">Tips</span>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Related Articles -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Artikel Terkait</h2>
                
                @php
                    $relatedBlogs = \App\Models\Blog::where('is_published', true)
                        ->where('id', '!=', $blog->id)
                        ->latest('published_at')
                        ->limit(3)
                        ->get();
                @endphp

                @if($relatedBlogs->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedBlogs as $related)
                            <a href="{{ route('blogs.show', $related->slug) }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                                @if($related->featured_image)
                                    <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-32 object-cover">
                                @else
                                    <div class="w-full h-32 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                        <span class="text-2xl">📰</span>
                                    </div>
                                @endif
                                
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-800 dark:text-gray-100 line-clamp-2">{{ $related->title }}</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">{{ $related->published_at->format('d M Y') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Include Prose styles for rich content -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/typography@0.5.13/lib/typography.min.css">
</x-app-layout>
