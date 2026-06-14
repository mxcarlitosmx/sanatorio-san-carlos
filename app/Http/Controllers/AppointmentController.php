<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * 1. LA RECEPCIONISTA CREA/PUBLICA UN HORARIO DISPONIBLE
     */
    public function publishSlot(Request $request)
    {
        $request->validate([
            'date'      => 'required|date|after_or_equal:today',
            'time'      => 'required|date_format:H:i',
            'id_doctor' => 'required|exists:doctors,id_doctor',
        ]);

        // Atrapa automáticamente el ID de la recepcionista que inició sesión
        $receptionistId = Auth::user()->receptionist->id_receptionist;

        $appointment = Appointment::create([
            'date'            => $request->date,
            'time'            => $request->time,
            'status'          => 'available', // Nace disponible
            'id_doctor'       => $request->id_doctor,
            'id_patient'      => null,        // Sin paciente asignado aún
            'id_receptionist' => $receptionistId,
        ]);

        return response()->json([
            'message'     => 'Horario médico publicado en la agenda.',
            'appointment' => $appointment
        ], 201);
    }

    /**
     * 2. LA RECEPCIONISTA CONSULTA LA AGENDA DEL DÍA A DÍA (Hoy)
     */
    public function todaysSchedule()
    {
        // Trae todas las citas agendadas para la fecha actual para el control de asistencia
        $appointments = Appointment::with(['doctor.user', 'patient.user'])
            ->where('date', '=', now()->toDateString())
            ->where('status', '!=', 'available') // Citas que ya tienen interacción
            ->orderBy('time')
            ->get();

        return response()->json($appointments, 200);
    }

    /**
     * 3. LA RECEPCIONISTA REGISTRA ASISTENCIA (Cambia a 'present')
     */
    public function checkInPatient($id_appointment)
    {
        $appointment = Appointment::findOrFail($id_appointment);

        if ($appointment->status !== 'pending') {
            return response()->json(['error' => 'Esta cita no está en estado pendiente.'], 400);
        }

        // El paciente llegó a la sala de espera del Sanatorio
        $appointment->update(['status' => 'present']);

        return response()->json([
            'message' => 'Asistencia registrada. El paciente está listo en sala de espera.',
            'appointment' => $appointment
        ], 200);
    }

    /**
     * 4. EL PACIENTE VISUALIZA LAS CITAS DISPONIBLES EN LA WEB
     */
    public function availableSlots()
    {
        // Busca únicamente las que estén totalmente libres y sean de hoy en adelante
        $slots = Appointment::with('doctor.user')
            ->where('status', 'available')
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        return response()->json($slots, 200);
    }

    /**
     * 5. EL PACIENTE SELECCIONA Y APARTA SU CITA
     */
    public function bookAppointment($id_appointment)
    {
        $appointment = Appointment::findOrFail($id_appointment);

        if ($appointment->status !== 'available') {
            return response()->json(['error' => 'Este horario ya no se encuentra disponible.'], 400);
        }

        // Atrapa el ID del paciente que inició sesión
        $patientId = Auth::user()->patient->id_patient;

        // Se adueña de la cita y cambia el estado
        $appointment->update([
            'id_patient' => $patientId,
            'status'     => 'pending' 
        ]);

        return response()->json([
            'message'     => 'Cita reservada con éxito. Te vemos el día de tu consulta.',
            'appointment' => $appointment
        ], 200);
    }

    // Para el detalle de la cita
    public function showDetail($id) {
        // Aquí buscas la cita en la base de datos...
        $appointment = Appointment::with('consultation', 'doctor.user')->findOrFail($id);
        
        return view('patient.appointmentDetail', compact('appointment'));
    }

    // Para el detalle de la receta
    public function showPrescription($id) {
        // Aquí buscas la receta en la base de datos...
        $prescription = Prescription::with('items.medicine', 'consultation.appointment.doctor.user')->findOrFail($id);

        return view('patient.prescriptionDetail', compact('prescription'));
    }



}