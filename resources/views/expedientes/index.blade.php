@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =====================================
         ENCABEZADO
    ====================================== --}}

    <div class="mb-4">
        <h1 class="page-title">
            Expedientes clínicos
        </h1>

        <p class="page-subtitle">
            Gestión y acceso a los expedientes clínicos de los pacientes
        </p>
    </div>


    {{-- =====================================
         TARJETA PRINCIPAL
    ====================================== --}}

    <div class="expedientes-card">

        <div class="expedientes-header">

            <div>
                <div class="section-title">
                    <i class="bi bi-folder2-open"></i>
                    Pacientes
                </div>

                <span class="section-description">
                    Consulte o inicie el expediente clínico de cada paciente
                </span>
            </div>

            <div class="patient-count">
                {{ $pacientes->count() }}
                <span>pacientes</span>
            </div>

        </div>


        {{-- =====================================
             TABLA
        ====================================== --}}

        <div class="table-responsive">

            <table class="expedientes-table">

                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Estado del expediente</th>
                        <th class="text-end">Acción</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($pacientes as $paciente)

                        <tr>

                            {{-- Paciente --}}

                            <td>

                                <div class="patient-info">

                                    <div class="patient-avatar">
                                        {{ strtoupper(substr($paciente->nombre, 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="patient-name">
                                            {{ $paciente->nombre }}
                                        </div>

                                        @if($paciente->cedula)
                                            <div class="patient-detail">
                                                Cédula: {{ $paciente->cedula }}
                                            </div>
                                        @endif
                                    </div>

                                </div>

                            </td>


                            {{-- Estado --}}

                            <td>

                                @if($paciente->expediente)

                                    <span class="status-badge status-active">
                                        <i class="bi bi-check-circle"></i>
                                        Expediente registrado
                                    </span>

                                @else

                                    <span class="status-badge status-pending">
                                        <i class="bi bi-clock"></i>
                                        Sin expediente
                                    </span>

                                @endif

                            </td>


                            {{-- Acción --}}

                            <td class="text-end">

                                @if($paciente->expediente)

                                    <a
                                        href="{{ route('expedientes.show', $paciente->expediente) }}"
                                        class="action-main"
                                    >
                                        <i class="bi bi-folder2-open"></i>
                                        Ver expediente
                                    </a>

                                @else

                                    <form
                                        action="{{ route('expedientes.store') }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf

                                        <input
                                            type="hidden"
                                            name="id_paciente"
                                            value="{{ $paciente->id_paciente }}"
                                        >

                                        <button
                                            type="submit"
                                            class="action-main action-create"
                                        >
                                            <i class="bi bi-folder-plus"></i>
                                            Iniciar expediente
                                        </button>

                                    </form>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="3">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-folder2-open"></i>
                                    </div>

                                    <strong>
                                        No hay pacientes registrados
                                    </strong>

                                    <span>
                                        Los pacientes aparecerán aquí cuando sean registrados.
                                    </span>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<style>

/* =====================================
   TARJETA
===================================== */

.expedientes-card {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    overflow: hidden;
}


/* =====================================
   ENCABEZADO DE TARJETA
===================================== */

.expedientes-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 22px 26px;
    border-bottom: 1px solid #edf0f2;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #37474f;
    font-size: 14px;
    font-weight: 600;
}

.section-title i {
    color: #176b75;
    font-size: 17px;
}

.section-description {
    display: block;
    margin-top: 4px;
    color: #90a4ae;
    font-size: 12px;
}

.patient-count {
    display: flex;
    align-items: baseline;
    gap: 5px;
    color: #176b75;
    font-size: 20px;
    font-weight: 600;
}

.patient-count span {
    color: #90a4ae;
    font-size: 12px;
    font-weight: 400;
}


/* =====================================
   TABLA
===================================== */

.expedientes-table {
    width: 100%;
    border-collapse: collapse;
}

.expedientes-table thead th {
    padding: 13px 26px;
    background-color: #fafbfc;
    border-bottom: 1px solid #edf0f2;
    color: #78909c;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}

.expedientes-table tbody td {
    padding: 16px 26px;
    border-bottom: 1px solid #f0f2f3;
    vertical-align: middle;
}

.expedientes-table tbody tr:last-child td {
    border-bottom: none;
}

.expedientes-table tbody tr:hover {
    background-color: #fbfcfc;
}


/* =====================================
   PACIENTE
===================================== */

.patient-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.patient-avatar {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: #dceff1;
    color: #176b75;
    font-size: 14px;
    font-weight: 600;
}

.patient-name {
    color: #263238;
    font-size: 14px;
    font-weight: 600;
}

.patient-detail {
    margin-top: 2px;
    color: #90a4ae;
    font-size: 12px;
}


/* =====================================
   ESTADOS
===================================== */

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 500;
}

.status-active {
    background-color: #e7f4f1;
    color: #39786f;
}

.status-pending {
    background-color: #f1f3f4;
    color: #78909c;
}


/* =====================================
   ACCIONES
===================================== */

.action-main {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 8px 13px;
    border: 1px solid #dceff1;
    border-radius: 7px;
    background-color: #f5fbfb;
    color: #176b75;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.action-main:hover {
    background-color: #dceff1;
    color: #125a63;
}

.action-create {
    font-family: inherit;
}


/* =====================================
   ESTADO VACÍO
===================================== */

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 55px 20px;
    text-align: center;
}

.empty-icon {
    width: 52px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    border-radius: 50%;
    background-color: #f1f6f7;
    color: #78909c;
    font-size: 22px;
}

.empty-state strong {
    color: #455a64;
    font-size: 14px;
    font-weight: 600;
}

.empty-state span {
    margin-top: 4px;
    color: #90a4ae;
    font-size: 12px;
}


/* =====================================
   RESPONSIVE
===================================== */

@media (max-width: 768px) {

    .expedientes-header {
        padding: 18px;
    }

    .expedientes-table thead th,
    .expedientes-table tbody td {
        padding: 13px 16px;
    }

    .patient-detail {
        display: none;
    }

}

</style>

@endsection