<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline text-sm">← Kembali ke Dashboard</a>
    </div>
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Kelola Mobil</h1>
        <a href="{{ route('cars.admin.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Mobil
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-6 py-3 text-left text-sm font-semibold">Foto</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Harga/Hari</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Transmisi</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Kapasitas</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Aktif</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cars as $car)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            @if ($car->featured_photo)
                                <img src="{{ asset('storage/' . $car->featured_photo->photo_path) }}" 
                                     alt="{{ $car->name }}" class="w-12 h-12 object-cover rounded">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-xs">No foto</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $car->name }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $car->transmission }}</td>
                        <td class="px-6 py-4">{{ $car->capacity }} orang</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $car->status === 'Tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $car->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs {{ $car->is_active ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $car->is_active ? 'Ya' : 'Tidak' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('cars.admin.edit', $car) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                            <form action="{{ route('cars.admin.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Belum ada mobil</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $cars->links() }}
    </div>
</div>
</x-app-layout>
