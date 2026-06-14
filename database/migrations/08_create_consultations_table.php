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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id('id_consultation'); // PK
            $table->text('symptoms');
            $table->text('diagnosis');
            $table->decimal('current_weight', 5, 2); // Ejemplo: 120.50 kg
            $table->decimal('current_height', 3, 2); // Ejemplo: 1.75 m
            
            // Relacion 1:1 con la cita que la origino
            $table->foreignId('id_appointment')->constrained('appointments', 'id_appointment')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};