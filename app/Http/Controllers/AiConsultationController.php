<?php

namespace App\Http\Controllers;

use App\Ai\Agents\ClinicAgent;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AiConsultationController extends Controller
{
    // Fitur 1: Analisis gejala per pasien
    public function analyzeSymptom(Request $request, string $id)
    {
        $patient = Patient::findOrFail($id);

        $medicalHistory = $patient->medical_history ?? 'tidak ada';

        $response = ClinicAgent::make()->prompt(
            "Pasien bernama {$patient->name}, usia {$patient->age} tahun, " .
            "jenis kelamin {$patient->gender}. " .
            "Keluhan yang disampaikan: {$request->input('keluhan')}. " .
            "Riwayat penyakit sebelumnya: {$medicalHistory}. " .
            "Berikan analisis gejala dan saran tindakan awal.",
            provider: Lab::Gemini
        );

        return view('ai.symptom-analysis', compact('patient', 'response'));
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

        $insight = ClinicAgent::make()->prompt(
            "Berikut statistik kunjungan pasien klinik: {$statsTeks}. ".
            "Tolong berikan: ".
            "1. Deskripsi kondisi kesehatan dominan. ".
            "2. Evaluasi pola penyakit yang perlu diwaspadai. ".
            "3. Rekomendasi konkret untuk peningkatan layanan klinik.",
            provider: Lab::Gemini
        );

        return view('ai.clinic-audit', compact('insight', 'stats'));
    }
}