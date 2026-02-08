<div class="space-y-3">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        {{-- Penyebab --}}
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Penyebab Kerusakan</label>
            <input
                type="text"
                name="penyebab"
                class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Masukkan penyebab"
                value="{{ old('penyebab', $service->penyebab) }}"
            />
        </div>

        {{-- Kerusakan --}}
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Jenis Kerusakan</label>
            <input
                type="text"
                name="kerusakan"
                class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Masukkan jenis kerusakan"
                value="{{ old('kerusakan', $service->kerusakan) }}"
            />
        </div>
    </div>
</div>