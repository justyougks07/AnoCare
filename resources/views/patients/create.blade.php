@extends('layouts.app')

@section('title', 'Registrasi Pasien Baru')

@section('content')

<div class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-800">
                Registrasi Pasien Baru
            </h1>

            <p class="text-slate-500 mt-2">
                Tambahkan data pasien baru ke dalam sistem klinik AnoCare.
            </p>

        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

            {{-- Top Section --}}
            <div class="px-8 py-6 border-b border-slate-100 bg-gradient-to-r from-blue-50 to-slate-50">

                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-2xl shadow-sm">
                        👨‍⚕️
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold text-slate-800">
                            Form Registrasi Pasien
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Pastikan seluruh informasi pasien diisi dengan benar.
                        </p>
                    </div>

                </div>

            </div>

            {{-- Form --}}
            <form action="{{ route('patients.store') }}" method="POST" class="p-8">

                @csrf

                {{-- Section Title --}}
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-slate-800">
                        Informasi Pasien
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Data identitas utama pasien.
                    </p>
                </div>

                {{-- Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Nama --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Masukkan nama lengkap"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('name') border-red-500 @enderror"
                        >

                        @error('name')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- NIK --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            NIK
                        </label>

                        <input
                            type="text"
                            name="nik"
                            maxlength="16"
                            value="{{ old('nik') }}"
                            placeholder="16 digit NIK"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('nik') border-red-500 @enderror"
                        >

                        @error('nik')
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
                            value="{{ old('phone') }}"
                            placeholder="08xxxxxxxxxx"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('phone') border-red-500 @enderror"
                        >

                        @error('phone')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Birth Date --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            name="birth_date"
                            value="{{ old('birth_date') }}"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('birth_date') border-red-500 @enderror"
                        >

                        @error('birth_date')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Jenis Kelamin
                        </label>

                        <select
                            name="gender"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        >
                            <option value="">Pilih Jenis Kelamin</option>

                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>
                                Laki-laki
                            </option>

                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>

                        @error('gender')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Blood --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Golongan Darah
                        </label>

                        <select
                            name="blood_type"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        >
                            <option value="">Pilih Golongan Darah</option>

                            <option value="A" {{ old('blood_type') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('blood_type') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="AB" {{ old('blood_type') == 'AB' ? 'selected' : '' }}>AB</option>
                            <option value="O" {{ old('blood_type') == 'O' ? 'selected' : '' }}>O</option>
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
                        class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none @error('address') border-red-500 @enderror"
                    >{{ old('address') }}</textarea>

                    @error('address')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Medical History --}}
                <div class="mt-6">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Riwayat Penyakit
                    </label>

                    <textarea
                        name="medical_history"
                        rows="4"
                        placeholder="Contoh: Hipertensi, diabetes, alergi obat, dan lain-lain..."
                        class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"
                    >{{ old('medical_history') }}</textarea>

                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row justify-end gap-3 mt-10">

                    <a href="{{ route('patients.index') }}"
                       class="px-6 py-3 rounded-2xl border border-slate-200 text-slate-700 hover:bg-slate-100 transition text-center font-medium">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-medium shadow-sm transition"
                    >
                        Simpan Pasien
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection