<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_medicine';

    protected $fillable = [
        'name',
        'dosage',
        'price',
        'stock'
    ];

    // Relación: Un medicamento del catálogo puede aparecer en muchos detalles de recetas
    public function prescriptionItems()
    {
        return $this->hasMany(PrescriptionItem::class, 'id_medicine', 'id_medicine');
    }

    // Relación: Un medicamento puede ser vendido muchas veces en diferentes tickets de farmacia
    public function sales()
    {
        return $this->hasMany(PharmacySale::class, 'id_medicine', 'id_medicine');
    }
}