<x-app-layout>
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <a href="{{ route('cars.admin.index') }}" class="text-blue-600 hover:underline text-sm mb-4 inline-block">← Kembali</a>
        
        <h1 class="text-3xl font-bold mb-6">Tambah Mobil</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form action="{{ route('cars.admin.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded shadow p-6 space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-semibold mb-2">Nama Mobil</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" 
                   value="{{ old('name') }}" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" rows="3">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Harga per Hari (Rp)</label>
            <input type="number" name="price_per_day" class="w-full border rounded px-3 py-2 @error('price_per_day') border-red-500 @enderror" 
                   value="{{ old('price_per_day') }}" step="0.01" required>
            @error('price_per_day') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Transmisi</label>
                <select name="transmission" class="w-full border rounded px-3 py-2 @error('transmission') border-red-500 @enderror" required>
                    <option value="">Pilih</option>
                    <option value="Manual" {{ old('transmission') === 'Manual' ? 'selected' : '' }}>Manual</option>
                    <option value="Matic" {{ old('transmission') === 'Matic' ? 'selected' : '' }}>Matic</option>
                </select>
                @error('transmission') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Kapasitas Penumpang</label>
                <input type="number" name="capacity" class="w-full border rounded px-3 py-2 @error('capacity') border-red-500 @enderror" 
                       value="{{ old('capacity') }}" min="1" required>
                @error('capacity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2 @error('status') border-red-500 @enderror" required>
                <option value="">Pilih</option>
                <option value="Tersedia" {{ old('status') === 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="Disewa" {{ old('status') === 'Disewa' ? 'selected' : '' }}>Disewa</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                   {{ old('is_featured') ? 'checked' : '' }} class="h-4 w-4">
            <label for="is_featured" class="text-sm font-semibold">Jadikan Mobil Unggulan</label>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Upload Foto (Multiple)</label>
            <input type="file" name="photos[]" multiple accept="image/*" 
                   class="w-full border rounded px-3 py-2 @error('photos') border-red-500 @enderror">
            <small class="text-gray-500">Format: JPG, PNG, GIF (max 2MB per foto)</small>
            @error('photos') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('cars.admin.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Batal</a>
        </div>
    </form>
</div>
</x-app-layout>
