<x-app-layout>
    <div class="min-h-screen bg-black text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Back Button -->
            <a href="{{ route('blogs.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-[#f53003] transition mb-8">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Blog
            </a>

            <!-- Article Container -->
            <article class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl overflow-hidden">
                <!-- Featured Image -->
                <div class="relative h-96 overflow-hidden bg-gradient-to-br from-gray-800 to-gray-900">
                    @if($blog->featured_image)
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500/20 to-purple-500/20">
                            <svg class="w-20 h-20 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                </div>

                <!-- Content -->
                <div class="p-8 lg:p-12">
                    <!-- Header -->
                    <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">{{ $blog->title }}</h1>
                    
                    <!-- Author & Meta -->
                    <div class="flex items-center gap-4 pb-8 border-b border-white/10 mb-8">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->user->name) }}&background=random&color=fff" alt="{{ $blog->user->name }}" class="w-12 h-12 rounded-full ring-2 ring-[#f53003]/30">
                        <div>
                            <p class="font-semibold text-white">{{ $blog->user->name }}</p>
                            <p class="text-sm text-gray-400">
                                {{ $blog->published_at->format('d F Y') }}
                                @if($blog->published_at->diffInMinutes() < 60)
                                    <span class="ml-2 text-xs text-[#f53003]">({{ $blog->published_at->diffForHumans() }})</span>
                                @endif
                            </p>
                        </div>
                        @auth
                            @if(Auth::user()->id === $blog->user_id && Auth::user()->is_admin)
                                <div class="ml-auto flex gap-2">
                                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="inline-flex items-center gap-2 bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition text-sm font-semibold">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition text-sm font-semibold">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <!-- Article Content -->
                    <div class="prose prose-invert max-w-none mb-8 text-gray-300 prose-headings:text-white prose-a:text-[#f53003] hover:prose-a:text-orange-500">
                        {!! $blog->content !!}
                    </div>

                    <!-- Tags -->
                    <div class="pt-8 border-t border-white/10">
                        <div class="flex flex-wrap gap-2">
                            <span class="text-sm text-gray-400">📌 Tags:</span>
                            <span class="px-3 py-1 bg-[#f53003]/20 text-[#f53003] rounded-full text-sm font-medium border border-[#f53003]/50">Rental</span>
                            <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full text-sm font-medium border border-blue-500/50">Tips</span>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Related Articles -->
            <div class="mt-16">
                <div class="flex items-center gap-3 mb-8">
                    <h2 class="text-3xl font-bold text-white">Artikel Terkait</h2>
                    <div class="flex-1 h-1 bg-gradient-to-r from-[#f53003]/50 to-transparent rounded-full"></div>
                </div>
                
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
                            <a href="{{ route('blogs.show', $related->slug) }}" class="group relative overflow-hidden bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 hover:border-[#f53003] rounded-2xl transition duration-300">
                                <!-- Image -->
                                <div class="relative h-40 overflow-hidden bg-gradient-to-br from-gray-800 to-gray-900">
                                    @if($related->featured_image)
                                        <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Content -->
                                <div class="p-4">
                                    <h3 class="font-bold text-white line-clamp-2 group-hover:text-[#f53003] transition">{{ $related->title }}</h3>
                                    <p class="text-xs text-gray-500 mt-2">{{ $related->published_at->format('d M Y') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400 text-center py-8">Tidak ada artikel terkait</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
