<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationVoucher extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pay';

    // Le indicamos el nombre exacto de la tabla en tu migración
    protected $table = 'consultation_vouchers';

    protected $fillable = [
        'consultation_fee',
        'status',
        'voucher_folio',
        'id_consultation',
        'id_cashier'
    ];

    // Relación inversa: El voucher pertenece a una consulta médica
    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'id_consultation', 'id_consultation');
    }

    // Relación inversa: El cobro fue procesado por un cajero específico (puede ser nullable al inicio)
    public function cashier()
    {
        return $this->belongsTo(Cashier::class, 'id_cashier', 'id_cashier');
    }
}