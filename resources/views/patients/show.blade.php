@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            
            {{-- Header --}}
            <div class="bg-blue-500 px-6 py-4">
                <h1 class="text-xl font-bold text-white">🩺 Detail Pasien</h1>
            </div>
            
            {{-- Info Pasien --}}
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Nomor Rekam Medis</p>
                        <p class="font-mono font-semibold">{{ $patient->medical_record_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <span class="px-2 py-1 text-xs rounded-full 
                            {{ $patient->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $patient->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                        <p class="font-semibold">{{ $patient->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">NIK</p>
                        <p>{{ $patient->nik }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">No HP</p>
                        <p>{{ $patient->phone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Lahir</p>
                        <p>{{ \Carbon\Carbon::parse($patient->birth_date)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                        <p>{{ $patient->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Golongan Darah</p>
                        <p>{{ $patient->blood_type ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p>{{ $patient->address }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500">Riwayat Penyakit</p>
                        <p>{{ $patient->medical_history ?? 'Tidak ada riwayat penyakit' }}</p>
                    </div>
                </div>
            </div>
            
            {{-- Tombol Aksi --}}
            <div class="bg-gray-50 px-6 py-4 flex justify-end gap-2">
                <a href="{{ route('patients.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    Kembali
                </a>
                <a href="{{ route('patients.edit', $patient) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg">
                    Edit Data
                </a>
            </div>
        </div>
    </div>
</div>
@endsection