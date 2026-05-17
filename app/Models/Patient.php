<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    
    protected $fillable = [
        'medical_record_number',
        'name',
        'nik',
        'phone',
        'address',
        'birth_date',
        'gender',
        'blood_type',
        'medical_history',
        'status'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    // Auto generate nomor rekam medis
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($patient) {
            $patient->medical_record_number = 'RM-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        });
    }

    // Hitung umur
    public function getAgeAttribute()
    {
        return $this->birth_date->age;
    }

    // Scope untuk pasien aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}