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

        {{-- Penyelesaian --}}
        <div class="md:col-span-2">
            <label class="block text-xs font-medium text-gray-600 mb-1">Penyelesaian</label>
            <textarea 
                name="penyelesaian" 
                rows="2" 
                class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                placeholder="Deskripsi penyelesaian">{{ old('penyelesaian', $service->penyelesaian) }}</textarea>
        </div>

        {{-- Part Diganti --}}
        <div class="md:col-span-2">
            <label class="block text-xs font-medium text-gray-600 mb-1">Part yang Diganti</label>
            <input 
                type="text" 
                name="partUsed" 
                class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                placeholder="Part yang digunakan"
                value="{{ old('partUsed', $service->partUsed) }}" 
            />
        </div>
    </div>

    {{-- Upload hasil --}}
    <div class="pt-3 border-t border-gray-200">
        <label class="block text-xs font-medium text-gray-600 mb-1">Foto Hasil Perbaikan</label>
        <input 
            type="file" 
            id="hasilInput" 
            name="hasil[]" 
            accept="image/*" 
            multiple 
            class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
        />
        <p class="text-xs text-gray-500 mt-1">Maksimal 10 foto</p>

        <div id="previewContainer" class="mt-3 grid grid-cols-2 md:grid-cols-4 gap-2"></div>
    </div>
</div>

<script>
    const hasilInput = document.getElementById('hasilInput');
    const previewContainer = document.getElementById('previewContainer');

    hasilInput.addEventListener('change', function(e) {
        previewContainer.innerHTML = '';
        const files = Array.from(this.files);

        if (files.length > 10) {
            alert('Maksimal 10 foto');
            this.value = '';
            return;
        }

        files.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewDiv = document.createElement('div');
                previewDiv.className = 'relative group';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-32 object-cover rounded-md border border-gray-200';
                img.alt = `Preview ${index + 1}`;

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'absolute top-1 right-1 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all shadow-md text-sm font-bold';
                removeBtn.innerHTML = '×';
                removeBtn.onclick = function(e) {
                    e.preventDefault();
                    previewDiv.remove();
                    const dt = new DataTransfer();
                    const newFiles = Array.from(hasilInput.files).filter((f, i) => i !== index);
                    newFiles.forEach(f => dt.items.add(f));
                    hasilInput.files = dt.files;
                };

                previewDiv.appendChild(img);
                previewDiv.appendChild(removeBtn);
                previewContainer.appendChild(previewDiv);
            };

            reader.readAsDataURL(file);
        });
    });
</script>