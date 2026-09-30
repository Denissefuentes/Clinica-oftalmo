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
                <strong>Diagnostico:</strong>
            </p>

            @if($consulta->diagnostico)
                <p>
                    {{ $consulta->diagnostico }}
                </p>
            @else
                <p>
                    No registrado.
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


@if($consulta->expediente->paciente->tipo_paciente === 'Pediatrico')

    <hr>

    <hr>

<h5>Alineación y motilidad ocular</h5>

@if($consulta->examen)

    @if($consulta->examen->alineacionMotilidadPediatrico)

        @php
            $alineacion = $consulta->examen->alineacionMotilidadPediatrico;
        @endphp

        <p>
            <strong>Test de Hirschberg:</strong>
            {{ $alineacion->hirschberg_resultado ?? 'No registrado' }}
        </p>

        @if($alineacion->hirschberg_direccion)
            <p>
                <strong>Dirección:</strong>
                {{ $alineacion->hirschberg_direccion }}
            </p>
        @endif

        @if($alineacion->hirschberg_desviacion)
            <p>
                <strong>Desviación:</strong>
                {{ $alineacion->hirschberg_desviacion }}
            </p>
        @endif

        <p>
            <strong>Cover test:</strong>
            {{ $alineacion->cover_resultado ?? 'No registrado' }}
        </p>

        @if($alineacion->cover_tipo_tropia)
            <p>
                <strong>Tipo de tropia:</strong>
                {{ $alineacion->cover_tipo_tropia }}
            </p>
        @endif

        @if($alineacion->cover_modalidad)
            <p>
                <strong>Modalidad:</strong>
                {{ $alineacion->cover_modalidad }}
            </p>
        @endif

        @if($alineacion->cover_distancia)
            <p>
                <strong>Distancia:</strong>
                {{ $alineacion->cover_distancia }}
            </p>
        @endif

        @if($alineacion->cover_cerca)
            <p>
                <strong>Cerca:</strong>
                {{ $alineacion->cover_cerca }}
            </p>
        @endif

        <p>
            <strong>Versiones:</strong>
            {{ $alineacion->versiones_resultado ?? 'No registrado' }}
        </p>

        @if($alineacion->versiones_limitadas)
            <p>
                <strong>Versiones limitadas:</strong>
                {{ $alineacion->versiones_limitadas }}
            </p>
        @endif

        <p>
            <strong>Ducciones:</strong>
            {{ $alineacion->ducciones_resultado ?? 'No registrado' }}
        </p>

        @if($alineacion->ducciones_limitadas)
            <p>
                <strong>Ducciones limitadas:</strong>
                {{ $alineacion->ducciones_limitadas }}
            </p>
        @endif

        <p>
            <strong>Nistagmo:</strong>
            {{ $alineacion->nistagmo ?? 'No registrado' }}
        </p>

        @if($alineacion->nistagmo_tipo)
            <p>
                <strong>Tipo de nistagmo:</strong>
                {{ $alineacion->nistagmo_tipo }}
            </p>
        @endif

        <p>
            <strong>Ojo dominante:</strong>
            {{ $alineacion->ojo_dominante ?? 'No registrado' }}
        </p>

        <a href="{{ route('alineacion_motilidad.edit', $consulta->examen->id_examen) }}"
           class="btn btn-warning">
            Editar alineación y motilidad
        </a>

    @else

        <p class="text-muted">
            No hay información de alineación y motilidad ocular registrada.
        </p>

        <a href="{{ route('alineacion_motilidad.create', $consulta->examen->id_examen) }}"
           class="btn btn-primary">
            Registrar alineación y motilidad
        </a>

    @endif

@else

    <p class="text-muted">
        Primero debe registrarse el examen para agregar la alineación y motilidad ocular.
    </p>

@endif

@endif

    <hr>

<h5>Exploración oftalmológica</h5>

