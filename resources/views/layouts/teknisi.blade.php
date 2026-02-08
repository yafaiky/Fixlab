<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Teknisi Dashboard</title>
    <link rel="icon" href="{{ asset('images/icon-fixlab.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen">

        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-40 w-64
    bg-gradient-to-b from-gray-900 to-gray-800 text-white
    transform transition-transform duration-300 ease-in-out shadow-2xl
    lg:translate-x-0 lg:static lg:inset-0
    flex flex-col"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            <!-- Logo -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-center gap-3">
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('images/logo-fixlab.png') }}" alt="Logo" class="h-7">
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('teknisi.dashboard') }}" @click="sidebarOpen = false"
                    class="flex items-center gap-3 rounded-lg px-4 py-3 transition-all duration-200
               {{ request()->routeIs('teknisi.dashboard') ? 'bg-blue-600 shadow-lg transform scale-105' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-3m0 0l7-4 7 4M5 7v10a1 1 0 001 1h12a1 1 0 001-1V7m-7 4v6m0 0v6m0-6h6m0 0h6">
                        </path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>
            </nav>

            <!-- Footer Info -->
            <div class="p-4 border-t border-gray-700">
                <p class="text-xs text-gray-400 text-center">© 2026 Fixlab</p>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-md border-b border-gray-200">
                <div class="px-6 py-4 flex justify-between items-center">
                    <!-- Mobile Toggle & Title -->
                    <div class="flex items-center gap-4">
                        <button class="lg:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition"
                            @click="sidebarOpen = !sidebarOpen">
                            <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>

                            <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <h1 class="text-2xl font-bold text-gray-900">
                            Teknisi <span
                                class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Dashboard</span>
                        </h1>
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="button" onclick="confirmLogout(this)"
                            class="flex items-center gap-2 bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-600
        text-white px-4 py-2.5 rounded-lg font-semibold transition-all duration-200 ease-out shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Flash Messages -->
            @if (session('success'))
                <div
                    class="mx-6 mt-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg px-5 py-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mx-6 mt-4 bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-lg px-5 py-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <p class="text-red-800 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        function confirmLogout(button) {
            Swal.fire({
                title: 'Logout?',
                text: 'Anda akan keluar dari akun teknisi?.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    confirmButton: 'swal-confirm',
                    cancelButton: 'swal-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>
</body>

</html>
