@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Registrar consulta</h2>
    <p>
        <strong>Paciente:</strong>
        {{ $expediente->paciente->nombre }}
    </p>

    <p>
        <strong>Tipo de paciente:</strong>
        {{ $expediente->paciente->tipo_paciente }}
    </p>


    <form action="{{ route('consultas.store', $expediente) }}"
          method="POST">

        @csrf

       <div class="mb-3">
    <label for="id_cita" class="form-label">
        Cita
    </label>

    <select name="id_cita" id="id_cita" class="form-select">

        <option value="">Seleccione una cita...</option>

        @foreach($citas as $cita)
            <option value="{{ $cita->id_cita }}"
                {{ old('id_cita') == $cita->id_cita ? 'selected' : '' }}>

                {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                -
                {{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}
                -
                {{ $cita->motivo }}

            </option>
        @endforeach

    </select>
</div>

        <div class="mb-3">
            <label for="enfermedad_actual" class="form-label">
                Enfermedad actual
            </label>

            <textarea
                name="enfermedad_actual"
                id="enfermedad_actual"
                class="form-control"
                rows="4"
            >{{ old('enfermedad_actual') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="diagnostico" class="form-label">
                Diagnostico consulta
            </label>

            <textarea
                name="diagnostico"
                id="diagnostico"
                class="form-control"
                rows="4"
            >{{ old('diagnostico') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="proxima_cita" class="form-label">
                Próxima cita
            </label>

            <input
                type="date"
                name="proxima_cita"
                id="proxima_cita"
                class="form-control"
                value="{{ old('proxima_cita') }}"
            >


            
        </div>


        <button type="submit" class="btn btn-primary">
            Guardar consulta
        </button>

        <a href="{{ route('expedientes.show', $expediente) }}"
       class="btn btn-outline-secondary">
        Volver al expediente
    </a>

    </form>

</div>

@endsection