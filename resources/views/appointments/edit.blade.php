@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-lg">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="bg-amber-500 px-6 py-4">
            <h2 class="text-lg font-bold text-white">Edit Janji Temu</h2>
            <p class="text-xs text-amber-500/10 text-white">Lakukan perubahan atau reschedule jadwal pasien.</p>
        </div>

        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-500">Nama Pasien</label>
                <input type="text" class="w-full border rounded-lg p-2 text-sm bg-gray-100 text-gray-600 focus:outline-none" value="{{ $appointment->patient->nama ?? 'Pasien ID: '.$appointment->patient_id }}" readonly>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Dokter Tujuan</label>
                <select name="dokter_id" class="w-full border rounded-lg p-2 text-sm focus:outline-none focus:border-amber-500" required>
                    @foreach($dokters as $doc)
                        <option value="{{ $doc->id }}" {{ $appointment->dokter_id == $doc->id ? 'selected' : '' }}>dr. {{ $doc->nama_dokter }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Pilih Sesi Jadwal</label>
                <select name="jadwal_id" class="w-full border rounded-lg p-2 text-sm focus:outline-none focus:border-amber-500" required>
                    @foreach($schedules as $s)
                        <option value="{{ $s->id }}" {{ $appointment->jadwal_id == $s->id ? 'selected' : '' }}>
                            {{ $s->tanggal }} (Jam: {{ substr($s->jam_mulai, 0, 5) }} WIB)
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Keluhan</label>
                <textarea name="keluhan" rows="3" class="w-full border rounded-lg p-2 text-sm focus:outline-none focus:border-amber-500">{{ $appointment->keluhan }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Status Master Janji Temu</label>
                <select name="status" class="w-full border rounded-lg p-2 text-sm focus:outline-none focus:border-amber-500" required>
                    <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="dikonfirmasi" {{ $appointment->status == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="sedang_dilayani" {{ $appointment->status == 'sedang_dilayani' ? 'selected' : '' }}>Sedang Dilayani</option>
                    <option value="selesai" {{ $appointment->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="batal" {{ $appointment->status == 'batal' ? 'selected' : '' }}>Batal (Cancel)</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('appointments.index') }}" class="px-4 py-2 border rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50">Batal</a>
                <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection