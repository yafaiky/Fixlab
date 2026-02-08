<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fixlab Login</title>

    <link rel="icon" href="{{ asset('images/icon-fixlab.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="min-h-screen flex items-center justify-center px-4 py-6">
        <div class="w-full max-w-md">
            <!-- Logo Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center">
                    <img src="{{ asset('images/logo-fixlab.png') }}" alt="Logo" class="h-12">
                </div>
                <p class="text-gray-600 text-sm">Service Management System</p>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                {{ $slot }}
            </div>

        </div>
    </div>
</body>

</html>
