@extends('layouts.app')

@section('title','Tambah Obat')

@section('content')

<div class="max-w-3xl mx-auto px-6 py-8">

    <div class="bg-white p-8 rounded-2xl shadow border">

        <h1 class="text-xl font-bold mb-6">
            Tambah Obat
        </h1>

        <form method="POST" action="{{ route('medicines.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-2">Nama Obat</label>
                <input type="text" name="name"
                    class="w-full border rounded-xl p-3">
            </div>

            <div class="mb-4">
                <label class="block mb-2">Stok</label>
                <input type="number" name="stock"
                    class="w-full border rounded-xl p-3">
            </div>
            <div class="mb-4">
    <label class="block mb-2">Jenis Obat</label>

    <select name="type"
        class="w-full border rounded-xl p-3">

        <option value="tablet">Tablet</option>
        <option value="sirup">Sirup</option>
        <option value="kapsul">Kapsul</option>
        <option value="salep">Salep</option>
        <option value="injeksi">Injeksi</option>

    </select>
</div>

            <div class="mb-6">
                <label class="block mb-2">Harga</label>
                <input type="number" name="price"
                    class="w-full border rounded-xl p-3">
            </div>

            <button class="bg-blue-600 text-white px-6 py-2 rounded-xl">
                Simpan
            </button>

        </form>

    </div>

</div>

@endsection