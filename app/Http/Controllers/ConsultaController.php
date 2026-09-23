<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Expediente;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index(Expediente $expediente)
    {
        $consultas = $expediente->consultas()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('consultas.index', compact(
            'expediente',
            'consultas'
        ));
    }

    public function create(Expediente $expediente)
{
    $citas = $expediente->paciente
        ->citas()
        ->orderBy('fecha', 'desc')
        ->orderBy('hora', 'desc')
        ->get();

    return view('consultas.create', compact(
        'expediente',
        'citas'
    ));
}

    public function store(Request $request, Expediente $expediente)
    {
        $datos = $request->validate([
            'id_cita' => 'nullable|exists:citas,id_cita',
            'enfermedad_actual' => 'nullable|string',
            'proxima_cita' => 'nullable|date',
        ]);

        $datos['id_expediente'] = $expediente->id_expediente;

        Consulta::create($datos);

        return redirect()
            ->route('expedientes.consultas', $expediente)
            ->with('success', 'Consulta registrada correctamente');
    }

    public function show(Consulta $consulta)
    {
        $consulta->load([
            'expediente.paciente',
            'cita'
        ]);

        return view('consultas.show', compact('consulta'));
    }

    public function edit(Consulta $consulta)
{
    $consulta->load([
        'expediente.paciente',
        'cita'
    ]);

    $citas = $consulta->expediente->paciente
        ->citas()
        ->orderBy('fecha', 'desc')
        ->orderBy('hora', 'desc')
        ->get();

    return view('consultas.edit', compact(
        'consulta',
        'citas'
    ));
}

public function update(Request $request, Consulta $consulta)
{
    $datos = $request->validate([
        'id_cita' => 'nullable|exists:citas,id_cita',
        'enfermedad_actual' => 'nullable|string',
        'proxima_cita' => 'nullable|date',
    ]);

    $consulta->update($datos);

    return redirect()
        ->route('consultas.show', $consulta)
        ->with('success', 'Consulta actualizada correctamente');
}

}