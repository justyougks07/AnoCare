<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        // Data Obat 1: Stok Aman
        Medicine::create([
            'name' => 'Paracetamol 500mg',
            'type' => 'Tablet',
            'stock' => 100,
            'min_stock' => 10,
            'price' => 5000
        ]);

        // Data Obat 2: Stok Menipis (Sengaja dibuat di bawah min_stock)
        Medicine::create([
            'name' => 'Amoxicillin',
            'type' => 'Kaplet',
            'stock' => 5,
            'min_stock' => 15,
            'price' => 12000
        ]);

        // Data Obat 3: Stok Pas-pasan
        Medicine::create([
            'name' => 'OBH Syrup',
            'type' => 'Cair',
            'stock' => 8,
            'min_stock' => 10,
            'price' => 25000
        ]);
    }
}