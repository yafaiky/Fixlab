<x-admin-layout>
    <div class="p-4 md:p-6">
        <h1 class="text-lg font-semibold mb-5 text-gray-900">Admin Dashboard</h1>

        @php
            // 1. Data Filter
            $filters = ["All", "OPEN", "PROGRESS", "SOLVED", "WARRANTY", "DONE", "CANCELLED"];
            $currentFilter = request('status', 'All');
            $search = request('search');
        @endphp

        <div class="space-y-4">
            {{-- Filter Section --}}
            <div class="flex flex-wrap gap-2">
                @foreach ($filters as $filter)
                    <a href="{{ route('admin.dashboard', ['status' => $filter, 'search' => $search]) }}"
                       class="px-4 py-1.5 rounded-md text-xs font-medium transition-all duration-200
                       {{ $currentFilter === $filter 
                            ? 'bg-blue-600 text-white shadow-sm' 
                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200' }}">
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
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <input type="text" 
                           id="searchInput"
                           name="search" 
                           value="{{ $search }}"
                           autocomplete="off"
                           placeholder="Cari data..."
                           class="w-full pl-10 pr-4 py-2 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                </div>
                
                {{-- Tombol tetap ada untuk estetika & mobile user --}}
                <button type="submit" class="p-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 shadow-sm transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
        </div>

        <hr class="my-6 border-gray-200">

        {{-- Main Content --}}
        <div class="mt-5">
    {{-- Service Cards --}}
    @if($services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($services as $service)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200 overflow-hidden">
                    {{-- Header Card --}}
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-4 py-3 border-b border-gray-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">{{ $service->customer->name }}</h3>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $service->customer->phone }}</p>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-md
                                @if($service->serviceStatus == 'OPEN') bg-blue-600 text-white
                                @elseif($service->serviceStatus == 'PROGRESS') bg-yellow-500 text-white
                                @elseif($service->serviceStatus == 'SOLVED') bg-green-600 text-white
                                @elseif($service->serviceStatus == 'WARRANTY') bg-purple-600 text-white
                                @elseif($service->serviceStatus == 'DONE') bg-gray-600 text-white
                                @else bg-red-600 text-white @endif">
                                {{ $service->serviceStatus }}
                            </span>
                        </div>
                    </div>

                    {{-- Body Card --}}
                    <div class="px-4 py-3">
                        <div class="space-y-2 text-xs">
                            <div class="flex items-start">
                                <span class="font-medium text-gray-700 min-w-[60px]">Model:</span>
                                <span class="text-gray-600">{{ $service->Model }}</span>
                            </div>
                            @if($service->IMEI)
                                <div class="flex items-start">
                                    <span class="font-medium text-gray-700 min-w-[60px]">IMEI:</span>
                                    <span class="text-gray-600">{{ $service->IMEI }}</span>
                                </div>
                            @endif
                            <div class="flex items-start">
                                <span class="font-medium text-gray-700 min-w-[60px]">Keluhan:</span>
                                <span class="text-gray-600">{{ Str::limit($service->Keluhan, 45) }}</span>
                            </div>
                            <div class="flex items-start">
                                <span class="font-medium text-gray-700 min-w-[60px]">Kondisi:</span>
                                <span class="text-gray-600">{{ Str::limit($service->Kondisi, 45) }}</span>
                            </div>
                            <div class="flex items-center pt-1">
                                <svg class="w-3.5 h-3.5 text-gray-400 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-500">{{ $service->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Card - Action Buttons --}}
                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex gap-2">
                        <a href="{{ route('admin.show', $service->id) }}"
                           class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 bg-white border border-gray-300 text-gray-700 text-xs font-medium rounded-md hover:bg-gray-50 hover:border-gray-400 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat Detail
                        </a>
                        <a href="{{ route('admin.update-service', $service->id) }}"
                           class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Update Status
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @else
        <div class="text-center py-10 text-sm text-gray-500">
        Data service tidak ditemukan.
        </div>
        @endif
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