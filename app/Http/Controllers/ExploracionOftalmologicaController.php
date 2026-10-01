<?php

namespace App\Http\Controllers;

use App\Models\exploracion_oftalmologica;
use Illuminate\Http\Request;
use App\Models\Examenes;


class ExploracionOftalmologicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_examen)
    {
        $examen = Examenes::with('consulta.expediente.paciente')->findOrFail($id_examen);

        return view('exploracion_oftalmologica.create',compact('examen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_examen)
    {
        $examen = Examenes::findOrFail($id_examen);

        exploracion_oftalmologica::updateOrCreate(
            ['id_examen' => $examen->id_examen],
            [
                // Ojo derecho
                'presion_intraocular_od' => $request->presion_intraocular_od,
                'parpados_anexos_od' => $request->parpados_anexos_od,
                'conjuntiva_od' => $request->conjuntiva_od,
                'cornea_od' => $request->cornea_od,
                'camara_anterior_od' => $request->camara_anterior_od,
                'iris_od' => $request->iris_od,
                'pupilas_od' => $request->pupilas_od,
                'cristalino_od' => $request->cristalino_od,
                'fondo_ojo_od' => $request->fondo_ojo_od,

                // Ojo izquierdo
                'presion_intraocular_oi' => $request->presion_intraocular_oi,
                'parpados_anexos_oi' => $request->parpados_anexos_oi,
                'conjuntiva_oi' => $request->conjuntiva_oi,
                'cornea_oi' => $request->cornea_oi,
                'camara_anterior_oi' => $request->camara_anterior_oi,
                'iris_oi' => $request->iris_oi,
                'pupilas_oi' => $request->pupilas_oi,
                'cristalino_oi' => $request->cristalino_oi,
                'fondo_ojo_oi' => $request->fondo_ojo_oi,
            ]
        );

        return redirect()->route('consultas.show', $examen->consulta)->with('success','Exploración oftalmológica registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(exploracion_oftalmologica $exploracion_oftalmologica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(exploracion_oftalmologica $exploracion_oftalmologica,$id_examen)
    {
        $examen = Examenes::with(['consulta.expediente.paciente','exploracionOftalmologica'])->findOrFail($id_examen);

        $exploracion = $examen->exploracionOftalmologica;

        return view('exploracion_oftalmologica.edit',compact('examen', 'exploracion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, exploracion_oftalmologica $exploracion_oftalmologica,$id_examen)
    {
        $examen = Examenes::findOrFail($id_examen);

        $exploracion = exploracion_oftalmologica::where(
            'id_examen',
            $examen->id_examen
        )->firstOrFail();

        $exploracion->update([
            // Ojo derecho
            'presion_intraocular_od' => $request->presion_intraocular_od,
            'parpados_anexos_od' => $request->parpados_anexos_od,
            'conjuntiva_od' => $request->conjuntiva_od,
            'cornea_od' => $request->cornea_od,
            'camara_anterior_od' => $request->camara_anterior_od,
            'iris_od' => $request->iris_od,
            'pupilas_od' => $request->pupilas_od,
            'cristalino_od' => $request->cristalino_od,
            'fondo_ojo_od' => $request->fondo_ojo_od,

            // Ojo izquierdo
            'presion_intraocular_oi' => $request->presion_intraocular_oi,
            'parpados_anexos_oi' => $request->parpados_anexos_oi,
            'conjuntiva_oi' => $request->conjuntiva_oi,
            'cornea_oi' => $request->cornea_oi,
            'camara_anterior_oi' => $request->camara_anterior_oi,
            'iris_oi' => $request->iris_oi,
            'pupilas_oi' => $request->pupilas_oi,
            'cristalino_oi' => $request->cristalino_oi,
            'fondo_ojo_oi' => $request->fondo_ojo_oi,
        ]);

        return redirect()->route('consultas.show', $examen->consulta)->with('success','Exploración oftalmológica actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(exploracion_oftalmologica $exploracion_oftalmologica)
    {
        //
    }
}
