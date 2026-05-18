@extends('layouts.app')

@section('title','Resep Obat')

@section('content')

<div class="min-h-screen bg-slate-50 py-10">

<div class="max-w-3xl mx-auto px-4">

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">

        <h1 class="text-2xl font-bold mb-6">
            Berikan Resep Obat
        </h1>

        <form action="{{ route('medicines.reduceStock') }}" method="POST">
            @csrf

            {{-- Pilih Obat --}}
            <div class="mb-6">
                <label class="block mb-2 font-medium">
                    Pilih Obat
                </label>

                <select name="medicine_id"
                    class="w-full border rounded-xl p-3" required>

                    <option value="">-- Pilih Obat --</option>

                    @foreach($medicines as $medicine)
                        <option value="{{ $medicine->id }}">
                            {{ $medicine->name }}
                            (Sisa: {{ $medicine->stock }})
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Jumlah --}}
            <div class="mb-6">
                <label class="block mb-2 font-medium">
                    Jumlah Diberikan
                </label>

                <input type="number"
                       name="quantity"
                       min="1"
                       required
                       class="w-full border rounded-xl p-3">
            </div>

            <div class="flex gap-3">

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium">
                    Proses Resep
                </button>

                <a href="{{ route('medicines.index') }}"
                   class="bg-slate-200 hover:bg-slate-300 px-6 py-3 rounded-xl">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>
</div>

@endsection