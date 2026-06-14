<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Receptionist;
use App\Models\Cashier;
use App\Models\Pharmacist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Registro de Usuarios y Perfiles asociados (Usa transacciones de MySQL)
     */
    public function register(Request $request)
    {
        // 1. Validar rigurosamente los datos del formulario entrante
        $request->validate([
            'name'       => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'second_name'=> 'nullable|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8',
            'role'       => 'required|in:patient,doctor,receptionist,cashier,pharmacist',
            
            // Campos obligatorios condicionales según el rol elegido
            'curp'                 => 'required_if:role,patient|string|max:18',
            'phone'                => 'required_if:role,patient|string|max:15',
            'birth_day'            => 'required_if:role,patient|date',
            'genere'               => 'required_if:role,patient|string',
            'professional_license' => 'required_if:role,doctor|string|max:255',
            'speciality'           => 'required_if:role,doctor|string|max:255',
        ]);

        // 2. Ejecutar la operación dentro de una transacción de Base de Datos
        // Si algo falla en las tablas secundarias, MySQL revierte todo automáticamente
        DB::transaction(function () use ($request) {
            
            // PASO A: Crear el registro base en la tabla global de 'users'
            $user = User::create([
                'name'            => $request->name,
                'first_name'      => $request->first_name,
                'second_name'     => $request->second_name,
                'email'           => $request->email,
                'password'        => Hash::make($request->password), // Contraseña encriptada de forma segura
                'role'            => $request->role,
                'employee_number' => null, // Lo dejamos en null temporalmente
            ]);

            // PASO B: Evaluar el rol asignado y disparar la inserción en su tabla correspondiente
            // Capturamos el ID autoincremental que genera XAMPP en sus respectivos rangos de nómina
            $employeeId = match ($user->role) {
                'patient' => Patient::create([
                    'id_user'   => $user->id_user,
                    'birth_day' => $request->birth_day,
                    'genere'    => $request->genere,
                    'curp'      => $request->curp,
                    'phone'     => $request->phone,
                ]) ? null : null, // Los pacientes no generan número de empleado institucional

                'doctor' => Doctor::create([
                    'id_user'              => $user->id_user,
                    'professional_license' => $request->professional_license,
                    'speciality'           => $request->speciality,
                ])->id_doctor, // Atrapa el ID de nómina (ej: 56780001)

                'receptionist' => Receptionist::create([
                    'id_user' => $user->id_user,
                ])->id_receptionist, // Atrapa el ID de nómina (ej: 20300001)

                'cashier' => Cashier::create([
                    'id_user' => $user->id_user,
                ])->id_cashier, // Atrapa el ID de nómina (ej: 40500001)

                'pharmacist' => Pharmacist::create([
                    'id_user' => $user->id_user,
                ])->id_pharmacist, // Atrapa el ID de nómina (ej: 60700001)
            };

            // PASO C: Si el rol fue un empleado, vinculamos su número de nómina de vuelta en la tabla central
            if ($employeeId) {
                $user->update(['employee_number' => $employeeId]);
            }
        });

        //return response()->json(['message' => 'Usuario y perfil creados con éxito en TIME4MED.'], 201);
        return redirect()->back()->with('success', 'Usuario y perfil creados con éxito.');
    }

    /**
     * Inicio de Sesión Inteligente (Detecta automáticamente si es Email o Nómina de Empleado)
     */
    public function login(Request $request)
    {
    $request->validate([
        'login_input' => 'required|string', // Recibe correo electrónico o número de nómina
        'password'    => 'required|string',
    ]);

    // Algoritmo de detección: si tiene formato de correo, busca por la columna 'email'.
    // Si no lo es, asume que es el 'employee_number' (el número de nómina).
    $fieldType = filter_var($request->login_input, FILTER_VALIDATE_EMAIL) ? 'email' : 'employee_number';

    // Intentar autenticar al usuario con las credenciales dinámicas
    if (Auth::attempt([$fieldType => $request->login_input, 'password' => $request->password])) {
        
        // Regenerar la sesión por seguridad contra ataques de fijación de sesión
        $request->session()->regenerate();

        $user = Auth::user();

        // REDIRECCIÓN OPERATIVA SEGÚN EL ROL DE TU DIAGRAMA DE BASE DE DATOS
        if ($user->role === 'patient') {
            return redirect('/patient/dashboard');
        } elseif ($user->role === 'doctor') {
            return redirect('/doctor/dashboard');
        } elseif ($user->role === 'receptionist') { 
                return redirect('/receptionist/dashboard');
        } elseif ($user->role === 'cashier') {
            return redirect('/cashier/dashboard');
        } elseif ($user->role === 'pharmacist') {
            return redirect('/pharmacist/dashboard');
        }

        // Redirección de respaldo por si no coincide ningún rol específico
        return redirect('/dashboard');
    }

    // Credenciales incorrectas: Regresa al Login con el error para mostrarlo en el Blade
    return redirect()->back()
        ->withInput($request->only('login_input'))
        ->withErrors([
            'login_input' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    /**
     * Cierre de Sesión Seguro
     */
    public function logout(Request $request)
    {
    // Cierra la sesión en el sistema de autenticación
    Auth::logout();

    // Invalida la sesión actual del navegador para borrar los datos del usuario
    $request->session()->invalidate();

    // Regenera el token CSRF por seguridad para que no pueda ser reutilizado
    $request->session()->regenerateToken();

    // Redirecciona al usuario a la vista de login limpia
    return redirect('/login');
    }

}