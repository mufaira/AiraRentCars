<x-app-layout>
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <a href="{{ route('cars.admin.index') }}" class="text-blue-600 hover:underline text-sm mb-4 inline-block">← Kembali</a>
    
    <h1 class="text-3xl font-bold mb-6">Edit Mobil: {{ $car->name }}</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM EDIT MOBIL - PLAIN HTML -->
    <form id="editForm" method="POST" action="{{ route('cars.admin.update', $car) }}" enctype="multipart/form-data" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-semibold mb-2">Nama Mobil</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" 
                   value="{{ old('name', $car->name) }}" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" rows="3">{{ old('description', $car->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Harga per Hari (Rp)</label>
            <input type="number" name="price_per_day" class="w-full border rounded px-3 py-2 @error('price_per_day') border-red-500 @enderror" 
                   value="{{ old('price_per_day', $car->price_per_day) }}" step="0.01" required>
            @error('price_per_day') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Transmisi</label>
                <select name="transmission" class="w-full border rounded px-3 py-2 @error('transmission') border-red-500 @enderror" required>
                    <option value="">Pilih</option>
                    <option value="Manual" {{ old('transmission', $car->transmission) === 'Manual' ? 'selected' : '' }}>Manual</option>
                    <option value="Matic" {{ old('transmission', $car->transmission) === 'Matic' ? 'selected' : '' }}>Matic</option>
                </select>
                @error('transmission') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Kapasitas Penumpang</label>
                <input type="number" name="capacity" class="w-full border rounded px-3 py-2 @error('capacity') border-red-500 @enderror" 
                       value="{{ old('capacity', $car->capacity) }}" min="1" required>
                @error('capacity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2 @error('status') border-red-500 @enderror" required>
                    <option value="">Pilih</option>
                    <option value="Tersedia" {{ old('status', $car->status) === 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Disewa" {{ old('status', $car->status) === 'Disewa' ? 'selected' : '' }}>Disewa</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Aktif</label>
                <select name="is_active" class="w-full border rounded px-3 py-2">
                    <option value="1" {{ old('is_active', $car->is_active) ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ !old('is_active', $car->is_active) ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                   {{ old('is_featured', $car->is_featured) ? 'checked' : '' }} class="h-4 w-4">
            <label for="is_featured" class="text-sm font-semibold">Jadikan Mobil Unggulan</label>
        </div>

        <!-- Foto Existing -->
        @if ($car->photos->count() > 0)
            <div>
                <label class="block text-sm font-semibold mb-2">Foto Existing</label>
                <div class="grid grid-cols-3 gap-4">
                    @foreach ($car->photos as $photo)
                        <div class="relative bg-gray-100 rounded p-2">
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Car photo" class="w-full h-24 object-cover rounded">
                            <form action="{{ route('photos.delete', $photo) }}" method="POST" class="absolute top-0 right-0" onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600">X</button>
                            </form>
                            @if ($photo->is_featured)
                                <span class="absolute bottom-2 left-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded">Utama</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Upload Foto Baru -->
        <div>
            <label class="block text-sm font-semibold mb-2">Tambah Foto (Multiple)</label>
            <input type="file" name="photos[]" multiple accept="image/*" 
                   class="w-full border rounded px-3 py-2 @error('photos') border-red-500 @enderror">
            <small class="text-gray-500">Format: JPG, PNG, GIF (max 2MB per foto)</small>
            @error('photos') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div style="margin-top: 20px;">
            <button type="button" onclick="submitEditForm()" id="submitBtn" style="background: #2563eb; color: white; padding: 12px 20px; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: 600;">Simpan Perubahan</button>
            <a href="{{ route('cars.admin.index') }}" style="background: #9ca3af; color: white; padding: 12px 20px; border-radius: 6px; text-decoration: none; display: inline-block; margin-left: 10px;">Batal</a>
        </div>
    </form>
    
    <script>
        function submitEditForm() {
            const form = document.getElementById('editForm');
            const carName = form.querySelector('input[name="name"]').value;
            
            if (confirm(`Apakah Anda yakin ingin menyimpan perubahan untuk mobil "${carName}"?`)) {
                form.submit();
            }
        }
    </script>
</div>
</x-app-layout>
