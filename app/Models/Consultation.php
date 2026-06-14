<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_consultation';

    protected $fillable = [
        'symptoms',
        'diagnosis',
        'current_weight',
        'current_height',
        'id_appointment'
    ];

    // Relacion inversa: La consulta proviene de una cita especifica
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'id_appointment', 'id_appointment');
    }

    // Relación 1:1: Una consulta genera una única receta médica digital
    public function prescription()
    {
        return $this->hasOne(Prescription::class, 'id_consultation', 'id_consultation');
    }

    // Relación 1:1: Una consulta genera una única orden de pago en caja central
    public function consultationVoucher()
    {
        return $this->hasOne(ConsultationVoucher::class, 'id_consultation', 'id_consultation');
    }
}