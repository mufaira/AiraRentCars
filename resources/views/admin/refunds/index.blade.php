<x-app-layout>
<style>
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    
    .status-badge {
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.3px;
        padding: 6px 12px;
        border-radius: 8px;
        display: inline-block;
    }

    .status-pending {
        background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 100%);
        color: #92400e;
        border: 1px solid #f59e0b;
    }

    .status-approved {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border: 1px solid #10b981;
    }

    .status-rejected {
        background: linear-gradient(135deg, #fee2e2 0%, #fca5a5 100%);
        color: #7f1d1d;
        border: 1px solid #ef4444;
    }

    table tbody tr {
        transition: all 0.3s ease;
    }

    table tbody tr:hover {
        background-color: #f9fafb;
        box-shadow: inset 0 0 0 1px #e5e7eb;
    }
</style>

<div class="container mx-auto px-4 py-10">
    <div class="mb-8">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base transition group">
            <span class="mr-2 group-hover:-translate-x-1 transition">←</span> Kembali ke Dashboard
        </a>
    </div>

    <div class="mb-10 bg-gradient-to-r from-amber-600 to-amber-700 rounded-2xl p-8 shadow-lg">
        <h1 class="text-5xl font-bold text-white mb-3">Kelola Permintaan Refund</h1>
        <p class="text-amber-100 font-medium text-base">Review dan proses semua permintaan refund dari pelanggan</p>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-8 shadow-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-8 shadow-sm font-medium">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filter Status -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-200">
        <form action="{{ route('refunds.admin.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
            <div class="flex-1">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Filter Status</label>
                <select name="status" class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100 transition">
                    <option value="">Semua Status</option>
                    <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Approved" {{ request('status') === 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Rejected" {{ request('status') === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <button type="submit" class="bg-gradient-to-r from-amber-600 to-amber-700 text-white px-8 py-3 rounded-xl hover:from-amber-700 hover:to-amber-800 font-bold transition shadow-lg hover:shadow-xl">Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">User</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Mobil</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Alasan</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Jumlah Refund</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Tanggal Request</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($refunds as $refund)
                        <tr class="border-b border-gray-100">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $refund->rental->user->name }}</div>
                                <div class="text-gray-500 text-xs font-medium">{{ $refund->rental->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $refund->rental->car->name }}</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $refund->reason_text }}</div>
                                @if ($refund->custom_reason)
                                    <div class="text-xs text-gray-600 mt-1 font-medium">{{ Str::limit($refund->custom_reason, 50) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-amber-600">Rp {{ number_format($refund->refund_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="status-badge
                                    @if($refund->status === 'Pending') status-pending
                                    @elseif($refund->status === 'Approved') status-approved
                                    @else status-rejected
                                    @endif">
                                    {{ $refund->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-700">{{ $refund->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4">
                                @if ($refund->status === 'Pending')
                                    <a href="{{ route('refunds.admin.show', $refund) }}" class="inline-flex items-center gap-2 text-white bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-2 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition text-sm shadow-md">
                                        Review
                                    </a>
                                @else
                                    <span class="text-gray-500 text-xs font-semibold bg-gray-100 px-3 py-2 rounded-lg">{{ $refund->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <p class="text-gray-500 font-medium text-base">Tidak ada permintaan refund</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $refunds->links() }}
    </div>
</div>
</x-app-layout>
