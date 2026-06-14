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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id('id_medicine'); // PK
            $table->string('name'); // Nombre del medicamento (comercial/genérico)
            $table->string('dosage'); // Presentación y gramaje (ej: "500mg - 20 tabletas")
            $table->decimal('price', 8, 2); // Precio unitario de venta
            $table->integer('stock'); // Cantidad disponible en inventario
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};