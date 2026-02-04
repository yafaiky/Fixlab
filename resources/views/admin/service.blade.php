<x-admin-layout>
    <div x-data="{ step: 1 }" class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

        <h1 class="text-2xl font-bold mb-6">Buat Service Baru</h1>

        {{-- STEP INDICATOR --}}
        <div class="flex mb-6">
            <div :class="step === 1 ? 'font-bold text-blue-600' : ''">1. Customer</div>
            <span class="mx-3">→</span>
            <div :class="step === 2 ? 'font-bold text-blue-600' : ''">2. Service</div>
        </div>

        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- STEP 1 --}}
            <div x-show="step === 1" x-transition>
                <h2 class="text-xl font-semibold mb-4">Step 1: Data Customer</h2>

                <div class="space-y-4">
                    <input name="name" placeholder="Nama Customer" class="w-full border p-2 rounded" required>
                    <input name="phone" placeholder="No HP" class="w-full border p-2 rounded" required>
                    <input name="email" placeholder="Email" class="w-full border p-2 rounded">
                    <textarea name="address" placeholder="Alamat" class="w-full border p-2 rounded" required></textarea>
                </div>

                <div class="mt-6 text-right">
                    <button type="button" @click="step = 2" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Lanjut →
                    </button>
                </div>
            </div>

            {{-- STEP 2 --}}
            <div x-show="step === 2" x-transition>
                <h2 class="text-xl font-semibold mb-4">Step 2: Data Service</h2>
                <input type="hidden" name="customer_id" value="{{ $customer->id ?? '' }}">

                <div class="space-y-4">
                    <input name="Model" placeholder="Model Hardware" class="w-full border p-2 rounded" required>
                    <input name="IMEI" placeholder="IMEI" class="w-full border p-2 rounded">
                    <input name="Keluhan" placeholder="Keluhan" class="w-full border p-2 rounded" required>
                    <textarea name="Kondisi" placeholder="Kondisi" class="w-full border p-2 rounded" required></textarea>

                    {{-- PHOTO UPLOAD --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Dokumentasi (Maksimal 10
                            foto)</label>
                        <input type="file" name="dokumentasi[]" multiple accept="image/*"
                            class="w-full border p-2 rounded" >
                        <p class="text-sm text-gray-500 mt-1">Pilih maksimal 10 foto</p>

                        {{-- PHOTO PREVIEW --}}
                        <div id="photoPreview" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4 hidden">
                            <!-- Preview images will be inserted here -->
                        </div>
                    </div>

                    {{-- SIGNATURE CANVAS --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanda Tangan Customer</label>
                        <div class="border border-gray-300 rounded p-2">
                            <canvas id="signatureCanvas" width="400" height="200"
                                class="border border-gray-200 bg-white cursor-crosshair"></canvas>
                            <input type="hidden" name="signature" id="signatureInput">
                        </div>
                        <div class="mt-2 space-x-2">
                            <button type="button" onclick="clearSignature()"
                                class="bg-gray-500 text-white px-3 py-1 rounded text-sm">
                                Hapus Tanda Tangan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-between">
                    <button type="button" @click="step = 1" class="bg-gray-400 text-white px-4 py-2 rounded">
                        ← Kembali
                    </button>

                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                        Simpan Service
                    </button>
                </div>
            </div>
        </form>

        {{-- Load Service Form JavaScript --}}
        @vite(['resources/js/service-form.js'])
    </div>
</x-admin-layout>
