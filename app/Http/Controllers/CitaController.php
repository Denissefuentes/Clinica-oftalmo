<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Doctor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    /**
 * Display a listing of the resource.
 */
public function index()
{
    // Iniciar la consulta de citas junto con sus relaciones.
    $consulta = Cita::with(['paciente', 'doctor']);

    // Obtener el usuario que actualmente inició sesión.
    $usuario = Auth::user();

    // Si el usuario es doctor, mostrar únicamente
    // las citas que pertenecen a su perfil profesional.
    if ($usuario->role === 'doctor') {

        // Obtener el perfil profesional asociado a su cuenta.
        $doctor = $usuario->doctor;

        // Si tiene un perfil de doctor asociado,
        // filtrar las citas utilizando su id_doctor.
        if ($doctor) {
            $consulta->where('id_doctor', $doctor->id_doctor);
        } else {
            // Si por alguna razón la cuenta no tiene perfil asociado,
            // no mostrar ninguna cita.
            $consulta->whereRaw('1 = 0');
        }
    }

    // Ordenar las citas por estado, fecha y hora.
    $citas = $consulta
        ->orderByRaw("CASE estado
            WHEN 'Pendiente' THEN 1
            WHEN 'Atendida' THEN 2
            WHEN 'Cancelada' THEN 3
            END")
        ->orderBy('fecha')
        ->orderBy('hora')
        ->get();

    // Enviar las citas a la vista.
    return view('citas.index', compact('citas'));
}

    /**
     * Show the form for creating a new resource.
     */
   public function create(Request $request)
{
    $doctores = Doctor::all();

    $paciente = null;

    if ($request->filled('id_paciente')) {
        $paciente = Paciente::find($request->id_paciente);
    }

    return view('citas.create', compact('paciente', 'doctores'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'id_paciente' => 'required',
        'id_doctor'   => 'required',
        'fecha'       => 'required|date',
        'hora'        => 'required',
        'motivo'      => 'required',
    ]);

        $existe = Cita::where('id_doctor', $request->id_doctor)
        ->where('fecha', $request->fecha)
        ->where('hora', $request->hora)
        ->where('estado', '!=', 'Cancelada')
        ->exists();

        if ($existe) {
            return back()->withErrors(['hora' => 'El doctor ya tiene una cita programada en esa fecha y hora.'])
            ->withInput();
        }

        Cita::create([
            'id_paciente' => $request->id_paciente,
            'id_doctor' =>$request->id_doctor,
            'fecha'=>$request->fecha,
            'hora'=>$request->hora,
            'motivo'=>$request->motivo,
            'estado'=>'Pendiente'
        ]);
            

        return redirect()->route('citas.index')->with('success','Cita agendada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        
        $paciente= $cita->paciente;
        $doctores = Doctor ::all();
        return view('citas.edit', compact('cita','paciente','doctores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'id_paciente'=>'required',
            'id_doctor'=>'required',
            'fecha'=>'required',
            'hora'=>'required',
            'motivo'=>'required',
            'estado'=>'required'
        ]);
if ($request->estado == 'Pendiente') {

    $existe = Cita::where('id_doctor', $request->id_doctor)
        ->where('fecha', $request->fecha)
        ->where('hora', $request->hora)
        ->where('estado', 'Pendiente')
        ->where('id_cita', '!=', $cita->id_cita)
        ->exists();

    if ($existe) {
        return back()->withErrors([
            'hora' => 'El doctor ya tiene una cita programada en esa fecha y hora.'
        ])->withInput();
    }
}

        $cita->update($request->all());
        return redirect()->route('citas.index')->with('success','Cita editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        //
    }

    public function buscarPaciente(Request $request){
        $pacientes = [];

        if($request->filled('buscar')){
            $pacientes = Paciente::where('nombre', 'like', '%' . $request->buscar . '%')->get();
            }
        return view('citas.buscarPaciente',compact('pacientes'));

    }
}
