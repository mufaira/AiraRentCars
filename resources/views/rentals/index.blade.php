<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline text-sm">← Kembali ke Dashboard</a>
    </div>
    
    <h1 class="text-3xl font-bold mb-6">Daftar Sewa Saya</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($rentals->count() > 0)
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-6 py-3 text-left text-sm font-semibold">Mobil</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Tanggal Sewa</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Durasi</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Total Harga</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status Rental</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Pembayaran</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rentals as $rental)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $rental->car->name }}</td>
                            <td class="px-6 py-4">{{ $rental->rental_date->format('d M Y') }}</td>
                            <td class="px-6 py-4">{{ $rental->duration_days }} hari</td>
                            <td class="px-6 py-4">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    @if($rental->status === 'Pending') bg-yellow-100 text-yellow-800
                                    @elseif($rental->status === 'Paid') bg-blue-100 text-blue-800
                                    @elseif($rental->status === 'Active') bg-green-100 text-green-800
                                    @elseif($rental->status === 'Completed') bg-gray-100 text-gray-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $rental->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($rental->payment)
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        @if($rental->payment->status === 'Pending') bg-yellow-100 text-yellow-800
                                        @elseif($rental->payment->status === 'Verified') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ $rental->payment->status }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-800">Belum</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('rentals.show', $rental) }}" class="text-blue-600 hover:underline text-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $rentals->links() }}
        </div>
    @else
        <div class="bg-white rounded shadow p-12 text-center">
            <p class="text-gray-500 text-lg mb-4">Anda belum memiliki rental</p>
            <a href="{{ route('cars.catalog') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Jelajahi Katalog Mobil
            </a>
        </div>
    @endif
</div>
</x-app-layout>
