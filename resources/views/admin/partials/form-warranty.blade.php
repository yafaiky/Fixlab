<div class="space-y-4">
    {{-- Barang Dinamis --}}
    <div>
        <label class="block text-xs font-medium text-gray-600 mb-2">Daftar Barang</label>
        <div id="barangList" class="space-y-2">
            @if (isset($service->items) && $service->items->count() > 0)
                @foreach ($service->items as $index => $item)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 items-end barang-row">
                        <div>
                            <input type="text" name="barangList[{{ $index }}][judulBarang]"
                                value="{{ old("barangList.$index.judulBarang", $item->judulBarang) }}"
                                class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Nama barang" />
                        </div>

                        <div>
                            <input type="number" name="barangList[{{ $index }}][hargaBarang]"
                                value="{{ old("barangList.$index.hargaBarang", $item->hargaBarang) }}"
                                class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Harga" />
                        </div>

                        <button type="button"
                            class="remove-barang bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endforeach
            @else
                {{-- Default satu row kosong --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 items-end barang-row">
                    <div>
                        <input type="text" name="barangList[0][judulBarang]"
                            class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Nama barang" />
                    </div>

                    <div>
                        <input type="number" name="barangList[0][hargaBarang]"
                            class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Harga" />
                    </div>

                    <button type="button"
                        class="remove-barang bg-red-500 hover:bg-red-600 text-white px-3 py-2 w-10 rounded-md inline-flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <button type="button" id="addBarang"
            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium text-xs mt-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            Tambah Barang
        </button>
    </div>

    {{-- Jasa & Garansi --}}
    <div class="pt-3 border-t border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nama Jasa</label>
                <input type="text" name="judulJasa"
                    class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    value="{{ old('judulJasa', $service->judulJasa) }}" placeholder="Nama jasa" />
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Harga Jasa</label>
                <input type="number" name="hargaJasa"
                    class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    value="{{ old('hargaJasa', $service->hargaJasa) }}" placeholder="Harga jasa" />
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-medium text-gray-600 mb-1">Garansi Hingga</label>
                <input type="date" name="garansi"
                    class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    value="{{ old('garansi', $service->garansi ? $service->garansi->format('Y-m-d') : '') }}" />
            </div>
        </div>
    </div>
</div>

{{-- Script untuk tambah/hapus barang dinamis --}}
<script>
    document.getElementById('addBarang').addEventListener('click', function() {
        const barangList = document.getElementById('barangList');
        const index = barangList.querySelectorAll('.barang-row').length;
        const row = document.createElement('div');
        row.classList.add('grid', 'grid-cols-1', 'md:grid-cols-3', 'gap-2', 'items-end', 'barang-row');
        row.innerHTML = `
            <div>
                <input type="text" name="barangList[${index}][judulBarang]" 
                    class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    placeholder="Nama barang"/>
            </div>
            <div>
                <input type="number" name="barangList[${index}][hargaBarang]" 
                    class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    placeholder="Harga"/>
            </div>
           <button type="button"
                        class="remove-barang bg-red-500 hover:bg-red-600 text-white px-3 py-2 w-10 rounded-md inline-flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
            </button>
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
