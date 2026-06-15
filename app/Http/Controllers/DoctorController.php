<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Medicine;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    // Carga la pantalla principal del médico
    public function dashboard()
    {
        $doctor = Doctor::where('id_user', Auth::id())->firstOrFail();
        $today = Carbon::today()->toDateString();

        // Traemos las citas de hoy exclusivamente para este doctor
        $today_appointments = Appointment::with('patient.user')
            ->where('id_doctor', $doctor->id_doctor)
            ->where('date', $today)
            ->orderBy('time', 'asc')
            ->get();

        // Calculamos las métricas para los recuadros de arriba
        $waiting_count = $today_appointments->where('status', 'present')->count();
        $completed_count = $today_appointments->where('status', 'completed')->count();

        return view('doctor.dashboard', compact('today_appointments', 'waiting_count', 'completed_count'));
    }

    // Carga la nueva Hoja Clínica buscando los datos de la cita y el paciente
    public function attend($id_appointment)
    {
        $appointment = Appointment::with('patient.user')->findOrFail($id_appointment);

        // Traemos todo el catálogo de medicinas para inyectarlo al JavaScript de la vista
        $medicines = Medicine::orderBy('name', 'asc')->get();

        return view('doctor.attend', compact('appointment', 'medicines'));
    }

    // Guarda el registro médico en la tabla 'consultations'
    public function storeConsultation(Request $request, $id_appointment)
    {
        // Validación básica de los campos de la hoja clínica
        $request->validate([
            'current_weight' => 'required|numeric',
            'current_height' => 'required|numeric',
            'symptoms'       => 'required|string',
            'diagnosis'      => 'required|string',
        ]);

        // Usamos una Transacción DB: Si algo falla, Laravel deshace todo para no dejar registros a medias
        DB::transaction(function () use ($request, $id_appointment) {
            
            // 1. Guardar la Valoración Clínica (Tabla consultations)
            $id_consultation = DB::table('consultations')->insertGetId([
                'symptoms'       => $request->symptoms,
                'diagnosis'      => $request->diagnosis,
                'current_weight' => $request->current_weight,
                'current_height' => $request->current_height,
                'id_appointment' => $id_appointment,
                'created_at'     => now(),
                'updated_at'     => now()
            ]);

            // 2. Generar Pase a Caja (Tabla consultation_vouchers)
            DB::table('consultation_vouchers')->insert([
                'consultation_fee' => 500.00, // Costo base de la consulta médica
                'status'           => 'pending',
                'voucher_folio'    => 'CON-' . str_pad($id_consultation, 5, '0', STR_PAD_LEFT),
                'id_consultation'  => $id_consultation,
                'created_at'       => now(),
                'updated_at'       => now()
            ]);

            // 3. Procesar Receta si el doctor agregó medicamentos dinámicamente
            if ($request->has('medicines') && count($request->medicines) > 0) {
                
                // Creamos la cabecera de la receta
                $id_prescription = DB::table('prescriptions')->insertGetId([
                    'folio'           => 'REC-' . time(),
                    // Queda pendiente para Farmacia
                    'id_consultation' => $id_consultation,
                    'created_at'      => now(),
                    'updated_at'      => now()
                ]);

                // Insertamos cada medicamento en prescription_items
                $items = [];
                for ($i = 0; $i < count($request->medicines); $i++) {
                    if (!empty($request->medicines[$i])) {
                        $items[] = [
                            'frequency'       => $request->frequencies[$i],
                            'quantity'        => $request->quantities[$i],
                            'id_medicine'     => $request->medicines[$i],
                            'id_prescription' => $id_prescription,
                            'created_at'      => now(),
                            'updated_at'      => now()
                        ];
                    }
                }
                
                if (count($items) > 0) {
                    DB::table('prescription_items')->insert($items);
                }
            }

            // 4. Cambiamos el estado de la cita a Completada
            DB::table('appointments')
                ->where('id_appointment', $id_appointment)
                ->update(['status' => 'completed']);
                
        });

        // Redirigir al dashboard con mensaje de éxito
        return redirect()->route('doctor.dashboard')->with('success', 'Consulta finalizada con éxito. Los pases se enviaron a Caja y Farmacia.');
    }
}