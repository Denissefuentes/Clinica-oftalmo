@extends('layouts.app')

@section('content')

<div class="container">


<h2>Registrar examen</h2>

<p>
    <strong>Paciente:</strong>
    {{ $consulta->expediente->paciente->nombre }}
</p>

<p>
    <strong>Tipo de paciente:</strong>
    {{ $consulta->expediente->paciente->tipo_paciente }}
</p>

<hr>

<form action="{{ route('examenes.store', $consulta) }}" method="POST">

    @csrf

    @if($consulta->expediente->paciente->tipo_paciente === 'Pediatrico')

        {{-- EXAMEN PEDIÁTRICO --}}

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
                                class="form-control">
                        </td>

                        <td>
                            <input
                                type="text"
                                name="av_sin_cicloplejia_od"
                                class="form-control">
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
                                class="form-control">
                        </td>

                        <td>
                            <input
                                type="text"
                                name="av_sin_cicloplejia_os"
                                class="form-control">
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

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
                    value="1">

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
                    value="1">

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
                    value="1">

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
                    value="1">

                <label class="form-check-label">
                    Reflejo rojo
                </label>

            </div>

        </div>

        <div class="mb-3">

            <label for="observaciones" class="form-label">
                <strong>Observaciones</strong>
            </label>

            <textarea
                name="observaciones"
                id="observaciones"
                class="form-control"
                rows="4"></textarea>

        </div>

    @else

        {{-- =========================
             EXAMEN ADULTO
        ========================== --}}

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
                                class="form-control">
                        </td>

                        <td>
                            <input
                                type="text"
                                name="av_lejos_con_correccion_od"
                                class="form-control">
                        </td>

                        <td>
                            <input
                                type="text"
                                name="av_cerca_od"
                                class="form-control">
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
                                class="form-control">
                        </td>

                        <td>
                            <input
                                type="text"
                                name="av_lejos_con_correccion_os"
                                class="form-control">
                        </td>

                        <td>
                            <input
                                type="text"
                                name="av_cerca_os"
                                class="form-control">
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <div class="mb-3">

            <label for="observaciones" class="form-label">
                <strong>Observaciones</strong>
            </label>

            <textarea
                name="observaciones"
                id="observaciones"
                class="form-control"
                rows="4"></textarea>

        </div>

    @endif

    <button type="submit" class="btn btn-primary">
        Guardar examen
    </button>

    <a
        href="{{ route('consultas.show', $consulta) }}"
        class="btn btn-secondary">
        Cancelar
    </a>

</form>
```

</div>

@endsection
