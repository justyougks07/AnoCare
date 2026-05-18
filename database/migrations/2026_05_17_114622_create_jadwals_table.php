<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade'); 
        $table->date('tanggal');
        $table->time('jam_mulai');
        $table->time('jam_selesai');
        $table->integer('kuota')->default(10);
        $table->integer('pasien_terdaftar')->default(0);
        $table->enum('status', ['aktif', 'tidak_aktif', 'selesai'])->default('aktif');
        $table->timestamps();
        
        $table->unique(['dokter_id', 'tanggal', 'jam_mulai']);
    });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};