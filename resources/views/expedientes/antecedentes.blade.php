@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Antecedentes del paciente</h2>

    <p>
        <strong>Paciente:</strong>
        {{ $expediente->paciente->nombre }}
    </p>

    <p>
        <strong>Tipo de paciente:</strong>
        {{ $expediente->paciente->tipo_paciente }}
    </p>
    <hr>

    <form
        action="{{ route('expedientes.antecedentes.guardar', $expediente) }}"
        method="POST">

        @csrf

        <h3>Seleccione los antecedentes</h3>
        @if ($expediente->paciente->tipo_paciente==='Pediatrico')
        
<h5>Antecedentes Prenatales</h5>

@foreach($antecedentes->where('categoria', 'Prenatales') as $antecedente)

    <div>
        <label>
            <input
                type="checkbox"
                name="antecedentes[]"
                value="{{ $antecedente->id_antecedentes }}"
            >

            {{ $antecedente->nombre }}
        </label>
    </div>
@endforeach
<hr>

<h5>Antecedentes de desarrollo psicomotor</h5>

@foreach($antecedentes->where('categoria', 'Desarrollo psicomotor') as $antecedente)

    <div>
        <label>
            <input
                type="checkbox"
                name="antecedentes[]"
                value="{{ $antecedente->id_antecedentes }}"
            >

            {{ $antecedente->nombre }}
        </label>
    </div>
@endforeach
<hr>   
<h5>Antecedentes patológicos personales</h5>

@foreach($antecedentes->where('categoria', 'Patológicos personales') as $antecedente)

    <div>
        <label>
            <input
                type="checkbox"
                name="antecedentes[]"
                value="{{ $antecedente->id_antecedentes }}"
            >

            {{ $antecedente->nombre }}
        </label>
    </div>
@endforeach
<hr>
        @endif

<h5>Antecedentes Oftalmologicos</h5>

@foreach($antecedentes->where('categoria', 'Oftalmológicos') as $antecedente)

    <div>
        <label>
            <input
                type="checkbox"
                name="antecedentes[]"
                value="{{ $antecedente->id_antecedentes }}"
            >

            {{ $antecedente->nombre }}
        </label>
    </div>
@endforeach
<hr>
        
<h5>Antecedentes médicos</h5>

@foreach($antecedentes->where('categoria', 'Médicos') as $antecedente)

    <div>
        <label>
            <input
                type="checkbox"
                name="antecedentes[]"
                value="{{ $antecedente->id_antecedentes }}"
            >

            {{ $antecedente->nombre }}
        </label>
    </div>
@endforeach
<hr>
        <button type="submit">
            Guardar antecedentes
        </button>

    </form>

</div>

@endsection