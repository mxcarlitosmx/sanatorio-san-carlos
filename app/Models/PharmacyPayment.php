<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyPayment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_payment';

    protected $table = 'pharmacy_payments';

    protected $fillable = [
        'total_amount',
        'status',
        'id_prescription',
        'id_pharmacist'
    ];

    // Relación inversa: El pago corresponde a una receta médica
    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'id_prescription', 'id_prescription');
    }

    // Relación inversa: La venta fue realizada por un farmacéutico
    public function pharmacist()
    {
        return $this->belongsTo(Pharmacist::class, 'id_pharmacist', 'id_pharmacist');
    }

    // Relación 1:N: Un ticket de pago de farmacia tiene muchos productos desglosados en la venta
    public function sales()
    {
        return $this->hasMany(PharmacySale::class, 'id_payment', 'id_payment');
    }
}