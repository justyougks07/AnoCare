@extends('layouts.app')

@section('title','Data Obat')

@section('content')

<div class="min-h-screen bg-slate-50 py-10">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Data Obat
            </h1>
            <p class="text-slate-500 mt-1">
                Kelola seluruh stok obat klinik.
            </p>
        </div>

        {{-- ✅ BUTTON AREA --}}
        <div class="flex gap-3">

            <a href="{{ route('medicines.editAllStock') }}"
               class="bg-amber-500 hover:bg-amber-600 text-white px-5 py-3 rounded-xl shadow-sm font-medium transition">
                Update Semua Stok
            </a>

            <a href="{{ route('medicines.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow-sm font-medium transition">
                + Tambah Obat
            </a>

        </div>

    </div>

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl">
            {{ session('success') }}
        </div>
    @endif


    {{-- TABLE CARD --}}
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="text-lg font-semibold text-slate-800">
                Daftar Obat
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">

                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Stok</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Harga</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                @forelse($medicines as $medicine)

                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-5 font-semibold">
                            {{ $medicine->name }}
                        </td>

                        <td class="px-6 py-5">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $medicine->stock > 10
                                ? 'bg-emerald-100 text-emerald-700'
                                : 'bg-red-100 text-red-700' }}">
                                {{ $medicine->stock }}
                            </span>
                        </td>

                        <td class="px-6 py-5">
                            Rp {{ number_format($medicine->price,0,',','.') }}
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex gap-4 text-sm font-medium">

                                <a href="{{ route('medicines.edit',$medicine) }}"
                                   class="text-amber-600 hover:text-amber-800">
                                    Edit
                                </a>

                                <form action="{{ route('medicines.destroy',$medicine) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Hapus obat?')"
                                        class="text-red-600 hover:text-red-800">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center py-16">

                            <div class="flex flex-col items-center">

                                <div class="text-5xl mb-4">💊</div>

                                <h3 class="font-semibold text-lg text-slate-700">
                                    Belum ada data obat
                                </h3>

                                <p class="text-slate-500 mb-5">
                                    Tambahkan obat pertama.
                                </p>

                                <a href="{{ route('medicines.create') }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl">
                                    Tambah Obat
                                </a>

                            </div>

                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>
</div>

@endsection