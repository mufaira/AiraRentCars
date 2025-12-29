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

    /* Hide columns on mobile */
    @media (max-width: 768px) {
        .hide-mobile {
            display: none;
        }
        
        .refund-card {
            display: block;
        }
        
        table {
            display: block;
            width: 100%;
        }
        
        table thead {
            display: none;
        }
        
        table tbody {
            display: block;
        }
        
        table tbody tr {
            display: block;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            margin-bottom: 16px;
            overflow: hidden;
        }
        
        table tbody tr:hover {
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        table td {
            display: block;
            padding: 12px 16px;
            border: none;
            text-align: left;
        }
        
        table td::before {
            content: attr(data-label);
            font-weight: bold;
            color: #6b7280;
            display: block;
            margin-bottom: 4px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        table td:first-child {
            padding-top: 16px;
        }
        
        table td:last-child {
            padding-bottom: 16px;
        }
    }
</style>

<div class="container mx-auto px-4 py-8 md:py-10">
    <div class="mb-6 md:mb-8">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base transition group">
            <span class="mr-2 group-hover:-translate-x-1 transition">←</span> Kembali ke Dashboard
        </a>
    </div>

    <div class="mb-8 md:mb-10 bg-gradient-to-r from-amber-600 to-amber-700 rounded-2xl p-6 md:p-8 shadow-lg">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-2 md:mb-3">Kelola Permintaan Refund</h1>
        <p class="text-amber-100 font-medium text-sm md:text-base">Review dan proses semua permintaan refund dari pelanggan</p>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-4 md:px-6 py-4 rounded-lg mb-8 shadow-sm font-medium text-sm md:text-base">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-4 md:px-6 py-4 rounded-lg mb-8 shadow-sm font-medium text-sm md:text-base">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filter Status -->
    <div class="bg-white rounded-xl shadow-md p-4 md:p-6 mb-8 border border-gray-200">
        <form action="{{ route('refunds.admin.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Filter Status</label>
                <select name="status" class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100 transition text-sm md:text-base">
                    <option value="">Semua Status</option>
                    <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Approved" {{ request('status') === 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Rejected" {{ request('status') === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-amber-600 to-amber-700 text-white px-6 md:px-8 py-3 rounded-xl hover:from-amber-700 hover:to-amber-800 font-bold transition shadow-lg hover:shadow-xl text-sm md:text-base">Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                        <th class="px-4 md:px-6 py-4 text-left text-xs md:text-sm font-bold text-gray-900">User</th>
                        <th class="px-4 md:px-6 py-4 text-left text-xs md:text-sm font-bold text-gray-900 hide-mobile">Mobil</th>
                        <th class="px-4 md:px-6 py-4 text-left text-xs md:text-sm font-bold text-gray-900 hide-mobile">Alasan</th>
                        <th class="px-4 md:px-6 py-4 text-left text-xs md:text-sm font-bold text-gray-900">Jumlah Refund</th>
                        <th class="px-4 md:px-6 py-4 text-left text-xs md:text-sm font-bold text-gray-900">Status</th>
                        <th class="px-4 md:px-6 py-4 text-left text-xs md:text-sm font-bold text-gray-900 hide-mobile">Tanggal Request</th>
                        <th class="px-4 md:px-6 py-4 text-left text-xs md:text-sm font-bold text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($refunds as $refund)
                        <tr class="border-b border-gray-100">
                            <td class="px-4 md:px-6 py-4" data-label="User">
                                <div class="font-semibold text-gray-900 text-sm">{{ $refund->rental->user->name }}</div>
                                <div class="text-gray-500 text-xs font-medium">{{ $refund->rental->user->email }}</div>
                            </td>
                            <td class="px-4 md:px-6 py-4 font-medium text-gray-900 text-sm hide-mobile" data-label="Mobil">{{ $refund->rental->car->name }}</td>
                            <td class="px-4 md:px-6 py-4 text-sm hide-mobile" data-label="Alasan">
                                <div class="font-semibold text-gray-900">{{ $refund->reason_text }}</div>
                                @if ($refund->custom_reason)
                                    <div class="text-xs text-gray-600 mt-1 font-medium">{{ Str::limit($refund->custom_reason, 50) }}</div>
                                @endif
                            </td>
                            <td class="px-4 md:px-6 py-4 font-bold text-amber-600 text-sm md:text-base" data-label="Jumlah Refund">Rp {{ number_format($refund->refund_amount, 0, ',', '.') }}</td>
                            <td class="px-4 md:px-6 py-4" data-label="Status">
                                <span class="status-badge
                                    @if($refund->status === 'Pending') status-pending
                                    @elseif($refund->status === 'Approved') status-approved
                                    @else status-rejected
                                    @endif">
                                    {{ $refund->status }}
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-4 text-sm font-medium text-gray-700 hide-mobile" data-label="Tanggal Request">{{ $refund->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 md:px-6 py-4" data-label="Aksi">
                                @if ($refund->status === 'Pending')
                                    <a href="{{ route('refunds.admin.show', $refund) }}" class="inline-flex items-center gap-2 text-white bg-gradient-to-r from-blue-600 to-blue-700 px-3 md:px-4 py-2 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition text-xs md:text-sm shadow-md whitespace-nowrap">
                                        Review
                                    </a>
                                @else
                                    <span class="text-gray-500 text-xs font-semibold bg-gray-100 px-3 py-2 rounded-lg">{{ $refund->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 md:px-6 py-12 text-center">
                                <p class="text-gray-500 font-medium text-sm md:text-base">Tidak ada permintaan refund</p>
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
