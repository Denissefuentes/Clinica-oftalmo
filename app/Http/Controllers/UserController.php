<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Muestra el formulario para registrar un nuevo usuario.
    public function create()
    {
        // Mostrar el formulario de registro de usuarios.
        return view('usuarios.create');
    }

    // Guarda un nuevo usuario en la base de datos.
    public function store(Request $request)
    {
        // Validar los datos enviados desde el formulario.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:doctor,secretaria'],
        ]);

        // Crear el nuevo usuario.
        // El modelo User se encarga de aplicar el hash
        // a la contraseña mediante su configuración actual.
        User::create($validated);

        // Regresar al formulario mostrando un mensaje de éxito.
        return redirect()
            ->route('usuarios.create')
            ->with('success', 'Usuario registrado correctamente.');
    }
}