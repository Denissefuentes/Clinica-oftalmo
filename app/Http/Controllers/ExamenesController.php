<?php

namespace App\Http\Controllers;

use App\Models\Examenes;
use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\agudeza_visual_pediatrico;
use App\Models\examen_visual_adultos;

class ExamenesController extends Controller
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
    public function create(Consulta $consulta)
    {
        $consulta->load('expediente.paciente', 'examen');

        return view('examenes.create', compact('consulta'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Consulta $consulta)
    {
        $consulta->load('expediente.paciente');
        //examenes diferentes segun tipo de paciente
        $tipoPaciente = $consulta->expediente->paciente->tipo_paciente;

        $examen = Examenes::firstOrCreate([
            'id_consulta' => $consulta->id_consulta,
        ]);

        if ($tipoPaciente === 'Pediatrico') {

            $datos = $request->validate([
                'av_con_cicloplejia_od' => 'nullable|string|max:50',
                'av_con_cicloplejia_os' => 'nullable|string|max:50',
                'av_sin_cicloplejia_od' => 'nullable|string|max:50',
                'av_sin_cicloplejia_os' => 'nullable|string|max:50',

                'metodo_optotipos' => 'nullable|boolean',
                'metodo_test_lea' => 'nullable|boolean',
                'metodo_mirada_preferencial' => 'nullable|boolean',
                'metodo_reflejo_rojo' => 'nullable|boolean',

                'observaciones' => 'nullable|string',
            ]);

            $datos['id_examen'] = $examen->id_examen;

        agudeza_visual_pediatrico::create($datos);

        } else {

            $datos = $request->validate([
                'av_lejos_sin_correccion_od' => 'nullable|string|max:50',
                'av_lejos_sin_correccion_os' => 'nullable|string|max:50',

                'av_lejos_con_correccion_od' => 'nullable|string|max:50',
                'av_lejos_con_correccion_os' => 'nullable|string|max:50',

                'av_cerca_od' => 'nullable|string|max:50',
                'av_cerca_os' => 'nullable|string|max:50',

                'observaciones' => 'nullable|string',
            ]);

            $datos['id_examen'] = $examen->id_examen;

            examen_visual_adultos::create($datos);
        }

        return redirect()
            ->route('consultas.show', $consulta)
            ->with('success', 'Examen registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Examenes $examenes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Examenes $examen)
    {
        $examen->load([
        'consulta.expediente.paciente',
        'agudeza_visual_pediatrico',
        'examen_visual_adulto',
    ]);

    return view('examenes.edit', compact('examen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Examenes $examenes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Examenes $examenes)
    {
        //
    }
}
