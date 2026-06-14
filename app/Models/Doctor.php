<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_doctor';

    protected $fillable = [
        'professional_license',
        'speciality',
        'id_user'
    ];

    // Relacion inversa: El medico pertenece a un usuario central
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Un doctor puede atender muchas citas
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id_doctor', 'id_doctor');
    }
}