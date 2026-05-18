@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-xl">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="bg-slate-800 px-6 py-4 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold text-white">Detail Janji Temu</h2>
                <p class="text-xs text-slate-400">ID Registrasi Master: #{{ $appointment->id }}</p>
            </div>
            <span class="text-xl font-black bg-indigo-600 text-white px-4 py-2 rounded-lg">
                No. #{{ $appointment->antrian->nomor_antrian ?? '-' }}
            </span>
        </div>

        <div class="p-6 space-y-4 text-sm text-gray-700">
            <div class="grid grid-cols-2 border-b pb-2">
                <span class="font-semibold text-gray-500">Nama Lengkap Pasien:</span>
                <span class="font-bold text-gray-900 text-right">{{ $appointment->patient->nama ?? 'Data Pasien Simulasi' }}</span>
            </div>

            <div class="grid grid-cols-2 border-b pb-2">
                <span class="font-semibold text-gray-500">Dokter Spesialis:</span>
                <span class="font-medium text-gray-900 text-right">dr. {{ $appointment->dokter->nama_dokter }}</span>
            </div>

            <div class="grid grid-cols-2 border-b pb-2">
                <span class="font-semibold text-gray-500">Waktu Kedatangan:</span>
                <span class="font-medium text-gray-900 text-right">
                    {{ \Carbon\Carbon::parse($appointment->tanggal_kunjungan)->format('d F Y') }} <br>
                    <small class="text-indigo-600 font-bold">Jam Sesi: {{ substr($appointment->jam_kunjungan, 0, 5) }} WIB</small>
                </span>
            </div>

            <div class="grid grid-cols-2 border-b pb-2">
                <span class="font-semibold text-gray-500">Waktu Masuk Antrian:</span>
                <span class="text-gray-900 text-right">{{ $appointment->antrian->waktu_masuk ?? '-' }} WIB</span>
            </div>

            <div class="grid grid-cols-2 border-b pb-2">
                <span class="font-semibold text-gray-500">Status Operasional:</span>
                <span class="text-right">
                    <span class="px-2.5 py-0.5 rounded text-xs font-bold uppercase bg-slate-100 border text-slate-700">
                        {{ $appointment->status }}
                    </span>
                </span>
            </div>

            <div class="pt-2">
                <span class="block font-semibold text-gray-500 mb-1">Catatan Keluhan Awal:</span>
                <div class="bg-gray-50 rounded-lg p-3 border text-gray-600 italic">
                    "{{ $appointment->keluhan ?? 'Tidak ada keluhan tertulis.' }}"
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <a href="{{ route('appointments.index') }}" class="px-5 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-lg font-medium shadow-sm transition text-sm">
                    Kembali ke Halaman Index
                </a>
            </div>
        </div>
    </div>
</div>
@endsection