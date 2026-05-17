<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'name' => 'Wanda Remalia',
                'nik' => '3171010101010001',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 123, Bandung',
                'birth_date' => '2006-01-21',
                'gender' => 'P',
                'blood_type' => 'O',
                'medical_history' => 'Tidak ada',
                'status' => 'active'
            ],
            [
                'name' => 'Siti Aminah',
                'nik' => '3171010101010002',
                'phone' => '081234567891',
                'address' => 'Jl. Sudirman No. 45, Jakarta',
                'birth_date' => '1985-08-20',
                'gender' => 'P',
                'blood_type' => 'A',
                'medical_history' => 'Asma',
                'status' => 'active'
            ],
            [
                'name' => 'Ahmad Wijaya',
                'nik' => '3171010101010003',
                'phone' => '081234567892',
                'address' => 'Jl. Gatot Subroto No. 78, Jakarta',
                'birth_date' => '1975-03-10',
                'gender' => 'L',
                'blood_type' => 'B',
                'medical_history' => 'Diabetes tipe 2, Hipertensi',
                'status' => 'active'
            ],
            [
                'name' => 'Dewi Kartika',
                'nik' => '3171010101010004',
                'phone' => '081234567893',
                'address' => 'Jl. Thamrin No. 12, Jakarta',
                'birth_date' => '2000-12-01',
                'gender' => 'P',
                'blood_type' => 'AB',
                'medical_history' => 'Alergi udang',
                'status' => 'active'
            ],
            [
                'name' => 'Rudi Hermawan',
                'nik' => '3171010101010005',
                'phone' => '081234567894',
                'address' => 'Jl. Rasuna Said No. 56, Jakarta',
                'birth_date' => '1995-07-25',
                'gender' => 'L',
                'blood_type' => 'O',
                'medical_history' => 'Maag kronis',
                'status' => 'inactive'
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}