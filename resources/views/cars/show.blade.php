<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <a href="{{ route('cars.catalog') }}" class="text-blue-600 hover:underline mb-4 inline-block">← Kembali ke Katalog</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Foto Gallery -->
        <div class="lg:col-span-2">
                    <div class="bg-gray-100 rounded overflow-hidden mb-4">
                @if ($car->featured_photo)
                    <img id="mainPhoto" src="{{ asset('storage/' . $car->featured_photo->photo_path) }}" 
                         alt="{{ $car->name }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 flex items-center justify-center">
                        <span class="text-gray-400">Tidak ada foto</span>
                    </div>
                @endif
            </div>

            @if ($car->photos->count() > 1)
                <div class="grid grid-cols-4 gap-2">
                    @foreach ($car->photos as $photo)
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" 
                             alt="{{ $car->name }}" class="w-full h-24 object-cover rounded cursor-pointer hover:opacity-75"
                             onclick="document.getElementById('mainPhoto').src = this.src">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Car Details -->
        <div class="bg-white rounded shadow p-6">
            <h1 class="text-3xl font-bold mb-2">{{ $car->name }}</h1>

            <div class="mb-4">
                <span class="px-3 py-1 rounded text-sm font-semibold {{ $car->status === 'Tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $car->status }}
                </span>
            </div>

            <div class="border-t border-b py-4 mb-4">
                <div class="text-3xl font-bold text-blue-600 mb-2">
                    Rp {{ number_format($car->price_per_day, 0, ',', '.') }}<span class="text-lg text-gray-600">/hari</span>
                </div>
            </div>

            <div class="space-y-4 mb-6">
                <div class="flex items-center">
                    <span class="font-semibold w-32">Transmisi:</span>
                    <span>{{ $car->transmission }}</span>
                </div>
                <div class="flex items-center">
                    <span class="font-semibold w-32">Kapasitas:</span>
                    <span>{{ $car->capacity }} penumpang</span>
                </div>
                <div class="flex items-center">
                    <span class="font-semibold w-32">Terdaftar:</span>
                    <span>{{ $car->created_at->format('d M Y') }}</span>
                </div>
            </div>

            @if ($car->description)
                <div class="border-t pt-4 mb-6">
                    <h3 class="font-semibold mb-2">Deskripsi</h3>
                    <p class="text-gray-600">{{ $car->description }}</p>
                </div>
            @endif

            @auth
                @if (auth()->user()->is_admin)
                    <button disabled class="w-full bg-gray-400 text-white px-4 py-3 rounded font-semibold cursor-not-allowed">
                        Admin Tidak Dapat Merental
                    </button>
                @elseif ($car->status === 'Tersedia')
                    <a href="{{ route('rentals.create', $car) }}" class="w-full bg-green-600 text-white px-4 py-3 rounded font-semibold hover:bg-green-700 mb-2 block text-center">
                        Sewa Sekarang
                    </a>
                @else
                    <button disabled class="w-full bg-gray-400 text-white px-4 py-3 rounded font-semibold cursor-not-allowed">
                        Sedang Disewa
                    </button>
                @endif
            @else
                @if ($car->status === 'Tersedia')
                    <a href="{{ route('login') }}" class="w-full bg-blue-600 text-white px-4 py-3 rounded font-semibold hover:bg-blue-700 mb-2 block text-center">
                        Login untuk Sewa
                    </a>
                @else
                    <button disabled class="w-full bg-gray-400 text-white px-4 py-3 rounded font-semibold cursor-not-allowed">
                        Sedang Disewa
                    </button>
                @endif
            @endauth

            <button class="w-full border border-blue-600 text-blue-600 px-4 py-2 rounded hover:bg-blue-50">
                Hubungi Admin
            </button>
        </div>
    </div>

    <!-- Related Cars -->
    @if ($relatedCars->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Mobil Sejenis</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($relatedCars as $relatedCar)
                    <div class="bg-white rounded shadow hover:shadow-lg transition">
                        <div class="relative overflow-hidden bg-gray-200 h-48">
                            @if ($relatedCar->featured_photo)
                                <img src="{{ asset('storage/' . $relatedCar->featured_photo->photo_path) }}" 
                                     alt="{{ $relatedCar->name }}" class="w-full h-full object-cover">
                            @endif
                            <div class="absolute top-2 right-2">
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $relatedCar->status === 'Tersedia' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                    {{ $relatedCar->status }}
                                </span>
                            </div>
                        </div>

                        <div class="p-4">
                            <h3 class="text-lg font-bold mb-2">{{ $relatedCar->name }}</h3>
                            <div class="text-sm text-gray-600 mb-4">
                                <p>{{ $relatedCar->transmission }} • {{ $relatedCar->capacity }} orang</p>
                                <p class="font-bold text-blue-600 mt-2">Rp {{ number_format($relatedCar->price_per_day, 0, ',', '.') }}/hari</p>
                            </div>
                            <a href="{{ route('cars.detail', $relatedCar) }}" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 block text-center text-sm">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
</x-app-layout>
