@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Consulta clínica</h2>

    <div class="card">
        <div class="card-body">

            <h4>
                {{ $consulta->expediente->paciente->nombre }}
            </h4>

            <hr>

            <p>
                <strong>Fecha de consulta:</strong>
                {{ $consulta->created_at->format('d/m/Y') }}
            </p>

            @if($consulta->cita)
                <p>
                    <strong>Cita:</strong>
                    #{{ $consulta->cita->id_cita }}
                </p>
            @endif

            <p>
                <strong>Enfermedad actual:</strong>
            </p>

            @if($consulta->enfermedad_actual)
                <p>
                    {{ $consulta->enfermedad_actual }}
                </p>
            @else
                <p>
                    No registrada.
                </p>
            @endif

            <p>
                <strong>Próxima cita:</strong>

                @if($consulta->proxima_cita)
                    {{ \Carbon\Carbon::parse($consulta->proxima_cita)->format('d/m/Y') }}
                @else
                    No registrada.
                @endif
            </p>

        </div>
    </div>

    <br>

    <a href="{{ route('expedientes.consultas', $consulta->expediente) }}"
       class="btn btn-secondary">
        Volver a consultas
    </a>

   

</div>

@endsection