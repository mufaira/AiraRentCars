<x-app-layout>
    <div class="min-h-screen bg-black text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Header Section -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#f53003]/30 to-[#f53003]/10 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-white">Blog & Artikel</h1>
                            <p class="text-gray-400 mt-2">Tips, panduan, dan artikel menarik seputar rental mobil</p>
                        </div>
                    </div>

                    @if(auth()->check() && auth()->user()->is_admin)
                        <a href="{{ route('admin.blogs.create') }}" class="bg-gradient-to-r from-[#f53003] to-red-700 text-white px-6 py-3 rounded-lg hover:from-[#d42801] hover:to-red-800 transition duration-200 shadow-lg font-semibold flex items-center gap-2 whitespace-nowrap">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah Blog
                        </a>
                    @endif
                </div>
            </div>

            @if($blogs->count() > 0)
                <!-- Blog Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-12">
                    @foreach($blogs as $blog)
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 hover:border-[#f53003] rounded-2xl transition duration-300">
                            <!-- Animated Background -->
                            <div class="absolute inset-0 bg-gradient-to-r from-[#f53003]/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                            
                            <!-- Image Container -->
                            <div class="relative h-40 sm:h-44 md:h-48 overflow-hidden bg-gradient-to-br from-gray-800 to-gray-900">
                                @if($blog->featured_image)
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500/20 to-purple-500/20">
                                        <svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-3 sm:p-4 md:p-6 relative z-10">
                                <!-- Author Info -->
                                <div class="flex items-center gap-2 mb-2 sm:mb-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->user->name) }}&background=random&color=fff" alt="{{ $blog->user->name }}" class="w-5 sm:w-6 h-5 sm:h-6 rounded-full">
                                    <span class="text-xs text-gray-400 line-clamp-1">{{ $blog->user->name }}</span>
                                </div>
                                
                                <!-- Title -->
                                <h3 class="text-sm sm:text-base md:text-lg font-bold text-white mb-1 sm:mb-2 group-hover:text-[#f53003] transition line-clamp-2">
                                    {{ $blog->title }}
                                </h3>
                                
                                <!-- Excerpt -->
                                @if($blog->excerpt)
                                    <p class="text-gray-400 text-xs sm:text-sm mb-3 sm:mb-4 line-clamp-2">
                                        {{ $blog->excerpt }}
                                    </p>
                                @endif
                                
                                <!-- Footer -->
                                <div class="flex items-center justify-between pt-3 sm:pt-4 border-t border-white/10">
                                    <span class="text-xs text-gray-500">
                                        {{ $blog->published_at->format('d M Y') }}
                                    </span>
                                    <div class="flex items-center gap-1 text-[#f53003] font-bold text-xs sm:text-sm group-hover:gap-2 transition">
                                        <span class="text-sm">Baca</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mb-8">
                    {{ $blogs->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-24">
                    <div class="w-20 h-20 bg-gradient-to-br from-[#f53003]/20 to-[#f53003]/5 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-[#f53003]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Tidak Ada Artikel</h3>
                    <p class="text-gray-400 max-w-md mx-auto">Belum ada artikel blog untuk ditampilkan. Silakan kembali lagi nanti untuk melihat tips dan panduan terbaru kami!</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
