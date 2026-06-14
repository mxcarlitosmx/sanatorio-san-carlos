<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsultationVoucher;
use App\Models\Cashier;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    /**
     * Carga la pantalla de Caja con los cobros pendientes y el historial reciente.
     */
    public function dashboard()
    {
        $cashier = Cashier::where('id_user', Auth::id())->firstOrFail();

        // 1. Traemos los vouchers (tickets) que el doctor generó y siguen pendientes
        // Asumimos que tienes las relaciones definidas en tus modelos para llegar al paciente
        $pending_vouchers = ConsultationVoucher::with('consultation.appointment.patient.user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc') // Los más antiguos primero (orden de llegada)
            ->get();

        // 2. Traemos los últimos cobros que este cajero específico ha realizado hoy
        $recent_payments = ConsultationVoucher::with('consultation.appointment.patient.user')
            ->where('status', 'paid')
            ->where('id_cashier', $cashier->id_cashier)
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return view('cashier.dashboard', compact('pending_vouchers', 'recent_payments'));
    }

    /**
     * Procesa el pago del paciente.
     */
    public function payVoucher($id_pay)
    {
        $cashier = Cashier::where('id_user', Auth::id())->firstOrFail();
        
        $voucher = ConsultationVoucher::findOrFail($id_pay);

        // Verificamos que no haya sido pagado antes por error
        if ($voucher->status === 'pending') {
            $voucher->update([
                'status'     => 'paid',
                'id_cashier' => $cashier->id_cashier // Estampamos la firma del cajero
            ]);

            return redirect()->route('cashier.dashboard')->with('success', 'El cobro del folio ' . $voucher->voucher_folio . ' se procesó correctamente.');
        }

        return redirect()->route('cashier.dashboard')->withErrors(['error' => 'Este folio ya ha sido cobrado.']);
    }
}