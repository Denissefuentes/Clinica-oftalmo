<?php

namespace App\Http\Controllers;

use App\Models\alineacion_motilidad_ocular_pediatricos;
use Illuminate\Http\Request;
use App\Models\Examenes;

class AlineacionMotilidadOcularPediatricosController extends Controller
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
    public function create($id_examen)
    {
        $examen = Examenes::with('consulta.expediente.paciente')->findOrFail($id_examen);

        return view('alineacion_motilidad_pediatrico.create',compact('examen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_examen)
    {
        $examen = Examenes::findOrFail($id_examen);

        alineacion_motilidad_ocular_pediatricos::updateOrCreate(
            ['id_examen' => $examen->id_examen],
            [
                'hirschberg_resultado' => $request->hirschberg_resultado,
                'hirschberg_direccion' => $request->hirschberg_direccion,
                'hirschberg_desviacion' => $request->hirschberg_desviacion,

                'cover_resultado' => $request->cover_resultado,
                'cover_tipo_tropia' => $request->cover_tipo_tropia,
                'cover_modalidad' => $request->cover_modalidad,
                'cover_distancia' => $request->cover_distancia,
                'cover_cerca' => $request->cover_cerca,

                'versiones_resultado' => $request->versiones_resultado,
                'versiones_limitadas' => $request->versiones_limitadas,

                'ducciones_resultado' => $request->ducciones_resultado,
                'ducciones_limitadas' => $request->ducciones_limitadas,

                'nistagmo' => $request->nistagmo,
                'nistagmo_tipo' => $request->nistagmo_tipo,

                'ojo_dominante' => $request->ojo_dominante,
            ]
        );
            return redirect()->route('consultas.show', $examen->id_examen)->with('success', 'Alineación y motilidad ocular registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(alineacion_motilidad_ocular_pediatricos $alineacion_motilidad_ocular_pediatricos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(alineacion_motilidad_ocular_pediatricos $alineacion_motilidad_ocular_pediatricos,$id_examen)
    {
        $examen = Examenes::with(['consulta.expediente.paciente','alineacionMotilidadPediatrico'
        ])->findOrFail($id_examen);

        $alineacion = $examen->alineacionMotilidadPediatrico;

        return view('alineacion_motilidad_pediatrico.edit',compact('examen', 'alineacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, alineacion_motilidad_ocular_pediatricos $alineacion_motilidad_ocular_pediatricos,$id_examen)
    {
        $examen = Examenes::findOrFail($id_examen);

        $alineacion = alineacion_motilidad_ocular_pediatricos::where('id_examen',$examen->id_examen)->firstOrFail();

        $alineacion->update([
            'hirschberg_resultado' => $request->hirschberg_resultado,
            'hirschberg_direccion' => $request->hirschberg_direccion,
            'hirschberg_desviacion' => $request->hirschberg_desviacion,

            'cover_resultado' => $request->cover_resultado,
            'cover_tipo_tropia' => $request->cover_tipo_tropia,
            'cover_modalidad' => $request->cover_modalidad,
            'cover_distancia' => $request->cover_distancia,
            'cover_cerca' => $request->cover_cerca,

            'versiones_resultado' => $request->versiones_resultado,
            'versiones_limitadas' => $request->versiones_limitadas,

            'ducciones_resultado' => $request->ducciones_resultado,
            'ducciones_limitadas' => $request->ducciones_limitadas,

            'nistagmo' => $request->nistagmo,
            'nistagmo_tipo' => $request->nistagmo_tipo,

            'ojo_dominante' => $request->ojo_dominante,
        ]);

        return redirect()->route('consultas.show', $examen->id_examen)->with('success', 'Alineación y motilidad ocular actualizada correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(alineacion_motilidad_ocular_pediatricos $alineacion_motilidad_ocular_pediatricos)
    {
        //
    }
}
