@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- ==============================
         ENCABEZADO
    ============================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="page-title">Citas</h1>

            <p class="page-subtitle">
                Gestión y seguimiento de las citas de la clínica
            </p>
        </div>

        <a
            href="{{ route('citas.buscarPaciente') }}"
            class="btn btn-clinica"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Nueva cita
        </a>

    </div>


    {{-- ==============================
         CARDS INFORMATIVAS
    ============================== --}}

    <div class="row g-3 mb-4">

        {{-- Pendientes --}}
        <div class="col-xl-3 col-md-6">

            <div class="appointment-card">

                <div class="appointment-icon pending">
                    <i class="bi bi-clock"></i>
                </div>

                <div class="appointment-info">

                    <span class="appointment-label">
                        Pendientes
                    </span>

                    <strong class="appointment-number">
                        {{ $citas->where('estado', 'Pendiente')->count() }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- Atendidas --}}
        <div class="col-xl-3 col-md-6">

            <div class="appointment-card">

                <div class="appointment-icon completed">
                    <i class="bi bi-check-circle"></i>
                </div>

                <div class="appointment-info">

                    <span class="appointment-label">
                        Atendidas
                    </span>

                    <strong class="appointment-number">
                        {{ $citas->where('estado', 'Atendida')->count() }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- Canceladas --}}
        <div class="col-xl-3 col-md-6">

            <div class="appointment-card">

                <div class="appointment-icon cancelled">
                    <i class="bi bi-x-circle"></i>
                </div>

                <div class="appointment-info">

                    <span class="appointment-label">
                        Canceladas
                    </span>

                    <strong class="appointment-number">
                        {{ $citas->where('estado', 'Cancelada')->count() }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- Total --}}
        <div class="col-xl-3 col-md-6">

            <div class="appointment-card">

                <div class="appointment-icon total">
                    <i class="bi bi-calendar3"></i>
                </div>

                <div class="appointment-info">

                    <span class="appointment-label">
                        Total de citas
                    </span>

                    <strong class="appointment-number">
                        {{ $citas->count() }}
                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- ==============================
         TARJETA PRINCIPAL
    ============================== --}}

    <div class="card citas-card">


        {{-- Barra de herramientas --}}
        <div class="citas-toolbar">

            <form
                method="GET"
                action="{{ route('citas.buscarPaciente') }}"
                class="search-box"
            >

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="buscar"
                    placeholder="Buscar paciente..."
                    value="{{ request('buscar') }}"
                    autocomplete="off"
                >

            </form>


            <span class="citas-count">

                {{ $citas->count() }}

                {{ $citas->count() == 1 ? 'cita registrada' : 'citas registradas' }}

            </span>

        </div>


        {{-- ==============================
             TABLA
        ============================== --}}

        <div class="table-responsive">

            <table class="table citas-table mb-0">

                <thead>

                    <tr>

                        <th>Paciente</th>
                        <th>Doctor</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($citas as $cita)

                        <tr>

                            {{-- Paciente --}}
                            <td>

                                <div class="patient-info">

                                    <div class="patient-avatar">
                                        {{ strtoupper(substr($cita->paciente->nombre, 0, 1)) }}
                                    </div>

                                    <div>

                                        <div class="patient-name">
                                            {{ $cita->paciente->nombre }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- Doctor --}}
                            <td>

                                <div class="doctor-name-table">
                                    {{ $cita->doctor->nombre }}
                                </div>

                            </td>


                            {{-- Fecha --}}
                            <td>
                                {{ $cita->fecha }}
                            </td>


                            {{-- Hora --}}
                            <td>
                                {{ $cita->hora }}
                            </td>


                            {{-- Motivo --}}
                            <td>
                                {{ $cita->motivo }}
                            </td>


                            {{-- Estado --}}
                            <td>

                                @if($cita->estado === 'Pendiente')

                                    <span class="status-badge pending">
                                        <span class="status-dot"></span>
                                        Pendiente
                                    </span>

                                @elseif($cita->estado === 'Atendida')

                                    <span class="status-badge completed">
                                        <span class="status-dot"></span>
                                        Atendida
                                    </span>

                                @elseif($cita->estado === 'Cancelada')

                                    <span class="status-badge cancelled">
                                        <span class="status-dot"></span>
                                        Cancelada
                                    </span>

                                @else

                                    <span class="status-badge">
                                        {{ $cita->estado }}
                                    </span>

                                @endif

                            </td>


                            {{-- Acciones --}}
                            <td class="text-end">

                                <a
                                    href="{{ route('citas.edit', $cita) }}"
                                    class="action-btn"
                                    title="Editar cita"
                                >
                                    <i class="bi bi-pencil"></i>
                                </a>


                                <a
                                    href="{{ route('citas.create', ['id_paciente' => $cita->id_paciente]) }}"
                                    class="action-btn"
                                    title="Agendar nueva cita"
                                >
                                    <i class="bi bi-calendar-plus"></i>
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-calendar-x"></i>
                                    </div>

                                    <h5>No hay citas registradas</h5>

                                    <p>
                                        Aún no se han registrado citas en el sistema.
                                    </p>

                                    <a
                                        href="{{ route('citas.buscarPaciente') }}"
                                        class="btn btn-clinica"
                                    >
                                        <i class="bi bi-plus-lg me-1"></i>
                                        Nueva cita
                                    </a>

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
   BOTÓN PRINCIPAL
===================================== */

.btn-clinica {
    background-color: #176b75;
    color: #ffffff;
    border: none;

    padding: 9px 16px;

    font-size: 14px;
    font-weight: 500;

    border-radius: 7px;

    text-decoration: none;

    transition: all 0.2s ease;
}

