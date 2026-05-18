@extends('layouts.app')

@section('title', 'Edit Data Pasien')

@section('content')

<div class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>

                    <h1 class="text-3xl font-bold text-slate-800">
                        Edit Data Pasien
                    </h1>

                    <p class="text-slate-500 mt-2">
                        Perbarui informasi pasien dalam sistem AnoCare.
                    </p>

                </div>

                <div class="bg-white border border-slate-200 rounded-2xl px-5 py-3 shadow-sm">

                    <p class="text-xs text-slate-500 uppercase tracking-wide">
                        Nomor Rekam Medis
                    </p>

                    <p class="font-semibold text-slate-800 mt-1">
                        {{ $patient->medical_record_number }}
                    </p>

                </div>

            </div>

        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

            {{-- Top --}}
            <div class="px-8 py-6 border-b border-slate-100 bg-gradient-to-r from-amber-50 to-slate-50">

                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-2xl shadow-sm">
                        ✏️
                    </div>

                    <div>

                        <h2 class="text-xl font-semibold text-slate-800">
                            Form Edit Pasien
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Pastikan data pasien diperbarui dengan benar.
                        </p>

                    </div>

                </div>

            </div>

            {{-- Form --}}
            <form action="{{ route('patients.update', $patient) }}" method="POST" class="p-8">

                @csrf
                @method('PUT')

                {{-- Section --}}
                <div class="mb-6">

                    <h3 class="text-lg font-semibold text-slate-800">
                        Informasi Pasien
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Data utama pasien yang dapat diperbarui.
                    </p>

                </div>

                {{-- Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Name --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $patient->name) }}"
                            placeholder="Masukkan nama lengkap"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition @error('name') border-red-500 @enderror"
                        >

                        @error('name')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Phone --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nomor HP
                        </label>

                        <input
                            type="tel"
                            name="phone"
                            value="{{ old('phone', $patient->phone) }}"
                            placeholder="08xxxxxxxxxx"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition @error('phone') border-red-500 @enderror"
                        >

                        @error('phone')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Status Pasien
                        </label>

                        <select
                            name="status"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                        >

                            <option value="active"
                                {{ old('status', $patient->status) == 'active' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="inactive"
                                {{ old('status', $patient->status) == 'inactive' ? 'selected' : '' }}>
                                Tidak Aktif
                            </option>

                        </select>

                    </div>

                </div>

                {{-- Address --}}
                <div class="mt-8">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Alamat
                    </label>

                    <textarea
                        name="address"
                        rows="4"
                        placeholder="Masukkan alamat lengkap pasien"
                        class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition resize-none @error('address') border-red-500 @enderror"
                    >{{ old('address', $patient->address) }}</textarea>

                    @error('address')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Medical --}}
                <div class="mt-6">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Riwayat Penyakit
                    </label>

                    <textarea
                        name="medical_history"
                        rows="4"
                        placeholder="Contoh: Hipertensi, diabetes, alergi obat..."
                        class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition resize-none"
                    >{{ old('medical_history', $patient->medical_history) }}</textarea>

                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row justify-end gap-3 mt-10">

                    <a href="{{ route('patients.show', $patient) }}"
                       class="px-6 py-3 rounded-2xl border border-slate-200 text-slate-700 hover:bg-slate-100 transition text-center font-medium">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="px-6 py-3 rounded-2xl bg-amber-500 hover:bg-amber-600 text-white font-medium shadow-sm transition"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection