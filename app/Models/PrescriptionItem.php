<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_item';

    // Laravel por defecto busca tablas en plural, le recordamos el nombre exacto de tu migración
    protected $table = 'prescription_items';

    protected $fillable = [
        'frequency',
        'quantity',
        'id_medicine',
        'id_prescription'
    ];

    // Relación inversa: Este renglón pertenece a una receta madre
    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'id_prescription', 'id_prescription');
    }

    // Relación inversa: Este renglón hace referencia a un medicamento específico del catálogo
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'id_medicine', 'id_medicine');
    }
}