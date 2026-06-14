<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Receptionist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReceptionistController extends Controller
{
    /**
     * 1. Carga la vista del Dashboard con los datos reales
     */
    public function dashboard()
    {
        // Trae a todos los doctores con su información de usuario para el select
        $doctors = Doctor::with('user')->get();

        // Trae los últimos 15 horarios creados para la tabla de la derecha
        $recent_appointments = Appointment::with('doctor.user')
            ->orderBy('id_appointment', 'desc')
            ->take(15)
            ->get();

        return view('receptionist.dashboard', compact('doctors', 'recent_appointments'));
    }

    /**
     * 2. Procesa el formulario y genera múltiples citas en lote
     */
    public function storeSchedule(Request $request)
    {
        // Validación adaptada a la base de datos real
        $request->validate([
            'id_doctor' => 'required|exists:doctors,id_doctor',
            'date'      => 'required|date',
            'time'      => 'required',
        ]);

        // Obtenemos a la recepcionista actual
        $receptionist = Receptionist::where('id_user', Auth::id())->firstOrFail();

        // Inserción de un único espacio disponible
        Appointment::create([
            'date'            => $request->date,
            'time'            => $request->time,
            'status'          => 'available', // Nace como disponible para que el paciente la vea
            'id_doctor'       => $request->id_doctor,
            'id_patient'      => null,
            'id_receptionist' => $receptionist->id_receptionist,
        ]);

        // Retornamos con el mensaje que activará el SweetAlert
        return redirect()->route('receptionist.dashboard')
            ->with('success', 'El espacio médico fue generado y está disponible en la agenda.');
    }

    /**
     * 3. Registra la asistencia del paciente cuando llega a la clínica
     * Cambia el estatus de 'pending' a 'present'
     */
    public function checkInPatient($id_appointment)
    {
        $appointment = Appointment::findOrFail($id_appointment);

        // Verificamos que la cita realmente esté esperando al paciente
        if ($appointment->status === 'pending') {
            $appointment->update([
                'status' => 'present'
            ]);

            return redirect()->back()->with('success', 'Asistencia confirmada. El paciente ya aparece en la pantalla del médico.');
        }

        return redirect()->back()->withErrors(['error' => 'No se pudo registrar la asistencia. Verifica el estado de la cita.']);
    }
}