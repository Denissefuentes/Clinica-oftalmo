@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Editar examen</h2>

    <p>
        <strong>Paciente:</strong>
        {{ $examen->consulta->expediente->paciente->nombre }}
    </p>

    <p>
        <strong>Tipo de paciente:</strong>
        {{ $examen->consulta->expediente->paciente->tipo_paciente }}
    </p>

    <hr>

    <form
        action="{{ route('examenes.update', $examen) }}"
        method="POST">

        @csrf
        @method('PUT')


        {{-- ================================= --}}
        {{-- EXAMEN PEDIÁTRICO --}}
        {{-- ================================= --}}

        @if($examen->consulta->expediente->paciente->tipo_paciente === 'Pediatrico')

            @php
                $datos = $examen->agudeza_visual_pediatrico;
            @endphp

            <h4>Agudeza Visual (según edad)</h4>

            <div class="table-responsive">

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

                            <td>
                                <strong>OD</strong> (Derecho)
                            </td>

                            <td>
                                <input
                                    type="text"
                                    name="av_con_cicloplejia_od"
                                    class="form-control"
                                    value="{{ old('av_con_cicloplejia_od', $datos->av_con_cicloplejia_od ?? '') }}">
                            </td>

                            <td>
                                <input
                                    type="text"
                                    name="av_sin_cicloplejia_od"
                                    class="form-control"
                                    value="{{ old('av_sin_cicloplejia_od', $datos->av_sin_cicloplejia_od ?? '') }}">
                            </td>

                        </tr>

                        <tr>

                            <td>
                                <strong>OS</strong> (Izquierdo)
                            </td>

                            <td>
                                <input
                                    type="text"
                                    name="av_con_cicloplejia_os"
                                    class="form-control"
                                    value="{{ old('av_con_cicloplejia_os', $datos->av_con_cicloplejia_os ?? '') }}">
                            </td>

                            <td>
                                <input
                                    type="text"
                                    name="av_sin_cicloplejia_os"
                                    class="form-control"
                                    value="{{ old('av_sin_cicloplejia_os', $datos->av_sin_cicloplejia_os ?? '') }}">
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- MÉTODOS --}}

            <div class="mb-3">

                <label class="form-label">
                    <strong>Método:</strong>
                </label>

                <div class="form-check form-check-inline">

                    <input
                        type="hidden"
                        name="metodo_optotipos"
                        value="0">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="metodo_optotipos"
                        value="1"
                        @checked(old(
                            'metodo_optotipos',
                            $datos->metodo_optotipos ?? false
                        ))>

                    <label class="form-check-label">
                        Optotipos
                    </label>

                </div>


                <div class="form-check form-check-inline">

                    <input
                        type="hidden"
                        name="metodo_test_lea"
                        value="0">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="metodo_test_lea"
                        value="1"
                        @checked(old(
                            'metodo_test_lea',
                            $datos->metodo_test_lea ?? false
                        ))>

                    <label class="form-check-label">
                        Test de Lea
                    </label>

                </div>


                <div class="form-check form-check-inline">

                    <input
                        type="hidden"
                        name="metodo_mirada_preferencial"
                        value="0">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="metodo_mirada_preferencial"
                        value="1"
                        @checked(old(
                            'metodo_mirada_preferencial',
                            $datos->metodo_mirada_preferencial ?? false
                        ))>

                    <label class="form-check-label">
                        Mirada preferencial
                    </label>

                </div>


                <div class="form-check form-check-inline">

                    <input
                        type="hidden"
                        name="metodo_reflejo_rojo"
                        value="0">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="metodo_reflejo_rojo"
                        value="1"
                        @checked(old(
                            'metodo_reflejo_rojo',
                            $datos->metodo_reflejo_rojo ?? false
                        ))>

                    <label class="form-check-label">
                        Reflejo rojo
                    </label>

                </div>

            </div>


            {{-- OBSERVACIONES --}}

            <div class="mb-3">

                <label
                    for="observaciones"
                    class="form-label">

                    Observaciones

                </label>

                <textarea
                    name="observaciones"
                    id="observaciones"
                    class="form-control"
                    rows="4">{{ old('observaciones', $datos->observaciones ?? '') }}</textarea>

            </div>


        {{-- ================================= --}}
        {{-- EXAMEN ADULTO --}}
        {{-- ================================= --}}

        @else

            @php
                $datos = $examen->examen_visual_adulto;
            @endphp

            <h4>Examen visual</h4>

            <div class="table-responsive">

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

                            <td>
                                <strong>OD</strong> (Derecho)
                            </td>

                            <td>
                                <input
                                    type="text"
                                    name="av_lejos_sin_correccion_od"
                                    class="form-control"
                                    value="{{ old('av_lejos_sin_correccion_od', $datos->av_lejos_sin_correccion_od ?? '') }}">
                            </td>

                            <td>
                                <input
                                    type="text"
                                    name="av_lejos_con_correccion_od"
                                    class="form-control"
                                    value="{{ old('av_lejos_con_correccion_od', $datos->av_lejos_con_correccion_od ?? '') }}">
                            </td>

                            <td>
                                <input
                                    type="text"
                                    name="av_cerca_od"
                                    class="form-control"
                                    value="{{ old('av_cerca_od', $datos->av_cerca_od ?? '') }}">
                            </td>

                        </tr>


                        <tr>

                            <td>
                                <strong>OS</strong> (Izquierdo)
                            </td>

                            <td>
                                <input
                                    type="text"
                                    name="av_lejos_sin_correccion_os"
                                    class="form-control"
                                    value="{{ old('av_lejos_sin_correccion_os', $datos->av_lejos_sin_correccion_os ?? '') }}">
                            </td>

                            <td>
                                <input
                                    type="text"
                                    name="av_lejos_con_correccion_os"
                                    class="form-control"
                                    value="{{ old('av_lejos_con_correccion_os', $datos->av_lejos_con_correccion_os ?? '') }}">
                            </td>

                            <td>
                                <input
                                    type="text"
                                    name="av_cerca_os"
                                    class="form-control"
                                    value="{{ old('av_cerca_os', $datos->av_cerca_os ?? '') }}">
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- OBSERVACIONES --}}

            <div class="mb-3">

                <label
                    for="observaciones"
                    class="form-label">

                    Observaciones

                </label>

                <textarea
                    name="observaciones"
                    id="observaciones"
                    class="form-control"
                    rows="4">{{ old('observaciones', $datos->observaciones ?? '') }}</textarea>

            </div>

        @endif


        {{-- BOTONES --}}

        <button
            type="submit"
            class="btn btn-primary">

            Actualizar examen

        </button>

        <a
            href="{{ route('consultas.show', $examen->consulta) }}"
            class="btn btn-secondary">

            Cancelar

        </a>

    </form>

</div>

@endsection