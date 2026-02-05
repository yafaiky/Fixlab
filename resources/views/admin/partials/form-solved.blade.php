<div id="formSolved" class="space-y-4 border-t pt-4">
    <h3 class="text-lg font-semibold">Form Solved</h3>

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

        {{-- Penyelesaian --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Penyelesaian</label>
            <textarea
                name="penyelesaian"
                rows="3"
                class="w-full border p-2 rounded"
                placeholder="Deskripsi penyelesaian"
            >{{ old('penyelesaian', $service->penyelesaian) }}</textarea>
        </div>

        {{-- Part Diganti --}}
        <div>
            <label class="block text-sm font-medium mb-1">Part Diganti</label>
            <input
                type="text"
                name="partUsed"
                class="w-full border p-2 rounded"
                placeholder="Part yang digunakan"
                value="{{ old('partUsed', $service->partUsed) }}"
            />
        </div>
    </div>

    {{-- Upload hasil --}}
    <div class="mt-4">
        <label class="block mb-1 font-medium">Upload Hasil</label>
        <input
            type="file"
            name="hasil[]"
            accept="image/*"
            multiple
            class="w-full border p-2 rounded"
        />
        <p class="text-sm text-gray-500 mt-1">Maksimal 10 gambar</p>
    </div>
</div>