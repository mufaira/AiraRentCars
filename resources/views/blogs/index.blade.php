<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blog & Artikel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-12">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mb-4">📰 Blog Rental Mobil</h1>
                <p class="text-gray-600 dark:text-gray-400">Artikel, tips, dan panduan seputar rental mobil</p>
            </div>

            @if($blogs->count() > 0)
                <!-- Blog Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($blogs as $blog)
                        <article class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            @if($blog->featured_image)
                                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                    <span class="text-white text-4xl">📰</span>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->user->name) }}&background=random" alt="{{ $blog->user->name }}" class="w-6 h-6 rounded-full">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $blog->user->name }}</span>
                                </div>
                                
                                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2 line-clamp-2">
                                    {{ $blog->title }}
                                </h3>
                                
                                @if($blog->excerpt)
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">
                                        {{ $blog->excerpt }}
                                    </p>
                                @endif
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 dark:text-gray-500">
                                        {{ $blog->published_at->format('d M Y') }}
                                    </span>
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="text-blue-600 hover:text-blue-800 dark:hover:text-blue-400 text-sm font-semibold">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mb-8">
                    {{ $blogs->links() }}
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-12 text-center">
                    <p class="text-gray-600 dark:text-gray-400 text-lg">
                        Belum ada artikel blog untuk ditampilkan. Silakan kembali lagi nanti!
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
