<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacist extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pharmacist';

    protected $fillable = [
        'id_user'
    ];

    // Relación inversa: El farmacéutico pertenece a un usuario central
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Un farmacéutico puede procesar muchos pagos de ventas de farmacia
    public function pharmacyPayments()
    {
        return $this->hasMany(PharmacyPayment::class, 'id_pharmacist', 'id_pharmacist');
    }
}