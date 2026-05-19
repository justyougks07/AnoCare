<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AnoCare - @yield('title', 'Klinik Cerdas')</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">
</head>

<body class="bg-slate-50 text-slate-800"
      style="font-family: 'Inter', sans-serif;">

    {{-- ✅ NAVBAR --}}
    @include('layouts.navigation')

    {{-- ✅ CONTENT --}}
    <main class="min-h-screen">
        @isset($header)
            <header class="bg-white border-b border-slate-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{ $slot ?? '' }}
        @yield('content')
    </main>

    {{-- ✅ FOOTER --}}
    <footer class="border-t border-slate-200 bg-white mt-10">
        <div class="max-w-7xl mx-auto px-4 py-5 flex justify-between items-center">
            <div>
                <h3 class="font-semibold">🏥 AnoCare</h3>
                <p class="text-sm text-slate-500">
                    Sistem Manajemen Klinik Modern
                </p>
            </div>

            <p class="text-sm text-slate-400">
                © 2025 AnoCare
            </p>
        </div>
    </footer>

</body>
</html>
