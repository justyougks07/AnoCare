<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AiConsultationController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. Route Publik & Utama
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('dashboard'));

/*
|--------------------------------------------------------------------------
| Route Setelah Login
|--------------------------------------------------------------------------
*/

Route::get('prescriptions/create', [MedicineController::class, 'prescription'])->name('prescriptions.create');
Route::post('prescriptions/store', [MedicineController::class, 'reduceStock'])->name('prescriptions.store');

Route::get('medicines/stock-update', [MedicineController::class, 'editAllStock'])->name('medicines.editAllStock');
Route::post('medicines/stock-update', [MedicineController::class, 'updateAllStock'])->name('medicines.updateAllStock');

Route::resource('medicines', MedicineController::class);

Route::get('patients/search', [PatientController::class, 'search'])->name('patients.search');
Route::resource('patients', PatientController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/patients/{id}/analyze', [AiConsultationController::class, 'analyzeSymptom'])
        ->name('ai.symptom')
        ->middleware('role:dokter');

    Route::get('/admin/clinic-audit', [AiConsultationController::class, 'clinicAudit'])
        ->name('ai.audit')
        ->middleware('role:admin');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    });

    Route::middleware(['role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/dashboard', [DokterController::class, 'index'])->name('dashboard');
    });

    Route::middleware(['role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
        Route::get('/dashboard', [PasienController::class, 'index'])->name('dashboard');
    });
});

require __DIR__.'/auth.php';
