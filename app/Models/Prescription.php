<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_prescription';

    protected $fillable = [
        'folio',
        'id_consultation'
    ];

    // Relación inversa: La receta pertenece a una consulta médica
    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'id_consultation', 'id_consultation');
    }

    // Relación 1:N: Una receta puede tener muchos medicamentos desglosados (items)
    public function items()
    {
        return $this->hasMany(PrescriptionItem::class, 'id_prescription', 'id_prescription');
    }

    // Relación 1:1: Una receta genera un único proceso de pago en la caja de farmacia
    public function pharmacyPayment()
    {
        return $this->hasOne(PharmacyPayment::class, 'id_prescription', 'id_prescription');
    }
}