<x-app-layout>
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <a href="{{ route('cars.detail', $car) }}" class="text-blue-600 hover:underline mb-4 inline-block">← Kembali</a>

    <h1 class="text-3xl font-bold mb-6">Sewa Mobil: {{ $car->name }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Car Info -->
        <div class="bg-white rounded shadow p-6">
            @if ($car->getFeaturedPhoto())
                <img src="{{ asset('storage/' . $car->getFeaturedPhoto()->photo_path) }}" 
                     alt="{{ $car->name }}" class="w-full h-48 object-cover rounded mb-4">
            @endif
            
            <h3 class="text-xl font-bold mb-3">Detail Mobil</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Transmisi:</span>
                    <span class="font-semibold">{{ $car->transmission }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Kapasitas:</span>
                    <span class="font-semibold">{{ $car->capacity }} orang</span>
                </div>
                <div class="flex justify-between border-t pt-2 mt-2">
                    <span class="text-gray-600">Harga/Hari:</span>
                    <span class="font-bold text-lg text-blue-600">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Rental Form -->
        <div class="bg-white rounded shadow p-6">
            <h3 class="text-xl font-bold mb-4">Form Sewa</h3>

            <form action="{{ route('rentals.store', $car) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold mb-2">Tanggal Sewa</label>
                    <input type="date" name="rental_date" class="w-full border rounded px-3 py-2 @error('rental_date') border-red-500 @enderror"
                           value="{{ old('rental_date', now()->format('Y-m-d')) }}" min="{{ now()->format('Y-m-d') }}" required>
                    @error('rental_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Durasi Sewa (Hari)</label>
                    <input type="number" name="duration_days" class="w-full border rounded px-3 py-2 @error('duration_days') border-red-500 @enderror"
                           value="{{ old('duration_days', 1) }}" min="1" max="90" required id="duration_days">
                    @error('duration_days') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="bg-gray-100 p-3 rounded">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Tanggal Kembali:</span>
                        <span id="return_date">-</span>
                    </div>
                    <div class="flex justify-between border-t pt-2">
                        <span class="font-semibold">Total Harga:</span>
                        <span class="font-bold text-lg text-blue-600" id="total_price">Rp 0</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Catatan (Opsional)</label>
                    <textarea name="notes" class="w-full border rounded px-3 py-2" rows="3">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 font-semibold">
                    Lanjut ke Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const pricePerDay = parseFloat('{{ $car->price_per_day }}');
    const durationInput = document.getElementById('duration_days');
    const rentalDateInput = document.querySelector('input[type="date"][name="rental_date"]');

    function updatePrice() {
        if (!durationInput || !rentalDateInput) {
            console.error('Required form elements not found');
            return;
        }

        const duration = parseInt(durationInput.value) || 1;
        const total = pricePerDay * duration;
        const totalPriceEl = document.getElementById('total_price');
        
        if (totalPriceEl) {
            totalPriceEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Update return date
        const rentalDate = new Date(rentalDateInput.value);
        const returnDate = new Date(rentalDate);
        returnDate.setDate(returnDate.getDate() + duration);
        
        const returnDateEl = document.getElementById('return_date');
        if (returnDateEl) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            returnDateEl.textContent = returnDate.toLocaleDateString('id-ID', options);
        }
    }

    if (durationInput) {
        durationInput.addEventListener('change', updatePrice);
    }
    if (rentalDateInput) {
        rentalDateInput.addEventListener('change', updatePrice);
    }
    
    // Initial calculation on page load
    window.addEventListener('load', updatePrice);
    updatePrice();
</script>
</x-app-layout>
