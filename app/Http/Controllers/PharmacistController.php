<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Pharmacist;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class PharmacistController extends Controller
{
    /**
     * Carga el panel de Farmacia con recetas pendientes y el historial.
     */
    public function dashboard()
    {
        $pharmacist = Pharmacist::where('id_user', Auth::id())->firstOrFail();

        // 1. Recetas pendientes: Buscamos las recetas cuyo ID *NO EXISTA* en pharmacy_payments
        $pending_prescriptions = Prescription::with('consultation.appointment.patient.user', 'consultation.appointment.doctor.user')
            ->whereNotIn('id_prescription', function($query) {
                $query->select('id_prescription')->from('pharmacy_payments');
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // 2. Historial: Buscamos las recetas que *SÍ EXISTAN* en pharmacy_payments y sean de este farmacéutico
        $recent_dispensed = Prescription::with('consultation.appointment.patient.user')
            ->whereIn('id_prescription', function($query) use ($pharmacist) {
                $query->select('id_prescription')
                      ->from('pharmacy_payments')
                      ->where('id_pharmacist', $pharmacist->id_pharmacist);
            })
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('pharmacist.dashboard', compact('pending_prescriptions', 'recent_dispensed'));
    }

    /**
     * Procesa la entrega de medicamentos y genera el pase a caja.
     */
    public function dispense($id_prescription)
    {
        $prescription = Prescription::with([
            'consultation.appointment.patient.user', 
            'consultation.appointment.doctor.user' // <-- AQUÍ ESTÁ LA CORRECCIÓN
        ])->findOrFail($id_prescription);

        // Traemos los medicamentos recetados cruzados con el catálogo actual usando DB Facade
        $items = \Illuminate\Support\Facades\DB::table('prescription_items')
            ->join('medicines', 'prescription_items.id_medicine', '=', 'medicines.id_medicine')
            ->where('id_prescription', $id_prescription)
            ->select('prescription_items.*', 'medicines.name', 'medicines.price', 'medicines.stock', 'medicines.dosage')
            ->get();


        // 1. NUEVO: Traemos todo el catálogo que tenga stock disponible
        $inventory = \App\Models\Medicine::where('stock', '>', 0)->get();

        // 2. Pasamos la nueva variable $inventory a la vista
        return view('pharmacist.dispense', compact('prescription', 'items', 'inventory'));    
    }

    /**
     * Procesa la venta, descuenta inventario y manda el ticket a Caja
     */
    public function confirmDispense(Request $request, $id_prescription)
    {
        $pharmacist = Pharmacist::where('id_user', Auth::id())->firstOrFail();

        // 1. Verificamos que no se haya cobrado antes
        $already_dispensed = \Illuminate\Support\Facades\DB::table('pharmacy_payments')->where('id_prescription', $id_prescription)->exists();
        if ($already_dispensed) {
            return redirect()->route('pharmacist.dashboard')->withErrors(['error' => 'Esta receta ya fue procesada y cobrada.']);
        }

        $total_amount = 0;
        $sales_data = [];

        // 2. Procesamos cada medicamento que el paciente decidió llevarse
        if ($request->has('items')) {
            foreach ($request->items as $id_medicine => $quantity_sold) {
                if ($quantity_sold > 0) {
                    $medicine = Medicine::findOrFail($id_medicine);

                    // Validamos que no vendamos más de lo que hay en stock
                    $quantity_sold = min($quantity_sold, $medicine->stock);
                    $subtotal = $medicine->price * $quantity_sold;
                    $total_amount += $subtotal;

                    $sales_data[] = [
                        'id_medicine'   => $id_medicine,
                        'quantity_sold' => $quantity_sold,
                        'unit_price'    => $medicine->price,
                        'created_at'    => now(),
                        'updated_at'    => now()
                    ];

                    // Descontamos físicamente del inventario
                    $medicine->decrement('stock', $quantity_sold);
                }
            }
        }

        // 3. Generamos el cobro DIRECTO EN FARMACIA (Estatus 'paid')
        $id_payment = \Illuminate\Support\Facades\DB::table('pharmacy_payments')->insertGetId([
            'total_amount'    => $total_amount,
            'status'          => 'paid', // <--- ¡AQUÍ ESTÁ LA CORRECCIÓN!
            'id_prescription' => $id_prescription,
            'id_pharmacist'   => $pharmacist->id_pharmacist,
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 4. Guardamos el detalle de los carritos de compra
        foreach ($sales_data as &$sale) {
            $sale['id_payment'] = $id_payment;
        }
        if (!empty($sales_data)) {
            \Illuminate\Support\Facades\DB::table('pharmacy_sale')->insert($sales_data);
        }

        return redirect()->route('pharmacist.dashboard')->with('success', 'Venta confirmada. Se cobró un total de $' . number_format($total_amount, 2));
    }

    /**
     * ==========================================
     * MÓDULO DE INVENTARIO Y CATÁLOGO
     * ==========================================
     */

    // 1. Carga la pantalla de inventario
    public function inventory()
    {
        // Traemos todo el catálogo ordenado alfabéticamente
        $medicines = Medicine::orderBy('name', 'asc')->get();
        return view('pharmacist.inventory', compact('medicines'));
    }

    // 2. Registra un nuevo medicamento desde cero
    public function storeMedicine(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'price'  => 'required|numeric|min:0',
            'stock'  => 'required|integer|min:0',
        ]);

        Medicine::create([
            'name'   => $request->name,
            'dosage' => $request->dosage,
            'price'  => $request->price,
            'stock'  => $request->stock,
        ]);

        return redirect()->route('pharmacist.inventory')->with('success', 'Nuevo medicamento agregado al catálogo exitosamente.');
    }

    // 3. Actualiza el precio o añade más cajas a un medicamento existente
    public function updateMedicine(Request $request, $id_medicine)
    {
        $request->validate([
            'price'     => 'required|numeric|min:0',
            'add_stock' => 'required|integer|min:0',
        ]);

        $medicine = Medicine::findOrFail($id_medicine);
        
        $medicine->update([
            'price' => $request->price,
            'stock' => $medicine->stock + $request->add_stock, // Sumamos las cajas nuevas al stock actual
        ]);

        return redirect()->route('pharmacist.inventory')->with('success', 'El inventario de ' . $medicine->name . ' ha sido actualizado.');
    }




}