.btn-clinica:hover {
    background-color: #125a63;
    color: #ffffff;
}


/* =====================================
   CARDS DE CITAS
===================================== */

.appointment-card {

    min-height: 105px;

    display: flex;
    align-items: center;

    gap: 15px;

    padding: 20px;

    background-color: #ffffff;

    border-radius: 12px;

    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);

    transition: transform 0.2s ease,
                box-shadow 0.2s ease;
}

.appointment-card:hover {

    transform: translateY(-2px);

    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);

}


.appointment-icon {

    width: 46px;
    height: 46px;

    min-width: 46px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    font-size: 20px;
}


/* Pendientes */

.appointment-icon.pending {
    background-color: #fff4df;
    color: #b78328;
}


/* Atendidas */

.appointment-icon.completed {
    background-color: #e8f5f2;
    color: #28766f;
}


/* Canceladas */

.appointment-icon.cancelled {
    background-color: #fceeee;
    color: #c45b5b;
}


/* Total */

.appointment-icon.total {
    background-color: #eaf4f5;
    color: #176b75;
}


.appointment-info {
    display: flex;
    flex-direction: column;
    gap: 3px;
}


.appointment-label {
    color: #78909c;
    font-size: 13px;
}


.appointment-number {
    color: #263238;
    font-size: 24px;
    font-weight: 600;
}


/* =====================================
   TARJETA PRINCIPAL
===================================== */

.citas-card {

    overflow: hidden;

    background-color: #ffffff;

}


/* =====================================
   TOOLBAR
===================================== */

.citas-toolbar {

    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 18px 22px;

    border-bottom: 1px solid #edf0f2;

}


/* =====================================
   BUSCADOR
===================================== */

.search-box {

    position: relative;

    width: 300px;

}

.search-box i {

    position: absolute;

    left: 13px;
    top: 50%;

    transform: translateY(-50%);

    color: #90a4ae;

    font-size: 15px;

}

.search-box input {

    width: 100%;

    height: 38px;

    padding: 8px 12px 8px 38px;

    border: 1px solid #e1e7ea;

    border-radius: 7px;

    font-size: 14px;

    color: #37474f;

    outline: none;

    transition: all 0.2s ease;

}

.search-box input::placeholder {
    color: #a5b1b6;
}

.search-box input:focus {

    border-color: #8fc5ca;

    box-shadow:
        0 0 0 3px rgba(23, 107, 117, 0.08);

}


.citas-count {

    color: #78909c;

    font-size: 13px;

}


/* =====================================
   TABLA
===================================== */

.citas-table {

    font-size: 14px;

    color: #455a64;

}


.citas-table thead {

    background-color: #fafbfc;

}


.citas-table th {

    padding: 13px 22px;

    border-bottom: 1px solid #edf0f2;

    color: #78909c;

    font-size: 12px;

    font-weight: 600;

    text-transform: uppercase;

    letter-spacing: 0.3px;

    white-space: nowrap;

}


.citas-table td {

    padding: 15px 22px;

    vertical-align: middle;

    border-bottom: 1px solid #f0f2f3;

}


.citas-table tbody tr {

    transition: background-color 0.2s ease;

}


.citas-table tbody tr:hover {

    background-color: #fafcfc;

}


.citas-table tbody tr:last-child td {

    border-bottom: none;

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

    min-width: 38px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    background-color: #e1f1f3;

    color: #176b75;

    font-size: 15px;

    font-weight: 600;

}


.patient-name {

    color: #263238;

    font-weight: 600;

}


/* =====================================
   DOCTOR
===================================== */

.doctor-name-table {

    color: #455a64;

    font-weight: 500;

}


/* =====================================
   ESTADOS
===================================== */

.status-badge {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 5px 10px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: 500;

}


.status-badge.pending {

    background-color: #fff4df;

    color: #a8751e;

}


.status-badge.completed {

    background-color: #e8f5f2;

    color: #28766f;

}


.status-badge.cancelled {

    background-color: #fceeee;

    color: #c45b5b;

}


.status-dot {

    width: 7px;
    height: 7px;

    border-radius: 50%;

    background-color: currentColor;

}


/* =====================================
   ACCIONES
===================================== */

.action-btn {

    width: 32px;
    height: 32px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    margin-left: 4px;

    border-radius: 6px;

    background-color: transparent;

    color: #78909c;

    text-decoration: none;

    transition: all 0.2s ease;

}


.action-btn:hover {

    background-color: #edf5f6;

    color: #176b75;

}


/* =====================================
   ESTADO VACÍO
===================================== */

.empty-state {

    text-align: center;

    padding: 60px 20px;

}


.empty-icon {

    width: 58px;
    height: 58px;

    margin: 0 auto 16px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    background-color: #eaf4f5;

    color: #176b75;

    font-size: 25px;

}


.empty-state h5 {

    margin-bottom: 6px;

    color: #37474f;

    font-size: 16px;

    font-weight: 600;

}


.empty-state p {

    margin-bottom: 20px;

    color: #90a4ae;

    font-size: 14px;

}


/* =====================================
   RESPONSIVE
===================================== */

@media (max-width: 768px) {

    .citas-toolbar {

        flex-direction: column;

        align-items: stretch;

        gap: 15px;

    }

    .search-box {

        width: 100%;

    }

    .citas-count {

        align-self: flex-end;

    }

    .citas-table th,
    .citas-table td {

        padding: 12px 14px;

    }

}

</style>

@endsection