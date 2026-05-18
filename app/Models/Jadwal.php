<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';

    protected $fillable = [
        'dokter_id', 
        'tanggal', 
        'jam_mulai', 
        'jam_selesai', 
        'kuota', 
        'pasien_terdaftar', 
        'status'
    ];

    // Relasi ke tabel Dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    // Relasi: Satu sesi jadwal bisa dipakai oleh banyak janji temu pasien
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'jadwal_id');
    }
}