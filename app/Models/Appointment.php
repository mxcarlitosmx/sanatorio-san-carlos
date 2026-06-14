<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_appointment';

    protected $fillable = [
        'date',
        'time',
        'status',
        'id_doctor',
        'id_patient',
        'id_receptionist'
    ];

    // Relación: Una cita pertenece a un médico
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_doctor', 'id_doctor');
    }

    // Relación: Una cita pertenece a un paciente (puede devolver null si está libre)
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_patient', 'id_patient');
    }

    // Relación: Una cita pertenece a la recepcionista que la publicó
    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class, 'id_receptionist', 'id_receptionist');
    }

    // Relación: Una cita genera una consulta médica
    public function consultation()
    {
        return $this->hasOne(Consultation::class, 'id_appointment', 'id_appointment');
    }
}