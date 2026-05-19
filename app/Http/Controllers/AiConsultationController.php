<?php

namespace App\Http\Controllers;

use App\Ai\Agents\ClinicAgent;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Ai\Enums\Lab;
use Throwable;

class AiConsultationController extends Controller
{
    // Fitur 1: Analisis gejala per pasien
    public function analyzeSymptom(Request $request, string $id)
    {
        $validated = $request->validate([
            'keluhan' => ['required', 'string', 'max:2000'],
        ]);

        $patient = Patient::findOrFail($id);

        $medicalHistory = $patient->medical_history ?? 'tidak ada';

        try {
            $response = ClinicAgent::make()->prompt(
                "Pasien bernama {$patient->name}, usia {$patient->age} tahun, " .
                "jenis kelamin {$patient->gender}. " .
                "Keluhan yang disampaikan: {$validated['keluhan']}. " .
                "Riwayat penyakit sebelumnya: {$medicalHistory}. " .
                "Berikan analisis gejala, kemungkinan kondisi, tindakan awal yang aman, dan saran rujukan dokter.",
                provider: Lab::Gemini
            )->text;
        } catch (Throwable) {
            $response = "AI belum dapat dihubungi. Berikut saran awal berbasis aturan klinik:\n\n" .
                "- Catat durasi, intensitas, dan pemicu keluhan pasien.\n" .
                "- Periksa tanda vital dasar seperti suhu, tekanan darah, nadi, dan saturasi oksigen bila tersedia.\n" .
                "- Hindari diagnosis pasti tanpa pemeriksaan dokter.\n" .
                "- Rujuk ke dokter umum terlebih dahulu, atau ke IGD bila muncul sesak berat, nyeri dada, penurunan kesadaran, demam tinggi menetap, atau perdarahan.";
        }

        return view('ai.symptom-analysis', [
            'patient' => $patient,
            'response' => $response,
        ]);
    }

    // Fitur 2: Audit laporan statistik klinik
    public function clinicAudit()
    {
        $stats = Visit::with('patient')
            ->select('diagnosis', DB::raw('count(*) as total'))
            ->groupBy('diagnosis')
            ->orderByDesc('total')
            ->get();

        $statsTeks = $stats->map(function ($item) {
            return "Diagnosis '{$item->diagnosis}': {$item->total} kasus";
        })->implode(', ');

        if ($stats->isEmpty()) {
            $insight = 'Belum ada data kunjungan yang cukup untuk audit klinik. Tambahkan data diagnosis pada riwayat kunjungan pasien terlebih dahulu.';
        } else {
            try {
                $insight = ClinicAgent::make()->prompt(
                    "Berikut statistik kunjungan pasien klinik: {$statsTeks}. ".
                    "Tolong berikan: ".
                    "1. Deskripsi kondisi kesehatan dominan. ".
                    "2. Evaluasi pola penyakit yang perlu diwaspadai. ".
                    "3. Rekomendasi konkret untuk peningkatan layanan klinik.",
                    provider: Lab::Gemini
                )->text;
            } catch (Throwable) {
                $insight = "AI belum dapat dihubungi. Ringkasan lokal:\n\n" .
                    "- Keluhan atau diagnosis terbanyak perlu diprioritaskan dalam edukasi pasien.\n" .
                    "- Pastikan stok obat untuk diagnosis dominan tersedia di atas batas minimum.\n" .
                    "- Evaluasi jadwal dokter bila antrian harian meningkat.\n" .
                    "- Gunakan data kunjungan mingguan untuk melihat tren layanan klinik.";
            }
        }

        return view('ai.clinic-audit', [
            'insight' => $insight,
            'stats' => $stats,
        ]);
    }
}
