<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_patient';

    protected $fillable = [
        'birth_day',
        'genere',
        'curp',
        'phone',
        'id_user'
    ];

    // Relación inversa: El perfil pertenece a un usuario central
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Un paciente puede tener muchas citas programadas
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id_patient', 'id_patient');
    }
}