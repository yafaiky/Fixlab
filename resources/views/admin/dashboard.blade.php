<x-admin-layout>
    <div class="p-4 md:p-6">
        <h1 class="text-xl md:text-2xl font-bold mb-6 text-gray-800 uppercase">Admin Dashboard</h1>

        @php
            // 1. Data Filter
            $filters = ["All", "OPEN", "PROGRESS", "SOLVED", "WARRANTY", "DONE", "CANCELLED"];
            $currentFilter = request('status', 'All');
            $search = request('search');
        @endphp

        <div class="space-y-5">
            {{-- Filter Section --}}
            <div class="flex flex-wrap gap-2">
                @foreach ($filters as $filter)
                    <a href="{{ route('admin.dashboard', ['status' => $filter, 'search' => $search]) }}"
                       class="px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200
                       {{ $currentFilter === $filter 
                            ? 'bg-blue-600 text-white shadow-md' 
                            : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        {{ $filter }}
                    </a>
                @endforeach
            </div>

            {{-- Search Section --}}
            <form id="searchForm" method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                {{-- Hidden input agar status filter tidak hilang saat search --}}
                <input type="hidden" name="status" value="{{ $currentFilter }}">

                <div class="relative w-full max-w-md">
                    {{-- Icon Kaca Pembesar di dalam Input --}}
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <input type="text" 
                           id="searchInput"
                           name="search" 
                           value="{{ $search }}"
                           autocomplete="off"
                           placeholder="Cari data..."
                           class="w-full pl-12 pr-6 py-3 bg-white border border-gray-200 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                    >
                </div>
                
                {{-- Tombol tetap ada untuk estetika & mobile user --}}
                <button type="submit" class="p-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 shadow-lg transition-all active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
        </div>

        <hr class="my-8 border-gray-100">

        {{-- Main Content --}}
        <div class="mt-6">
            {{-- Tambahkan tabel atau data kamu di sini --}}
        </div>
    </div>

    {{-- Script untuk Auto-Submit tanpa reload manual --}}
    <script>
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        let typingTimer;

        searchInput.addEventListener('input', () => {
            clearTimeout(typingTimer);
            // Submit otomatis setelah user berhenti mengetik selama 500ms
            typingTimer = setTimeout(() => {
                searchForm.submit();
            }, 500);
        });

        // Pastikan kursor tetap di akhir teks setelah reload
        const val = searchInput.value;
        searchInput.value = '';
        searchInput.value = val;
        searchInput.focus();
    </script>
    
</x-admin-layout>