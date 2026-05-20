<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100 min-h-screen">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            
            <!-- Background decoration -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute top-20 left-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
                <div class="absolute top-40 right-20 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
                <div class="absolute -bottom-20 left-40 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
            </div>

            <div class="w-full sm:max-w-md z-10">
                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <a href="/" class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center text-white shadow-soft-lg text-xl">
                            🏥
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-slate-800">AnoCare</h1>
                            <p class="text-xs text-slate-500">Smart Clinic System</p>
                        </div>
                    </a>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-2xl shadow-soft-lg p-8 border border-slate-100 backdrop-blur-sm">
                    {{ $slot }}
                </div>

                <!-- Footer text -->
                <p class="text-center text-sm text-slate-600 mt-6">
                    © 2025 AnoCare. All rights reserved.
                </p>
            </div>
        </div>
    </body>
</html>
