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
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->id('id_item'); // PK
            $table->string('frequency'); // Instruccion (ej: "Cada 8 horas por 7 días")
            $table->integer('quantity'); // Cantidad de cajas recomendadas por el doctor
            
            // Llaves foráneas hacia el catálogo y hacia la receta correspondiente
            $table->foreignId('id_medicine')->constrained('medicines', 'id_medicine')->onDelete('cascade');
            $table->foreignId('id_prescription')->constrained('prescriptions', 'id_prescription')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_items');
    }
};