<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;

class PasienController extends Controller
{
    public function index()
    {
        $patient = Patient::where('name', auth()->user()->name)->first();

        return view('pasien.dashboard', [
            'patient' => $patient,
            'appointments' => $patient
                ? Appointment::with(['dokter', 'jadwal'])
                    ->where('patient_id', $patient->id)
                    ->latest('tanggal_kunjungan')
                    ->limit(5)
                    ->get()
                : collect(),
        ]);
    }
}
