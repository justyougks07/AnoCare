<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dokter;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Visit;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalPatients' => Patient::count(),
            'activeDoctors' => Dokter::where('is_active', true)->count(),
            'todayAppointments' => Appointment::whereDate('tanggal_kunjungan', Carbon::today())->count(),
            'lowStockMedicines' => Medicine::whereColumn('stock', '<=', 'min_stock')->count(),
            'recentVisits' => Visit::with('patient')->latest('visit_date')->limit(5)->get(),
        ]);
    }
}
