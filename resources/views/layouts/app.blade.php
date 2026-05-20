<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AnoCare - @yield('title', 'Klinik Cerdas')</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Modern animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        .slide-up {
            animation: slideUp 0.5s ease-out;
        }

        /* Gradient backgrounds */
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Smooth transitions */
        .transition-smooth {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100 text-slate-800"
      style="font-family: 'Inter', sans-serif;">

    {{-- ✅ NAVBAR --}}
    @include('layouts.navigation')

    {{-- ✅ CONTENT --}}
    <main class="min-h-screen">
        @isset($header)
            <header class="bg-white/80 backdrop-blur-xl border-b border-slate-100 shadow-soft-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </main>

    {{-- ✅ FOOTER --}}
    <footer class="border-t border-slate-200 bg-white/80 backdrop-blur-xl mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center text-white text-sm">
                            🏥
                        </div>
                        <h3 class="font-bold text-slate-800">AnoCare</h3>
                    </div>
                    <p class="text-sm text-slate-600">
                        Sistem Manajemen Klinik Modern
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-700 mb-3">Navigasi</h4>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a></li>
                        <li><a href="{{ route('patients.index') }}" class="hover:text-blue-600 transition-colors">Pasien</a></li>
                        <li><a href="{{ route('appointments.index') }}" class="hover:text-blue-600 transition-colors">Antrian</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-700 mb-3">Informasi</h4>
                    <p class="text-sm text-slate-600">
                        © 2025 AnoCare. All rights reserved.
                    </p>
                </div>
            </div>
            <div class="border-t border-slate-100 mt-8 pt-6 text-center text-sm text-slate-500">
                <p>Made with ❤️ for better healthcare</p>
            </div>
        </div>
    </footer>

</body>
</html>
