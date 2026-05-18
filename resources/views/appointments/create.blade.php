@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-lg">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="bg-indigo-600 px-6 py-4">
            <h2 class="text-lg font-bold text-white">Form Booking Janji Temu</h2>
            <p class="text-xs text-indigo-100">Silakan pilih dokter dan sesi jadwal praktik yang tersedia.</p>
        </div>

        <form action="{{ route('appointments.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Pasien</label>
                <select name="patient_id" class="w-full border rounded-lg p-2 text-sm focus:border-indigo-500 focus:outline-none" required>
                    <option value="">-- Pilih Pasien --</option>
                    @foreach($patients as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                    <option value="1">Pasien Simulasi Kelompok #1</option> </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Dokter Tujuan</label>
                <select name="dokter_id" id="dokter_id" class="w-full border rounded-lg p-2 text-sm focus:border-indigo-500 focus:outline-none" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokters as $doc)
                        <option value="{{ $doc->id }}">dr. {{ $doc->nama_dokter }} ({{ $doc->spesialisasi }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Jadwal Sesi Praktik</label>
                <select name="jadwal_id" id="jadwal_id" class="w-full border rounded-lg p-2 text-sm bg-gray-50 focus:border-indigo-500 focus:outline-none" required disabled>
                    <option value="">Silakan pilih dokter terlebih dahulu</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Keluhan Medis</label>
                <textarea name="keluhan" rows="3" class="w-full border rounded-lg p-2 text-sm focus:border-indigo-500 focus:outline-none" placeholder="Tuliskan gejala atau keluhan singkat pasien..."></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('appointments.index') }}" class="px-4 py-2 border rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium shadow-sm">Simpan Booking</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('dokter_id').addEventListener('change', function() {
    const dokterId = this.value;
    const jadwalSelect = document.getElementById('jadwal_id');
    
    jadwalSelect.innerHTML = '<option value="">-- Memuat Jadwal... --</option>';
    jadwalSelect.disabled = true;
    jadwalSelect.classList.add('bg-gray-50');

    if (!dokterId) {
        jadwalSelect.innerHTML = '<option value="">Silakan pilih dokter terlebih dahulu</option>';
        return;
    }

    fetch(`/api/doctors/${dokterId}/schedules`)
        .then(response => response.json())
        .then(data => {
            jadwalSelect.innerHTML = '<option value="">-- Pilih Sesi Jadwal --</option>';
            if(data.length === 0) {
                jadwalSelect.innerHTML = '<option value="">Tidak ada jadwal aktif tersedia</option>';
                return;
            }
            data.forEach(j => {
                const opsi = document.createElement('option');
                opsi.value = j.id;
                opsi.textContent = `${j.tanggal} | Jam: ${j.jam_mulai.substring(0,5)} - ${j.jam_selesai.substring(0,5)} (Sisa Kuota: ${j.kuota - j.pasien_terdaftar})`;
                jadwalSelect.appendChild(opsi);
            });
            jadwalSelect.disabled = false;
            jadwalSelect.classList.remove('bg-gray-50');
        });
});
</script>
@endsection