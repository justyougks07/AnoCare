<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $table = 'antrians';

    protected $fillable = [
        'appointment_id', 
        'patient_id', 
        'dokter_id', 
        'nomor_antrian', 
        'tanggal', 
        'waktu_masuk', 
        'waktu_panggil', 
        'status'
    ];

    // Relasi kembali ke data master Appointment
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    // Relasi langsung ke Dokter untuk filter monitor antrian per spesialisasi
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    // Relasi langsung ke Pasien (milik Anggota 2) untuk display nama di monitor
    public function patient()
    {
        return $this->belongsTo(class_exists('App\Models\Patient') ? Patient::class : User::class, 'patient_id');
    }
}