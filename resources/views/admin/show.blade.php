
<div class="max-w-4xl mx-auto py-6 space-y-6">

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Detail Service #{{ $service->id }}</h2>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-500">Customer</p>
                <p class="font-medium">{{ $service->customer->name }}</p>
            </div>

            <div>
                <p class="text-gray-500">Status</p>
                <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-700">
                    {{ $service->serviceStatus }}
                </span>
            </div>

            <div>
                <p class="text-gray-500">Model</p>
                <p>{{ $service->Model }}</p>
            </div>

            <div>
                <p class="text-gray-500">IMEI</p>
                <p>{{ $service->IMEI }}</p>
            </div>

            <div class="col-span-2">
                <p class="text-gray-500">Keluhan</p>
                <p>{{ $service->Keluhan }}</p>
            </div>

            <div class="col-span-2">
                <p class="text-gray-500">Kondisi</p>
                <p>{{ $service->Kondisi }}</p>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.dashboard') }}"
       class="inline-block text-sm text-blue-600 hover:underline">
        ← Kembali
    </a>

</div>

