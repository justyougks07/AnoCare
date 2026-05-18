@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.app')
@section('title', 'Analisis Gejala')
@section('content')

<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('patients.show', $patient->id) }}"
       class="p-2 bg-white border rounded-lg hover:bg-gray-50">
        <i class="ti ti-arrow-left"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Analisis Gejala</h1>
        <p class="text-gray-500">{{ $patient->name }} · {{ $patient->age }} tahun</p>
    </div>
</div>

<!-- Form input keluhan -->
<div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
    <h2 class="font-semibold text-gray-700 mb-3">Input Keluhan Pasien</h2>
    <form method="POST" action="{{ route('ai.symptom', $patient->id) }}">
        @csrf
        <textarea name="keluhan" rows="3" required
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
            placeholder="Contoh: sakit kepala sudah 2 hari, disertai demam dan mual..."></textarea>
        <button type="submit"
            class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
            <i class="ti ti-robot mr-1"></i> Analisis dengan AI
        </button>
    </form>
</div>

<!-- Hasil analisis AI -->
@isset($response)
<div class="bg-blue-50 border border-blue-200 rounded-xl overflow-hidden">
    <div class="bg-blue-600 px-6 py-3 flex items-center gap-2">
        <i class="ti ti-sparkles text-white text-lg"></i>
        <span class="text-white font-semibold text-sm uppercase tracking-wide">Hasil Analisis AI</span>
    </div>
    <div class="p-6">
        <article class="prose max-w-none
            prose-headings:text-blue-900 prose-headings:font-bold
            prose-p:text-gray-700 prose-p:leading-relaxed
            prose-li:text-gray-700 prose-strong:text-blue-800">
            {!! Str::markdown($response) !!}
        </article>
    </div>
</div>
<div class="mt-3 text-xs text-gray-400 italic">
    * Analisis ini bukan diagnosis medis. Selalu konsultasikan dengan dokter.
</div>
@endisset

@endsection