<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Appointment;
use App\Models\Antrian;
use App\Models\Visit;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil Akun Dokter dari UserSeeder (Dr. Gabriel)
        $userDokter = User::where('role', 'dokter')->first();

        // Fallback aman jika UserSeeder belum dieksekusi di lokal
        if (!$userDokter) {
            $userDokter = User::create([
                'name'     => 'Dr. Gabriel',
                'email'    => 'dokter@example.com',
                'password' => bcrypt('password'),
                'role'     => 'dokter',
            ]);
        }

        // 2. Daftarkan Dokter ke tabel dokters (Modul Kamu)
        $dokter = Dokter::create([
            'user_id' => $userDokter->id,
            'nama_dokter' => 'Gabriel', 
            'spesialisasi' => 'Spesialis Umum',
            'no_telepon' => '081223344556',
            'alamat_praktek' => 'Ruang Poli Umum, Ruang 03 AnoCare',
            'is_active' => true,
        ]);

        // 3. Buat Jadwal Praktik Hari Ini untuk dr. Gabriel
        $jadwal = Jadwal::create([
            'dokter_id' => $dokter->id,
            'tanggal' => Carbon::today()->toDateString(),
            'jam_mulai' => '09:00:00',
            'jam_selesai' => '13:00:00',
            'kuota' => 10,
            'pasien_terdaftar' => 3, 
            'status' => 'aktif',
        ]);

        // 4. Ambil Data Pasien Riil dari PatientSeeder milik Anggota 2
        $pasienWanda = Patient::where('name', 'Wanda Remalia')->first();
        $pasienSiti  = Patient::where('name', 'Siti Aminah')->first();
        $pasienAhmad = Patient::where('name', 'Ahmad Wijaya')->first();

        // ==========================================
        // SKENARIO DEMO PASIEN 1: WANDA (STATUS: SELESAI)
        // ==========================================
        if ($pasienWanda) {
            $app1 = Appointment::create([
                'patient_id' => $pasienWanda->id, 
                'dokter_id' => $dokter->id,
                'jadwal_id' => $jadwal->id,
                'tanggal_kunjungan' => $jadwal->tanggal,
                'jam_kunjungan' => '09:15:00',
                'keluhan' => 'Pasien mengeluhkan pusing berputar dan mual.',
                'status' => 'selesai',
                'catatan_dokter' => 'Diberikan obat Betahistine mesylate. Istirahat 2 hari.'
            ]);

            Antrian::create([
                'appointment_id' => $app1->id,
                'patient_id' => $pasienWanda->id,
                'dokter_id' => $dokter->id,
                'nomor_antrian' => 1,
                'tanggal' => $jadwal->tanggal,
                'waktu_masuk' => '09:00:00',
                'waktu_panggil' => '09:15:00',
                'status' => 'selesai'
            ]);

            Visit::create([
                'patient_id' => $pasienWanda->id,
                'visit_date' => Carbon::today()->toDateString(),
                'diagnosis' => 'Vertigo',
                'notes' => 'Diberikan obat Betahistine mesylate. Istirahat 2 hari.',
            ]);
        }

        // ==========================================
        // SKENARIO DEMO PASIEN 2: SITI AMINAH (STATUS: SEDANG DIPERIKSA)
        // ==========================================
        if ($pasienSiti) {
            $app2 = Appointment::create([
                'patient_id' => $pasienSiti->id,
                'dokter_id' => $dokter->id,
                'jadwal_id' => $jadwal->id,
                'tanggal_kunjungan' => $jadwal->tanggal,
                'jam_kunjungan' => '09:45:00',
                'keluhan' => 'Sesak napas ringan (Riwayat Asma kumat semenjak hujan).',
                'status' => 'sedang_dilayani',
                'catatan_dokter' => null
            ]);

            Antrian::create([
                'appointment_id' => $app2->id,
                'patient_id' => $pasienSiti->id,
                'dokter_id' => $dokter->id,
                'nomor_antrian' => 2,
                'tanggal' => $jadwal->tanggal,
                'waktu_masuk' => '09:15:00',
                'waktu_panggil' => '09:46:00',
                'status' => 'sedang_dilayani'
            ]);

            Visit::create([
                'patient_id' => $pasienSiti->id,
                'visit_date' => Carbon::today()->toDateString(),
                'diagnosis' => 'Asma',
                'notes' => 'Pasien mengalami sesak napas ringan.',
            ]);
        }

        // ==========================================
        // SKENARIO DEMO PASIEN 3: AHMAD WIJAYA (STATUS: MENUNGGU)
        // ==========================================
        if ($pasienAhmad) {
            $app3 = Appointment::create([
                'patient_id' => $pasienAhmad->id,
                'dokter_id' => $dokter->id,
                'jadwal_id' => $jadwal->id,
                'tanggal_kunjungan' => $jadwal->tanggal,
                'jam_kunjungan' => '10:15:00',
                'keluhan' => 'Kontrol rutin gula darah dan tensi.',
                'status' => 'dikonfirmasi',
                'catatan_dokter' => null
            ]);

            Antrian::create([
                'appointment_id' => $app3->id,
                'patient_id' => $pasienAhmad->id,
                'dokter_id' => $dokter->id,
                'nomor_antrian' => 3,
                'tanggal' => $jadwal->tanggal,
                'waktu_masuk' => '09:30:00',
                'waktu_panggil' => null,
                'status' => 'menunggu'
            ]);
        }
    }
}
