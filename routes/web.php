<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AiConsultationController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| STEP 1: Pengaturan Route Utama & Redireksi
|--------------------------------------------------------------------------
| Menjamin setiap akses ke root URL langsung diarahkan ke Dashboard.
|
*/

Route::get('/', fn() => redirect()->route('dashboard'));

/*
|--------------------------------------------------------------------------
| STEP 2: Grup Middleware Autentikasi (Auth)
|--------------------------------------------------------------------------
| Memastikan seluruh fitur hanya dapat diakses oleh pengguna yang sah.
|
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | STEP 3: Fitur Inti 4
    |--------------------------------------------------------------------------
    | Bagian ini mencakup Manajemen Obat, Stok, Resep, dan Data Pasien.
    |
    */

    Route::middleware(['role:admin,dokter'])->group(function () {
        // --- 3.1 Manajemen Stok & Data Obat ---
        Route::get('medicines/stock-update', [MedicineController::class, 'editAllStock'])->name('medicines.editAllStock');
        Route::post('medicines/stock-update', [MedicineController::class, 'updateAllStock'])->name('medicines.updateAllStock');
        Route::resource('medicines', MedicineController::class);

        // --- 3.2 Sistem Pembuatan Resep (Potong Stok Otomatis) ---
        Route::get('prescriptions/create', [MedicineController::class, 'prescription'])->name('prescriptions.create');
        Route::post('prescriptions/store', [MedicineController::class, 'reduceStock'])->name('prescriptions.store');

        // --- 3.3 Manajemen & Pencarian Data Pasien ---
        Route::get('patients/search', [PatientController::class, 'search'])->name('patients.search');
        Route::resource('patients', PatientController::class);
    });


    /*
    |--------------------------------------------------------------------------
    | STEP 4: Integrasi AI & Hak Akses Berdasarkan Role
    |--------------------------------------------------------------------------
    */

    // Dashboard Umum: arahkan user ke dashboard sesuai role.
    Route::get('/dashboard', function () {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'dokter' => redirect()->route('dokter.dashboard'),
            default => redirect()->route('pasien.dashboard'),
        };
    })->name('dashboard');

    // Pengaturan Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Integrasi AI: Analisis Gejala (Khusus Role Dokter)
    Route::post('/patients/{id}/analyze', [AiConsultationController::class, 'analyzeSymptom'])
        ->name('ai.symptom')
        ->middleware('role:dokter');

    // Integrasi AI: Audit Klinik (Khusus Role Admin)
    Route::get('/admin/clinic-audit', [AiConsultationController::class, 'clinicAudit'])
        ->name('ai.audit')
        ->middleware('role:admin');

    /*
    |--------------------------------------------------------------------------
    | STEP 5: Pengaturan Dashboard Berdasarkan Role (Prefixing)
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    });

    Route::middleware(['role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/dashboard', [DokterController::class, 'index'])->name('dashboard');
    });

    Route::middleware(['role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
        Route::get('/dashboard', [PasienController::class, 'index'])->name('dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | STEP 6: Jadwal Janji Temu & Antrian
    |--------------------------------------------------------------------------
    */

    Route::get('api/doctors/{dokter}/schedules', [AppointmentController::class, 'getDoctorSchedules'])
        ->name('appointments.doctor-schedules');

    Route::middleware(['role:admin,dokter,pasien'])->group(function () {
        Route::get('appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
        Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    });

    Route::middleware(['role:admin,dokter'])->group(function () {
        Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
        Route::get('appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
        Route::get('appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
        Route::put('appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
        Route::patch('appointments/{appointment}', [AppointmentController::class, 'update']);
        Route::delete('appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
        Route::get('appointments/{appointment}/delete', [AppointmentController::class, 'delete'])->name('appointments.delete');
        Route::patch('appointments/queue/{antrian}', [AppointmentController::class, 'updateQueueStatus'])
            ->name('appointments.queue.update');
    });
});
/*
|--------------------------------------------------------------------------
| STEP 7: Sistem Autentikasi & Login
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
