<x-app-layout>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        input::placeholder, textarea::placeholder, select option {
            color: #9CA3AF !important;
            opacity: 1 !important;
        }
        input[type="text"], input[type="number"], textarea, select {
            color: #1F2937 !important;
            font-family: inherit;
            font-size: 16px;
        }

        .form-label {
            font-weight: 600;
            color: #111827;
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            letter-spacing: 0.3px;
        }

        .form-input, .form-textarea, .form-select {
            font-size: 15px;
            font-weight: 500;
            letter-spacing: 0.2px;
        }

        input[type="text"]::placeholder, textarea::placeholder {
            font-weight: 400;
            font-size: 14px;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            animation: slideIn 0.3s ease-out;
            z-index: 9999;
            font-weight: 600;
            max-width: 400px;
        }
        
        .toast.success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border-left: 4px solid #059669;
        }
        
        .toast.error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border-left: 4px solid #dc2626;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
        
        .toast.removing {
            animation: slideOut 0.3s ease-out;
        }
    </style>
    <div class="container mx-auto px-4 py-10 max-w-4xl">
        <a href="{{ route('cars.admin.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base mb-8 transition group">
            <span class="mr-2 group-hover:-translate-x-1 transition">←</span> Kembali ke Daftar Mobil
        </a>
        
        <div class="mb-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 shadow-lg">
            <h1 class="text-5xl font-bold text-white mb-3">Edit Mobil: {{ $car->name }}</h1>
            <p class="text-blue-100 font-medium text-base">Perbarui informasi kendaraan sesuai kebutuhan</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6 mb-8 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <h3 class="font-bold text-lg text-red-900">Terjadi Kesalahan Validasi</h3>
                </div>
                <ul class="space-y-2 ml-9">
                    @foreach ($errors->all() as $error)
                        <li class="text-base text-red-700 font-medium">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6 mb-8 shadow-sm">
                <p class="text-red-700 font-semibold">{{ session('error') }}</p>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-6 mb-8 shadow-sm">
                <p class="text-green-700 font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        <form id="editForm" action="{{ route('cars.admin.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-xl p-10 space-y-8" novalidate>
            @csrf
            @method('PUT')

            <!-- Nama Mobil -->
            <div>
                <label class="form-label">Nama Mobil *</label>
                <input type="text" name="name" class="form-input w-full border-2 rounded-xl px-5 py-3 text-gray-900 @error('name') border-red-500 bg-red-50 @else border-gray-200 focus:border-blue-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-100 transition" 
                       placeholder="Contoh: Toyota Avanza 2024" value="{{ old('name', $car->name) }}" required>
                @error('name') <span class="text-red-600 text-sm font-semibold mt-2 block">{{ $message }}</span> @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="form-label">Deskripsi</label>
                <textarea name="description" placeholder="Masukkan deskripsi lengkap tentang mobil..." class="form-textarea w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" rows="5">{{ old('description', $car->description) }}</textarea>
            </div>

            <!-- Harga per Hari -->
            <div>
                <label class="form-label">Harga per Hari (Rp) *</label>
                <input type="number" name="price_per_day" class="form-input w-full border-2 rounded-xl px-5 py-3 text-gray-900 @error('price_per_day') border-red-500 bg-red-50 @else border-gray-200 focus:border-blue-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-100 transition" 
                       placeholder="Contoh: 500000" value="{{ old('price_per_day', $car->price_per_day) }}" step="0.01" required>
                @error('price_per_day') <span class="text-red-600 text-sm font-semibold mt-2 block">{{ $message }}</span> @enderror
            </div>

            <!-- Transmisi dan Kapasitas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="form-label">Transmisi *</label>
                    <select name="transmission" class="form-select w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 @error('transmission') border-red-500 bg-red-50 @enderror focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                        <option value="">-- Pilih Transmisi --</option>
                        <option value="Manual" {{ old('transmission', $car->transmission) === 'Manual' ? 'selected' : '' }}>Manual</option>
                        <option value="Matic" {{ old('transmission', $car->transmission) === 'Matic' ? 'selected' : '' }}>Matic</option>
                    </select>
                    @error('transmission') <span class="text-red-600 text-sm font-semibold mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="form-label">Kapasitas Penumpang *</label>
                    <input type="number" name="capacity" class="form-input w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 @error('capacity') border-red-500 bg-red-50 @enderror focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" 
                           placeholder="Contoh: 5" value="{{ old('capacity', $car->capacity) }}" min="1" required>
                    @error('capacity') <span class="text-red-600 text-sm font-semibold mt-2 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Status -->
            <div>
                <label class="form-label">Status *</label>
                <select name="status" class="form-select w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 @error('status') border-red-500 bg-red-50 @enderror focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Tersedia" {{ old('status', $car->status) === 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Disewa" {{ old('status', $car->status) === 'Disewa' ? 'selected' : '' }}>Disewa</option>
                </select>
                @error('status') <span class="text-red-600 text-sm font-semibold mt-2 block">{{ $message }}</span> @enderror
            </div>

            <!-- Status Aktif -->
            <div>
                <label class="form-label">Status Aktif *</label>
                <select name="is_active" class="form-select w-full border-2 border-gray-200 rounded-xl px-5 py-3 text-gray-900 @error('is_active') border-red-500 bg-red-50 @enderror focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                    <option value="1" {{ old('is_active', $car->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active', $car->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('is_active') <span class="text-red-600 text-sm font-semibold mt-2 block">{{ $message }}</span> @enderror
            </div>

            <!-- Checkbox Mobil Unggulan -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-2xl p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                           {{ old('is_featured', $car->is_featured) ? 'checked' : '' }} class="h-6 w-6 text-blue-600 rounded focus:ring-2 focus:ring-blue-500 cursor-pointer">
                    <label for="is_featured" class="form-label !mb-0 cursor-pointer">Jadikan Mobil Unggulan (Featured)</label>
                </div>
                <p class="text-sm text-gray-600 mt-3 ml-10 font-medium">Mobil unggulan akan ditampilkan di halaman utama dengan prioritas lebih tinggi</p>
            </div>

            <!-- Foto Existing -->
            @if ($car->photos->count() > 0)
                <div class="bg-yellow-50 border-2 border-yellow-300 rounded-2xl p-6 shadow-sm">
                    <p class="text-yellow-800 font-semibold text-base">
                        ⚠️ Foto yang ada akan dihapus saat menyimpan perubahan. Upload foto baru jika diperlukan.
                    </p>
                </div>
            @endif

            <!-- Upload Foto -->
            <div>
                <label class="form-label">Upload Foto (Multiple)</label>
                <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer group">
                    <input type="file" name="photos[]" multiple accept="image/*" 
                           class="w-full @error('photos') border-red-500 @enderror cursor-pointer" id="photoInput">
                    <p class="text-gray-700 font-semibold text-lg mt-3 group-hover:text-blue-600 transition">Klik untuk memilih foto atau drag & drop di sini</p>
                    <small class="text-gray-500 text-base block mt-3 font-medium">Format: JPG, PNG, GIF (max 2MB per foto)</small>
                </div>
                @error('photos') <span class="text-red-600 text-sm font-semibold mt-2 block">{{ $message }}</span> @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t-2 border-gray-100">
                <button type="submit" id="submitBtn" class="flex-1 bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-4 rounded-xl hover:from-green-700 hover:to-green-800 font-bold text-base transition shadow-lg hover:shadow-xl transform hover:scale-105">
                    Simpan Perubahan
                </button>
                <a href="{{ route('cars.admin.index') }}" class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 text-white px-8 py-4 rounded-xl hover:from-gray-600 hover:to-gray-700 font-bold text-base transition shadow-lg hover:shadow-xl text-center transform hover:scale-105">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        // Toast notification
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.textContent = (type === 'success' ? '✓ ' : '✕ ') + message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.add('removing');
                setTimeout(() => toast.remove(), 300);
            }, type === 'error' ? 5000 : 3000);
        }
        
        // Show success/error messages on page load
        document.addEventListener('DOMContentLoaded', function() {
            const successMsg = document.querySelector('.bg-green-50');
            if (successMsg) {
                showToast('Mobil berhasil diperbarui!', 'success');
                successMsg.style.display = 'none';
            }
            
            const errorMsg = document.querySelector('.bg-red-50');
            if (errorMsg) {
                showToast('Ada error!', 'error');
            }
        });
    </script>
</x-app-layout>
