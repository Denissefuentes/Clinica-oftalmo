<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use App\Models\Paciente;
use App\Models\Antecedentes;
use App\Models\Datos_adicionales;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::with('expediente')->get();

        return view('expedientes.index', compact('pacientes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_paciente)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'antecedentes' =>'nulleable|array',
            'antecedentes.*'=>'exists:antecedentes,id_antecedentes'
        ]);

        $expediente = Expediente::create([
            'id_paciente'=>$request->id_paciente,
            'fecha_apertura' =>now()
        ]);

        $expediente->antecedentes()->attach($request->antecedentes ?? [] );
        return redirect()->route('expedientes.show',$expediente)->with('success','Expediente creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expediente $expediente)
    {
        $expediente->load([
        'paciente',
        'antecedentes',
        'datos_adicionales'
    ]);

        return view('expedientes.show',compact('expediente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expediente $expediente)
    {
        return view('expedientes.edit',compact('expediente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expediente $expediente)
    {
        $expediente->update($request->all());

        return redirect()->route('expedientes.show',$expediente)->with('success,Expediente actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expediente $expediente)
    {
        abort(404);
    }
    public function antecedentes(Expediente $expediente)
{
    $expediente->load('paciente');

    if ($expediente->paciente->tipo_paciente === 'Pediatrico') {

        $antecedentes = Antecedentes::whereIn(
            'tipo_paciente',
            ['Regular', 'Pediatrico']
        )->get();

    } else {

        $antecedentes = Antecedentes::where(
            'tipo_paciente',
            'Regular'
        )->get();
    }

    return view('expedientes.antecedentes', compact(
        'expediente',
        'antecedentes'
    ));
}



public function guardarAntecedentes(Request $request, Expediente $expediente)
{
    $request->validate([
        'antecedentes' => 'nullable|array',
        'antecedentes.*' => 'exists:antecedentes,id_antecedentes'
    ]);

    $expediente->antecedentes()->sync(
        $request->antecedentes ?? []
    );

    return redirect()
        ->route('expedientes.show', $expediente)
        ->with('success', 'Antecedentes registrados correctamente');
}

}
