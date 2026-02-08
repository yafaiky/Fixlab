<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Service</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/icon-fixlab.png') }}" type="image/png">
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="min-h-screen bg-gray-100 ">
        <div class="w-full min-h-screen py-4 px-8 lg:px-12 space-y-4">

             {{-- Back Button --}}
            <div class="flex justify-start">
                <a href="{{ route('teknisi.dashboard') }}"
                    class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 px-4 py-2.5 rounded-lg text-sm font-medium transition-all shadow-sm hover:shadow-md border border-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            {{-- Header Section --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-gray-100 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <h1 class="text-lg font-semibold text-gray-900">Detail Service #{{ $service->id }}</h1>
                        </div>
                        <p class="text-xs text-gray-500 flex items-center gap-2 ml-11">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            {{ $service->created_at->format('d F Y, H:i') }} WIB
                        </p>
                    </div>

                    {{-- Status Badge --}}
                    @php
                        $status = strtolower($service->serviceStatus);
                    @endphp
                    <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                        <span
                            class="px-3 py-1.5 text-xs font-semibold rounded-md
                        @if ($status === 'open') bg-blue-600 text-white
                        @elseif($status === 'progress') bg-yellow-500 text-white
                        @elseif($status === 'solved') bg-green-600 text-white
                        @elseif($status === 'warranty') bg-purple-600 text-white
                        @elseif($status === 'done') bg-gray-600 text-white
                        @else bg-red-600 text-white @endif">
                            {{ strtoupper($service->serviceStatus) }}
                        </span>

                        {{-- PDF Download Buttons --}}
                        @if ($status === 'open')
                            <a href="{{ route('service.generate.pdf', ['id' => $service->id, 'type' => 'CREATE']) }}"
                                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-xs font-medium transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Download PDF
                            </a>
                        @elseif($status === 'solved')
                            <a href="{{ route('service.generate.pdf', ['id' => $service->id, 'type' => 'UPDATE']) }}"
                                class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-xs font-medium transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Download PDF
                            </a>
                        @elseif($status === 'warranty')
                            <a href="{{ route('service.generate.pdf', ['id' => $service->id, 'type' => 'INVOICE']) }}"
                                class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-xs font-medium transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Download PDF
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Main Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

                {{-- Customer Information Card --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3">
                        <h2 class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Informasi Customer
                        </h2>
                    </div>
                    <div class="p-4 space-y-3 text-xs">
                        <div class="flex items-start group">
                            <div class="bg-gray-100 p-2 rounded-lg mr-3 group-hover:bg-gray-200 transition-colors">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-medium text-gray-500 block mb-0.5">Nama Lengkap</span>
                                <span class="text-gray-900 font-semibold">{{ $service->customer->name }}</span>
                            </div>
                        </div>
                        <div class="flex items-start group">
                            <div class="bg-gray-100 p-2 rounded-lg mr-3 group-hover:bg-gray-200 transition-colors">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-medium text-gray-500 block mb-0.5">Nomor Telepon</span>
                                <span class="text-gray-900 font-semibold">{{ $service->customer->phone }}</span>
                            </div>
                        </div>
                        <div class="flex items-start group">
                            <div class="bg-gray-100 p-2 rounded-lg mr-3 group-hover:bg-gray-200 transition-colors">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-medium text-gray-500 block mb-0.5">Email</span>
                                <span class="text-gray-900 font-semibold">{{ $service->customer->email ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="flex items-start group">
                            <div class="bg-gray-100 p-2 rounded-lg mr-3 group-hover:bg-gray-200 transition-colors">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-medium text-gray-500 block mb-0.5">Alamat</span>
                                <span class="text-gray-900 font-semibold">{{ $service->customer->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Hardware Information Card --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3">
                        <h2 class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                            Informasi Hardware
                        </h2>
                    </div>
                    <div class="p-4 space-y-3 text-xs">
                        <div class="flex items-start group">
                            <div class="bg-gray-100 p-2 rounded-lg mr-3 group-hover:bg-gray-200 transition-colors">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-medium text-gray-500 block mb-0.5">Model Device</span>
                                <span class="text-gray-900 font-semibold">{{ $service->Model }}</span>
                            </div>
                        </div>
                        <div class="flex items-start group">
                            <div class="bg-gray-100 p-2 rounded-lg mr-3 group-hover:bg-gray-200 transition-colors">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-medium text-gray-500 block mb-0.5">IMEI Number</span>
                                <span class="text-gray-900 font-semibold">{{ $service->IMEI ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="flex items-start group">
                            <div class="bg-gray-100 p-2 rounded-lg mr-3 group-hover:bg-gray-200 transition-colors">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-medium text-gray-500 block mb-0.5">Keluhan</span>
                                <span class="text-gray-900 font-semibold">{{ $service->Keluhan }}</span>
                            </div>
                        </div>
                        <div class="flex items-start group">
                            <div class="bg-gray-100 p-2 rounded-lg mr-3 group-hover:bg-gray-200 transition-colors">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-medium text-gray-500 block mb-0.5">Kondisi Fisik</span>
                                <span class="text-gray-900 font-semibold">{{ $service->Kondisi }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Service Detail Card --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 border-b border-gray-200 px-4 py-3">
                    <h2 class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Detail Perbaikan
                    </h2>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                            <span class="font-medium text-gray-500 block mb-1 flex items-center gap-2">
                                <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                                Penyebab Kerusakan
                            </span>
                            <span class="text-gray-900 font-semibold">{{ $service->penyebab ?? '-' }}</span>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                            <span class="font-medium text-gray-500 block mb-1 flex items-center gap-2">
                                <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                                Jenis Kerusakan
                            </span>
                            <span class="text-gray-900 font-semibold">{{ $service->kerusakan ?? '-' }}</span>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                            <span class="font-medium text-gray-500 block mb-1 flex items-center gap-2">
                                <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                                Penyelesaian
                            </span>
                            <span class="text-gray-900 font-semibold">{{ $service->penyelesaian ?? '-' }}</span>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                            <span class="font-medium text-gray-500 block mb-1 flex items-center gap-2">
                                <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                                Part yang Diganti
                            </span>
                            <span class="text-gray-900 font-semibold">{{ $service->partUsed ?? '-' }}</span>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 md:col-span-2">
                            <span class="font-medium text-gray-500 block mb-1 flex items-center gap-2">
                                <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                                Masa Garansi
                            </span>
                            <span class="text-gray-900 font-semibold">
                                {{ $service->garansi ? \Carbon\Carbon::parse($service->garansi)->format('d F Y') : '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Rincian Biaya --}}
            @if (($service->items && $service->items->count() > 0) || $service->hargaJasa)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3">
                        <h2 class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            Rincian Biaya
                        </h2>
                    </div>

                    <div class="p-4">
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200">
                                        <th class="py-2.5 px-3 text-left font-semibold text-gray-700">Item</th>
                                        <th class="py-2.5 px-3 text-right font-semibold text-gray-700">Harga</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @if ($service->items)
                                        @foreach ($service->items as $item)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="py-2.5 px-3 text-gray-900 font-medium">
                                                    {{ $item->judulBarang }}</td>
                                                <td class="py-2.5 px-3 text-right text-gray-900 font-semibold">
                                                    Rp {{ number_format((int) $item->hargaBarang, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    @if ($service->judulJasa)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="py-2.5 px-3 text-gray-900 font-medium">
                                                {{ $service->judulJasa }}</td>
                                            <td class="py-2.5 px-3 text-right text-gray-900 font-semibold">
                                                Rp {{ number_format((int) $service->hargaJasa, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    @php
                                        $totalBarang = $service->items
                                            ? $service->items->sum(fn($b) => (int) $b->hargaBarang)
                                            : 0;
                                        $totalJasa = (int) ($service->hargaJasa ?? 0);
                                    @endphp
                                    <tr class="bg-gray-800 text-white">
                                        <td class="py-3 px-3 text-left font-bold text-sm">Total Pembayaran</td>
                                        <td class="py-3 px-3 text-right font-bold text-base">
                                            Rp {{ number_format($totalBarang + $totalJasa, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Media Section --}}
            @if ($service->media && $service->media->count() > 0)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3">
                        <h2 class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Dokumentasi & Media
                        </h2>
                    </div>

                    @foreach ($service->media as $m)
                        <div class="p-4 space-y-5">

                            {{-- Tanda Tangan --}}
                            @if ($m->signature)
                                <div>
                                    <h3 class="text-xs font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                        Tanda Tangan Customer
                                    </h3>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 inline-block">
                                        <img src="{{ Storage::url($m->signature) }}" alt="Signature"
                                            class="max-h-32 w-auto rounded" />
                                    </div>
                                </div>
                            @endif

                            {{-- Dokumentasi --}}
                            @if ($m->dokumentasi && count($m->dokumentasi) > 0)
                                <div>
                                    <h3 class="text-xs font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Foto Dokumentasi
                                        <span
                                            class="ml-auto bg-gray-200 text-gray-700 px-2 py-0.5 rounded text-xs font-bold">
                                            {{ count($m->dokumentasi) }} Foto
                                        </span>
                                    </h3>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                                        @foreach ($m->dokumentasi as $i => $dok)
                                            <div class="group relative bg-gray-50 rounded-lg overflow-hidden border border-gray-200 hover:border-gray-400 transition-all duration-300 cursor-pointer shadow-sm hover:shadow-md"
                                                onclick="openLightbox('{{ Storage::url($dok) }}', 'Dokumentasi {{ $i + 1 }}')">
                                                <div class="aspect-square overflow-hidden">
                                                    <img src="{{ Storage::url($dok) }}"
                                                        alt="Dokumentasi {{ $i + 1 }}"
                                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                                                </div>
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div
                                                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-2">
                                                    <p class="text-white text-xs font-semibold">Foto
                                                        {{ $i + 1 }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Hasil Perbaikan --}}
                            @if ($m->hasil && count($m->hasil) > 0)
                                <div>
                                    <h3 class="text-xs font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Hasil Perbaikan
                                        <span
                                            class="ml-auto bg-gray-200 text-gray-700 px-2 py-0.5 rounded text-xs font-bold">
                                            {{ count($m->hasil) }} Foto
                                        </span>
                                    </h3>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                                        @foreach ($m->hasil as $i => $hasilImg)
                                            <div class="group relative bg-gray-50 rounded-lg overflow-hidden border border-gray-200 hover:border-gray-400 transition-all duration-300 cursor-pointer shadow-sm hover:shadow-md"
                                                onclick="openLightbox('{{ Storage::url($hasilImg) }}', 'Hasil Perbaikan {{ $i + 1 }}')">
                                                <div class="aspect-square overflow-hidden">
                                                    <img src="{{ Storage::url($hasilImg) }}"
                                                        alt="Hasil {{ $i + 1 }}"
                                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                                                </div>
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div
                                                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-2">
                                                    <p class="text-white text-xs font-semibold">Hasil
                                                        {{ $i + 1 }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

    {{-- Lightbox Modal --}}
    <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4"
        onclick="closeLightbox()">
        <div class="relative max-w-5xl max-h-full" onclick="event.stopPropagation()">
            {{-- Close Button --}}
            <button onclick="closeLightbox()"
                class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            {{-- Image Container --}}
            <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                <div class="bg-gray-800 px-4 py-3">
                    <h3 id="lightboxTitle" class="text-white font-semibold text-sm"></h3>
                </div>
                <div class="p-2">
                    <img id="lightboxImg" src="" alt=""
                        class="max-w-full max-h-[80vh] mx-auto rounded">
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript for Lightbox --}}
    <script>
        function openLightbox(imageSrc, title) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightboxImg');
            const lightboxTitle = document.getElementById('lightboxTitle');

            lightboxImg.src = imageSrc;
            lightboxTitle.textContent = title;
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Close lightbox with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>

</body>

</html>
