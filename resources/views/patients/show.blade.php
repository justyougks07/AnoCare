@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('content')

<div class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>

                <h1 class="text-3xl font-bold text-slate-800">
                    Detail Pasien
                </h1>

                <p class="text-slate-500 mt-2">
                    Informasi lengkap data pasien klinik.
                </p>

            </div>

            <div class="flex items-center gap-3">

                <a href="{{ route('patients.index') }}"
                   class="px-5 py-3 rounded-2xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 font-medium transition">
                    Kembali
                </a>

                <a href="{{ route('patients.edit', $patient) }}"
                   class="px-5 py-3 rounded-2xl bg-amber-500 hover:bg-amber-600 text-white font-medium shadow-sm transition">
                    Edit Data
                </a>

            </div>

        </div>

        {{-- Main Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

            {{-- Top Profile --}}
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-8 py-8">

                <div class="flex flex-col md:flex-row md:items-center gap-6">

                    {{-- Avatar --}}
                    <div class="w-24 h-24 rounded-3xl bg-white/20 backdrop-blur flex items-center justify-center text-white text-4xl font-bold shadow-sm">
                        {{ strtoupper(substr($patient->name, 0, 1)) }}
                    </div>

                    {{-- Name --}}
                    <div class="text-white">

                        <div class="flex items-center gap-3 flex-wrap">

                            <h2 class="text-3xl font-bold">
                                {{ $patient->name }}
                            </h2>

                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $patient->status == 'active'
                                    ? 'bg-emerald-100 text-emerald-700'
                                    : 'bg-red-100 text-red-700' }}">
                                {{ $patient->status == 'active' ? 'Aktif' : 'Nonaktif' }}
                            </span>

                        </div>

                        <p class="mt-2 text-blue-100">
                            Nomor Rekam Medis:
                            <span class="font-semibold text-white">
                                {{ $patient->medical_record_number }}
                            </span>
                        </p>

                    </div>

                </div>

            </div>

            {{-- Content --}}
            <div class="p-8">

                {{-- Information Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- NIK --}}
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">

                        <p class="text-sm text-slate-500 mb-2">
                            NIK
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $patient->nik }}
                        </p>

                    </div>

                    {{-- Phone --}}
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">

                        <p class="text-sm text-slate-500 mb-2">
                            Nomor HP
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $patient->phone }}
                        </p>

                    </div>

                    {{-- Birth --}}
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">

                        <p class="text-sm text-slate-500 mb-2">
                            Tanggal Lahir
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ \Carbon\Carbon::parse($patient->birth_date)->format('d F Y') }}
                        </p>

                    </div>

                    {{-- Gender --}}
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">

                        <p class="text-sm text-slate-500 mb-2">
                            Jenis Kelamin
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $patient->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </p>

                    </div>

                    {{-- Blood --}}
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">

                        <p class="text-sm text-slate-500 mb-2">
                            Golongan Darah
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $patient->blood_type ?? '-' }}
                        </p>

                    </div>

                    {{-- Status --}}
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">

                        <p class="text-sm text-slate-500 mb-2">
                            Status Pasien
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $patient->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                        </p>

                    </div>

                </div>

                {{-- Address --}}
                <div class="mt-8">

                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">

                        <h3 class="text-lg font-semibold text-slate-800 mb-4">
                            Alamat
                        </h3>

                        <p class="text-slate-600 leading-relaxed">
                            {{ $patient->address }}
                        </p>

                    </div>

                </div>

                {{-- Medical History --}}
                <div class="mt-6">

                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">

                        <h3 class="text-lg font-semibold text-slate-800 mb-4">
                            Riwayat Penyakit
                        </h3>

                        <p class="text-slate-600 leading-relaxed">
                            {{ $patient->medical_history ?? 'Tidak ada riwayat penyakit yang tercatat.' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection