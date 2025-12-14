<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline text-sm">← Kembali ke Dashboard</a>
    </div>
    
    <h1 class="text-4xl font-bold mb-8">Katalog Mobil</h1>

    <!-- Filter Section -->
    <div class="bg-white rounded shadow p-6 mb-8">
        <form action="{{ route('cars.catalog') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="">Semua Status</option>
                    <option value="Tersedia" {{ request('status') === 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Disewa" {{ request('status') === 'Disewa' ? 'selected' : '' }}>Disewa</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Tipe Transmisi</label>
                <select name="type" class="w-full border rounded px-3 py-2">
                    <option value="">Semua Tipe</option>
                    <option value="Manual" {{ request('type') === 'Manual' ? 'selected' : '' }}>Manual</option>
                    <option value="Matic" {{ request('type') === 'Matic' ? 'selected' : '' }}>Matic</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Harga Min (Rp)</label>
                <input type="number" name="min_price" class="w-full border rounded px-3 py-2" 
                       value="{{ request('min_price') }}" placeholder="0">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Harga Max (Rp)</label>
                <input type="number" name="max_price" class="w-full border rounded px-3 py-2" 
                       value="{{ request('max_price') }}" placeholder="{{ $maxPrice }}">
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Filter
                </button>
            </div>

            @if (request()->filled('status') || request()->filled('type') || request()->filled('min_price') || request()->filled('max_price'))
                <div class="flex items-end">
                    <a href="{{ route('cars.catalog') }}" class="w-full bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 text-center">
                        Reset
                    </a>
                </div>
            @endif
        </form>
    </div>

    <!-- Cars Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($cars as $car)
            <div class="bg-white rounded shadow hover:shadow-lg transition">
                <div class="relative overflow-hidden bg-gray-200 h-48">
                    @if ($car->featured_photo)
                        <img src="{{ asset('storage/' . $car->featured_photo->photo_path) }}" 
                             alt="{{ $car->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <span>Tidak ada foto</span>
                        </div>
                    @endif

                    <div class="absolute top-2 right-2">
                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $car->status === 'Tersedia' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                            {{ $car->status }}
                        </span>
                    </div>
                </div>

                <div class="p-4">
                    <h3 class="text-lg font-bold mb-2">{{ $car->name }}</h3>

                    <div class="space-y-2 text-sm text-gray-600 mb-4">
                        <div class="flex items-center">
                            <span class="w-20">Transmisi:</span>
                            <span>{{ $car->transmission }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-20">Kapasitas:</span>
                            <span>{{ $car->capacity }} orang</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-20">Harga:</span>
                            <span class="font-bold text-lg text-blue-600">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}/hari</span>
                        </div>
                    </div>

                    <a href="{{ route('cars.detail', $car) }}" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 block text-center">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Mobil tidak ditemukan</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $cars->appends(request()->query())->links() }}
    </div>
</div>
</x-app-layout>
