<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head> 

<body class="bg-gray-100">
<div x-data="{ sidebarOpen: false }" class="flex h-screen">

    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-40 w-64 bg-gray-900 text-white transform
        transition-transform duration-300 ease-in-out
        lg:translate-x-0 lg:static lg:inset-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        <!-- Logo -->
        <div class="p-4 text-center border-b border-gray-700">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-10 w-auto">
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               @click="sidebarOpen = false"
               class="block rounded px-3 py-2
               {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                Dashboard
            </a>

            <a href="{{ route('admin.service') }}"
               @click="sidebarOpen = false"
               class="block rounded px-3 py-2
               {{ request()->routeIs('admin.service') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                Service
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <!-- Mobile Toggle -->
            <button
                class="lg:hidden p-2 rounded-md text-gray-700 hover:bg-gray-200"
                @click="sidebarOpen = !sidebarOpen"
            >
                <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <h1 class="text-xl font-bold">Admin Dashboard</h1>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}"
                  onsubmit="return confirm('Apakah Ente yakin ingin logout?')">
                @csrf
                <button
                    class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Logout
                </button>
            </form>
        </header>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Content -->
        <main class="p-6 flex-1 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>
</div>
</body>
</html>
