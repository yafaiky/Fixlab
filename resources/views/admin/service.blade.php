<x-admin-layout>
<div 
    x-data="{ step: 1 }" 
    class="max-w-3xl mx-auto bg-white p-6 rounded shadow"
>

    <h1 class="text-2xl font-bold mb-6">Buat Service Baru</h1>

    {{-- STEP INDICATOR --}}
    <div class="flex mb-6">
        <div :class="step === 1 ? 'font-bold text-blue-600' : ''">1. Customer</div>
        <span class="mx-3">→</span>
        <div :class="step === 2 ? 'font-bold text-blue-600' : ''">2. Service</div>
    </div>

    <form method="POST" action="{{ route('admin.services.store') }}">
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
                <button
                    type="button"
                    @click="step = 2"
                    class="bg-blue-600 text-white px-4 py-2 rounded"
                >
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
            </div>

            <div class="mt-6 flex justify-between">
                <button
                    type="button"
                    @click="step = 1"
                    class="bg-gray-400 text-white px-4 py-2 rounded"
                >
                    ← Kembali
                </button>

                <button
                    type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded"
                >
                    Simpan Service
                </button>
            </div>
        </div>
    </form>
</div>
</x-admin-layout>
