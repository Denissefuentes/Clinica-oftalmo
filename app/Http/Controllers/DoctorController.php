<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctores = Doctor::all();
        return view('doctores.index', compact('doctores'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'cedula'=>'required',
            'telefono'=>'required',
        ]);

        Doctor :: create($request->all());
        return redirect()->route('doctores.index')->with('success','Doctor registrado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        return view('doctores.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'nombre'=>'required',
            'cedula'=>'required',
            'telefono'=>'required',
        ]);

        $doctor->update($request->all());
        return redirect()->route('doctores.index')->with('success','Doctor editado con exito');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }

    public function cambiarEstado(Doctor $doctor)
    {
        $doctor->activo = !$doctor->activo;
        $doctor->save();
        return redirect()->route('doctores.index')->with('success','Estado del doctor actualizado con exito');
    }
}
