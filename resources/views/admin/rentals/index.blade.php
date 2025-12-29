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
                    <th class="px-6 py-4 text-left text-base font-bold text-gray-800">User</th>
                    <th class="px-6 py-4 text-left text-base font-bold text-gray-800">Mobil</th>
                    <th class="px-6 py-4 text-left text-base font-bold text-gray-800">Tanggal Sewa</th>
                    <th class="px-6 py-4 text-left text-base font-bold text-gray-800">Total</th>
                    <th class="px-6 py-4 text-left text-base font-bold text-gray-800">Status Rental</th>
                    <th class="px-6 py-4 text-left text-base font-bold text-gray-800">Pembayaran</th>
                    <th class="px-6 py-4 text-left text-base font-bold text-gray-800">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentals as $rental)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-6 py-5 text-sm">
                            <div class="font-semibold text-gray-900">{{ $rental->user->name }}</div>
                            <div class="text-gray-600 text-sm">{{ $rental->user->email }}</div>
                        </td>
                        <td class="px-6 py-5 text-sm font-medium text-gray-900">{{ $rental->car->name }}</td>
                        <td class="px-6 py-5 text-sm text-gray-800">{{ $rental->rental_date->format('d M Y') }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-900">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-5">
                            <span class="px-3 py-2 rounded-lg text-sm font-bold
                                @if($rental->status === 'Pending') bg-yellow-100 text-yellow-800
                                @elseif($rental->status === 'Paid') bg-blue-100 text-blue-800
                                @elseif($rental->status === 'Active') bg-green-100 text-green-800
                                @elseif($rental->status === 'Completed') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ $rental->status }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            @if ($rental->payment)
                                <span class="px-3 py-2 rounded-lg text-sm font-bold
                                    @if($rental->payment->status === 'Pending') bg-yellow-100 text-yellow-800
                                    @elseif($rental->payment->status === 'Verified') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $rental->payment->status }}
                                </span>
                            @else
                                <span class="text-gray-500 text-sm font-medium">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            @if ($rental->payment && $rental->payment->status === 'Pending')
                                <button onclick="openPaymentModal('{{ $rental->id }}')" class="text-blue-600 hover:text-blue-800 hover:underline text-sm font-semibold">
                                    Verifikasi
                                </button>
                            @elseif ($rental->status === 'Active')
                                <form method="POST" action="{{ route('rentals.complete', $rental) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800 hover:underline text-sm font-semibold" onclick="return confirm('Selesaikan rental ini?')">
                                        Selesaikan
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-500 text-sm font-medium">-</span>
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
<div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-2xl p-8 max-w-3xl w-full mx-auto max-h-[90vh] overflow-y-auto">
        <h3 class="text-2xl font-bold mb-6 text-gray-900">Verifikasi Pembayaran</h3>

        <div id="paymentContent" class="space-y-6">
            <!-- Loading -->
            <div class="text-center text-gray-500 py-8">Memuat...</div>
        </div>

        <div class="mt-8 flex gap-3 border-t pt-6">
            <button onclick="closePaymentModal()" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 font-semibold transition">
                Batal
            </button>
            <button onclick="submitPaymentVerification('reject')" class="flex-1 bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-semibold transition">
                Tolak
            </button>
            <button onclick="submitPaymentVerification('approve')" class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 font-semibold transition">
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
                    <div class="space-y-6">
                        <!-- Detail User -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg border border-blue-200">
                            <h4 class="font-bold text-lg mb-4 text-blue-900">👤 Detail User</h4>
                            <p class="text-base mb-2"><strong class="text-gray-700">Nama:</strong> <span class="text-gray-900">${rental.user.name}</span></p>
                            <p class="text-base"><strong class="text-gray-700">Email:</strong> <span class="text-gray-900">${rental.user.email}</span></p>
                        </div>

                        <!-- Detail Rental -->
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg border border-purple-200">
                            <h4 class="font-bold text-lg mb-4 text-purple-900">🚗 Detail Rental</h4>
                            <p class="text-base mb-2"><strong class="text-gray-700">Mobil:</strong> <span class="text-gray-900">${rental.car.name}</span></p>
                            <p class="text-base mb-2"><strong class="text-gray-700">Tanggal Sewa:</strong> <span class="text-gray-900">${new Date(rental.rental_date).toLocaleDateString('id-ID')}</span></p>
                            <p class="text-base mb-2"><strong class="text-gray-700">Durasi:</strong> <span class="text-gray-900">${rental.duration_days} hari</span></p>
                            <p class="text-base mb-2"><strong class="text-gray-700">Total Harga:</strong> <span class="font-semibold text-green-700">Rp ${rental.total_price.toLocaleString('id-ID')}</span></p>
                            ${rental.notes ? `<p class="text-base"><strong class="text-gray-700">Catatan User:</strong> <span class="text-gray-900">${rental.notes}</span></p>` : ''}
                        </div>

                        <!-- Bukti Pembayaran -->
                        <div class="border-2 border-gray-300 rounded-lg p-6 bg-gray-50">
                            <h4 class="font-bold text-lg mb-4 text-gray-900">📸 Bukti Pembayaran</h4>
                            <img src="/storage/${payment.payment_proof_path}" alt="Bukti Pembayaran" class="w-full rounded-lg border-2 border-gray-300 mb-4 max-h-96 object-cover shadow-lg">
                            <p class="text-sm text-gray-600 font-medium">📅 Tanggal Upload: <span class="text-gray-900">${new Date(payment.created_at).toLocaleDateString('id-ID', {year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit'})}</span></p>
                        </div>

                        <!-- Catatan Admin -->
                        <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200">
                            <label class="block text-base font-bold mb-3 text-yellow-900">📝 Catatan Verifikasi (opsional)</label>
                            <textarea id="adminNotes" placeholder="Masukkan catatan untuk disetujui atau ditolak..." class="w-full border-2 border-yellow-300 rounded-lg px-4 py-3 text-gray-900 font-medium placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent resize-vertical min-h-32" rows="5"></textarea>
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
