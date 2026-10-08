<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Muestra el listado de usuarios registrados.
     */
    public function index()
    {
        // Obtener todos los usuarios registrados.
        // Se ordenan del más reciente al más antiguo.
        $usuarios = User::orderBy('id', 'desc')->get();

        // Enviar los usuarios a la vista del listado.
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Muestra el formulario para registrar un nuevo usuario.
     */
    public function create()
    {
        // Mostrar el formulario de registro de usuarios.
        return view('usuarios.create');
    }

    /**
     * Guarda un nuevo usuario en la base de datos.
     */
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
        // El modelo User aplica automáticamente el hash
        // a la contraseña mediante su configuración actual.
        User::create($validated);

        // Regresar al formulario mostrando un mensaje de éxito.
        return redirect()
            ->route('usuarios.create')
            ->with('success', 'Usuario registrado correctamente.');
    }

            //  Muestra el formulario para editar los datos de un usuario.
        public function edit(User $usuario)
        {
            // Mostrar el formulario con los datos del usuario seleccionado.
            return view('usuarios.edit', compact('usuario'));
        }

        // Actualiza los datos de un usuario.
        public function update(Request $request, User $usuario)
        {
            // Validar los datos enviados desde el formulario.
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email,' . $usuario->id,
                ],
                'role' => ['required', 'in:doctor,secretaria'],
            ]);

            // Actualizar los datos permitidos del usuario.
            $usuario->update($validated);

            // Regresar al listado mostrando un mensaje de éxito.
            return redirect()
                ->route('usuarios.index')
                ->with('success', 'Los datos del usuario fueron actualizados correctamente.');
        }

    /**
     * Muestra el formulario para cambiar la contraseña de un usuario.
     */
    public function editPassword(User $usuario)
    {
        // Mostrar el formulario indicando qué usuario modificaremos.
        return view('usuarios.edit-password', compact('usuario'));
    }

    /**
     * Actualiza la contraseña de un usuario.
     */
    public function updatePassword(Request $request, User $usuario)
    {
        // Validar la nueva contraseña y su confirmación.
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Asignar la nueva contraseña.
        // Laravel la convierte automáticamente en un hash.
        $usuario->password = $validated['password'];

        // Guardar los cambios en la base de datos.
        $usuario->save();

        // Regresar al listado de usuarios con un mensaje de éxito.
        return redirect()
            ->route('usuarios.index')
            ->with('success', 'La contraseña del usuario fue actualizada correctamente.');
    }

     /**
     * Activa o desactiva una cuenta de usuario.
     */
    public function cambiarEstado(User $usuario)
    {
        // Evitar que el administrador desactive su propia cuenta.
        if (Auth::id() === $usuario->id) {
            return redirect()
                ->route('usuarios.index')
                ->with('error', 'No puedes desactivar tu propia cuenta.');
        }

        // Cambiar el estado actual de la cuenta.
        $usuario->activo = !$usuario->activo;

        // Guardar el nuevo estado en la base de datos.
        $usuario->save();

        // Regresar al listado mostrando un mensaje de confirmación.
        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Estado de la cuenta actualizado correctamente.');
    }
}