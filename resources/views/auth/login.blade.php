<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6 px-6 pt-6" :status="session('status')" />

    <div class="px-6 py-8">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Masuk ke Akun</h2>
            <p class="text-sm text-gray-600">Kelola semua service dengan mudah</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <x-input-label for="email" :value="__('Email Address')" class="text-sm font-semibold text-gray-700" />
                </div>
                <x-text-input id="email" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all hover:border-gray-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="your@email.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <x-input-label for="password" :value="__('Password')" class="text-sm font-semibold text-gray-700" />
                </div>
                <x-text-input id="password" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all hover:border-gray-400" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" class="w-4 h-4 text-blue-600 rounded border-gray-300 shadow-sm focus:ring-blue-500" name="remember">
                <label for="remember_me" class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</label>
            </div>

            <!-- Login Button -->
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-all shadow-md hover:shadow-lg mt-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                {{ __('Masuk') }}
            </button>
        </form>
    </div>
</x-guest-layout>
