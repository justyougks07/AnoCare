<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function create()
    {
        $patients = Patient::orderBy('name')->get();

        return view('admin.visits.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'visit_date' => 'required|date',
            'diagnosis' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Visit::create($request->only(['patient_id', 'visit_date', 'diagnosis', 'notes']));

        return redirect()->route('admin.dashboard')->with('success', 'Riwayat kunjungan baru berhasil ditambahkan.');
    }
}
