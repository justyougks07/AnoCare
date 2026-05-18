<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('patient_id')->nullable(); 
        $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade'); 
        $table->foreignId('jadwal_id')->constrained('jadwals')->onDelete('cascade');
        $table->date('tanggal_kunjungan');
        $table->time('jam_kunjungan');
        $table->text('keluhan')->nullable();
        $table->enum('status', ['pending', 'dikonfirmasi', 'sedang_dilayani', 'selesai', 'batal'])->default('pending');
        $table->text('catatan_dokter')->nullable();
        $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};