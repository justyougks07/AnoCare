<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            // Diarahkan kembali ke appointment_id
            $table->foreignId('appointment_id')->constrained('appointments')->onDelete('cascade');
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade'); 
            $table->integer('nomor_antrian');
            $table->date('tanggal');
            $table->time('waktu_masuk')->nullable();
            $table->time('waktu_panggil')->nullable();
            $table->enum('status', ['menunggu', 'dipanggil', 'sedang_dilayani', 'selesai'])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('queues');
    }
};