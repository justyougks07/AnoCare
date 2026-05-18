<nav x-data="{ open: false }"
     class="bg-white border-b border-slate-200 sticky top-0 z-50">

    <div class="w-full px-6 lg:px-10">

        <div class="flex justify-between h-16 items-center">

            {{-- LEFT AREA --}}
            <div class="flex items-center gap-8">

                {{-- LOGO --}}
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-2xl bg-blue-600
                                flex items-center justify-center
                                text-white shadow">
                        🏥
                    </div>

                    <div>
                        <h1 class="text-lg font-bold text-slate-800 leading-none">
                            AnoCare
                        </h1>
                        <p class="text-xs text-slate-500">
                            Smart Clinic System
                        </p>
                    </div>

                </a>

                {{-- DESKTOP MENU --}}
                <div class="hidden md:flex items-center gap-2">

                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition
                       {{ request()->routeIs('dashboard')
                            ? 'bg-blue-50 text-blue-700'
                            : 'text-slate-600 hover:bg-slate-100' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('patients.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition
                       {{ request()->routeIs('patients.*')
                            ? 'bg-blue-50 text-blue-700'
                            : 'text-slate-600 hover:bg-slate-100' }}">
                        Pasien
                    </a>

                    <a href="{{ route('medicines.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition
                       {{ request()->routeIs('medicines.*')
                            ? 'bg-blue-50 text-blue-700'
                            : 'text-slate-600 hover:bg-slate-100' }}">
                        Obat
                    </a>

                </div>

            </div>

            {{-- RIGHT AREA --}}
            <div class="hidden md:flex items-center gap-4">

                {{-- BUTTON TAMBAH PASIEN (SATU SAJA) --}}
                <a href="{{ route('patients.create') }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded-xl
                          font-medium shadow hover:bg-blue-700 transition">
                    + Pasien Baru
                </a>

                {{-- USER INFO --}}
                <div class="flex items-center gap-3 bg-slate-50 px-3 py-2
                            rounded-2xl border border-slate-200">

                    <div class="w-10 h-10 rounded-xl bg-blue-600 text-white
                                flex items-center justify-center font-semibold">
                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                    </div>

                    <div class="leading-tight">
                        <p class="text-sm font-semibold text-slate-800">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-slate-500">
                            {{ Auth::user()->email }}
                        </p>
                    </div>

                </div>

                {{-- DROPDOWN --}}
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="w-10 h-10 rounded-xl border
                                       border-slate-200 hover:bg-slate-100">
                            ⚙️
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                Logout
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- MOBILE BUTTON --}}
            <div class="md:hidden">
                <button @click="open=!open"
                        class="p-2 rounded-xl hover:bg-slate-100">
                    ☰
                </button>
            </div>

        </div>

    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open" class="md:hidden border-t bg-white">

        <div class="p-4 space-y-2">

            <a href="{{ route('dashboard') }}" class="block p-3 rounded-xl hover:bg-slate-100">
                Dashboard
            </a>

            <a href="{{ route('patients.index') }}" class="block p-3 rounded-xl hover:bg-slate-100">
                Pasien
            </a>

            <a href="{{ route('medicines.index') }}" class="block p-3 rounded-xl hover:bg-slate-100">
                Obat
            </a>

            <a href="{{ route('patients.create') }}"
               class="block p-3 rounded-xl bg-blue-600 text-white">
                + Pasien Baru
            </a>

        </div>

    </div>

</nav>