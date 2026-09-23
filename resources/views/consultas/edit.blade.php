@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Editar consulta</h2>

    <p>
        <strong>Paciente:</strong>
        {{ $consulta->expediente->paciente->nombre }}
    </p>

    <hr>

    <form action="{{ route('consultas.update', $consulta) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_cita" class="form-label">
                Cita
            </label>

            <select name="id_cita" id="id_cita" class="form-select">

                <option value="">Seleccione una cita...</option>

                @foreach($citas as $cita)

                    <option value="{{ $cita->id_cita }}"
                        {{ old('id_cita', $consulta->id_cita) == $cita->id_cita ? 'selected' : '' }}>

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
            >{{ old('enfermedad_actual', $consulta->enfermedad_actual) }}</textarea>
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
                value="{{ old('proxima_cita', $consulta->proxima_cita) }}"
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Actualizar consulta
        </button>

        <a href="{{ route('consultas.show', $consulta) }}"
           class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

@endsection