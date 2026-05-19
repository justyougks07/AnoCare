@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="min-h-screen bg-slate-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Dashboard Pasien</h1>
            <p class="text-slate-500 mt-2">
                Kelola profil akun dan janji temu klinik Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('profile.edit') }}" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-blue-300 transition">
                <p class="text-sm text-slate-500">Akun</p>
                <h2 class="text-xl font-semibold text-slate-800 mt-1">Profil Saya</h2>
                <p class="text-sm text-slate-500 mt-3">Perbarui informasi akun dan password login.</p>
            </a>

            <a href="{{ route('appointments.create') }}" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-blue-300 transition">
                <p class="text-sm text-slate-500">Kunjungan</p>
                <h2 class="text-xl font-semibold text-slate-800 mt-1">Booking Janji Temu</h2>
                <p class="text-sm text-slate-500 mt-3">Pilih dokter dan jadwal praktek yang tersedia.</p>
            </a>
        </div>

        <div class="mt-8 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-4">
                <div>
                    <h2 class="text-xl font-semibold text-slate-800">Janji Temu Saya</h2>
                    <p class="text-sm text-slate-500 mt-1">
                        @if($patient)
                            Data pasien terhubung: {{ $patient->name }}.
                        @else
                            Data pasien belum terhubung otomatis. Gunakan nama akun yang sama dengan data pasien atau minta admin memperbarui data.
                        @endif
                    </p>
                </div>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($appointments as $appointment)
                    <div class="py-3 flex items-center justify-between gap-4">
                        <div>
                            <p class="font-medium text-slate-800">
                                dr. {{ $appointment->dokter->nama_dokter ?? '-' }}
                            </p>
                            <p class="text-sm text-slate-500">
                                {{ $appointment->tanggal_kunjungan }} pukul {{ substr($appointment->jam_kunjungan, 0, 5) }}
                            </p>
                        </div>
                        <span class="text-sm font-medium text-slate-600">{{ ucfirst(str_replace('_', ' ', $appointment->status)) }}</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada janji temu yang tercatat.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
