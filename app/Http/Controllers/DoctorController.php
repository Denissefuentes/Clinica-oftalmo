<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctores = Doctor::all();
        return view('doctores.index', compact('doctores'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener solamente las cuentas que tienen rol de doctor
    // y que todavía no están asociadas a un perfil profesional.
    $usuarios = \App\Models\User::where('role', 'doctor')
        ->whereDoesntHave('doctor')
        ->orderBy('name')
        ->get();

    // Enviar los usuarios disponibles al formulario.
    return view('doctores.create', compact('usuarios'));
    }

    // Guarda un nuevo doctor en la base de datos.
    public function store(Request $request)
    {
        // Validar los datos enviados desde el formulario.
        $validated = $request->validate([
            'id_user' => ['required', 'exists:users,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
        ]);

        // Crear el perfil profesional del doctor
        // utilizando únicamente los datos validados.
        Doctor::create($validated);

        // Regresar al listado de doctores mostrando un mensaje de éxito.
        return redirect()
            ->route('doctores.index')
            ->with('success', 'Doctor registrado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
            // Obtener las cuentas con rol de doctor que todavía
        // no están asociadas a otro perfil profesional.
        $usuarios = \App\Models\User::where('role', 'doctor')
            ->where(function ($query) use ($doctor) {
                $query->whereDoesntHave('doctor')
                    ->orWhere('id', $doctor->id_user);
            })
            ->orderBy('name')   
            ->get();

        // Enviar el doctor y las cuentas disponibles al formulario.
        return view('doctores.edit', compact('doctor', 'usuarios'));
    }

        /**
         * Actualiza los datos de un doctor.
         */
        public function update(Request $request, Doctor $doctor)
        {
            // Validar los datos enviados desde el formulario.
            $validated = $request->validate([
                'id_user' => ['required', 'exists:users,id'],
                'nombre' => ['required', 'string', 'max:255'],
                'cedula' => ['required', 'string', 'max:255'],
                'telefono' => ['required', 'string', 'max:255'],
            ]);

            // Actualizar únicamente los datos validados.
            $doctor->update($validated);

            // Regresar al listado de doctores mostrando un mensaje de éxito.
            return redirect()
                ->route('doctores.index')
                ->with('success', 'Doctor editado con exito');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
//desactiva al doctor porque no se puede eliminar 
    public function cambiarEstado(Doctor $doctor)
    {
        $doctor->activo = !$doctor->activo;
        $doctor->save();
        return redirect()->route('doctores.index')->with('success','Estado del doctor actualizado con exito');
    }
}
