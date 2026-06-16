<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- ¡Importante! Agregamos el Facade DB

class PatientController extends Controller
{
    /**
     * 1. Panel Principal: Mis Citas Reservadas y Recetas
     */
    public function dashboard()
    {
        $patient = Patient::where('id_user', Auth::id())->firstOrFail();

        // Citas del paciente
        $appointments = Appointment::with('doctor.user')
            ->where('id_patient', $patient->id_patient)
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        // Recetas recientes del paciente usando DB Facade para saltar directamente
        $prescriptions = DB::table('prescriptions')
            ->join('consultations', 'prescriptions.id_consultation', '=', 'consultations.id_consultation')
            ->join('appointments', 'consultations.id_appointment', '=', 'appointments.id_appointment')
            ->join('doctors', 'appointments.id_doctor', '=', 'doctors.id_doctor')
            ->join('users', 'doctors.id_user', '=', 'users.id_user')
            ->where('appointments.id_patient', $patient->id_patient)
            ->orderBy('prescriptions.created_at', 'desc')
            ->select(
                'prescriptions.id_prescription', 
                'prescriptions.folio',
                'prescriptions.created_at', 
                'users.first_name as doctor_name',
                'doctors.speciality'
            )
            ->take(3)
            ->get();

        return view('patient.dashboard', compact('appointments', 'prescriptions'));
    }

    /**
     * 2. Muestra la vista de Citas Disponibles (Tarjetas) con el nombre original
     */
    public function book()
    {
        $today = Carbon::today()->toDateString();

        $available_appointments = Appointment::with('doctor.user')
            ->where('status', 'available')
            ->whereNull('id_patient')
            ->where('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        // Retorna el nombre de vista original listo en tu proyecto
        return view('patient.appointments', compact('available_appointments'));
    }

    /**
     * 3. Acción para que el paciente tome la cita
     */
    public function confirmBooking($id_appointment)
    {
        $patient = Patient::where('id_user', Auth::id())->firstOrFail();
        
        $appointment = Appointment::where('id_appointment', $id_appointment)
            ->where('status', 'available')
            ->firstOrFail();

        $appointment->update([
            'id_patient' => $patient->id_patient,
            'status'     => 'pending'
        ]);

        return redirect()->route('patient.dashboard')->with('success', '¡Cita agendada con éxito!');
    }
}