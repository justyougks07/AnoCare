@extends('layouts.app')

@section('title','Edit Obat')

@section('content')

<div class="max-w-3xl mx-auto px-6 py-8">

    <div class="bg-white p-8 rounded-2xl shadow border">

        <h1 class="text-xl font-bold mb-6">
            Edit Obat
        </h1>

        <form method="POST"
            action="{{ route('medicines.update',$medicine->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Nama Obat</label>
                <input type="text" name="name"
                    value="{{ $medicine->name }}"
                    class="w-full border rounded-xl p-3">
            </div>

            <div class="mb-4">
                <label>Stok</label>
                <input type="number" name="stock"
                    value="{{ $medicine->stock }}"
                    class="w-full border rounded-xl p-3">
            </div>

            <div class="mb-4">
    <label>Jenis Obat</label>

    <select name="type" class="w-full border rounded-xl p-3">

        <option value="tablet" {{ $medicine->type=='tablet'?'selected':'' }}>Tablet</option>
        <option value="sirup" {{ $medicine->type=='sirup'?'selected':'' }}>Sirup</option>
        <option value="kapsul" {{ $medicine->type=='kapsul'?'selected':'' }}>Kapsul</option>
        <option value="salep" {{ $medicine->type=='salep'?'selected':'' }}>Salep</option>
        <option value="injeksi" {{ $medicine->type=='injeksi'?'selected':'' }}>Injeksi</option>

    </select>
</div>

            <div class="mb-6">
                <label>Harga</label>
                <input type="number" name="price"
                    value="{{ $medicine->price }}"
                    class="w-full border rounded-xl p-3">
            </div>

            <button class="bg-blue-600 text-white px-6 py-2 rounded-xl">
                Update
            </button>

        </form>

    </div>

</div>

@endsection