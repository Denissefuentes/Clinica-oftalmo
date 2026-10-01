<?php
// MANEJO DE ROLES
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Verifica que el usuario tenga uno de los roles permitidos.
     *
     * Ejemplo:
     * ->middleware('role:admin')
     * ->middleware('role:admin,doctor')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Obtener el usuario que actualmente tiene la sesión iniciada.
        $user = $request->user();

        // Si no existe un usuario autenticado, se deniega el acceso.
        // Normalmente esto no debería ocurrir porque primero tendremos
        // el middleware "auth".
        if (!$user) {
            abort(403);
        }

        // Comprobar si el rol del usuario está entre los roles permitidos.
        if (!in_array($user->role, $roles)) {
            abort(403);
        }

        // Si tiene un rol permitido, continúa hacia la ruta solicitada.
        return $next($request);
    }
}