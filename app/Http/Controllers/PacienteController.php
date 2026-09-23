<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return view('pacientes.index', compact('pacientes'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pacientes.create');	
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nombre' => 'required',
        'f_nacimiento' => 'required',
        'sexo' => 'required',
        'tipo_paciente' => 'required',
        'telefono' => 'required'
        ]);

       $paciente= Paciente :: create($request->all());
        return redirect()->route('citas.create', ['id_paciente'=>$paciente->id_paciente]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        return view ('pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        $request->validate ([
            'nombre'=>'required',
            'f_nacimiento'=>'required',
            'sexo'=>'required',
            'tipo_paciente'=>'required',
            'telefono'=>'required'
        ]);

        $paciente->update($request->all());

        return redirect()->route('pacientes.index')->with('success','Paciente editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return redirect()->route('pacientes.index')->with('success','Paciente eliminado correctamente');
    }
}
