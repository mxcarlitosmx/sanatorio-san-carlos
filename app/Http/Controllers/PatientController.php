<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * 1. Panel Principal: Mis Citas Reservadas
     */
    public function dashboard()
    {
        $patient = Patient::where('id_user', Auth::id())->firstOrFail();

        $appointments = Appointment::with('doctor.user')
            ->where('id_patient', $patient->id_patient)
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        $prescriptions = [];

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