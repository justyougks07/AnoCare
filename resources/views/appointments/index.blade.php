@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kalender Antrian Klinik</h1>
        <a href="{{ route('appointments.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 font-medium text-sm">+ Tambah Booking</a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-lg mb-6 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm font-medium">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mb-6 max-w-xs">
        <form action="{{ route('appointments.index') }}" method="GET" class="flex items-center gap-3">
            <label class="text-sm font-semibold text-gray-600">Tanggal:</label>
            <input type="date" name="date" value="{{ $tanggal }}" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm text-gray-700 focus:outline-none focus:border-indigo-500">
        </form>
    </div>

    @forelse($groupedQueues as $namaDokter => $daftarAntrian)
        <div class="mb-8 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-indigo-50 px-6 py-4 border-b border-indigo-100 flex justify-between items-center">
                <h2 class="text-md font-bold text-indigo-900">dr. {{ $namaDokter }}</h2>
                <span class="text-xs bg-indigo-200 text-indigo-800 px-2.5 py-1 rounded-full font-semibold">
                    {{ $daftarAntrian->count() }} Pasien Terdaftar
                </span>
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase">
                        <th class="px-6 py-3 w-28">No. Antrian</th>
                        <th class="px-6 py-3">Nama Pasien</th>
                        <th class="px-6 py-3">Jam Registrasi</th>
                        <th class="px-6 py-3">Status Antrian</th>
                        <th class="px-6 py-3 text-center">Manajemen Antrian</th>
                        <th class="px-6 py-3 text-right">Aksi Data (CRUD)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @foreach($daftarAntrian as $antrian)
                    <tr class="{{ $antrian->status == 'sedang_dilayani' ? 'bg-purple-50/50' : '' }} hover:bg-gray-50/80">
                        <td class="px-6 py-4 font-bold text-lg text-indigo-600">#{{ $antrian->nomor_antrian }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $antrian->appointment->patient->nama ?? 'Pasien Pasien (ID: '.$antrian->patient_id.')' }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ \Carbon\Carbon::parse($antrian->waktu_masuk)->format('H:i') }} WIB</td>
                        <td class="px-6 py-4">
                            @if($antrian->status == 'menunggu')
                                <span class="px-2.5 py-1 bg-amber-50 text-amber-700 rounded-full text-xs font-medium border border-amber-200">Menunggu</span>
                            @elseif($antrian->status == 'dipanggil')
                                <span class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-medium border border-blue-200">Dipanggil</span>
                            @elseif($antrian->status == 'sedang_dilayani')
                                <span class="px-2.5 py-1 bg-purple-50 text-purple-700 rounded-full text-xs font-medium border border-purple-200">Diperiksa</span>
                            @else
                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-medium border border-emerald-200">Selesai</span>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 text-center">
                            @if($antrian->status == 'menunggu')
                                <form action="{{ route('appointments.queue.update', $antrian->id) }}" method="POST" class="inline">
                                    @csrf @method('PATCH') <input type="hidden" name="status" value="dipanggil">
                                    <button class="bg-blue-600 text-white px-3 py-1 rounded-md text-xs font-medium hover:bg-blue-700 shadow-sm">Panggil</button>
                                </form>
                            @elseif($antrian->status == 'dipanggil')
                                <form action="{{ route('appointments.queue.update', $antrian->id) }}" method="POST" class="inline">
                                    @csrf @method('PATCH') <input type="hidden" name="status" value="sedang_dilayani">
                                    <button class="bg-purple-600 text-white px-3 py-1 rounded-md text-xs font-medium hover:bg-purple-700 shadow-sm">Mulai Periksa</button>
                                </form>
                            @elseif($antrian->status == 'sedang_dilayani')
                                <form action="{{ route('appointments.queue.update', $antrian->id) }}" method="POST" class="inline">
                                    @csrf @method('PATCH') <input type="hidden" name="status" value="selesai">
                                    <button class="bg-emerald-600 text-white px-3 py-1 rounded-md text-xs font-medium hover:bg-emerald-700 shadow-sm">Selesai</button>
                                </form>
                            @else
                                <span class="text-xs text-gray-400 italic">Selesai diproses</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-right space-x-1 whitespace-nowrap">
                            <a href="{{ route('appointments.show', $antrian->appointment_id) }}" class="text-indigo-600 hover:text-indigo-900 text-xs font-semibold border border-indigo-200 px-2.5 py-1 rounded hover:bg-indigo-50">Detail</a>
                            <a href="{{ route('appointments.edit', $antrian->appointment_id) }}" class="text-amber-600 hover:text-amber-900 text-xs font-semibold border border-amber-200 px-2.5 py-1 rounded hover:bg-amber-50">Edit</a>
                            <a href="{{ route('appointments.delete', $antrian->appointment_id) }}" class="text-red-600 hover:text-red-900 text-xs font-semibold border border-red-200 px-2.5 py-1 rounded hover:bg-red-50">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @empty
        <div class="bg-white rounded-xl border border-dashed border-gray-300 py-12 text-center text-gray-400">
            Belum ada data janji temu atau antrian yang terdaftar untuk tanggal ini.
        </div>
    @endforelse
</div>
@endsection