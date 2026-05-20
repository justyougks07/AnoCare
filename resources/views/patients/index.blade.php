@extends('layouts.app')

@section('content')
<div class="min-h-screen pb-12">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8 animate-fade-in">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-800 to-blue-700 bg-clip-text text-transparent">
                👥 Daftar Pasien
            </h1>
            <p class="text-slate-600 mt-2">
                Kelola seluruh data pasien klinik dengan mudah dan efisien.
            </p>
        </div>

        <a href="{{ route('patients.create') }}"
           class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl shadow-soft-lg hover:shadow-glow-blue transition-all duration-300 font-semibold">
            <span class="text-lg">➕</span>
            Pasien Baru
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 font-medium flex items-center gap-2 animate-slide-up">
            <span>✓</span>
            {{ session('success') }}
        </div>
    @endif

    {{-- Search Card --}}
    <div class="bg-white rounded-2xl shadow-soft border border-slate-100 p-6 mb-6 hover:shadow-soft-lg transition-all duration-300">
        <form action="{{ route('patients.search') }}" method="GET">
            <div class="flex flex-col md:flex-row gap-3">

                <div class="flex-1">
                    <input
                        type="text"
                        name="search"
                        placeholder="🔍 Cari nama, NIK, atau no rekam medis..."
                        value="{{ request('search') }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 shadow-soft"
                    >
                </div>

                <button type="submit"
                    class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-semibold shadow-soft-lg hover:shadow-glow-blue transition-all duration-300">
                    Cari
                </button>

                @if(request('search'))
                    <a href="{{ route('patients.index') }}"
                       class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-6 py-3 rounded-xl font-semibold text-center transition-all duration-300">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-2xl shadow-soft border border-slate-100 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-blue-50 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    📋 Data Pasien
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Total {{ count($patients) }} data pasien terdaftar.
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-slate-100 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">
                            No RM
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">
                            Nama
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">
                            NIK
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">
                            No HP
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($patients as $patient)
                        <tr class="hover:bg-blue-50/50 transition-colors duration-300 group">

                            <td class="px-6 py-4 text-sm font-mono text-slate-600 font-semibold">
                                {{ $patient->medical_record_number ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 group-hover:text-blue-700 transition-colors">
                                    {{ $patient->name }}
                                </div>
                                <div class="text-xs text-slate-500">
                                    {{ $patient->gender ?? '-' }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                <code class="text-xs bg-slate-100 px-2 py-1 rounded">{{ $patient->nik }}</code>
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                <a href="tel:{{ $patient->phone }}" class="hover:text-blue-600 transition-colors">
                                    {{ $patient->phone }}
                                </a>
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold gap-1
                                    {{ $patient->status == 'active'
                                        ? 'bg-emerald-100 text-emerald-700'
                                        : 'bg-red-100 text-red-700' }}">
                                    <span class="w-2 h-2 rounded-full {{ $patient->status == 'active' ? 'bg-emerald-700' : 'bg-red-700' }}"></span>
                                    {{ $patient->status == 'active' ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 text-sm font-medium">

                                    <a href="{{ route('patients.show', $patient) }}"
                                       class="text-blue-600 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">
                                        👁️ Lihat
                                    </a>

                                    <a href="{{ route('patients.edit', $patient) }}"
                                       class="text-amber-600 hover:bg-amber-100 px-3 py-1 rounded-lg transition-colors">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('patients.destroy', $patient) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-600 hover:bg-red-100 px-3 py-1 rounded-lg transition-colors"
                                                onclick="return confirm('Yakin hapus data pasien ini?')">
                                            🗑️ Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @empty

                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">
                                    <div class="text-7xl mb-4">
                                        🩺
                                    </div>

                                    <h3 class="text-xl font-bold text-slate-800 mb-2">
                                        Belum ada data pasien
                                    </h3>

                                    <p class="text-slate-500 mb-6 max-w-md">
                                        Tambahkan pasien pertama untuk mulai mengelola data klinik Anda dengan sistem AnoCare.
                                    </p>

                                    <a href="{{ route('patients.create') }}"
                                       class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-semibold shadow-soft-lg hover:shadow-glow-blue transition-all duration-300">
                                        ➕ Tambah Pasien Pertama
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