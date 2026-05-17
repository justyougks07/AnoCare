<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AiConsultationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route Utama
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('dashboard'));

/*
|--------------------------------------------------------------------------
| Route Setelah Login
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Redirect Dashboard Berdasarkan Role
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

        /*
    |--------------------------------------------------------------------------
    | AI Consultation
    |--------------------------------------------------------------------------
    */

    // Analisis gejala — hanya dokter
    Route::post('/patients/{id}/analyze', [AiConsultationController::class, 'analyzeSymptom'])
        ->name('ai.symptom')
        ->middleware('role:dokter');

    // Audit klinik — hanya admin
    Route::get('/admin/clinic-audit', [AiConsultationController::class, 'clinicAudit'])
        ->name('ai.audit')
        ->middleware('role:admin');

    /*
    |--------------------------------------------------------------------------
    | Route Admin
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard', [AdminController::class, 'index'])
                ->name('dashboard');

        });

    /*
    |--------------------------------------------------------------------------
    | Route Dokter
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:dokter'])
        ->prefix('dokter')
        ->name('dokter.')
        ->group(function () {

            Route::get('/dashboard', [DokterController::class, 'index'])
                ->name('dashboard');

        });

    /*
    |--------------------------------------------------------------------------
    | Route Pasien
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:pasien'])
        ->prefix('pasien')
        ->name('pasien.')
        ->group(function () {

            Route::get('/dashboard', [PasienController::class, 'index'])
                ->name('dashboard');

        });

});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('patients', PatientController::class);
Route::get('patients/search', [PatientController::class, 'search'])->name('patients.search');
