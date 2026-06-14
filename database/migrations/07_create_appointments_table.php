<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('id_appointment'); // Clave Primaria
            $table->date('date');          // Fecha programada
            $table->time('time');          // Hora programada
            
            // Ciclo de vida completo de la cita
            $table->enum('status', ['available', 'pending', 'present', 'canceled'])->default('available');
            
            // Llaves Foráneas
            $table->foreignId('id_doctor')->constrained('doctors', 'id_doctor')->onDelete('cascade');
            
            // Nullable: Vacío al crearse, se llena cuando el paciente la elige
            $table->foreignId('id_patient')->nullable()->constrained('patients', 'id_patient')->onDelete('cascade');
            
            // Quién del personal de recepción creó este espacio en la agenda
            $table->foreignId('id_receptionist')->nullable()->constrained('receptionists', 'id_receptionist')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};