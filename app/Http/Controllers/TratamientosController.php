<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Tratamientos;
use Illuminate\Http\Request;

class TratamientosController extends Controller
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
    public function create($id_consulta)
    {
        $consulta = Consulta::with(['expediente.paciente','cita'])->findOrFail($id_consulta);

        return view('tratamientos.create',compact('consulta'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_consulta)
    {
        $consulta = Consulta::findOrFail($id_consulta);

        Tratamientos::updateOrCreate(
            [
                'id_consulta' => $consulta->id_consulta
            ],
            [
                'lentes' => $request->has('lentes'),
                'oclusion' => $request->has('oclusion'),
                'medicacion' => $request->medicacion,
                'examenes_complementarios' => $request->examenes_complementarios,
                'referencias' => $request->referencias,
                'control_en' => $request->control_en,
                'manejo_medico' => $request->manejo_medico,
                'cirugia_propuesta' => $request->cirugia_propuesta,
            ]
        );

            return redirect()->route('consultas.show', $consulta)->with('success','Tratamiento registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tratamientos $tratamientos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tratamientos $tratamientos, $id_consulta)
    {
        $consulta = Consulta::with([
            'expediente.paciente',
            'cita',
            'tratamiento'
        ])->findOrFail($id_consulta);

        $tratamiento = $consulta->tratamiento;

        return view('tratamientos.edit',compact('consulta', 'tratamiento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tratamientos $tratamientos, $id_consulta)
    {
        $consulta = Consulta::findOrFail($id_consulta);

        $tratamiento = Tratamientos::where(
            'id_consulta',
            $consulta->id_consulta
        )->firstOrFail();

        $tratamiento->update([
            'lentes' => $request->has('lentes'),
            'oclusion' => $request->has('oclusion'),
            'medicacion' => $request->medicacion,
            'examenes_complementarios' => $request->examenes_complementarios,
            'referencias' => $request->referencias,
            'control_en' => $request->control_en,
            'manejo_medico' => $request->manejo_medico,
            'cirugia_propuesta' => $request->cirugia_propuesta,
        ]);

        return redirect() ->route('consultas.show', $consulta)->with('success','Tratamiento actualizado correctamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tratamientos $tratamientos)
    {
        //
    }

    public function receta($id_consulta)
{
    $consulta = Consulta::with([
        'expediente.paciente',
        'tratamiento'
    ])->findOrFail($id_consulta);

    return view(
        'tratamientos.receta',
        compact('consulta')
    );
}

    public function ordenExamenes($id_consulta)
{
    $consulta = Consulta::with([
        'expediente.paciente',
        'tratamiento'
    ])->findOrFail($id_consulta);

    return view('tratamientos.orden_examenes',compact('consulta'));
    }
}
