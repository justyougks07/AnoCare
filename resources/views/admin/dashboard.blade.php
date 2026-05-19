@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen bg-slate-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Dashboard Admin</h1>
            <p class="text-slate-500 mt-2">Ringkasan operasional klinik dan akses audit AI.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <p class="text-sm text-slate-500">Total Pasien</p>
                <h2 class="text-3xl font-bold text-slate-800 mt-2">{{ $totalPatients }}</h2>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <p class="text-sm text-slate-500">Dokter Aktif</p>
                <h2 class="text-3xl font-bold text-slate-800 mt-2">{{ $activeDoctors }}</h2>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <p class="text-sm text-slate-500">Janji Hari Ini</p>
                <h2 class="text-3xl font-bold text-slate-800 mt-2">{{ $todayAppointments }}</h2>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <p class="text-sm text-slate-500">Stok Menipis</p>
                <h2 class="text-3xl font-bold text-slate-800 mt-2">{{ $lowStockMedicines }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('patients.index') }}" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-blue-300 transition">
                <p class="text-sm text-slate-500">Modul</p>
                <h2 class="text-xl font-semibold text-slate-800 mt-1">Data Pasien</h2>
                <p class="text-sm text-slate-500 mt-3">Kelola registrasi, profil, dan rekam medis sederhana.</p>
            </a>

            <a href="{{ route('appointments.index') }}" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-blue-300 transition">
                <p class="text-sm text-slate-500">Modul</p>
                <h2 class="text-xl font-semibold text-slate-800 mt-1">Jadwal & Antrian</h2>
                <p class="text-sm text-slate-500 mt-3">Pantau booking janji temu dan antrian harian.</p>
            </a>

            <a href="{{ route('medicines.index') }}" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-blue-300 transition">
                <p class="text-sm text-slate-500">Modul</p>
                <h2 class="text-xl font-semibold text-slate-800 mt-1">Obat & Stok</h2>
                <p class="text-sm text-slate-500 mt-3">Kelola data obat, stok, dan resep digital.</p>
            </a>
        </div>

        <div class="mt-8 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-slate-800">Audit Klinik dengan AI</h2>
                    <p class="text-sm text-slate-500 mt-1">Analisis tren diagnosis dan rekomendasi peningkatan layanan.</p>
                </div>
                <a href="{{ route('ai.audit') }}" class="inline-flex justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition">
                    Buka Audit AI
                </a>
            </div>
        </div>

        <div class="mt-8 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-800 mb-4">Riwayat Kunjungan Terbaru</h2>
            <div class="divide-y divide-slate-100">
                @forelse($recentVisits as $visit)
                    <div class="py-3 flex items-center justify-between gap-4">
                        <div>
                            <p class="font-medium text-slate-800">{{ $visit->patient->name ?? 'Pasien terhapus' }}</p>
                            <p class="text-sm text-slate-500">{{ $visit->diagnosis }}</p>
                        </div>
                        <span class="text-sm text-slate-500">{{ $visit->visit_date }}</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada riwayat kunjungan.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
