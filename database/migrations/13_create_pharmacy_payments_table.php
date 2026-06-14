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
        Schema::create('pharmacy_payments', function (Blueprint $table) {
            $table->id('id_payment'); // PK
            $table->decimal('total_amount', 10, 2); // Monto total de la nota de farmacia
            $table->enum('status', ['pending', 'paid', 'canceled'])->default('pending');
            
            // Llaves foraneas hacia la receta de referencia y el farmaceutico encargado
            $table->foreignId('id_prescription')->constrained('prescriptions', 'id_prescription')->onDelete('cascade');
            $table->foreignId('id_pharmacist')->constrained('pharmacists', 'id_pharmacist')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_payments');
    }
};