<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Menampilkan daftar pasien
    public function index()
    {
        $patients = Patient::latest()->paginate(10);
        return view('patients.index', compact('patients'));
    }

    // Menampilkan form tambah pasien
    public function create()
    {
        return view('patients.create');
    }

    // Menyimpan pasien baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'nik' => 'required|string|size:16|unique:patients,nik',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:L,P',
            'blood_type' => 'nullable|in:A,B,AB,O',
            'medical_history' => 'nullable|string',
        ]);

        $patient = Patient::create($validated);

        return redirect()->route('patients.index')
            ->with('success', 'Pasien berhasil didaftarkan! Nomor RM: ' . $patient->medical_record_number);
    }

    // Menampilkan detail pasien
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    // Menampilkan form edit pasien
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    // Mengupdate data pasien
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'medical_history' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.index')
            ->with('success', 'Data pasien berhasil diperbarui');
    }

    // Menghapus pasien
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')
            ->with('success', 'Data pasien berhasil dihapus');
    }

    // Pencarian pasien
    public function search(Request $request)
    {
        $search = $request->get('search');
        $patients = Patient::where('name', 'like', "%{$search}%")
            ->orWhere('nik', 'like', "%{$search}%")
            ->orWhere('medical_record_number', 'like', "%{$search}%")
            ->paginate(10);
        
        return view('patients.index', compact('patients'));
    }
}