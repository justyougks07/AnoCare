@extends('layouts.app')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="min-h-screen bg-slate-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Dashboard Dokter</h1>
            <p class="text-slate-500 mt-2">
                {{ $dokter ? 'Selamat bertugas, dr. '.$dokter->nama_dokter.'.' : 'Akun dokter belum terhubung ke data dokter.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <p class="text-sm text-slate-500">Janji Hari Ini</p>
                <h2 class="text-3xl font-bold text-slate-800 mt-2">{{ $todayAppointments }}</h2>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <p class="text-sm text-slate-500">Antrian Aktif</p>
                <h2 class="text-3xl font-bold text-slate-800 mt-2">{{ $todayQueues->where('status', '!=', 'selesai')->count() }}</h2>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <p class="text-sm text-slate-500">Selesai</p>
                <h2 class="text-3xl font-bold text-slate-800 mt-2">{{ $todayQueues->where('status', 'selesai')->count() }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('appointments.index') }}" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-blue-300 transition">
                <p class="text-sm text-slate-500">Hari Ini</p>
                <h2 class="text-xl font-semibold text-slate-800 mt-1">Antrian Pasien</h2>
                <p class="text-sm text-slate-500 mt-3">Kelola status kunjungan pasien yang sedang berjalan.</p>
            </a>

            <a href="{{ route('patients.index') }}" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-blue-300 transition">
                <p class="text-sm text-slate-500">Data Klinik</p>
                <h2 class="text-xl font-semibold text-slate-800 mt-1">Data Pasien</h2>
                <p class="text-sm text-slate-500 mt-3">Lihat profil, keluhan, dan riwayat pasien.</p>
            </a>

            <a href="{{ route('dokter.visits.create') }}" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-blue-300 transition">
                <p class="text-sm text-slate-500">Diagnosis</p>
                <h2 class="text-xl font-semibold text-slate-800 mt-1">Tambah Hasil Kunjungan</h2>
                <p class="text-sm text-slate-500 mt-3">Dokter dapat mencatat diagnosis dan catatan setelah periksa pasien.</p>
            </a>
        </div>

        <div class="mt-8 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-800 mb-4">Antrian Hari Ini</h2>
            <div class="divide-y divide-slate-100">
                @forelse($todayQueues as $queue)
                    <div class="py-3 flex items-center justify-between gap-4">
                        <div>
                            <p class="font-medium text-slate-800">#{{ $queue->nomor_antrian }} - {{ $queue->appointment->patient->name ?? 'Pasien tidak ditemukan' }}</p>
                            <p class="text-sm text-slate-500">{{ ucfirst(str_replace('_', ' ', $queue->status)) }}</p>
                        </div>
                        <a href="{{ route('appointments.show', $queue->appointment_id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">Detail</a>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada antrian untuk hari ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
