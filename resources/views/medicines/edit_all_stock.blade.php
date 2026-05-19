@extends('layouts.app')

@section('title','Update Semua Stok')

@section('content')

<div class="min-h-screen bg-slate-50 py-10">

<div class="max-w-5xl mx-auto px-6">

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200">

        <div class="px-8 py-6 border-b">
            <h1 class="text-2xl font-bold">
                Update Semua Stok Obat
            </h1>
            <p class="text-slate-500">
                Sinkronisasi stok seluruh obat sekaligus.
            </p>
        </div>

        <form action="{{ route('medicines.updateAllStock') }}" method="POST">
            @csrf

            <div class="overflow-x-auto">
                <table class="min-w-full">

                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm">Nama Obat</th>
                            <th class="px-6 py-4 text-left text-sm">Stok Saat Ini</th>
                            <th class="px-6 py-4 text-left text-sm">Stok Baru</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @foreach($medicines as $medicine)
                        <tr>
                            <td class="px-6 py-4 font-semibold">
                                {{ $medicine->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $medicine->stock }}
                            </td>

                            <td class="px-6 py-4">
                                <input
                                    type="number"
                                    name="stocks[{{ $medicine->id }}]"
                                    value="{{ $medicine->stock }}"
                                    class="w-32 border rounded-xl p-2"
                                    required>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="flex justify-end gap-3 px-8 py-6 border-t">

                <a href="{{ route('medicines.index') }}"
                   class="px-5 py-2 rounded-xl border">
                    Batal
                </a>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl">
                    Simpan Semua Stok
                </button>

            </div>

        </form>

    </div>

</div>
</div>

@endsection