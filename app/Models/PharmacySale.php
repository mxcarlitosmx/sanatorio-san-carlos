<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacySale extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_sale';

    // Forzamos el nombre en singular tal como lo definiste en tu diagrama y migración
    protected $table = 'pharmacy_sale';

    protected $fillable = [
        'quantity_sold',
        'unit_price',
        'id_payment',
        'id_medicine'
    ];

    // Relación inversa: Este renglón pertenece a un ticket de pago global de farmacia
    public function payment()
    {
        return $this->belongsTo(PharmacyPayment::class, 'id_payment', 'id_payment');
    }

    // Relación inversa: Este renglón descuenta un medicamento específico del catálogo maestro
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'id_medicine', 'id_medicine');
    }
}