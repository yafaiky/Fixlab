<x-admin-layout>
    <div class="w-full mx-auto py-4 px-4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">

            {{-- HEADER --}}
            <div class="border-b border-gray-200 px-5 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-600 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                        <h1 class="text-lg font-semibold text-gray-900">Update Service</h1>
                    </div>
                    <a href="{{ route('teknisi.dashboard') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 text-xs font-medium border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

            {{-- SERVICE INFO PREVIEW --}}
            <div class="px-5 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-xs font-semibold text-gray-600 mb-3">Informasi Service</h2>
                <div class="grid grid-cols-2 gap-4 text-xs">
                    <div class="flex items-start">
                        <div class="bg-white p-2 rounded-lg mr-3 border border-gray-200">
                            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 font-medium mb-0.5">Customer</p>
                            <p class="font-semibold text-gray-900">{{ $service->customer->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-white p-2 rounded-lg mr-3 border border-gray-200">
                            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 font-medium mb-0.5">Model</p>
                            <p class="font-semibold text-gray-900">{{ $service->Model }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-white p-2 rounded-lg mr-3 border border-gray-200">
                            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 font-medium mb-0.5">No HP</p>
                            <p class="font-semibold text-gray-900">{{ $service->customer->phone }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-white p-2 rounded-lg mr-3 border border-gray-200">
                            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 font-medium mb-0.5">Keluhan</p>
                            <p class="font-semibold text-gray-900">{{ Str::limit($service->Keluhan, 30) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORM --}}
            <form action="{{ route('teknisi.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="px-5 py-5">
                @csrf
                @method('PATCH')

                {{-- Status Selection --}}
                <div class="mb-5">
                    <label class="block text-xs font-medium text-gray-600 mb-2">Status Service</label>
                    <div class="relative">
                        <select name="serviceStatus" id="statusSelect" class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white pr-10">
                            <option value="OPEN" {{ $service->serviceStatus == 'OPEN' ? 'selected' : '' }}>🔵 OPEN</option>
                            <option value="PROGRESS" {{ $service->serviceStatus == 'PROGRESS' ? 'selected' : '' }}>🟡 PROGRESS</option>
                            <option value="SOLVED" {{ $service->serviceStatus == 'SOLVED' ? 'selected' : '' }}>🟢 SOLVED</option>
                            <option value="WARRANTY" {{ $service->serviceStatus == 'WARRANTY' ? 'selected' : '' }}>🟣 WARRANTY</option>
                            <option value="DONE" {{ $service->serviceStatus == 'DONE' ? 'selected' : '' }}>⚫ DONE</option>
                            <option value="CANCELLED" {{ $service->serviceStatus == 'CANCELLED' ? 'selected' : '' }}>🔴 CANCELLED</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Dynamic Forms --}}
                <div class="space-y-4 mb-5">
                    {{-- PROGRESS FORM --}}
                    <div id="formProgress" class="bg-gray-50 border border-gray-200 rounded-lg overflow-hidden" style="display:none;">
                        <div class="bg-gray-100 px-4 py-2.5 border-b border-gray-200">
                            <h3 class="text-xs font-semibold text-gray-700 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Detail Progress
                            </h3>
                        </div>
                        <div class="p-4">
                            @include('teknisi.partials.form-progress')
                        </div>
                    </div>

                    {{-- SOLVED FORM --}}
                    <div id="formSolved" class="bg-gray-50 border border-gray-200 rounded-lg overflow-hidden" style="display:none;">
                        <div class="bg-gray-100 px-4 py-2.5 border-b border-gray-200">
                            <h3 class="text-xs font-semibold text-gray-700 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Detail Penyelesaian
                            </h3>
                        </div>
                        <div class="p-4">
                            @include('teknisi.partials.form-solved')
                        </div>
                    </div>

                    {{-- WARRANTY FORM --}}
                    <div id="formWarranty" class="bg-gray-50 border border-gray-200 rounded-lg overflow-hidden" style="display:none;">
                        <div class="bg-gray-100 px-4 py-2.5 border-b border-gray-200">
                            <h3 class="text-xs font-semibold text-gray-700 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Detail Garansi
                            </h3>
                        </div>
                        <div class="p-4">
                            @include('teknisi.partials.form-warranty')
                        </div>
                    </div>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="pt-4 border-t border-gray-200 flex gap-3">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-md text-sm font-semibold transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script untuk toggle form dinamis --}}
    <script>
        const statusSelect = document.getElementById('statusSelect');
        const formProgress = document.getElementById('formProgress');
        const formSolved = document.getElementById('formSolved');
        const formWarranty = document.getElementById('formWarranty');

        function toggleForms() {
            // Hide all forms first
            formProgress.style.display = 'none';
            formSolved.style.display = 'none';
            formWarranty.style.display = 'none';

            // Show relevant form
            if (statusSelect.value === 'PROGRESS') {
                formProgress.style.display = 'block';
            } else if (statusSelect.value === 'SOLVED') {
                formSolved.style.display = 'block';
            } else if (statusSelect.value === 'WARRANTY') {
                formWarranty.style.display = 'block';
            }
        }

        statusSelect.addEventListener('change', toggleForms);
        toggleForms(); // initial load
    </script>

</x-admin-layout>