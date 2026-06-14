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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('id_patient'); // PK
            $table->date('birth_day');
            $table->string('genere');
            $table->string('curp', 18)->unique();
            $table->string('phone', 15);
            
            // Relacion 1:1 con la tabla central de usuarios
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};