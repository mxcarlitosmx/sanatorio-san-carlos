<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_receptionist';

    protected $fillable = [
        'id_user'
    ];

    // Relación inversa: La recepcionista pertenece a un usuario central
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Una recepcionista puede registrar o validar muchas citas
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id_receptionist', 'id_receptionist');
    }
}