<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pharmacists', function (Blueprint $table) {
            $table->id('id_pharmacist'); // PK y Numero de empleado
            
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->timestamps();
        });

        // Forzar a MySQL a iniciar el autoincremento en el rango de farmacia
        DB::statement('ALTER TABLE pharmacists AUTO_INCREMENT = 90920001;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacists');
    }
};