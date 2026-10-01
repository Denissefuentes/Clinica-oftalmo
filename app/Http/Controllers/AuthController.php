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

            // Regenerar la sesión por seguridad
            $request->session()->regenerate();

            // Depues de iniciar sesion envia al modulo inicial del sistema que seria pacientes
            return redirect()->route('pacientes.index');
        }

        // Si las credenciales no son correctas
        return back()->withErrors([
            'email' => 'El correo electrónico o la contraseña son incorrectos.',
        ])->onlyInput('email');
    }
}
