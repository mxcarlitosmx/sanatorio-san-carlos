<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_cashier';

    protected $fillable = [
        'id_user'
    ];

    // Relación inversa: El cajero pertenece a un usuario central
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Un cajero puede cobrar muchos vouchers de consultas
    public function consultationVouchers()
    {
        return $this->hasMany(ConsultationVoucher::class, 'id_cashier', 'id_cashier');
    }
}