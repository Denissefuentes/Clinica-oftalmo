@extends('layouts.app')

@section('content')

<div class="container">


<h2>Alineación y motilidad ocular</h2>

<p>
    <strong>Paciente:</strong>
    {{ $examen->consulta->expediente->paciente->nombre }}
</p>

<hr>

<form action="{{ route('alineacion_motilidad.update', $examen->id_examen) }}" method="POST">
    @csrf
    @method('PUT')

    <h4>Test de Hirschberg (reflejo corneal)</h4>

    <div class="mb-3">

        <label class="form-label">Resultado</label><br>

        <input type="radio"
               name="hirschberg_resultado"
               value="Centrado"
               {{ $alineacion->hirschberg_resultado == 'Centrado' ? 'checked' : '' }}>
        Centrado

        <input type="radio"
               name="hirschberg_resultado"
               value="Desviado"
               class="ms-3"
               {{ $alineacion->hirschberg_resultado == 'Desviado' ? 'checked' : '' }}>
        Desviado

    </div>

    <div class="mb-3">

        <label class="form-label">Dirección de la desviación</label>

        <select name="hirschberg_direccion" class="form-select">

            <option value="">Seleccione</option>

            <option value="Nasal"
                {{ $alineacion->hirschberg_direccion == 'Nasal' ? 'selected' : '' }}>
                Nasal
            </option>

            <option value="Temporal"
                {{ $alineacion->hirschberg_direccion == 'Temporal' ? 'selected' : '' }}>
                Temporal
            </option>

            <option value="Superior"
                {{ $alineacion->hirschberg_direccion == 'Superior' ? 'selected' : '' }}>
                Superior
            </option>

            <option value="Inferior"
                {{ $alineacion->hirschberg_direccion == 'Inferior' ? 'selected' : '' }}>
                Inferior
            </option>

        </select>

    </div>

    <div class="mb-3">

        <label class="form-label">
            Desviación estimada
        </label>

        <input type="text"
               name="hirschberg_desviacion"
               class="form-control"
               value="{{ $alineacion->hirschberg_desviacion }}">

    </div>


    <hr>

    <h4>Cover Test</h4>

    <div class="mb-3">

        <label class="form-label">Resultado</label><br>

        <input type="radio"
               name="cover_resultado"
               value="Ortotropía"
               {{ $alineacion->cover_resultado == 'Ortotropía' ? 'checked' : '' }}>
        Ortotropía

        <input type="radio"
               name="cover_resultado"
               value="Tropia"
               class="ms-3"
               {{ $alineacion->cover_resultado == 'Tropia' ? 'checked' : '' }}>
        Tropia

    </div>

    <div class="mb-3">

        <label class="form-label">Tipo de tropia</label>

        <select name="cover_tipo_tropia" class="form-select">

            <option value="">Seleccione</option>

            <option value="ET"
                {{ $alineacion->cover_tipo_tropia == 'ET' ? 'selected' : '' }}>
                ET
            </option>

            <option value="XT"
                {{ $alineacion->cover_tipo_tropia == 'XT' ? 'selected' : '' }}>
                XT
            </option>

            <option value="HT"
                {{ $alineacion->cover_tipo_tropia == 'HT' ? 'selected' : '' }}>
                HT
            </option>

            <option value="Hipotropía"
                {{ $alineacion->cover_tipo_tropia == 'Hipotropía' ? 'selected' : '' }}>
                Hipotropía
            </option>

        </select>

    </div>

    <div class="mb-3">

        <label class="form-label">Modalidad</label><br>

        <input type="radio"
               name="cover_modalidad"
               value="Alternante"
               {{ $alineacion->cover_modalidad == 'Alternante' ? 'checked' : '' }}>
        Alternante

        <input type="radio"
               name="cover_modalidad"
               value="Monocular"
               class="ms-3"
               {{ $alineacion->cover_modalidad == 'Monocular' ? 'checked' : '' }}>
        Monocular

    </div>

    <div class="row">

        <div class="col-md-6 mb-3">

            <label class="form-label">
                Distancia
            </label>

            <input type="text"
                   name="cover_distancia"
                   class="form-control"
                   value="{{ $alineacion->cover_distancia }}">

        </div>

        <div class="col-md-6 mb-3">

            <label class="form-label">
                Cerca
            </label>

            <input type="text"
                   name="cover_cerca"
                   class="form-control"
                   value="{{ $alineacion->cover_cerca }}">

        </div>

    </div>


    <hr>

    <h4>Versiones (movimientos conjugados)</h4>

    <div class="mb-3">

        <label class="form-label">Resultado</label><br>

        <input type="radio"
               name="versiones_resultado"
               value="Normales"
               {{ $alineacion->versiones_resultado == 'Normales' ? 'checked' : '' }}>
        Normales

        <input type="radio"
               name="versiones_resultado"
               value="Limitadas"
               class="ms-3"
               {{ $alineacion->versiones_resultado == 'Limitadas' ? 'checked' : '' }}>
        Limitadas

    </div>

    <div class="mb-3">

        <label class="form-label">
            Limitadas en
        </label>

        <textarea name="versiones_limitadas"
                  class="form-control"
                  rows="2">{{ $alineacion->versiones_limitadas }}</textarea>

    </div>


    <hr>

    <h4>Ducciones (movimientos monoculares)</h4>

    <div class="mb-3">

        <label class="form-label">Resultado</label><br>

        <input type="radio"
               name="ducciones_resultado"
               value="Normales"
               {{ $alineacion->ducciones_resultado == 'Normales' ? 'checked' : '' }}>
        Normales

        <input type="radio"
               name="ducciones_resultado"
               value="Limitadas"
               class="ms-3"
               {{ $alineacion->ducciones_resultado == 'Limitadas' ? 'checked' : '' }}>
        Limitadas

    </div>

    <div class="mb-3">

        <label class="form-label">
            Limitadas en
        </label>

        <textarea name="ducciones_limitadas"
                  class="form-control"
                  rows="2">{{ $alineacion->ducciones_limitadas }}</textarea>

    </div>


    <hr>

    <h4>Nistagmo</h4>

    <div class="mb-3">

        <input type="radio"
               name="nistagmo"
               value="No"
               {{ $alineacion->nistagmo == 'No' ? 'checked' : '' }}>
        No

        <input type="radio"
               name="nistagmo"
               value="Sí"
               class="ms-3"
               {{ $alineacion->nistagmo == 'Sí' ? 'checked' : '' }}>
        Sí

    </div>

    <div class="mb-3">

        <label class="form-label">
            Tipo
        </label>

        <input type="text"
               name="nistagmo_tipo"
               class="form-control"
               value="{{ $alineacion->nistagmo_tipo }}">

    </div>


    <hr>

    <h4>Ojo dominante</h4>

    <div class="mb-4">

        <input type="radio"
               name="ojo_dominante"
               value="OD"
               {{ $alineacion->ojo_dominante == 'OD' ? 'checked' : '' }}>
        OD

        <input type="radio"
               name="ojo_dominante"
               value="OS"
               class="ms-3"
               {{ $alineacion->ojo_dominante == 'OS' ? 'checked' : '' }}>
        OS

        <input type="radio"
               name="ojo_dominante"
               value="No definido"
               class="ms-3"
               {{ $alineacion->ojo_dominante == 'No definido' ? 'checked' : '' }}>
        No definido

    </div>


    <button type="submit" class="btn btn-primary">
        Actualizar
    </button>

    <a href="{{ route('consultas.show', $examen->consulta) }}" class="btn btn-secondary">
        Cancelar
    </a>

</form>


</div>

@endsection
