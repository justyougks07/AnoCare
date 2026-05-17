@extends('layouts.app')

@section('title', 'Edit Pasien')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edit Data Pasien</h1>
            <p class="text-sm text-gray-500 mb-4">Nomor RM: <span class="font-mono">{{ $patient->medical_record_number }}</span></p>
            
            <form action="{{ route('patients.update', $patient) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name', $patient->name) }}" 
                               class="w-full px-3 py-2 border rounded-lg @error('name') border-red-500 @enderror">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No HP *</label>
                        <input type="tel" name="phone" value="{{ old('phone', $patient->phone) }}"
                               class="w-full px-3 py-2 border rounded-lg @error('phone') border-red-500 @enderror">
                        @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full px-3 py-2 border rounded-lg">
                            <option value="active" {{ old('status', $patient->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status', $patient->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat *</label>
                    <textarea name="address" rows="3" 
                              class="w-full px-3 py-2 border rounded-lg @error('address') border-red-500 @enderror">{{ old('address', $patient->address) }}</textarea>
                    @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Riwayat Penyakit</label>
                    <textarea name="medical_history" rows="2" 
                              class="w-full px-3 py-2 border rounded-lg"
                              placeholder="Contoh: Hipertensi, diabetes, alergi obat...">{{ old('medical_history', $patient->medical_history) }}</textarea>
                </div>
                
                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('patients.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection