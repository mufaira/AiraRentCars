<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline text-sm">← Kembali ke Dashboard</a>
    </div>

    <h1 class="text-3xl font-bold mb-6">Kelola Refund</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filter Status -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <form action="{{ route('refunds.admin.index') }}" method="GET" class="flex gap-3">
            <select name="status" class="border rounded px-3 py-2">
                <option value="">Semua Status</option>
                <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ request('status') === 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ request('status') === 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
        </form>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-6 py-3 text-left text-sm font-semibold">User</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Mobil</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Alasan</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Jumlah Refund</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Tanggal Request</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($refunds as $refund)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">
                            <div class="font-semibold">{{ $refund->rental->user->name }}</div>
                            <div class="text-gray-500 text-xs">{{ $refund->rental->user->email }}</div>
                        </td>
                        <td class="px-6 py-4">{{ $refund->rental->car->name }}</td>
                        <td class="px-6 py-4 text-sm">
                            <div class="font-semibold">{{ $refund->reason_text }}</div>
                            @if ($refund->custom_reason)
                                <div class="text-xs text-gray-600 mt-1">{{ Str::limit($refund->custom_reason, 50) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold">Rp {{ number_format($refund->refund_amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                @if($refund->status === 'Pending') bg-yellow-100 text-yellow-800
                                @elseif($refund->status === 'Approved') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ $refund->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $refund->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4">
                            @if ($refund->status === 'Pending')
                                <a href="{{ route('refunds.admin.show', $refund) }}" class="text-blue-600 hover:underline text-sm">
                                    Review
                                </a>
                            @else
                                <span class="text-gray-500 text-xs">{{ $refund->status }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada refund request
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $refunds->links() }}
    </div>
</div>
</x-app-layout>
