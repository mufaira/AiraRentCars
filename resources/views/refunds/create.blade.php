<x-app-layout>
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <a href="{{ route('rentals.show', $rental) }}" class="text-blue-600 hover:underline text-sm mb-4 inline-block">← Kembali</a>

    <div class="bg-white rounded shadow p-6">
        <h1 class="text-3xl font-bold mb-6">Ajukan Refund</h1>

        <div class="bg-yellow-50 border border-yellow-200 rounded p-4 mb-6">
            <p class="text-sm text-yellow-800">
                <strong>Perhatian:</strong> Anda sedang mengajukan refund untuk rental <strong>{{ $rental->car->name }}</strong>. 
                Admin akan meninjau permintaan Anda dan menghubungi Anda dalam waktu 1-2 hari kerja.
            </p>
        </div>

        <!-- Rental Summary -->
        <div class="bg-gray-50 rounded p-4 mb-6">
            <h3 class="font-semibold mb-3">Detail Rental</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-600">Mobil</p>
                    <p class="font-semibold">{{ $rental->car->name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Tanggal Sewa</p>
                    <p class="font-semibold">{{ $rental->rental_date->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Durasi</p>
                    <p class="font-semibold">{{ $rental->duration_days }} hari</p>
                </div>
                <div>
                    <p class="text-gray-600">Total Harga</p>
                    <p class="font-semibold">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Status Rental</p>
                    <p class="font-semibold">{{ $rental->status }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Status Pembayaran</p>
                    @if ($rental->payment)
                        <p class="font-semibold">{{ $rental->payment->status }}</p>
                    @else
                        <p class="font-semibold text-gray-400">-</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Refund Form -->
        <form action="{{ route('refunds.store', $rental) }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold mb-3">Pilih Alasan Refund</label>
                
                <div class="space-y-3">
                    <label class="flex items-start p-3 border rounded cursor-pointer hover:bg-blue-50" onclick="selectReason('change_plan')">
                        <input type="radio" name="reason" value="change_plan" class="mt-1" required>
                        <div class="ml-3">
                            <p class="font-semibold text-sm">Berubah Rencana</p>
                            <p class="text-xs text-gray-600">Saya memutuskan tidak jadi menyewa mobil ini</p>
                        </div>
                    </label>

                    <label class="flex items-start p-3 border rounded cursor-pointer hover:bg-blue-50" onclick="selectReason('time_issue')">
                        <input type="radio" name="reason" value="time_issue" class="mt-1" required>
                        <div class="ml-3">
                            <p class="font-semibold text-sm">Masalah Waktu</p>
                            <p class="text-xs text-gray-600">Jadwal sewa saya berubah atau ada keperluan mendesak</p>
                        </div>
                    </label>

                    <label class="flex items-start p-3 border rounded cursor-pointer hover:bg-blue-50" onclick="selectReason('car_issue')">
                        <input type="radio" name="reason" value="car_issue" class="mt-1" required>
                        <div class="ml-3">
                            <p class="font-semibold text-sm">Masalah dengan Mobil</p>
                            <p class="text-xs text-gray-600">Ada masalah atau ketidaksesuaian dengan kondisi mobil</p>
                        </div>
                    </label>

                    <label class="flex items-start p-3 border rounded cursor-pointer hover:bg-blue-50" onclick="selectReason('other')">
                        <input type="radio" name="reason" value="other" class="mt-1" required>
                        <div class="ml-3">
                            <p class="font-semibold text-sm">Alasan Lainnya</p>
                            <p class="text-xs text-gray-600">Silakan jelaskan alasan Anda di bawah</p>
                        </div>
                    </label>
                </div>

                @error('reason')
                    <span class="text-red-500 text-sm block mt-2">{{ $message }}</span>
                @enderror
            </div>

            <!-- Custom Reason -->
            <div id="customReasonSection" class="hidden">
                <label class="block text-sm font-semibold mb-2">Jelaskan Alasan Refund Anda</label>
                <textarea name="custom_reason" rows="4" 
                          class="w-full border rounded px-3 py-2 @error('custom_reason') border-red-500 @enderror"
                          placeholder="Jelaskan secara detail alasan Anda ingin melakukan refund..."></textarea>
                @error('custom_reason')
                    <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 font-semibold">
                    Ajukan Refund
                </button>
                <a href="{{ route('rentals.show', $rental) }}" class="flex-1 bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 font-semibold text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function selectReason(reason) {
        const customSection = document.getElementById('customReasonSection');
        if (reason === 'other') {
            customSection.classList.remove('hidden');
        } else {
            customSection.classList.add('hidden');
        }
    }

    // Check initial state
    window.addEventListener('load', () => {
        const selectedReason = document.querySelector('input[name="reason"]:checked')?.value;
        selectReason(selectedReason || '');
    });
</script>
</x-app-layout>
