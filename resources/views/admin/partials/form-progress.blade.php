<div id="formProgress" class="space-y-4 border-t pt-4">
    <h3 class="text-lg font-semibold">Form Progress</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Penyebab --}}
        <div>
            <label class="block text-sm font-medium mb-1">Penyebab</label>
            <input
                type="text"
                name="penyebab"
                class="w-full border p-2 rounded"
                placeholder="Masukkan penyebab"
                value="{{ old('penyebab', $service->penyebab) }}"
            />
        </div>

        {{-- Kerusakan --}}
        <div>
            <label class="block text-sm font-medium mb-1">Kerusakan</label>
            <input
                type="text"
                name="kerusakan"
                class="w-full border p-2 rounded"
                placeholder="Masukkan kerusakan"
                value="{{ old('kerusakan', $service->kerusakan) }}"
            />
        </div>
    </div>
</div>