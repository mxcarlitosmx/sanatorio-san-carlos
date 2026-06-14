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
        Schema::create('consultation_vouchers', function (Blueprint $table) {
            $table->id('id_pay'); // PK
            $table->decimal('consultation_fee', 8, 2); // Costo de la consulta
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->string('voucher_folio')->unique(); // Folio único de pago
            
            // Llave foránea hacia la consulta médica
            $table->foreignId('id_consultation')->constrained('consultations', 'id_consultation')->onDelete('cascade');
            
            // Llave foránea hacia el cajero que cobra (nullable al inicio)
            $table->foreignId('id_cashier')->nullable()->constrained('cashiers', 'id_cashier')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_vouchers');
    }
};