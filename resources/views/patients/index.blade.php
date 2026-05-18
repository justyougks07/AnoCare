@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">
                    Daftar Pasien
                </h1>
                <p class="text-slate-500 mt-1">
                    Kelola seluruh data pasien klinik dengan mudah.
                </p>
            </div>

            <a href="{{ route('patients.create') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow-sm transition-all duration-200 font-medium">
                <span class="text-lg">+</span>
                Pasien Baru
            </a>
        </div>

        {{-- Success Alert --}}
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- Search Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 mb-6">
            <form action="{{ route('patients.search') }}" method="GET">
                <div class="flex flex-col md:flex-row gap-3">

                    <div class="flex-1">
                        <input
                            type="text"
                            name="search"
                            placeholder="Cari nama pasien, NIK, atau nomor rekam medis..."
                            value="{{ request('search') }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>

                    <button type="submit"
                        class="bg-slate-800 hover:bg-slate-900 text-white px-6 py-3 rounded-xl font-medium transition">
                        Cari
                    </button>

                    @if(request('search'))
                        <a href="{{ route('patients.index') }}"
                           class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl font-medium text-center transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-800">
                        Data Pasien
                    </h2>
                    <p class="text-sm text-slate-500">
                        Total data pasien terdaftar.
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                No RM
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Nama
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                NIK
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                No HP
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse($patients as $patient)
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-5 text-sm font-mono text-slate-700">
                                {{ $patient->medical_record_number ?? '-' }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="font-semibold text-slate-800">
                                    {{ $patient->name }}
                                </div>
                            </td>

                            <td class="px-6 py-5 text-slate-600">
                                {{ $patient->nik }}
                            </td>

                            <td class="px-6 py-5 text-slate-600">
                                {{ $patient->phone }}
                            </td>

                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $patient->status == 'active'
                                        ? 'bg-emerald-100 text-emerald-700'
                                        : 'bg-red-100 text-red-700' }}">
                                    {{ $patient->status == 'active' ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3 text-sm font-medium">

                                    <a href="{{ route('patients.show', $patient) }}"
                                       class="text-blue-600 hover:text-blue-800 transition">
                                        Detail
                                    </a>

                                    <a href="{{ route('patients.edit', $patient) }}"
                                       class="text-amber-600 hover:text-amber-800 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('patients.destroy', $patient) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 transition"
                                                onclick="return confirm('Yakin hapus data pasien ini?')">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @empty

                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">
                                    <div class="text-5xl mb-4">
                                        🩺
                                    </div>

                                    <h3 class="text-lg font-semibold text-slate-700 mb-1">
                                        Belum ada data pasien
                                    </h3>

                                    <p class="text-slate-500 mb-5">
                                        Tambahkan pasien pertama untuk mulai mengelola data klinik.
                                    </p>

                                    <a href="{{ route('patients.create') }}"
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-medium transition">
                                        Tambah Pasien
                                    </a>
                                </div>

                            </td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $patients->links() }}
        </div>

    </div>
</div>
@endsection