<x-app-layout>
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <a href="{{ route('refunds.admin.index') }}" class="text-blue-600 hover:underline text-sm mb-4 inline-block">← Kembali</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- User Info -->
            <div class="bg-white rounded shadow p-6 mb-6">
                <h2 class="text-xl font-bold mb-4">Informasi User</h2>
                <div class="space-y-2 text-sm">
                    <div>
                        <p class="text-gray-600">Nama</p>
                        <p class="font-semibold">{{ $refund->rental->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Email</p>
                        <p class="font-semibold">{{ $refund->rental->user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Rental Info -->
            <div class="bg-white rounded shadow p-6 mb-6">
                <h2 class="text-xl font-bold mb-4">Detail Rental</h2>
                <div class="space-y-2 text-sm">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600">Mobil</p>
                            <p class="font-semibold">{{ $refund->rental->car->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Status Rental</p>
                            <p class="font-semibold">{{ $refund->rental->status }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Tanggal Sewa</p>
                            <p class="font-semibold">{{ $refund->rental->rental_date->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Durasi</p>
                            <p class="font-semibold">{{ $refund->rental->duration_days }} hari</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Total Harga</p>
                            <p class="font-semibold">Rp {{ number_format($refund->rental->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Status Pembayaran</p>
                            @if ($refund->rental->payment)
                                <p class="font-semibold">{{ $refund->rental->payment->status }}</p>
                            @else
                                <p class="font-semibold text-gray-400">-</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Refund Request Info -->
            <div class="bg-white rounded shadow p-6 mb-6">
                <h2 class="text-xl font-bold mb-4">Detail Permintaan Refund</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600 text-sm">Alasan Refund</p>
                        <p class="font-semibold">{{ $refund->reason_text }}</p>
                    </div>

                    @if ($refund->custom_reason)
                        <div>
                            <p class="text-gray-600 text-sm">Penjelasan Tambahan</p>
                            <p class="bg-gray-50 rounded p-3 text-sm">{{ $refund->custom_reason }}</p>
                        </div>
                    @endif

                    <div>
                        <p class="text-gray-600 text-sm">Jumlah Refund</p>
                        <p class="font-bold text-lg">Rp {{ number_format($refund->refund_amount, 0, ',', '.') }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 text-sm">Tanggal Request</p>
                        <p class="font-semibold">{{ $refund->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Process Refund -->
            @if ($refund->status === 'Pending')
                <div class="bg-white rounded shadow p-6">
                    <h2 class="text-xl font-bold mb-4">Proses Refund</h2>
                    
                    <form action="{{ route('refunds.process', $refund) }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold mb-2">Catatan Admin</label>
                            <textarea name="admin_notes" rows="4" 
                                      class="w-full border rounded px-3 py-2"
                                      placeholder="Catatan untuk user atau alasan keputusan Anda..."></textarea>
                        </div>

                        <div class="flex gap-3">
                            <button type="submit" name="action" value="approve" class="flex-1 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 font-semibold">
                                ✓ Setujui Refund
                            </button>
                            <button type="submit" name="action" value="reject" class="flex-1 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 font-semibold"
                                    onclick="return confirm('Anda yakin menolak refund ini?')">
                                ✗ Tolak Refund
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="bg-white rounded shadow p-6">
                    <h2 class="text-xl font-bold mb-4">Status Refund</h2>
                    
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-600 text-sm">Status</p>
                            <p class="font-bold text-lg">
                                <span class="px-3 py-1 rounded text-sm
                                    @if($refund->status === 'Approved') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $refund->status }}
                                </span>
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-600 text-sm">Diproses Pada</p>
                            <p class="font-semibold">{{ $refund->processed_at ? $refund->processed_at->format('d M Y H:i') : '-' }}</p>
                        </div>

                        @if ($refund->admin_notes)
                            <div>
                                <p class="text-gray-600 text-sm">Catatan Admin</p>
                                <p class="bg-gray-50 rounded p-3 text-sm">{{ $refund->admin_notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-blue-50 rounded shadow p-6 sticky top-4">
                <h3 class="font-bold text-blue-900 mb-3">Status Refund</h3>
                
                <div class="mb-4">
                    <div class="text-3xl font-bold text-blue-600 mb-2">
                        Rp {{ number_format($refund->refund_amount, 0, ',', '.') }}
                    </div>
                    <p class="text-xs text-blue-800">Jumlah yang akan dikembalikan</p>
                </div>

                <div class="mb-4">
                    <span class="px-3 py-1 rounded text-sm font-semibold
                        @if($refund->status === 'Pending') bg-yellow-100 text-yellow-800
                        @elseif($refund->status === 'Approved') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ $refund->status }}
                    </span>
                </div>

                <hr class="my-4 border-blue-200">

                <div class="text-sm">
                    <p class="text-blue-800 mb-2"><strong>Informasi Penting:</strong></p>
                    <ul class="text-xs text-blue-700 space-y-2">
                        <li>• Review detail refund dengan teliti</li>
                        <li>• Pastikan alasan refund valid</li>
                        <li>• Berikan catatan yang jelas untuk user</li>
                        <li>• Keputusan refund tidak bisa diubah</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
