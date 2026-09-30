@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Exploración oftalmológica</h2>

    <div class="card">
        <div class="card-body">

            <h4>
                {{ $examen->consulta->expediente->paciente->nombre }}
            </h4>

            <p>
                <strong>Tipo de paciente:</strong>
                {{ $examen->consulta->expediente->paciente->tipo_paciente }}
            </p>

            <hr>

            <form action="{{ route('exploracion_oftalmologica.store', $examen->id_examen) }}" method="POST">

                @csrf

                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead>
                            <tr>
                                <th>Exploración</th>
                                <th class="text-center">Ojo Derecho</th>
                                <th class="text-center">Ojo Izquierdo</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <th>Presión Intraocular</th>
                                <td>
                                    <input
                                        type="text"
                                        name="presion_intraocular_od"
                                        class="form-control">
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        name="presion_intraocular_oi"
                                        class="form-control">
                                </td>
                            </tr>

                            <tr>
                                <th>Párpados y anexos</th>
                                <td>
                                    <textarea
                                        name="parpados_anexos_od"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                                <td>
                                    <textarea
                                        name="parpados_anexos_oi"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <th>Conjuntiva</th>
                                <td>
                                    <textarea
                                        name="conjuntiva_od"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                                <td>
                                    <textarea
                                        name="conjuntiva_oi"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <th>Córnea</th>
                                <td>
                                    <textarea
                                        name="cornea_od"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                                <td>
                                    <textarea
                                        name="cornea_oi"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <th>Cámara anterior</th>
                                <td>
                                    <textarea
                                        name="camara_anterior_od"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                                <td>
                                    <textarea
                                        name="camara_anterior_oi"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <th>Iris</th>
                                <td>
                                    <textarea
                                        name="iris_od"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                                <td>
                                    <textarea
                                        name="iris_oi"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <th>Pupilas</th>
                                <td>
                                    <textarea
                                        name="pupilas_od"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                                <td>
                                    <textarea
                                        name="pupilas_oi"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <th>Cristalino</th>
                                <td>
                                    <textarea
                                        name="cristalino_od"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                                <td>
                                    <textarea
                                        name="cristalino_oi"
                                        class="form-control"
                                        rows="2"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <th>Fondo de ojo</th>
                                <td>
                                    <textarea
                                        name="fondo_ojo_od"
                                        class="form-control"
                                        rows="3"></textarea>
                                </td>
                                <td>
                                    <textarea
                                        name="fondo_ojo_oi"
                                        class="form-control"
                                        rows="3"></textarea>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">

                    <button type="submit" class="btn btn-primary">
                        Guardar exploración
                    </button>

                    <a
                        href="{{ route('consultas.show', $examen->consulta) }}"
                        class="btn btn-secondary">
                        Cancelar
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection