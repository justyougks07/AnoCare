@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-lg">
    <div class="bg-white rounded-xl shadow-md border border-red-100 overflow-hidden">
        <div class="bg-red-50 border-b border-red-100 px-6 py-4 flex items-center gap-3">
            <div class="p-2 bg-red-100 text-red-700 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-red-900">Konfirmasi Hapus Jadwal</h2>
                <p class="text-xs text-red-600">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
        </div>

        <div class="p-6">
            <p class="text-sm text-gray-600 mb-4">
                Apakah Anda yakin ingin menghapus data janji temu berikut? Tindakan ini akan membatalkan nomor antrian dan mengembalikan kuota dokter terdaftar otomatis.
            </p>

            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 space-y-2 mb-6 text-sm text-gray-700">
                <div class="flex justify-between">
                    <span class="text-gray-400">Nama Pasien:</span>
                    <span class="font-semibold text-gray-900">{{ $appointment->patient->nama ?? 'Pasien ID: '.$appointment->patient_id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Dokter Tujuan:</span>
                    <span class="font-medium">dr. {{ $appointment->dokter->nama_dokter }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Waktu Sesi Kunjungan:</span>
                    <span class="font-medium">{{ \Carbon\Carbon::parse($appointment->tanggal_kunjungan)->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">No. Antrian saat ini:</span>
                    <span class="font-bold text-indigo-600">#{{ $appointment->antrian->nomor_antrian ?? '-' }}</span>
                </div>
            </div>

            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex justify-end gap-3">
                    <a href="{{ route('appointments.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 font-medium">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium shadow-sm">
                        Ya, Hapus Permanen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection