<?php

namespace App\Http\Controllers;
use App\Models\Expediente;
use App\Models\Datos_adicionales;
use Illuminate\Http\Request;

class DatosAdicionalesController extends Controller
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
    public function create(Expediente $expediente)
    {
        $datos_adicionales = $expediente->datos_adicionales;
        return view('expedientes.datos', compact('expediente','datos_adicionales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Expediente $expediente)
    {
        $datos = $request->validate([
            'uso_lentes'=>'required|boolean',
            'tipo_lentes'=>'nullable|string|max:255',
            'graduacion_previa'=>'nullable|string|max:255',
            'quirurgicos_generales'=>'nullable|string|max:255',
            'medicamentos_actuales'=>'nullable|string|max:255',
        ]);

        $datos['id_expediente'] = $expediente->id_expediente;
        Datos_adicionales::create($datos);
        return redirect()->route('expedientes.show',$expediente)->with('success','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Datos_adicionales $datos_adicionales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Datos_adicionales $datos_adicionales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Datos_adicionales $datos_adicionales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Datos_adicionales $datos_adicionales)
    {
        //
    }
}
