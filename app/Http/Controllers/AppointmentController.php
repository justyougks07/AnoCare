<?php

namespace App\Http\Controllers;

use App\Models\Appointment; // Menggunakan nama model Appointment kembali
use App\Models\Jadwal;
use App\Models\Antrian;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    // 1. READ
    public function index(Request $request)
    {
        $tanggal = $request->get('date', Carbon::today()->toDateString());

        $antrians = Antrian::with(['appointment.patient', 'dokter'])
            ->whereDate('tanggal', $tanggal)
            ->orderBy('nomor_antrian', 'asc')
            ->get();

        $groupedQueues = $antrians->groupBy(function($antrian) {
            return $antrian->dokter->nama_dokter;
        });

        return view('appointments.index', compact('groupedQueues', 'tanggal'));
    }

    // 2. CREATE
    public function create()
    {
        $dokters = Dokter::where('is_active', true)->get();
        $patients = class_exists('App\Models\Patient') ? \App\Models\Patient::all() : [];

        return view('appointments.create', compact('dokters', 'patients'));
    }

    // 3. STORE
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'dokter_id' => 'required|exists:dokters,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'keluhan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $jadwal = Jadwal::lockForUpdate()->findOrFail($request->jadwal_id);

            if ($jadwal->pasien_terdaftar >= $jadwal->kuota) {
                return redirect()->back()->with('error', 'Kuota jadwal dokter sudah penuh.');
            }

            $appointment = Appointment::create([
                'patient_id' => $request->patient_id,
                'dokter_id' => $request->dokter_id,
                'jadwal_id' => $jadwal->id,
                'tanggal_kunjungan' => $jadwal->tanggal,
                'jam_kunjungan' => $jadwal->jam_mulai,
                'keluhan' => $request->keluhan,
                'status' => 'dikonfirmasi',
            ]);

            $jadwal->increment('pasien_terdaftar');

            Antrian::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $request->patient_id,
                'dokter_id' => $request->dokter_id,
                'nomor_antrian' => $jadwal->pasien_terdaftar,
                'tanggal' => $jadwal->tanggal,
                'waktu_masuk' => Carbon::now()->toTimeString(),
                'status' => 'menunggu',
            ]);

            DB::commit();
            return redirect()->route('appointments.index')->with('success', 'Booking berhasil! No Antrian: #' . $jadwal->pasien_terdaftar);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    // 4. SHOW
    public function show($id)
    {
        $appointment = Appointment::with(['patient', 'dokter', 'antrian', 'jadwal'])->findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }

    // 5. EDIT
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $dokters = Dokter::where('is_active', true)->get();
        $schedules = Jadwal::where('dokter_id', $appointment->dokter_id)->where('status', 'aktif')->get();

        return view('appointments.edit', compact('appointment', 'dokters', 'schedules'));
    }

    // 6. UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'keluhan' => 'nullable|string',
            'status' => 'required|in:pending,dikonfirmasi,sedang_dilayani,selesai,batal',
        ]);

        DB::beginTransaction();
        try {
            $appointment = Appointment::findOrFail($id);
            
            if ($appointment->jadwal_id != $request->jadwal_id) {
                Jadwal::where('id', $appointment->jadwal_id)->decrement('pasien_terdaftar');
                $jadwalBaru = Jadwal::findOrFail($request->jadwal_id);
                $jadwalBaru->increment('pasien_terdaftar');
                
                $appointment->tanggal_kunjungan = $jadwalBaru->tanggal;
                $appointment->jam_kunjungan = $jadwalBaru->jam_mulai;
                
                if ($appointment->antrian) {
                    $appointment->antrian->update([
                        'dokter_id' => $request->dokter_id,
                        'tanggal' => $jadwalBaru->tanggal,
                        'nomor_antrian' => $jadwalBaru->pasien_terdaftar
                    ]);
                }
            }

            $appointment->update([
                'dokter_id' => $request->dokter_id,
                'jadwal_id' => $request->jadwal_id,
                'keluhan' => $request->keluhan,
                'status' => $request->status,
            ]);

            DB::commit();
            return redirect()->route('appointments.index')->with('success', 'Data berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    // 7. CONFIRM DELETE
    public function delete($id)
    {
        $appointment = Appointment::with(['patient', 'dokter', 'antrian'])->findOrFail($id);
        return view('appointments.delete', compact('appointment'));
    }

    // 8. DESTROY
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        Jadwal::where('id', $appointment->jadwal_id)->decrement('pasien_terdaftar');
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Data janji temu berhasil dihapus.');
    }

    // 9. CONTROL ALUR ANTRIAN
    public function updateQueueStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:menunggu,dipanggil,sedang_dilayani,selesai']);

        $antrian = Antrian::findOrFail($id);
        $updateData = ['status' => $request->status];

        if ($request->status === 'dipanggil') {
            $updateData['waktu_panggil'] = Carbon::now()->toTimeString();
        }

        $antrian->update($updateData);

        if ($request->status === 'selesai') {
            $antrian->appointment->update(['status' => 'selesai']);
        } elseif ($request->status === 'sedang_dilayani') {
            $antrian->appointment->update(['status' => 'sedang_dilayani']);
        }

        return redirect()->back()->with('success', 'Status antrian berhasil diperbarui!');
    }

    // 10. AJAX API
    public function getDoctorSchedules($dokterId)
    {
        $jadwals = Jadwal::where('dokter_id', $dokterId)
            ->where('tanggal', '>=', Carbon::today()->toDateString())
            ->where('status', 'aktif')
            ->get();

        return response()->json($jadwals);
    }
}