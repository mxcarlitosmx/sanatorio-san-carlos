<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // IMPORTANTE para usar DB::statement

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('id_doctor'); // PK y Número de empleado
            $table->string('professional_license')->unique();
            $table->string('speciality');
            
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->timestamps();
        });

        // Forzar a MySQL a iniciar el autoincremento en el rango de doctores
        DB::statement('ALTER TABLE doctors AUTO_INCREMENT = 50240001;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};