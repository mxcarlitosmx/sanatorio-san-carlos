<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 1. Indicarle a Laravel tu llave primaria personalizada
    protected $primaryKey = 'id_user';

    // 2. Permitir la asignación masiva de tus columnas específicas
    protected $fillable = [
        'name',
        'first_name',
        'second_name',
        'email',
        'password',
        'role',
        'employee_number',
    ];

    // 3. Ocultar la contraseña en las consultas automáticas
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // ==========================================
    // RELACIONES 1:1 (Perfiles de usuario)
    // ==========================================

    public function patient()
    {
        return $this->hasOne(Patient::class, 'id_user', 'id_user');
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'id_user', 'id_user');
    }

    public function receptionist()
    {
        return $this->hasOne(Receptionist::class, 'id_user', 'id_user');
    }

    public function cashier()
    {
        return $this->hasOne(Cashier::class, 'id_user', 'id_user');
    }

    public function pharmacist()
    {
        return $this->hasOne(Pharmacist::class, 'id_user', 'id_user');
    }
}