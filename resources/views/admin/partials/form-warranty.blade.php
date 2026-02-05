<div id="formWarranty" class="space-y-4 border-t pt-4">
    <h3 class="text-lg font-semibold">💰 Form Warranty</h3>

    {{-- Barang Dinamis --}}
    <div id="barangList" class="space-y-3">
        @if(isset($service->items) && $service->items->count() > 0)
            @foreach($service->items as $index => $item)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end barang-row">
                    <div>
                        <label class="block text-sm font-medium mb-1">Barang</label>
                        <input
                            type="text"
                            name="barangList[{{ $index }}][judulBarang]"
                            value="{{ old("barangList.$index.judulBarang", $item->judulBarang) }}"
                            class="w-full border p-2 rounded"
                            placeholder="Nama barang..."
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Harga Barang</label>
                        <input
                            type="number"
                            name="barangList[{{ $index }}][hargaBarang]"
                            value="{{ old("barangList.$index.hargaBarang", $item->hargaBarang) }}"
                            class="w-full border p-2 rounded"
                            placeholder="Harga..."
                        />
                    </div>

                    <button type="button"
                        class="remove-barang bg-red-500 hover:bg-red-600 text-white p-2 py-3 w-12 rounded-md flex items-center justify-center">
                        ✕
                    </button>
                </div>
            @endforeach
        @else
            {{-- Default satu row kosong --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end barang-row">
                <div>
                    <label class="block text-sm font-medium mb-1">Barang</label>
                    <input
                        type="text"
                        name="barangList[0][judulBarang]"
                        class="w-full border p-2 rounded"
                        placeholder="Nama barang..."
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Harga Barang</label>
                    <input
                        type="number"
                        name="barangList[0][hargaBarang]"
                        class="w-full border p-2 rounded"
                        placeholder="Harga..."
                    />
                </div>

                <button type="button"
                    class="remove-barang bg-red-500 hover:bg-red-600 text-white p-2 py-3 w-12 rounded-md flex items-center justify-center">
                    ✕
                </button>
            </div>
        @endif
    </div>

    <button type="button" id="addBarang"
        class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium mt-2">
        ➕ Tambah Barang
    </button>

    {{-- Jasa & Garansi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block text-sm font-medium mb-1">Jasa</label>
            <input
                type="text"
                name="judulJasa"
                class="w-full border p-2 rounded"
                value="{{ old('judulJasa', $service->judulJasa) }}"
                placeholder="Nama jasa..."
            />
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Harga Jasa</label>
            <input
                type="number"
                name="hargaJasa"
                class="w-full border p-2 rounded"
                value="{{ old('hargaJasa', $service->hargaJasa) }}"
                placeholder="Harga jasa..."
            />
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Garansi Hingga</label>
            <input
                type="date"
                name="garansi"
                class="w-full border p-2 rounded"
                value="{{ old('garansi', $service->garansi ? $service->garansi->format('Y-m-d') : '') }}"
            />
        </div>
    </div>
</div>

{{-- Script untuk tambah/hapus barang dinamis --}}
<script>
    document.getElementById('addBarang').addEventListener('click', function() {
        const barangList = document.getElementById('barangList');
        const index = barangList.querySelectorAll('.barang-row').length;
        const row = document.createElement('div');
        row.classList.add('grid','grid-cols-1','md:grid-cols-3','gap-3','items-end','barang-row');
        row.innerHTML = `
            <div>
                <label class="block text-sm font-medium mb-1">Barang</label>
                <input type="text" name="barangList[${index}][judulBarang]" class="w-full border p-2 rounded" placeholder="Nama barang..."/>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Harga Barang</label>
                <input type="number" name="barangList[${index}][hargaBarang]" class="w-full border p-2 rounded" placeholder="Harga..."/>
            </div>
            <button type="button" class="remove-barang bg-red-500 hover:bg-red-600 text-white p-2 py-3 w-12 rounded-md flex items-center justify-center">✕</button>
        `;
        barangList.appendChild(row);

        row.querySelector('.remove-barang').addEventListener('click', function() {
            row.remove();
        });
    });

    document.querySelectorAll('.remove-barang').forEach(btn => {
        btn.addEventListener('click', function() {
            btn.closest('.barang-row').remove();
        });
    });
</script>