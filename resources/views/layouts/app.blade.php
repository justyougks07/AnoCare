<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AnoCare - @yield('title', 'Klinik Cerdas')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome (opsional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    
    {{-- Navbar Sederhana --}}
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-blue-600">🏥 AnoCare</span>
                    <span class="ml-2 text-gray-600">Klinik Cerdas</span>
                </div>
                
                <div class="flex space-x-4">
                    <a href="{{ route('patients.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">
                        📋 Pasien
                    </a>
                    <a href="{{ route('patients.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        + Pasien Baru
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>
    
    {{-- Footer --}}
    <footer class="bg-white shadow-lg mt-8 py-4 text-center text-gray-500 text-sm">
        © 2025 AnoCare - Sistem Manajemen Klinik Cerdas
    </footer>
    
</body>
</html>
