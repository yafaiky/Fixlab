<x-admin-layout>

<div class="bg-white p-6 rounded shadow-md">
    <a href="{{ route('admin.dashboard') }}"
   class="inline-flex  items-center justify-center mb-4 gap-1.5 px-3 py-2
          bg-gray-100 text-gray-700 text-xs font-medium
          border border-gray-300 rounded-md
          hover:bg-gray-200 hover:text-gray-900
          transition-colors">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 19l-7-7 7-7M3 12h18"/>
    </svg>
    Kembali
</a>

    <h2 class="text-xl font-semibold mb-4"> Update Service</h2>

    {{-- Form utama --}}
    <form action="{{ route('admin.update-service', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        {{-- Dropdown status --}}
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Status Service</label>
            <select name="serviceStatus" id="statusSelect" class="w-full border p-2 rounded">
                <option value="OPEN" {{ $service->serviceStatus == 'OPEN' ? 'selected' : '' }}>OPEN</option>
                <option value="PROGRESS" {{ $service->serviceStatus == 'PROGRESS' ? 'selected' : '' }}>PROGRESS</option>
                <option value="SOLVED" {{ $service->serviceStatus == 'SOLVED' ? 'selected' : '' }}>SOLVED</option>
                <option value="WARRANTY" {{ $service->serviceStatus == 'WARRANTY' ? 'selected' : '' }}>WARRANTY</option>
                <option value="DONE" {{ $service->serviceStatus == 'DONE' ? 'selected' : '' }}>DONE</option>
                <option value="CANCELLED" {{ $service->serviceStatus == 'CANCELLED' ? 'selected' : '' }}>CANCELLED</option>
            </select>
        </div>

        {{-- Partial dinamis --}}
        <div id="formProgress" style="display:none;">
            @include('admin.partials.form-progress')
        </div>

        <div id="formSolved" style="display:none;">
            @include('admin.partials.form-solved')
        </div>

        <div id="formWarranty" style="display:none;">
            @include('admin.partials.form-warranty')
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mt-4 w-full">
            Simpan Perubahan
        </button>
    </form>
</div>

{{-- Script kecil untuk toggle form dinamis --}}
<script>
    const statusSelect = document.getElementById('statusSelect');
    const formProgress = document.getElementById('formProgress');
    const formSolved = document.getElementById('formSolved');
    const formWarranty = document.getElementById('formWarranty');

    function toggleForms() {
        formProgress.style.display = (statusSelect.value === 'PROGRESS') ? 'block' : 'none';
        formSolved.style.display   = (statusSelect.value === 'SOLVED') ? 'block' : 'none';
        formWarranty.style.display = (statusSelect.value === 'WARRANTY') ? 'block' : 'none';
    }

    statusSelect.addEventListener('change', toggleForms);
    toggleForms(); // initial load
</script>

</x-admin-layout>