<x-admin-layout>
    <div x-data="{ step: 1 }" class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm border border-gray-200">

        {{-- HEADER --}}
        <div class="border-b border-gray-200 px-6 py-4">
            <h1 class="text-lg font-semibold text-gray-900">Buat Service Baru</h1>
        </div>

        {{-- STEP INDICATOR --}}
        <div class="px-6 py-3 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center text-sm">
                <div :class="step === 1 ? 'font-semibold text-blue-600' : 'text-gray-500'">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full text-xs mr-2"
                          :class="step === 1 ? 'bg-blue-600 text-white' : 'bg-gray-200'">1</span>
                    Customer
                </div>
                <svg class="w-4 h-4 mx-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <div :class="step === 2 ? 'font-semibold text-blue-600' : 'text-gray-500'">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full text-xs mr-2"
                          :class="step === 2 ? 'bg-blue-600 text-white' : 'bg-gray-200'">2</span>
                    Service
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- STEP 1 --}}
            <div x-show="step === 1" x-transition class="px-6 py-5">
                <h2 class="text-sm font-semibold text-gray-700 mb-4">Data Customer</h2>

                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Nama Customer</label>
                        <input name="name" type="text" class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">No HP</label>
                        <input name="phone" type="tel" class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Email</label>
                        <input name="email" type="email" class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Alamat</label>
                        <textarea name="address" rows="2" class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-t border-gray-200 text-right">
                    <button type="button" @click="step = 2" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md text-sm font-medium transition-colors">
                        Lanjut
                    </button>
                </div>
            </div>

            {{-- STEP 2 --}}
            <div x-show="step === 2" x-transition class="px-6 py-5">
                <h2 class="text-sm font-semibold text-gray-700 mb-4">Data Service</h2>
                <input type="hidden" name="customer_id" value="{{ $customer->id ?? '' }}">

                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Model Hardware</label>
                        <input name="Model" type="text" class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">IMEI</label>
                        <input name="IMEI" type="text" class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Keluhan</label>
                        <input name="Keluhan" type="text" class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Kondisi</label>
                        <textarea name="Kondisi" rows="2" class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
                    </div>

                    {{-- PHOTO UPLOAD --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Foto Dokumentasi</label>
                        <input type="file" name="dokumentasi[]" multiple accept="image/*"
                            class="w-full border border-gray-300 px-3 py-2 rounded-md text-sm file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-500 mt-1">Maksimal 10 foto</p>

                        {{-- PHOTO PREVIEW --}}
                        <div id="photoPreview" class="mt-3 grid grid-cols-3 gap-2 hidden"></div>
                    </div>

                    {{-- SIGNATURE CANVAS --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Tanda Tangan Customer</label>
                        <div class="border border-gray-300 rounded-md p-2 bg-gray-50">
                            <canvas id="signatureCanvas" width="400" height="150"
                                class="border border-gray-200 bg-white cursor-crosshair w-full rounded"></canvas>
                            <input type="hidden" name="signature" id="signatureInput">
                        </div>
                        <button type="button" onclick="clearSignature()"
                            class="mt-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-md text-xs font-medium transition-colors">
                            Hapus Tanda Tangan
                        </button>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-t border-gray-200 flex justify-between">
                    <button type="button" @click="step = 1" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-md text-sm font-medium transition-colors">
                        Kembali
                    </button>

                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md text-sm font-medium transition-colors">
                        Simpan Service
                    </button>
                </div>
            </div>
        </form>

        @vite(['resources/js/service-form.js'])
    </div>
</x-admin-layout>