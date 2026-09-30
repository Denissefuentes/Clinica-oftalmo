@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Alineación y motilidad ocular</h2>

    <p>
        <strong>Paciente:</strong>
        {{ $examen->consulta->expediente->paciente->nombre }}
    </p>

    <hr>

    <form action="{{ route('alineacion_motilidad.store', $examen->id_examen) }}" method="POST">
        @csrf

        <h4>Test de Hirschberg (reflejo corneal)</h4>

        <div class="mb-3">

            <label class="form-label">Resultado</label><br>

            <input type="radio"
                   name="hirschberg_resultado"
                   value="Centrado">
            Centrado

            <input type="radio"
                   name="hirschberg_resultado"
                   value="Desviado"
                   class="ms-3">
            Desviado

        </div>

        <div class="mb-3">

            <label class="form-label">Dirección de la desviación</label>

            <select name="hirschberg_direccion" class="form-select">

                <option value="">Seleccione</option>

                <option value="Nasal">Nasal</option>
                <option value="Temporal">Temporal</option>
                <option value="Superior">Superior</option>
                <option value="Inferior">Inferior</option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Desviación estimada
            </label>

            <input type="text"
                   name="hirschberg_desviacion"
                   class="form-control">

        </div>


        <hr>

        <h4>Cover Test</h4>

        <div class="mb-3">

            <label class="form-label">Resultado</label><br>

            <input type="radio"
                   name="cover_resultado"
                   value="Ortotropía">
            Ortotropía

            <input type="radio"
                   name="cover_resultado"
                   value="Tropia"
                   class="ms-3">
            Tropia

        </div>

        <div class="mb-3">

            <label class="form-label">Tipo de tropia</label>

            <select name="cover_tipo_tropia" class="form-select">

                <option value="">Seleccione</option>

                <option value="ET">ET</option>
                <option value="XT">XT</option>
                <option value="HT">HT</option>
                <option value="Hipotropía">Hipotropía</option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">Modalidad</label><br>

            <input type="radio"
                   name="cover_modalidad"
                   value="Alternante">
            Alternante

            <input type="radio"
                   name="cover_modalidad"
                   value="Monocular"
                   class="ms-3">
            Monocular

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Distancia
                </label>

                <input type="text"
                       name="cover_distancia"
                       class="form-control">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Cerca
                </label>

                <input type="text"
                       name="cover_cerca"
                       class="form-control">

            </div>

        </div>


        <hr>

        <h4>Versiones (movimientos conjugados)</h4>

        <div class="mb-3">

            <label class="form-label">Resultado</label><br>

            <input type="radio"
                   name="versiones_resultado"
                   value="Normales">
            Normales

            <input type="radio"
                   name="versiones_resultado"
                   value="Limitadas"
                   class="ms-3">
            Limitadas

        </div>

        <div class="mb-3">

            <label class="form-label">
                Limitadas en
            </label>

            <textarea name="versiones_limitadas"
                      class="form-control"
                      rows="2"></textarea>

        </div>


        <hr>

        <h4>Ducciones (movimientos monoculares)</h4>

        <div class="mb-3">

            <label class="form-label">Resultado</label><br>

            <input type="radio"
                   name="ducciones_resultado"
                   value="Normales">
            Normales

            <input type="radio"
                   name="ducciones_resultado"
                   value="Limitadas"
                   class="ms-3">
            Limitadas

        </div>

        <div class="mb-3">

            <label class="form-label">
                Limitadas en
            </label>

            <textarea name="ducciones_limitadas"
                      class="form-control"
                      rows="2"></textarea>

        </div>


        <hr>

        <h4>Nistagmo</h4>

        <div class="mb-3">

            <input type="radio"
                   name="nistagmo"
                   value="No">
            No

            <input type="radio"
                   name="nistagmo"
                   value="Sí"
                   class="ms-3">
            Sí

        </div>

        <div class="mb-3">

            <label class="form-label">
                Tipo
            </label>

            <input type="text"
                   name="nistagmo_tipo"
                   class="form-control">

        </div>


        <hr>

        <h4>Ojo dominante</h4>

        <div class="mb-4">

            <input type="radio"
                   name="ojo_dominante"
                   value="OD">
            OD

            <input type="radio"
                   name="ojo_dominante"
                   value="OS"
                   class="ms-3">
            OS

            <input type="radio"
                   name="ojo_dominante"
                   value="No definido"
                   class="ms-3">
            No definido

        </div>


        <button type="submit" class="btn btn-primary">
            Guardar
        </button>

        <a href="{{ route('consultas.show', $examen->consulta) }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

@endsection