@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Plan / Tratamiento</h2>

    <div class="card">
        <div class="card-body">

            <h4>
                {{ $consulta->expediente->paciente->nombre }}
            </h4>

            <p>
                <strong>Tipo de paciente:</strong>
                {{ $consulta->expediente->paciente->tipo_paciente }}
            </p>

            <hr>

            <form
                action="{{ route('tratamientos.store', $consulta->id_consulta) }}"
                method="POST"
            >
                @csrf

                <h5>Plan / Tratamiento</h5>

                <div class="mb-3">

                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="lentes"
                            value="1"
                            id="lentes"
                        >

                        <label
                            class="form-check-label"
                            for="lentes"
                        >
                            Lentes
                        </label>
                    </div>

                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="oclusion"
                            value="1"
                            id="oclusion"
                        >

                        <label
                            class="form-check-label"
                            for="oclusion"
                        >
                            Oclusión
                        </label>
                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Medicación
                    </label>

                    <textarea
                        name="medicacion"
                        class="form-control"
                        rows="3"
                    ></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Exámenes complementarios
                    </label>

                    <textarea
                        name="examenes_complementarios"
                        class="form-control"
                        rows="3"
                    ></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Referencias
                    </label>

                    <textarea
                        name="referencias"
                        class="form-control"
                        rows="3"
                    ></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Control en
                    </label>

                    <input
                        type="text"
                        name="control_en"
                        class="form-control"
                        placeholder="Ejemplo: 15 días, 1 mes, 3 meses"
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Manejo médico
                    </label>

                    <textarea
                        name="manejo_medico"
                        class="form-control"
                        rows="3"
                    ></textarea>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Cirugía propuesta
                    </label>

                    <textarea
                        name="cirugia_propuesta"
                        class="form-control"
                        rows="3"
                    ></textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Guardar tratamiento
                </button>

                <a
                    href="{{ route('consultas.show', $consulta) }}"
                    class="btn btn-secondary"
                >
                    Cancelar
                </a>

            </form>

        </div>
    </div>

</div>

@endsection