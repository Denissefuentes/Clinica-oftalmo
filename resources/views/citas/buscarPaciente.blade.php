@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Encabezado --}}
    <div class="mb-4">

        <h1 class="page-title">
            Nueva cita
        </h1>

        <p class="page-subtitle">
            Busque un paciente para comenzar a agendar una cita
        </p>

    </div>


    {{-- Tarjeta de búsqueda --}}
    <div class="search-patient-card">

        <div class="search-patient-header">

            <div class="search-patient-icon">
                <i class="bi bi-person-search"></i>
            </div>

            <div>
                <h2>Buscar paciente</h2>

                <p>
                    Busque al paciente por su nombre para continuar
                </p>
            </div>

        </div>


        {{-- Formulario --}}
        <form
            method="GET"
            action="{{ route('citas.buscarPaciente') }}"
            class="patient-search-form"
        >

            <div class="search-input-container">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="buscar"
                    placeholder="Escriba el nombre del paciente..."
                    value="{{ request('buscar') }}"
                    autocomplete="off"
                    autofocus
                >

            </div>

            <button
                type="submit"
                class="btn-search"
            >
                <i class="bi bi-search me-1"></i>
                Buscar
            </button>

        </form>


        {{-- Resultados --}}
        @if (request()->filled('buscar'))

            <div class="results-container">

                <div class="results-header">
                    <span>Resultados de búsqueda</span>
                </div>


                @if (count($pacientes))

                    <div class="patient-results">

                        @foreach ($pacientes as $paciente)

                            <div class="patient-result">

                                <div class="result-patient-info">

                                    <div class="result-avatar">
                                        {{ strtoupper(substr($paciente->nombre, 0, 1)) }}
                                    </div>

                                    <div>

                                        <div class="result-name">
                                            {{ $paciente->nombre }}
                                        </div>

                                        <div class="result-detail">

                                            {{ $paciente->cedula ?? 'Sin cédula registrada' }}

                                        </div>

                                    </div>

                                </div>


                                <a
                                    href="{{ route('citas.create', ['id_paciente' => $paciente->id_paciente]) }}"
                                    class="select-patient-btn"
                                >
                                    Seleccionar

                                    <i class="bi bi-arrow-right"></i>
                                </a>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="no-results">

                        <div class="no-results-icon">
                            <i class="bi bi-person-x"></i>
                        </div>

                        <h5>No se encontró ningún paciente</h5>

                        <p>
                            Verifique el nombre ingresado o registre un nuevo paciente.
                        </p>

                        <a
                            href="{{ route('pacientes.create') }}"
                            class="btn-clinica"
                        >
                            <i class="bi bi-person-plus me-1"></i>
                            Registrar paciente
                        </a>

                    </div>

                @endif

            </div>

        @endif

    </div>

</div>


<style>

/* =====================================
   TARJETA PRINCIPAL
===================================== */

.search-patient-card {

    max-width: 900px;

    margin: 20px auto 0;

    background-color: #ffffff;

    border-radius: 12px;

    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);

    overflow: hidden;

}


/* =====================================
   ENCABEZADO
===================================== */

.search-patient-header {

    display: flex;

    align-items: center;

    gap: 15px;

    padding: 25px 28px;

    border-bottom: 1px solid #edf0f2;

}


.search-patient-icon {

    width: 46px;
    height: 46px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background-color: #e1f1f3;

    color: #176b75;

    font-size: 21px;

}


.search-patient-header h2 {

    margin: 0;

    color: #263238;

    font-size: 20px;

    font-weight: 600;

}


.search-patient-header p {

    margin: 4px 0 0;

    color: #90a4ae;

    font-size: 13px;

}


/* =====================================
   BUSCADOR
===================================== */

.patient-search-form {

    display: flex;

    gap: 10px;

    padding: 24px 28px;

}


.search-input-container {

    position: relative;

    flex: 1;

}


.search-input-container i {

    position: absolute;

    left: 14px;

    top: 50%;

    transform: translateY(-50%);

    color: #90a4ae;

    font-size: 16px;

}


.search-input-container input {

    width: 100%;

    height: 43px;

    padding: 9px 13px 9px 40px;

    border: 1px solid #dfe6e9;

    border-radius: 7px;

    color: #37474f;

    font-size: 14px;

    outline: none;

    transition: all 0.2s ease;

}


.search-input-container input::placeholder {

    color: #aab5b9;

}


.search-input-container input:focus {

    border-color: #8fc5ca;

    box-shadow:
        0 0 0 3px rgba(23, 107, 117, 0.08);

}


.btn-search {

    height: 43px;

    padding: 0 20px;

    border: none;

    border-radius: 7px;

    background-color: #176b75;

    color: #ffffff;

    font-size: 14px;

    font-weight: 500;

    cursor: pointer;

    transition: all 0.2s ease;

}


.btn-search:hover {

    background-color: #125a63;

}


/* =====================================
   RESULTADOS
===================================== */

.results-container {

    border-top: 1px solid #edf0f2;

}


.results-header {

    padding: 14px 28px;

    background-color: #fafbfc;

    color: #78909c;

    font-size: 12px;

    font-weight: 600;

    text-transform: uppercase;

    letter-spacing: 0.3px;

}


/* =====================================
   PACIENTES ENCONTRADOS
===================================== */

.patient-results {

    padding: 8px 0;

}


.patient-result {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    padding: 14px 28px;

    border-bottom: 1px solid #f0f2f3;

    transition: background-color 0.2s ease;

}


.patient-result:last-child {

    border-bottom: none;

}


.patient-result:hover {

    background-color: #fafcfc;

}


.result-patient-info {

    display: flex;

    align-items: center;

    gap: 12px;

}


.result-avatar {

    width: 40px;
    height: 40px;

    min-width: 40px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background-color: #e1f1f3;

    color: #176b75;

    font-size: 15px;

    font-weight: 600;

}


.result-name {

    color: #263238;

    font-size: 14px;

    font-weight: 600;

}


.result-detail {

    margin-top: 3px;

    color: #90a4ae;

    font-size: 12px;

}


.select-patient-btn {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 8px 13px;

    border-radius: 7px;

    background-color: #edf5f6;

    color: #176b75;

    font-size: 13px;

    font-weight: 500;

    text-decoration: none;

    transition: all 0.2s ease;

}


.select-patient-btn:hover {

    background-color: #dceff1;

    color: #125a63;

}


/* =====================================
   SIN RESULTADOS
===================================== */

.no-results {

    text-align: center;

    padding: 45px 20px;

}


.no-results-icon {

    width: 55px;
    height: 55px;

    margin: 0 auto 15px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background-color: #f1f4f5;

    color: #78909c;

    font-size: 23px;

}


.no-results h5 {

    margin-bottom: 6px;

    color: #37474f;

    font-size: 16px;

    font-weight: 600;

}


.no-results p {

    margin-bottom: 18px;

    color: #90a4ae;

    font-size: 13px;

}


.btn-clinica {

    display: inline-flex;

    align-items: center;

    padding: 9px 16px;

    background-color: #176b75;

    color: #ffffff;

    border-radius: 7px;

    font-size: 13px;

    font-weight: 500;

    text-decoration: none;

}


.btn-clinica:hover {

    background-color: #125a63;

    color: #ffffff;

}


/* =====================================
   RESPONSIVE
===================================== */

@media (max-width: 768px) {

    .patient-search-form {

        flex-direction: column;

    }

    .btn-search {

        width: 100%;

    }

    .patient-result {

        align-items: flex-start;

        flex-direction: column;

    }

    .select-patient-btn {

        width: 100%;

        justify-content: center;

    }

}

</style>

@endsection