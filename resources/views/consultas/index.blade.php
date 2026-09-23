@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Consultas del paciente</h2>

    <p>
        <strong>Paciente:</strong>
        {{ $expediente->paciente->nombre }}
    </p>

    <p>
        <strong>Tipo de paciente:</strong>
        {{ $expediente->paciente->tipo_paciente }}
    </p>

    <hr>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Historial de consultas</h4>

        <a href="{{ route('consultas.create', $expediente) }}"
           class="btn btn-primary">
            Registrar consulta
        </a>
    </div>

    @if($consultas->isEmpty())

        <div class="alert alert-info">
            No se han registrado consultas para este paciente.
        </div>

    @else

        @foreach($consultas as $consulta)

            <div class="card mb-3">
                <div class="card-body">

                    <h5>
                        Consulta del
                        {{ $consulta->created_at->format('d/m/Y') }}
                    </h5>

                    @if($consulta->enfermedad_actual)
                        <p>
                            <strong>Enfermedad actual:</strong>
                            {{ $consulta->enfermedad_actual }}
                        </p>
                    @else
                        <p>
                            <strong>Enfermedad actual:</strong>
                            No registrada
                        </p>
                    @endif

                    @if($consulta->proxima_cita)
                        <p>
                            <strong>Próxima cita:</strong>
                            {{ \Carbon\Carbon::parse($consulta->proxima_cita)->format('d/m/Y') }}
                        </p>
                    @endif

                    <a href="{{ route('consultas.show', $consulta) }}"
                       class="btn btn-secondary">
                        Ver consulta
                    </a>

                     <a href="{{ route('consultas.edit', $consulta) }}"class="btn btn-primary">
                        Editar consulta</a>

                </div>
            </div>

        @endforeach

    @endif

    <a href="{{ route('expedientes.show', $expediente) }}"
       class="btn btn-outline-secondary">
        Volver al expediente
    </a>

    
</div>

@endsection