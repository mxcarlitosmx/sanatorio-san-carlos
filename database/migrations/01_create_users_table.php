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
        // 1. Tabla Centralizada de Usuarios
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user'); // Tu PK personalizada en lugar del 'id' por defecto
            $table->string('name');
            $table->string('first_name');
            $table->string('second_name')->nullable(); // Apellido materno (opcional)
            $table->string('email')->unique();
            $table->string('password');
            
            // ENUM de roles para el Sanatorio San Carlos
            $table->enum('role', ['patient', 'doctor', 'receptionist', 'cashier', 'pharmacist']);
            
            // El número de empleado institucional (único y nullable para los pacientes)
            $table->bigInteger('employee_number')->unique()->nullable();
            
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Tabla de Tokens de Restablecimiento (Por defecto de Laravel)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 3. Tabla de Sesiones del Sistema
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            
            // Cambiado a id_user para mantener la consistencia relacional con tu PK
            $table->foreignId('id_user')->nullable()->index(); 
            
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};