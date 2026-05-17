@extends('layouts.app')

@section('title', 'Registrasi Pasien Baru')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">➕ Registrasi Pasien Baru</h1>
            
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                               class="w-full px-3 py-2 border rounded-lg @error('name') border-red-500 @enderror">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    {{-- NIK --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIK (16 digit) *</label>
                        <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16"
                               class="w-full px-3 py-2 border rounded-lg @error('nik') border-red-500 @enderror">
                        @error('nik') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    {{-- No HP --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No HP *</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                               class="w-full px-3 py-2 border rounded-lg @error('phone') border-red-500 @enderror">
                        @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir *</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                               class="w-full px-3 py-2 border rounded-lg @error('birth_date') border-red-500 @enderror">
                        @error('birth_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin *</label>
                        <select name="gender" class="w-full px-3 py-2 border rounded-lg">
                            <option value="">Pilih</option>
                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    {{-- Golongan Darah --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                        <select name="blood_type" class="w-full px-3 py-2 border rounded-lg">
                            <option value="">Pilih</option>
                            <option value="A" {{ old('blood_type') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('blood_type') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="AB" {{ old('blood_type') == 'AB' ? 'selected' : '' }}>AB</option>
                            <option value="O" {{ old('blood_type') == 'O' ? 'selected' : '' }}>O</option>
                        </select>
                    </div>
                </div>
                
                {{-- Alamat --}}
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat *</label>
                    <textarea name="address" rows="3" 
                              class="w-full px-3 py-2 border rounded-lg @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                    @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                {{-- Riwayat Penyakit --}}
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Riwayat Penyakit</label>
                    <textarea name="medical_history" rows="2" 
                              class="w-full px-3 py-2 border rounded-lg"
                              placeholder="Contoh: Hipertensi, diabetes, alergi obat...">{{ old('medical_history') }}</textarea>
                </div>
                
                {{-- Tombol --}}
                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('patients.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Simpan Pasien
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection