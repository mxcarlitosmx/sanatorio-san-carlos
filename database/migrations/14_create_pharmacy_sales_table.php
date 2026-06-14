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
        Schema::create('pharmacy_sale', function (Blueprint $table) {
            $table->id('id_sale'); // PK
            $table->integer('quantity_sold'); // Lo que el cliente pago realmente
            $table->decimal('unit_price', 8, 2); // Precio congelado en el momento de la venta
            
            // Llaves foraneas hacia el ticket de pago global y el catalogo de medicinas
            $table->foreignId('id_payment')->constrained('pharmacy_payments', 'id_payment')->onDelete('cascade');
            $table->foreignId('id_medicine')->constrained('medicines', 'id_medicine')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_sale');
    }
};