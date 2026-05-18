<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'dokters';

    protected $fillable = [
        'user_id', 
        'nama_dokter', 
        'spesialisasi', 
        'no_telepon', 
        'alamat_praktek', 
        'foto', 
        'is_active'
    ];

    // Relasi: Satu dokter memiliki banyak jadwal praktik
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'dokter_id');
    }

    // Relasi: Satu dokter memiliki banyak janji temu (appointments)
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'dokter_id');
    }

    // Relasi: Satu dokter mengelola banyak antrian hari H
    public function antrians()
    {
        return $this->hasMany(Antrian::class, 'dokter_id');
    }
}