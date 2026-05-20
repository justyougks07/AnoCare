<nav x-data="{ open: false }"
     class="bg-white/80 backdrop-blur-xl border-b border-slate-100 sticky top-0 z-50 shadow-soft">

    <div class="w-full px-6 lg:px-10">

        <div class="flex justify-between h-16 items-center">

            {{-- LEFT AREA --}}
            <div class="flex items-center gap-8">

                {{-- LOGO --}}
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 hover:opacity-80 transition-opacity">

                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-700
                                flex items-center justify-center text-white shadow-soft-lg">
                        🏥
                    </div>

                    <div>
                        <h1 class="text-lg font-bold text-slate-800 leading-tight">
                            AnoCare
                        </h1>
                        <p class="text-xs text-slate-500 leading-none">
                            Clinic System
                        </p>
                    </div>

                </a>

                @php($role = Auth::user()->role)

                {{-- DESKTOP MENU --}}
                <div class="hidden md:flex items-center gap-1">

                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300
                       {{ request()->routeIs('dashboard')
                            ? 'bg-blue-100 text-blue-700 shadow-soft'
                            : 'text-slate-600 hover:bg-slate-100' }}">
                        Dashboard
                    </a>

                    @if(in_array($role, ['admin', 'dokter'], true))
                        <a href="{{ route('patients.index') }}"
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300
                           {{ request()->routeIs('patients.*')
                                ? 'bg-blue-100 text-blue-700 shadow-soft'
                                : 'text-slate-600 hover:bg-slate-100' }}">
                            👥 Pasien
                        </a>

                        <a href="{{ route('appointments.index') }}"
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300
                           {{ request()->routeIs('appointments.*')
                                ? 'bg-blue-100 text-blue-700 shadow-soft'
                                : 'text-slate-600 hover:bg-slate-100' }}">
                            📋 Antrian
                        </a>

                        <a href="{{ route('medicines.index') }}"
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300
                           {{ request()->routeIs('medicines.*') || request()->routeIs('prescriptions.*')
                                ? 'bg-blue-100 text-blue-700 shadow-soft'
                                : 'text-slate-600 hover:bg-slate-100' }}">
                            💊 Obat
                        </a>
                    @endif

                    @if($role === 'pasien')
                        <a href="{{ route('appointments.create') }}"
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300
                           {{ request()->routeIs('appointments.create')
                                ? 'bg-blue-100 text-blue-700 shadow-soft'
                                : 'text-slate-600 hover:bg-slate-100' }}">
                            📅 Booking
                        </a>
                    @endif

                </div>

            </div>

            {{-- RIGHT AREA --}}
            <div class="hidden md:flex items-center gap-4">

                @if(in_array($role, ['admin', 'dokter'], true))
                    <a href="{{ route('patients.create') }}"
                       class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-5 py-2 rounded-lg
                              font-medium shadow-soft-lg hover:shadow-glow-blue hover:from-blue-700 hover:to-blue-800 transition-all duration-300">
                        ➕ Pasien Baru
                    </a>
                @else
                    <a href="{{ route('appointments.create') }}"
                       class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-5 py-2 rounded-lg
                              font-medium shadow-soft-lg hover:shadow-glow-blue hover:from-blue-700 hover:to-blue-800 transition-all duration-300">
                        📅 Booking
                    </a>
                @endif

                {{-- USER INFO --}}
                <div x-data="{ showMenu: false }" class="relative">
                    <button @click="showMenu = !showMenu" 
                            class="flex items-center gap-3 bg-gradient-to-br from-slate-50 to-slate-100 px-3 py-1.5
                            rounded-lg border border-slate-200 hover:border-slate-300 hover:shadow-soft transition-all duration-300">

                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 text-white
                                    flex items-center justify-center font-semibold text-sm">
                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                        </div>

                        <div class="leading-tight hidden sm:block">
                            <p class="text-sm font-medium text-slate-800">
                                {{ Auth::user()->name }}
                            </p>
                        </div>
                        
                        <svg x-show="!showMenu" class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        <svg x-show="showMenu" class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>

                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="showMenu" @click.outside="showMenu = false"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-soft-lg border border-slate-100 overflow-hidden z-50">
                        
                        <a href="{{ route('profile.edit') }}" 
                           class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                            ⚙️ Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                   class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors border-t border-slate-100">
                                🚪 Logout
                            </button>
                        </form>
                    </div>

                </div>

            </div>

            {{-- MOBILE BUTTON --}}
            <div class="md:hidden">
                <button @click="open=!open"
                        class="p-2 rounded-lg hover:bg-slate-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>

    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open" @click.outside="open = false"
         x-transition class="md:hidden border-t border-slate-100 bg-white">

        <div class="p-4 space-y-2">

            <a href="{{ route('dashboard') }}" 
               class="block p-3 rounded-lg text-slate-700 hover:bg-blue-50 transition-colors font-medium">
                Dashboard
            </a>

            @if(in_array($role, ['admin', 'dokter'], true))
                <a href="{{ route('patients.index') }}" 
                   class="block p-3 rounded-lg text-slate-700 hover:bg-blue-50 transition-colors font-medium">
                    👥 Pasien
                </a>

                <a href="{{ route('appointments.index') }}" 
                   class="block p-3 rounded-lg text-slate-700 hover:bg-blue-50 transition-colors font-medium">
                    📋 Antrian
                </a>

                <a href="{{ route('medicines.index') }}" 
                   class="block p-3 rounded-lg text-slate-700 hover:bg-blue-50 transition-colors font-medium">
                    💊 Obat
                </a>

                <a href="{{ route('patients.create') }}"
                   class="block p-3 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium">
                    ➕ Pasien Baru
                </a>
            @else
                <a href="{{ route('appointments.create') }}"
                   class="block p-3 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium">
                    📅 Booking Janji
                </a>
            @endif

            <hr class="my-3 border-slate-100">

            <a href="{{ route('profile.edit') }}" 
               class="block p-3 rounded-lg text-slate-700 hover:bg-slate-50 transition-colors">
                ⚙️ Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                       class="w-full text-left p-3 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                    🚪 Logout
                </button>
            </form>

        </div>

    </div>
</nav>

</nav>
