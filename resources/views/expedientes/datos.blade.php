@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Datos adicionales oftalmológicos</h2>

    <form action="{{ route('datos_adicionales.store', $expediente->id_expediente) }}" method="POST">

        @csrf


        {{-- ============================= --}}
        {{-- DATOS GENERALES --}}
        {{-- ============================= --}}

        <h4 class="mb-3">Datos generales</h4>

        <div class="mb-3">

            <label for="uso_lentes" class="form-label">
                Uso de lentes
            </label>

            <select name="uso_lentes" id="uso_lentes" class="form-select" required>

                <option value="">Seleccione...</option>

                <option value="1"
                    {{ old('uso_lentes', $datos_adicionales->uso_lentes ?? '') == '1' ? 'selected' : '' }}>
                    Sí
                </option>

                <option value="0"
                    {{ old('uso_lentes', $datos_adicionales->uso_lentes ?? '') == '0' ? 'selected' : '' }}>
                    No
                </option>

            </select>

        </div>


        <div class="mb-3">

            <label for="tipo_lentes" class="form-label">
                Tipo de lentes
            </label>

            <select name="tipo_lentes" id="tipo_lentes" class="form-select">

                <option value="">Seleccione...</option>

                <option value="Gafas"
                    {{ old('tipo_lentes', $datos_adicionales->tipo_lentes ?? '') == 'Gafas' ? 'selected' : '' }}>
                    Gafas
                </option>

                <option value="Lentes_de_contacto"
                    {{ old('tipo_lentes', $datos_adicionales->tipo_lentes ?? '') == 'Lentes_de_contacto' ? 'selected' : '' }}>
                    Lentes de contacto
                </option>

            </select>

        </div>


        <div class="mb-3">

            <label for="graduacion_previa" class="form-label">
                Graduación previa
            </label>

            <input
                type="text"
                name="graduacion_previa"
                id="graduacion_previa"
                class="form-control"
                value="{{ old('graduacion_previa', $datos_adicionales->graduacion_previa ?? '') }}"
            >

        </div>


        <div class="mb-3">

            <label for="quirurgicos_generales" class="form-label">
                Antecedentes quirúrgicos generales
            </label>

            <input
                type="text"
                name="quirurgicos_generales"
                id="quirurgicos_generales"
                class="form-control"
                value="{{ old('quirurgicos_generales', $datos_adicionales->quirurgicos_generales ?? '') }}"
            >

        </div>


        <div class="mb-3">

            <label for="medicamentos_actuales" class="form-label">
                Medicamentos actuales
            </label>

            <input
                type="text"
                name="medicamentos_actuales"
                id="medicamentos_actuales"
                class="form-control"
                value="{{ old('medicamentos_actuales', $datos_adicionales->medicamentos_actuales ?? '') }}"
            >

        </div>


        <div class="mb-3">

            <label for="otros_antecedentes" class="form-label">
                Otros antecedentes
            </label>

            <input
                type="text"
                name="otros_antecedentes"
                id="otros_antecedentes"
                class="form-control"
                value="{{ old('otros_antecedentes', $datos_adicionales->otros_antecedentes ?? '') }}"
            >

        </div>


        {{-- ============================= --}}
        {{-- DATOS PEDIÁTRICOS --}}
        {{-- ============================= --}}

        @if($expediente->paciente->tipo_paciente === 'Pediatrico')

            <hr>

            <h4 class="mb-3">
                Datos pediátricos
            </h4>


            <div class="mb-3">

                <label for="retraso_desarrollo_psicomotor" class="form-label">
                    Retraso del desarrollo psicomotor
                </label>

                <input
                    type="text"
                    name="retraso_desarrollo_psicomotor"
                    id="retraso_desarrollo_psicomotor"
                    class="form-control"
                    value="{{ old('retraso_desarrollo_psicomotor', $datos_adicionales->retraso_desarrollo_psicomotor ?? '') }}"
                >

            </div>


            <div class="mb-3">

                <label for="complicaciones_embarazo" class="form-label">
                    Complicaciones del embarazo
                </label>

                <input
                    type="text"
                    name="complicaciones_embarazo"
                    id="complicaciones_embarazo"
                    class="form-control"
                    value="{{ old('complicaciones_embarazo', $datos_adicionales->complicaciones_embarazo ?? '') }}"
                >

            </div>


            <div class="mb-3">

                <label for="semanas_nacimiento" class="form-label">
                    Prematuro - semanas
                </label>

                <input
                    type="text"
                    name="semanas_nacimiento"
                    id="semanas_nacimiento"
                    class="form-control"
                    value="{{ old('semanas_nacimiento', $datos_adicionales->semanas_nacimiento ?? '') }}"
                >

            </div>


            <div class="mb-3">

                <label for="peso_al_nacer" class="form-label">
                    Peso al nacer
                </label>

                <input
                    type="text"
                    name="peso_al_nacer"
                    id="peso_al_nacer"
                    class="form-control"
                    value="{{ old('peso_al_nacer', $datos_adicionales->peso_al_nacer ?? '') }}"
                >

            </div>

        @endif


        {{-- ============================= --}}
        {{-- BOTONES --}}
        {{-- ============================= --}}

        <button type="submit" class="btn btn-primary">
            Guardar datos
        </button>

        <a href="{{ route('expedientes.show', $expediente) }}"
           class="btn btn-outline-secondary">
            Volver al expediente
        </a>

    </form>

</div>

@endsection