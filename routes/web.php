<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\PharmacistController;


// RUTAS PÚBLICAS

// Ruta para MOSTRAR la pantalla de Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Ruta para MOSTRAR la pantalla de Registro de Pacientes
Route::get('/register', function () {
    return view('auth.register');
});

// Rutas para PROCESAR los formularios
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// RUTAS PROTEGIDAS POR ROL (Middleware Activo)
Route::middleware(['role:patient'])->group(function () {
    
    // 1. Panel Principal (Muestra citas reservadas y recetas del paciente)
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    
    // 2. Muestra la vista de Citas Libres (Para agendar)
    Route::get('/patient/book', [PatientController::class, 'book'])->name('patient.book');
    
    // 3. Acción de confirmación cuando el paciente le da clic a "Agendar ahora"
    Route::post('/patient/book/{id_appointment}', [PatientController::class, 'confirmBooking'])->name('patient.confirm_booking'); 
    
    Route::get('/patient/appointment/{id}', [AppointmentController::class, 'showDetail'])->name('patient.appointment.detail');
    Route::get('/patient/prescription/{id}', [AppointmentController::class, 'showPrescription'])->name('patient.prescription.detail');
    Route::get('/patient/slots', [AppointmentController::class, 'availableSlots']); // Tu ruta lógica original conservada
    
});

//MÓDULO DE RECEPCIÓN (Gestión y Día a Día)
Route::middleware(['role:receptionist'])->group(function () {
    
    // 1. Carga el Dashboard y la lista de doctores
    Route::get('/receptionist/dashboard', [ReceptionistController::class, 'dashboard'])->name('receptionist.dashboard');
    
    // 2. Genera los bloques de horarios en lote
    Route::post('/receptionist/schedule', [ReceptionistController::class, 'storeSchedule'])->name('receptionist.store_schedule');

    // 3. TU RUTA ORIGINAL INTEGRADA: Pasar asistencia al paciente (De 'pending' a 'present')
    Route::post('/receptionist/checkin/{id_appointment}', [ReceptionistController::class, 'checkInPatient'])->name('receptionist.checkin'); 
    
});

//MÓDULO DEL MÉDICO
Route::middleware(['role:doctor'])->group(function () {
    
    // Ruta para el Dashboard del Médico
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');

    // Muestra el formulario clínico pasándole el ID de la cita
    Route::get('/doctor/attend/{id_appointment}', [DoctorController::class, 'attend'])->name('doctor.attend');

    // Procesa el formulario para hacer el registro en la base de datos
    Route::post('/doctor/attend/{id_appointment}', [DoctorController::class, 'storeConsultation'])->name('doctor.store_consultation');
    
});

//MÓDULO DE CAJA CENTRAL
Route::middleware(['role:cashier'])->group(function () {
    
    // Panel Principal de Caja
    Route::get('/cashier/dashboard', function () {
        return view('cashier.dashboard');
    })->name('cashier.dashboard');
});

//MÓDULO DE FARMACIA
Route::middleware(['role:pharmacist'])->group(function () {
    // Panel principal
    Route::get('/pharmacist/dashboard', [PharmacistController::class, 'dashboard'])->name('pharmacist.dashboard');
    
    // 1. Nueva ruta para VER la pantalla de surtido
    Route::get('/pharmacist/dispense/{id_prescription}', [PharmacistController::class, 'dispense'])->name('pharmacist.dispense');
    
    // 2. Nueva ruta para PROCESAR el cobro y descontar stock
    Route::post('/pharmacist/dispense/{id_prescription}', [PharmacistController::class, 'confirmDispense'])->name('pharmacist.confirm_dispense');

    // Inventario
    Route::get('/pharmacist/inventory', [PharmacistController::class, 'inventory'])->name('pharmacist.inventory');
    Route::post('/pharmacist/inventory/store', [PharmacistController::class, 'storeMedicine'])->name('pharmacist.store_medicine');
    Route::post('/pharmacist/inventory/update/{id_medicine}', [PharmacistController::class, 'updateMedicine'])->name('pharmacist.update_medicine');
});

//MÓDULO DE CAJA
Route::middleware(['role:cashier'])->group(function () {
    Route::get('/cashier/dashboard', [CashierController::class, 'dashboard'])->name('cashier.dashboard');
    Route::post('/cashier/pay/{id_pay}', [CashierController::class, 'payVoucher'])->name('cashier.pay_voucher');
});