<x-app-layout>
<div class="min-h-screen bg-black text-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('cars.detail', $car) }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-[#f53003] transition mb-8">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>

        <h1 class="text-4xl font-bold mb-8">Sewa Mobil: <span class="text-[#f53003]">{{ $car->name }}</span></h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Car Info -->
            <div class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-6">
                @if ($car->getFeaturedPhoto())
                    <img src="{{ asset('storage/' . $car->getFeaturedPhoto()->photo_path) }}" 
                         alt="{{ $car->name }}" class="w-full h-48 object-cover rounded-xl mb-6">
                @endif
                
                <h3 class="text-2xl font-bold mb-4 text-white">Detail Mobil</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-white/10">
                        <span class="text-gray-400">Transmisi:</span>
                        <span class="font-semibold text-white">{{ $car->transmission }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-white/10">
                        <span class="text-gray-400">Kapasitas:</span>
                        <span class="font-semibold text-white">{{ $car->capacity }} penumpang</span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-400">Harga/Hari:</span>
                        <span class="font-bold text-2xl bg-gradient-to-r from-[#f53003] to-orange-500 bg-clip-text text-transparent">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Rental Form -->
            <div class="bg-gradient-to-br from-[#1a1a1a] via-[#1a1a1a] to-[#0a0a0a] border border-white/10 rounded-2xl p-6">
                <h3 class="text-2xl font-bold mb-6 text-white">Form Penyewaan</h3>

                <form action="{{ route('rentals.store', $car) }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-3">Tanggal Sewa</label>
                        <input type="date" name="rental_date" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition @error('rental_date') border-red-500/50 @enderror"
                               value="{{ old('rental_date', now()->format('Y-m-d')) }}" min="{{ now()->format('Y-m-d') }}" required>
                        @error('rental_date') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-3">Durasi Sewa (Hari)</label>
                        <input type="number" name="duration_days" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition @error('duration_days') border-red-500/50 @enderror"
                               value="{{ old('duration_days', 1) }}" min="1" max="90" required id="duration_days">
                        @error('duration_days') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="bg-black/50 border border-white/10 p-4 rounded-lg">
                        <div class="flex justify-between mb-3 pb-3 border-b border-white/10">
                            <span class="text-gray-400">Tanggal Kembali:</span>
                            <span id="return_date" class="font-semibold text-white">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Total Harga:</span>
                            <span class="font-bold text-xl bg-gradient-to-r from-[#f53003] to-orange-500 bg-clip-text text-transparent" id="total_price">Rp 0</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-3">Catatan (Opsional)</label>
                        <textarea name="notes" class="w-full bg-black/50 border border-white/20 text-white rounded-lg px-4 py-2.5 hover:border-white/40 focus:border-[#f53003] transition" rows="3" placeholder="Tambahkan catatan khusus...">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-[#f53003] to-orange-600 hover:from-[#d63000] hover:to-orange-700 text-white px-4 py-3 rounded-lg font-bold transition transform hover:-translate-y-0.5 shadow-lg">
                        Lanjut ke Pembayaran
                    </button>
                </form>
            </div>
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
