<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AiConsultationController;
use App\Http\Controllers\MedicineController; // Controller Obat (Tugas Kamu)
use App\Http\Controllers\PatientController;  // Controller Pasien (Anggota 2)
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. Route Publik & Utama
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('dashboard'));

/*
|--------------------------------------------------------------------------
| 2. Route Manajemen Obat (Tugas Anggota 4)
|--------------------------------------------------------------------------
| 
*/

// Fitur Resep: Memilih obat dari dropdown dan mengurangi stok
Route::get('prescriptions/create', [MedicineController::class, 'prescription'])->name('prescriptions.create');
Route::post('prescriptions/store', [MedicineController::class, 'reduceStock'])->name('prescriptions.store');

// Fitur Stok Massal: Menampilkan semua obat untuk diupdate sekaligus
Route::get('medicines/stock-update', [MedicineController::class, 'editAllStock'])->name('medicines.editAllStock');
Route::post('medicines/stock-update', [MedicineController::class, 'updateAllStock'])->name('medicines.updateAllStock');

// Fitur CRUD Standar: Index, Create, Store, Edit, Update, Destroy
Route::resource('medicines', MedicineController::class);


/*
|--------------------------------------------------------------------------
| 3. Route Manajemen Pasien (Tugas Anggota 2)
|--------------------------------------------------------------------------
*/
Route::get('patients/search', [PatientController::class, 'search'])->name('patients.search');
Route::resource('patients', PatientController::class);


/*
|--------------------------------------------------------------------------
| 4. Route Terproteksi (Harus Login / Middleware Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /* --- Profile User --- */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* --- Fitur AI Consultation (Tugas Lead) --- */
    // Hanya Dokter yang bisa analisis gejala
    Route::post('/patients/{id}/analyze', [AiConsultationController::class, 'analyzeSymptom'])
        ->name('ai.symptom')
        ->middleware('role:dokter');

    // Hanya Admin yang bisa audit klinik
    Route::get('/admin/clinic-audit', [AiConsultationController::class, 'clinicAudit'])
        ->name('ai.audit')
        ->middleware('role:admin');

    /* --- Grouping Berdasarkan Role --- */

    // Khusus Admin
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    });

    // Khusus Dokter
    Route::middleware(['role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/dashboard', [DokterController::class, 'index'])->name('dashboard');
    });

    // Khusus Pasien
    Route::middleware(['role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
        Route::get('/dashboard', [PasienController::class, 'index'])->name('dashboard');
    });
});

// Memanggil route autentikasi bawaan Laravel (Login, Register, dll)
require __DIR__.'/auth.php';