<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <a href="{{ route('rentals.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">← Daftar Sewa Saya</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Rental Info -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded shadow p-6 mb-6">
                <h2 class="text-2xl font-bold mb-4">Detail Rental #{{ $rental->id }}</h2>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-gray-600 text-sm">Status Rental</p>
                        <p class="font-bold text-lg">
                            <span class="px-3 py-1 rounded text-sm 
                                @if($rental->status === 'Pending') bg-yellow-100 text-yellow-800
                                @elseif($rental->status === 'Paid') bg-blue-100 text-blue-800
                                @elseif($rental->status === 'Active') bg-green-100 text-green-800
                                @elseif($rental->status === 'Completed') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ $rental->status }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Mobil</p>
                        <p class="font-bold text-lg">{{ $rental->car->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tanggal Sewa</p>
                        <p class="font-bold">{{ $rental->rental_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tanggal Kembali</p>
                        <p class="font-bold">{{ $rental->return_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Durasi</p>
                        <p class="font-bold">{{ $rental->duration_days }} hari</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Total Harga</p>
                        <p class="font-bold text-lg text-blue-600">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>

                @if ($rental->notes)
                    <div class="border-t pt-4">
                        <p class="text-gray-600 text-sm mb-1">Catatan</p>
                        <p>{{ $rental->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Payment Status -->
        <div>
            <div class="bg-white rounded shadow p-6">
                <h3 class="text-lg font-bold mb-4">Status Pembayaran</h3>

                @if ($rental->payment)
                    <div class="space-y-4">
                        <div>
                            <p class="text-gray-600 text-sm">Status</p>
                            <p class="font-bold">
                                <span class="px-3 py-1 rounded text-sm
                                    @if($rental->payment->status === 'Pending') bg-yellow-100 text-yellow-800
                                    @elseif($rental->payment->status === 'Verified') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $rental->payment->status }}
                                </span>
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-600 text-sm">Jumlah Pembayaran</p>
                            <p class="font-bold text-lg">Rp {{ number_format($rental->payment->amount, 0, ',', '.') }}</p>
                        </div>

                        <div>
                            <p class="text-gray-600 text-sm">Bukti Pembayaran</p>
                            <img src="{{ asset('storage/' . $rental->payment->payment_proof_path) }}" 
                                 alt="Bukti pembayaran" class="w-full rounded mt-2 border">
                        </div>

                        @if ($rental->payment->admin_notes)
                            <div class="bg-gray-100 p-3 rounded">
                                <p class="text-gray-600 text-sm mb-1">Catatan Admin</p>
                                <p class="text-sm">{{ $rental->payment->admin_notes }}</p>
                            </div>
                        @endif

                        @if ($rental->payment->status === 'Pending')
                            <a href="{{ route('rentals.payment', $rental) }}" class="block text-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Update Pembayaran
                            </a>
                        @endif
                    </div>
                @else
                    <div class="bg-yellow-50 border border-yellow-200 rounded p-4">
                        <p class="text-yellow-800 text-sm mb-3">Belum ada pembayaran</p>
                        <a href="{{ route('rentals.payment', $rental) }}" class="block text-center bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 font-semibold">
                            Lakukan Pembayaran
                        </a>
                    </div>
                @endif

                <!-- Refund Section -->
                <div class="mt-6 pt-6 border-t">
                    <h3 class="text-lg font-bold mb-4">Refund / Pembatalan</h3>

                    @if ($rental->refundRequest)
                        <div class="bg-blue-50 border border-blue-200 rounded p-4">
                            <div class="mb-3">
                                <p class="text-gray-600 text-sm">Status Refund</p>
                                <p class="font-bold">
                                    <span class="px-3 py-1 rounded text-sm
                                        @if($rental->refundRequest->status === 'Pending') bg-yellow-100 text-yellow-800
                                        @elseif($rental->refundRequest->status === 'Approved') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ $rental->refundRequest->status }}
                                    </span>
                                </p>
                            </div>

                            @if ($rental->refundRequest->admin_notes)
                                <div class="bg-white p-3 rounded text-sm">
                                    <p class="text-gray-600 mb-1"><strong>Catatan Admin:</strong></p>
                                    <p>{{ $rental->refundRequest->admin_notes }}</p>
                                </div>
                            @endif
                        </div>
                    @elseif ($rental->status === 'Pending' && !$rental->payment)
                        <!-- Cancel untuk yang belum bayar -->
                        <form method="POST" action="{{ route('rentals.cancel', $rental) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="w-full bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 font-semibold"
                                    onclick="return confirm('Anda yakin ingin membatalkan rental ini?')">
                                Batalkan Pesanan
                            </button>
                        </form>
                    @elseif (in_array($rental->status, ['Paid', 'Active']))
                        <!-- Refund untuk yang sudah bayar -->
                        <button onclick="confirmRefund()" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 font-semibold">
                            Ajukan Refund
                        </button>

                        <script>
                            function confirmRefund() {
                                if (confirm('Anda yakin ingin melakukan refund untuk rental ini? Silakan review alasan Anda dengan hati-hati.')) {
                                    window.location.href = '{{ route('refunds.create', $rental) }}';
                                }
                            }
                        </script>
                    @else
                        <div class="bg-gray-100 rounded p-3 text-sm text-gray-600">
                            Rental dengan status {{ $rental->status }} tidak dapat dibatalkan atau di-refund
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
