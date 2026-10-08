<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     public function login(Request $request)
    {
        // Validar los datos recibidos del formulario
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentar iniciar sesión
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            if (Auth::attempt(
                array_merge($credentials, ['activo' => true]),
                $request->boolean('remember')
            )) {
                // Regenerar la sesión después de iniciar correctamente.
                $request->session()->regenerate();

                // Redirigir al usuario al sistema.
                return redirect()->route('pacientes.index');
            }
        }

        // Si las credenciales no son correctas
        return back()->withErrors([
            'email' => 'El correo electrónico o la contraseña son incorrectos.',
        ])->onlyInput('email');
    }

       
    
    // Cierra la sesión del usuario actual.*/
    public function logout(Request $request)
    {
        // Cerrar la sesión del usuario autenticado.
        Auth::logout();

        // Invalidar la sesión actual para evitar reutilizarla.
        $request->session()->invalidate();

        // Generar un nuevo token CSRF para la siguiente sesión.
        $request->session()->regenerateToken();

        // Regresar a la pantalla de inicio de sesión.
        return redirect()->route('login');
    }

}
