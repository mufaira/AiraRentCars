<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="text-gray-300 hover:underline text-sm">← Kembali ke Dashboard</a>
            </div>

            <div class="mb-6 flex items-center gap-4">
                <h1 class="text-2xl md:text-3xl font-extrabold text-white">Kelola Mobil</h1>
                <a href="{{ route('cars.admin.create') }}" class="ml-auto inline-flex items-center gap-2 bg-gradient-to-br from-[#ff7a59] to-[#f53003] text-white px-4 py-2 rounded-2xl shadow-lg hover:opacity-95">
                    <span class="text-lg">+</span> <span class="font-semibold">Tambah Mobil</span>
                </a>
            </div>

            @if (session('success'))
                <div class="bg-green-900/40 border border-green-700 text-green-100 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gradient-to-br from-[#070707] to-[#091019] border border-white/6 rounded-2xl p-4 shadow-md">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="text-left text-sm text-gray-300 border-b border-white/6">
                                <th class="px-4 py-3">Foto</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Harga/Hari</th>
                                <th class="px-4 py-3">Transmisi</th>
                                <th class="px-4 py-3">Kapasitas</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Aktif</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cars as $car)
                                <tr class="border-b border-white/6 hover:bg-white/2">
                                    <td class="px-4 py-3 align-middle">
                                        @if ($car->featured_photo)
                                            <img src="{{ asset('storage/' . $car->featured_photo->photo_path) }}" 
                                                 alt="{{ $car->name }}" class="w-14 h-14 object-cover rounded-lg">
                                        @else
                                            <div class="w-14 h-14 bg-gray-800 rounded-lg flex items-center justify-center text-xs text-gray-400">No foto</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 align-middle text-white">{{ $car->name }}</td>
                                    <td class="px-4 py-3 align-middle text-gray-300">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 align-middle text-gray-300">{{ $car->transmission }}</td>
                                    <td class="px-4 py-3 align-middle text-gray-300">{{ $car->capacity }} orang</td>
                                    <td class="px-4 py-3 align-middle">
                                        @if($car->status === 'Tersedia')
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-emerald-900/30 text-emerald-200">{{ $car->status }}</span>
                                        @else
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-red-900/30 text-red-200">{{ $car->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        @if($car->is_active)
                                            <span class="px-2 py-1 rounded-full text-xs bg-blue-900/30 text-blue-200">Ya</span>
                                        @else
                                            <span class="px-2 py-1 rounded-full text-xs bg-gray-800 text-gray-400">Tidak</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 align-middle space-x-3">
                                        <a href="{{ route('cars.admin.edit', $car) }}" class="inline-flex items-center gap-2 text-sm text-white/90 bg-white/6 px-3 py-1 rounded hover:bg-white/8">Edit</a>
                                        <form action="{{ route('cars.admin.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-2 text-sm text-red-300 bg-red-900/10 px-3 py-1 rounded hover:opacity-90">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-gray-400">Belum ada mobil</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $cars->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
