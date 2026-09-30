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
            <hr>
<hr>

<h4>Examen oftalmológico</h4>

@if($consulta->examen)

    @if($consulta->expediente->paciente->tipo_paciente === 'Pediatrico')

        @if($consulta->examen->agudeza_visual_pediatrico)

            <h5>Agudeza visual pediátrica</h5>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Ojo</th>
                        <th>AV con cicloplejia</th>
                        <th>AV sin cicloplejia</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td><strong>OD</strong> (Derecho)</td>

                        <td>
                            {{ $consulta->examen->agudeza_visual_pediatrico->av_con_cicloplejia_od }}
                        </td>

                        <td>
                            {{ $consulta->examen->agudeza_visual_pediatrico->av_sin_cicloplejia_od }}
                        </td>
                    </tr>

                    <tr>
                        <td><strong>OS</strong> (Izquierdo)</td>

                        <td>
                            {{ $consulta->examen->agudeza_visual_pediatrico->av_con_cicloplejia_os }}
                        </td>

                        <td>
                            {{ $consulta->examen->agudeza_visual_pediatrico->av_sin_cicloplejia_os }}
                        </td>
                    </tr>

                </tbody>

            </table>

            <p>
                <strong>Métodos:</strong>
            </p>

            <ul>
                @if($consulta->examen->agudeza_visual_pediatrico->metodo_optotipos)
                    <li>Optotipos</li>
                @endif

                @if($consulta->examen->agudeza_visual_pediatrico->metodo_test_lea)
                    <li>Test de Lea</li>
                @endif

                @if($consulta->examen->agudeza_visual_pediatrico->metodo_mirada_preferencial)
                    <li>Mirada preferencial</li>
                @endif

                @if($consulta->examen->agudeza_visual_pediatrico->metodo_reflejo_rojo)
                    <li>Reflejo rojo</li>
                @endif
            </ul>

            <p>
                <strong>Observaciones:</strong>
                {{ $consulta->examen->agudeza_visual_pediatrico->observaciones ?: 'No registradas.' }}
            </p>

        @endif

    @else

        @if($consulta->examen->examen_visual_adulto)

            <h5>Examen visual</h5>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Ojo</th>
                        <th>AV lejos sin corrección</th>
                        <th>AV lejos con corrección</th>
                        <th>AV cerca</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td><strong>OD</strong> (Derecho)</td>

                        <td>
                            {{ $consulta->examen->examen_visual_adulto->av_lejos_sin_correccion_od }}
                        </td>

                        <td>
                            {{ $consulta->examen->examen_visual_adulto->av_lejos_con_correccion_od }}
                        </td>

                        <td>
                            {{ $consulta->examen->examen_visual_adulto->av_cerca_od }}
                        </td>
                    </tr>

                    <tr>
                        <td><strong>OS</strong> (Izquierdo)</td>

                        <td>
                            {{ $consulta->examen->examen_visual_adulto->av_lejos_sin_correccion_os }}
                        </td>

                        <td>
                            {{ $consulta->examen->examen_visual_adulto->av_lejos_con_correccion_os }}
                        </td>

                        <td>
                            {{ $consulta->examen->examen_visual_adulto->av_cerca_os }}
                        </td>
                    </tr>

                </tbody>

            </table>

            <p>
                <strong>Observaciones:</strong>
                {{ $consulta->examen->examen_visual_adulto->observaciones ?: 'No registradas.' }}
            </p>

        @endif

    @endif

    <a
        href="{{ route('examenes.edit', $consulta->examen) }}"
        class="btn btn-warning">
        Editar examen
    </a>

@else

    <a
        href="{{ route('examenes.create', $consulta) }}"
        class="btn btn-primary">
        Registrar examen
    </a>

@endif
        </div>
    </div>

    <br>

    <a href="{{ route('expedientes.consultas', $consulta->expediente) }}"class="btn btn-secondary">
        Volver a consultas
    </a>

</div>

@endsection