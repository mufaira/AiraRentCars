<x-app-layout>
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <a href="{{ route('rentals.show', $rental) }}" class="text-blue-600 hover:underline mb-4 inline-block">← Kembali</a>

    <h1 class="text-3xl font-bold mb-6">Verifikasi Pembayaran</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Rental Info -->
        <div class="bg-white rounded shadow p-6">
            <h3 class="text-xl font-bold mb-4">Detail Rental</h3>
            
            <div class="space-y-3 text-sm">
                <div>
                    <span class="text-gray-600">Mobil:</span>
                    <p class="font-semibold">{{ $rental->car->name }}</p>
                </div>
                <div>
                    <span class="text-gray-600">Tanggal Sewa:</span>
                    <p class="font-semibold">{{ $rental->rental_date->format('d M Y') }}</p>
                </div>
                <div>
                    <span class="text-gray-600">Durasi:</span>
                    <p class="font-semibold">{{ $rental->duration_days }} hari</p>
                </div>
                <div>
                    <span class="text-gray-600">Total Harga:</span>
                    <p class="font-bold text-lg text-blue-600">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Form -->
        <div class="bg-white rounded shadow p-6">
            <h3 class="text-xl font-bold mb-4">Upload Bukti Pembayaran</h3>

            <form action="{{ route('rentals.storePayment', $rental) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="bg-blue-50 border border-blue-200 rounded p-3 text-sm">
                    <p class="font-semibold text-blue-900 mb-1">Panduan Pembayaran:</p>
                    <ul class="text-blue-800 space-y-1 list-disc list-inside">
                        <li>Transfer ke rekening yang telah disediakan</li>
                        <li>Jumlah transfer: Rp {{ number_format($rental->total_price, 0, ',', '.') }}</li>
                        <li>Upload screenshot/foto bukti transfer</li>
                        <li>Tunggu verifikasi dari admin</li>
                    </ul>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Upload Foto Bukti Pembayaran</label>
                    <input type="file" name="payment_proof" accept="image/*" 
                           class="w-full border rounded px-3 py-2 @error('payment_proof') border-red-500 @enderror" required>
                    <small class="text-gray-500">Format: JPG, PNG, GIF (max 2MB)</small>
                    @error('payment_proof') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold">
                    Kirim Bukti Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
