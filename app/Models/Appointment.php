<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'patient_id', 
        'dokter_id', 
        'jadwal_id', 
        'tanggal_kunjungan', 
        'jam_kunjungan', 
        'keluhan', 
        'status', 
        'catatan_dokter'
    ];

    // Relasi ke Dokter yang dipilih
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    // Relasi ke Sesi Jadwal yang dipilih
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    // Relasi: Satu appointment menghasilkan satu baris data antrian harian
    public function antrian()
    {
        return $this->hasOne(Antrian::class, 'appointment_id');
    }

    // Relasi ke data Pasien (Menyesuaikan pekerjaan Anggota 2 jika nama kelasnya Patient)
    public function patient()
    {
        return $this->belongsTo(class_exists('App\Models\Patient') ? Patient::class : User::class, 'patient_id');
    }
}