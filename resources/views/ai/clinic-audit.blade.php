@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app')
@section('title', 'Audit Klinik AI')
@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        <i class="ti ti-chart-bar mr-2 text-indigo-600"></i>Audit Klinik
    </h1>
    <p class="text-gray-500 mt-1">Laporan statistik dan insight dari AI</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Statistik mentah -->
    <div class="lg:col-span-1">
        <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
            <i class="ti ti-list"></i> Data Statistik
        </h3>
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-4 py-3 text-left">Diagnosis</th>
                        <th class="px-4 py-3 text-center">Kasus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats as $s)
                    <tr class="border-t border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-700">{{ $s->diagnosis }}</td>
                        <td class="px-4 py-3 text-center font-bold text-gray-800">{{ $s->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Insight AI -->
    <div class="lg:col-span-2">
        <div class="bg-indigo-50 border border-indigo-200 rounded-xl overflow-hidden">
            <div class="bg-indigo-600 px-6 py-3 flex items-center gap-2">
                <i class="ti ti-magic-wand text-white text-lg"></i>
                <span class="text-white font-semibold text-sm uppercase tracking-wide">AI Academic Insight</span>
            </div>
            <div class="p-6">
                <article class="prose max-w-none
                    prose-headings:text-indigo-900 prose-headings:font-bold
                    prose-p:text-gray-700 prose-strong:text-indigo-700
                    prose-ul:list-disc prose-ul:ml-5">
                    {!! Str::markdown($insight) !!}
                </article>
            </div>
        </div>
    </div>

</div>
@endsection