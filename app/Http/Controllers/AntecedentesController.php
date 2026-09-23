<?php

namespace App\Http\Controllers;
use App\Models\Expediente;
use App\Models\Antecedentes;
use Illuminate\Http\Request;

class AntecedentesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request-> validate([
            'nombre'=>'required',
            'categoria'=>'required',
            'tipo_paciente'=>'required'
        ]);

        Antecedentes::create([
            'nombre'=>$request->nombre,
            'categoria'=>$request->categoria,
            'tipo_paciente'=>$request->tipo_paciente
        ]);

        return redirect()->route('antecedentes.index')->with('success','antecedente agregado correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Antecedentes $antecedentes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Antecedentes $antecedentes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Antecedentes $antecedentes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Antecedentes $antecedentes)
    {
        //
    }

}
