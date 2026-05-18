<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'visit_date',
        'diagnosis',
        'notes',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}