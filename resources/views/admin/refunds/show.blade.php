<x-app-layout>
<style>
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .info-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .info-card:hover {
        border-color: #d1d5db;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .info-label {
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 500;
        color: #111827;
    }

    .status-badge {
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.3px;
        padding: 8px 14px;
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
</style>

<div class="container mx-auto px-4 py-10 max-w-5xl">
    <a href="{{ route('refunds.admin.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base mb-8 transition group">
        <span class="mr-2 group-hover:-translate-x-1 transition">←</span> Kembali ke Daftar
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- User Info -->
            <div class="info-card">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Informasi User</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <div class="info-label">Nama</div>
                        <div class="info-value">{{ $refund->rental->user->name }}</div>
                    </div>
                    <div>
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $refund->rental->user->email }}</div>
                    </div>
                </div>
            </div>

            <!-- Rental Info -->
            <div class="info-card">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Detail Rental</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <div class="info-label">Mobil</div>
                        <div class="info-value">{{ $refund->rental->car->name }}</div>
                    </div>
                    <div>
                        <div class="info-label">Status Rental</div>
                        <div class="info-value">{{ $refund->rental->status }}</div>
                    </div>
                    <div>
                        <div class="info-label">Tanggal Sewa</div>
                        <div class="info-value">{{ $refund->rental->rental_date->format('d M Y') }}</div>
                    </div>
                    <div>
                        <div class="info-label">Durasi</div>
                        <div class="info-value">{{ $refund->rental->duration_days }} hari</div>
                    </div>
                    <div>
                        <div class="info-label">Total Harga</div>
                        <div class="info-value font-bold text-amber-600">Rp {{ number_format($refund->rental->total_price, 0, ',', '.') }}</div>
                    </div>
                    <div>
                        <div class="info-label">Status Pembayaran</div>
                        <div class="info-value">
                            @if ($refund->rental->payment)
                                {{ $refund->rental->payment->status }}
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Refund Request Info -->
            <div class="info-card">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Detail Permintaan Refund</h2>
                <div class="space-y-6">
                    <div>
                        <div class="info-label">Alasan Refund</div>
                        <div class="info-value">{{ $refund->reason_text }}</div>
                    </div>

                    @if ($refund->custom_reason)
                        <div>
                            <div class="info-label">Penjelasan Tambahan</div>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-sm text-gray-700 leading-relaxed">{{ $refund->custom_reason }}</div>
                        </div>
                    @endif

                    <div>
                        <div class="info-label">Jumlah Refund</div>
                        <div class="text-2xl font-bold text-amber-600">Rp {{ number_format($refund->refund_amount, 0, ',', '.') }}</div>
                    </div>

                    <div>
                        <div class="info-label">Tanggal Request</div>
                        <div class="info-value">{{ $refund->created_at->format('d M Y H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Process Refund -->
            @if ($refund->status === 'Pending')
                <div class="info-card border-2 border-amber-200 bg-amber-50">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Proses Refund</h2>
                    
                    <form action="{{ route('refunds.process', $refund) }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-bold text-gray-900 mb-3">Catatan Admin</label>
                            <textarea name="admin_notes" rows="5" 
                                      class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100 transition"
                                      placeholder="Catatan untuk user atau alasan keputusan Anda..."></textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <button type="submit" name="action" value="approve" class="bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-4 rounded-xl hover:from-green-700 hover:to-green-800 font-bold text-base transition shadow-lg hover:shadow-xl transform hover:scale-105">
                                Setujui Refund
                            </button>
                            <button type="submit" name="action" value="reject" class="bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-4 rounded-xl hover:from-red-700 hover:to-red-800 font-bold text-base transition shadow-lg hover:shadow-xl transform hover:scale-105"
                                    onclick="return confirm('Anda yakin menolak refund ini?')">
                                Tolak Refund
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="info-card">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Status Refund</h2>
                    
                    <div class="space-y-6">
                        <div>
                            <div class="info-label">Status</div>
                            <div>
                                <span class="status-badge
                                    @if($refund->status === 'Approved') status-approved
                                    @else status-rejected
                                    @endif">
                                    {{ $refund->status }}
                                </span>
                            </div>
                        </div>

                        <div>
                            <div class="info-label">Diproses Pada</div>
                            <div class="info-value">{{ $refund->processed_at ? $refund->processed_at->format('d M Y H:i') : '-' }}</div>
                        </div>

                        @if ($refund->admin_notes)
                            <div>
                                <div class="info-label">Catatan Admin</div>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-sm text-gray-700 leading-relaxed">{{ $refund->admin_notes }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="info-card border-2 border-amber-300 bg-gradient-to-br from-amber-50 to-amber-100 sticky top-4">
                <h3 class="font-bold text-amber-900 mb-4 text-lg">Ringkasan Refund</h3>
                
                <div class="mb-6 pb-6 border-b-2 border-amber-200">
                    <div class="text-3xl font-bold text-amber-600 mb-2">
                        Rp {{ number_format($refund->refund_amount, 0, ',', '.') }}
                    </div>
                    <p class="text-sm font-semibold text-amber-800">Jumlah yang akan dikembalikan</p>
                </div>

                <div class="mb-6">
                    <span class="status-badge
                        @if($refund->status === 'Pending') status-pending
                        @elseif($refund->status === 'Approved') status-approved
                        @else status-rejected
                        @endif">
                        {{ $refund->status }}
                    </span>
                </div>

                <div class="bg-white bg-opacity-60 rounded-lg p-4">
                    <p class="text-sm font-bold text-amber-900 mb-3">Checklist Verifikasi:</p>
                    <ul class="text-xs text-amber-800 space-y-2 font-medium">
                        <li class="flex items-start gap-2">
                            <span class="text-lg leading-none">✓</span>
                            <span>Review detail refund dengan teliti</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-lg leading-none">✓</span>
                            <span>Pastikan alasan refund valid</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-lg leading-none">✓</span>
                            <span>Berikan catatan yang jelas</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-lg leading-none">✓</span>
                            <span>Keputusan tidak bisa diubah</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
