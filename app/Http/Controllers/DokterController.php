<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Appointment;
use App\Models\Dokter;
use Carbon\Carbon;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::where('user_id', auth()->id())->first();

        return view('dokter.dashboard', [
            'dokter' => $dokter,
            'todayQueues' => $dokter
                ? Antrian::with('appointment.patient')
                    ->where('dokter_id', $dokter->id)
                    ->whereDate('tanggal', Carbon::today())
                    ->orderBy('nomor_antrian')
                    ->get()
                : collect(),
            'todayAppointments' => $dokter
                ? Appointment::where('dokter_id', $dokter->id)
                    ->whereDate('tanggal_kunjungan', Carbon::today())
                    ->count()
                : 0,
        ]);
    }
}