@if($consulta->examen)

    @if($consulta->examen->exploracionOftalmologica)

        @php
            $exploracion = $consulta->examen->exploracionOftalmologica;
        @endphp

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Exploración</th>
                        <th>Ojo Derecho</th>
                        <th>Ojo Izquierdo</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>Presión intraocular</td>
                        <td>{{ $exploracion->presion_intraocular_od }}</td>
                        <td>{{ $exploracion->presion_intraocular_oi }}</td>
                    </tr>

                    <tr>
                        <td>Párpados y anexos</td>
                        <td>{{ $exploracion->parpados_anexos_od }}</td>
                        <td>{{ $exploracion->parpados_anexos_oi }}</td>
                    </tr>

                    <tr>
                        <td>Conjuntiva</td>
                        <td>{{ $exploracion->conjuntiva_od }}</td>
                        <td>{{ $exploracion->conjuntiva_oi }}</td>
                    </tr>

                    <tr>
                        <td>Córnea</td>
                        <td>{{ $exploracion->cornea_od }}</td>
                        <td>{{ $exploracion->cornea_oi }}</td>
                    </tr>

                    <tr>
                        <td>Cámara anterior</td>
                        <td>{{ $exploracion->camara_anterior_od }}</td>
                        <td>{{ $exploracion->camara_anterior_oi }}</td>
                    </tr>

                    <tr>
                        <td>Iris</td>
                        <td>{{ $exploracion->iris_od }}</td>
                        <td>{{ $exploracion->iris_oi }}</td>
                    </tr>

                    <tr>
                        <td>Pupilas</td>
                        <td>{{ $exploracion->pupilas_od }}</td>
                        <td>{{ $exploracion->pupilas_oi }}</td>
                    </tr>

                    <tr>
                        <td>Cristalino</td>
                        <td>{{ $exploracion->cristalino_od }}</td>
                        <td>{{ $exploracion->cristalino_oi }}</td>
                    </tr>

                    <tr>
                        <td>Fondo de ojo</td>
                        <td>{{ $exploracion->fondo_ojo_od }}</td>
                        <td>{{ $exploracion->fondo_ojo_oi }}</td>
                    </tr>

                </tbody>

            </table>

        </div>

        <a
            href="{{ route('exploracion_oftalmologica.edit', $consulta->examen->id_examen) }}"
            class="btn btn-warning">
            Editar exploración oftalmológica
        </a>

    @else

        <p class="text-muted">
            No hay información de exploración oftalmológica registrada.
        </p>

        <a
            href="{{ route('exploracion_oftalmologica.create', $consulta->examen->id_examen) }}"
            class="btn btn-primary">
            Registrar exploración oftalmológica
        </a>

    @endif

@else

    <p class="text-muted">
        Primero debe registrarse el examen para agregar la exploración oftalmológica.
    </p>

@endif

<hr>

<h5>Plan / Tratamiento</h5>

@if($consulta->tratamiento)

    @php
        $tratamiento = $consulta->tratamiento;
    @endphp

    <div class="table-responsive">

        <table class="table table-bordered">

            <tbody>

                <tr>
                    <th>Lentes</th>
                    <td>
                        {{ $tratamiento->lentes ? 'Sí' : 'No' }}
                    </td>
                </tr>

                <tr>
                    <th>Oclusión</th>
                    <td>
                        {{ $tratamiento->oclusion ? 'Sí' : 'No' }}
                    </td>
                </tr>

                <tr>
                    <th>Medicación</th>
                    <td>
                        {{ $tratamiento->medicacion ?? 'No registrado' }}
                    </td>
                </tr>

                <tr>
                    <th>Exámenes complementarios</th>
                    <td>
                        {{ $tratamiento->examenes_complementarios ?? 'No registrado' }}
                    </td>
                </tr>

                <tr>
                    <th>Referencias</th>
                    <td>
                        {{ $tratamiento->referencias ?? 'No registrado' }}
                    </td>
                </tr>

                <tr>
                    <th>Control en</th>
                    <td>
                        {{ $tratamiento->control_en ?? 'No registrado' }}
                    </td>
                </tr>

                <tr>
                    <th>Manejo médico</th>
                    <td>
                        {{ $tratamiento->manejo_medico ?? 'No registrado' }}
                    </td>
                </tr>

                <tr>
                    <th>Cirugía propuesta</th>
                    <td>
                        {{ $tratamiento->cirugia_propuesta ?? 'No registrado' }}
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

    <a
        href="{{ route('tratamientos.edit', $consulta->id_consulta) }}"
        class="btn btn-warning"
    >
        Editar tratamiento
    </a>

@else

    <p class="text-muted">
        No hay información de tratamiento registrada.
    </p>

    <a
        href="{{ route('tratamientos.create', $consulta->id_consulta) }}"
        class="btn btn-primary"
    >
        Registrar tratamiento
    </a>

@endif

<a href="{{ route('tratamientos.receta', $consulta->id_consulta) }}" class="btn btn-secondary"target="_blank">
    Imprimir receta</a>

<a href="{{ route('tratamientos.orden_examenes', $consulta->id_consulta) }}"class="btn btn-secondary" target="_blank">
    Imprimir orden de exámenes
</a>
        </div>
    </div>

    <br>

    <a href="{{ route('expedientes.consultas', $consulta->expediente) }}"class="btn btn-secondary">
        Volver a consultas
    </a>

</div>

@endsection