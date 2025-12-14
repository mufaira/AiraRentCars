<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline text-sm">← Kembali ke Dashboard</a>
    </div>
    
    <h1 class="text-3xl font-bold mb-6">Kelola Rental</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-6 py-3 text-left text-sm font-semibold">User</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Mobil</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Tanggal Sewa</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Total</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Status Rental</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Pembayaran</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentals as $rental)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">
                            <div class="font-semibold">{{ $rental->user->name }}</div>
                            <div class="text-gray-500 text-xs">{{ $rental->user->email }}</div>
                        </td>
                        <td class="px-6 py-4">{{ $rental->car->name }}</td>
                        <td class="px-6 py-4">{{ $rental->rental_date->format('d M Y') }}</td>
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
                                <span class="text-gray-500 text-xs">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($rental->payment && $rental->payment->status === 'Pending')
                                <button onclick="openPaymentModal({{ $rental->id }})" class="text-blue-600 hover:underline text-sm">
                                    Verifikasi
                                </button>
                            @elseif ($rental->status === 'Active')
                                <form method="POST" action="{{ route('rentals.complete', $rental) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:underline text-sm" onclick="return confirm('Selesaikan rental ini?')">
                                        Selesaikan
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-500 text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $rentals->links() }}
    </div>
</div>

<!-- Payment Verification Modal -->
<div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded shadow p-6 max-w-2xl w-full mx-auto max-h-[90vh] overflow-y-auto">
        <h3 class="text-lg font-bold mb-4">Verifikasi Pembayaran</h3>

        <div id="paymentContent" class="space-y-4">
            <!-- Loading -->
            <div class="text-center text-gray-500">Memuat...</div>
        </div>

        <div class="mt-6 flex gap-2 border-t pt-4">
            <button onclick="closePaymentModal()" class="flex-1 bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                Batal
            </button>
            <button onclick="submitPaymentVerification('reject')" class="flex-1 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Tolak
            </button>
            <button onclick="submitPaymentVerification('approve')" class="flex-1 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Setujui
            </button>
        </div>
    </div>
</div>

<script>
    function openPaymentModal(rentalId) {
        // Fetch payment details via API
        fetch(`/api/rentals/${rentalId}/payment`)
            .then(r => r.json())
            .then(data => {
                const rental = data.rental;
                const payment = data.payment;
                
                const html = `
                    <div class="space-y-4">
                        <!-- Detail User -->
                        <div class="bg-gray-50 p-4 rounded">
                            <h4 class="font-semibold text-sm mb-2">Detail User</h4>
                            <p class="text-sm"><strong>Nama:</strong> ${rental.user.name}</p>
                            <p class="text-sm"><strong>Email:</strong> ${rental.user.email}</p>
                        </div>

                        <!-- Detail Rental -->
                        <div class="bg-gray-50 p-4 rounded">
                            <h4 class="font-semibold text-sm mb-2">Detail Rental</h4>
                            <p class="text-sm"><strong>Mobil:</strong> ${rental.car.name}</p>
                            <p class="text-sm"><strong>Tanggal Sewa:</strong> ${new Date(rental.rental_date).toLocaleDateString('id-ID')}</p>
                            <p class="text-sm"><strong>Durasi:</strong> ${rental.duration_days} hari</p>
                            <p class="text-sm"><strong>Total Harga:</strong> Rp ${rental.total_price.toLocaleString('id-ID')}</p>
                            ${rental.notes ? `<p class="text-sm"><strong>Catatan User:</strong> ${rental.notes}</p>` : ''}
                        </div>

                        <!-- Bukti Pembayaran -->
                        <div class="border rounded p-4">
                            <h4 class="font-semibold text-sm mb-2">Bukti Pembayaran</h4>
                            <img src="/storage/${payment.payment_proof_path}" alt="Bukti Pembayaran" class="w-full rounded border mb-3 max-h-96 object-cover">
                            <p class="text-xs text-gray-500">Tanggal Upload: ${new Date(payment.created_at).toLocaleDateString('id-ID', {year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit'})}</p>
                        </div>

                        <!-- Catatan Admin -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Catatan Verifikasi (opsional)</label>
                            <textarea id="adminNotes" placeholder="Masukkan catatan untuk disetujui atau ditolak..." class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"></textarea>
                        </div>
                    </div>
                `;
                document.getElementById('paymentContent').innerHTML = html;
                document.getElementById('paymentModal').classList.remove('hidden');
                window.currentRentalId = rentalId;
            })
            .catch(err => {
                alert('Error: ' + err);
            });
    }

    function closePaymentModal() {
        document.getElementById('paymentModal').classList.add('hidden');
    }

    function submitPaymentVerification(action) {
        const notes = document.getElementById('adminNotes')?.value || '';
        fetch(`/admin/rentals/${window.currentRentalId}/payment`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
            },
            body: JSON.stringify({
                action: action,
                admin_notes: notes
            })
        }).then(() => {
            location.reload();
        });
    }
</script>
</x-app-layout>
