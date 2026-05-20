<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Masuk ke AnoCare</h1>
        <p class="text-slate-600 text-sm mt-2">Kelola klinik Anda dengan sistem modern</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username"
                placeholder="nama@email.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" />

            <x-text-input 
                id="password" 
                class="block mt-1 w-full"
                type="password"
                name="password"
                required 
                autocomplete="current-password"
                placeholder="••••••••"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="rounded border-slate-300 text-blue-600 shadow-soft focus:ring-blue-500" 
                    name="remember"
                >
                <span class="text-sm text-slate-600 font-medium">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-700 font-medium" href="{{ route('password.request') }}">
                    {{ __('Lupa kata sandi?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="w-full justify-center mt-6">
            {{ __('Masuk') }}
        </x-primary-button>

        @if (Route::has('register'))
            <p class="text-center text-slate-600 text-sm">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                    Daftar di sini
                </a>
            </p>
        @endif
    </form>
</x-guest-layout>
