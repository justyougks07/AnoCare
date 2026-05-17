<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    User::create([
        'name'     => 'Admin',
        'email'    => 'admin@example.com',
        'password' => Hash::make('password'),
        'role'     => 'admin',
    ]);

    User::create([
        'name'     => 'Dr. Gabriel',
        'email'    => 'dokter@example.com',
        'password' => Hash::make('password'),
        'role'     => 'dokter',
    ]);

    User::create([
        'name'     => 'Pasien Satu',
        'email'    => 'pasien@example.com',
        'password' => Hash::make('password'),
        'role'     => 'pasien',
    ]);
}
}
