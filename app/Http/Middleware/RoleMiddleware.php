<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Maneja una solicitud entrante.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Si el usuario ni siquiera ha iniciado sesión, mándalo al login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

        $user = Auth::user();

        // 2. Comprobar si el rol del usuario está dentro de los roles permitidos para la ruta
        if (in_array($user->role, $roles)) {
            return $next($request); // ¡Pasa adelante!
        }

        // 3. Si está logueado pero no tiene permiso, bótalo con un error 403 (Forbidden)
        abort(403, 'No tienes autorización para acceder a esta sección del Sanatorio.');
    }
}