<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('medical_record_number')->unique();
            $table->string('name', 100);
            $table->string('nik', 16)->unique();
            $table->string('phone', 15);
            $table->text('address');
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->enum('blood_type', ['A', 'B', 'AB', 'O'])->nullable();
            $table->text('medical_history')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
