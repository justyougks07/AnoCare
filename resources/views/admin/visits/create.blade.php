@extends('layouts.app')

@section('title', 'Tambah Riwayat Kunjungan')

@section('content')
<div class="min-h-screen bg-slate-50 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-slate-800">Tambah Riwayat Kunjungan</h1>
                <p class="text-sm text-slate-500 mt-2">Isi hasil diagnosis dan catatan kunjungan pasien.</p>
            </div>

            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-300 text-emerald-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('dokter.visits.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pasien</label>
                    <select name="patient_id" class="w-full border rounded-xl p-3 text-sm focus:border-blue-500 focus:ring-blue-100 focus:outline-none" required>
                        <option value="">Pilih pasien</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                {{ $patient->name }} - {{ $patient->medical_history ?? 'Riwayat medis belum tersedia' }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('patient_id')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Kunjungan</label>
                        <input type="date" name="visit_date" value="{{ old('visit_date') }}" class="w-full border rounded-xl p-3 text-sm focus:border-blue-500 focus:ring-blue-100 focus:outline-none" required>
                        <x-input-error :messages="$errors->get('visit_date')" class="mt-2" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Diagnosis Singkat</label>
                        <input type="text" name="diagnosis" value="{{ old('diagnosis') }}" placeholder="Contoh: Infeksi saluran pernapasan" class="w-full border rounded-xl p-3 text-sm focus:border-blue-500 focus:ring-blue-100 focus:outline-none" required>
                        <x-input-error :messages="$errors->get('diagnosis')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Catatan Tambahan</label>
                    <textarea name="notes" rows="4" class="w-full border rounded-xl p-3 text-sm focus:border-blue-500 focus:ring-blue-100 focus:outline-none" placeholder="Tulis catatan perawatan atau saran pasien.">{{ old('notes') }}</textarea>
                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-between gap-3 pt-3">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">Kembali ke Dashboard</a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition">Simpan Riwayat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
