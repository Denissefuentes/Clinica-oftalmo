@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Encabezado --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="page-title">Doctores</h1>

            <p class="page-subtitle">
                Gestión y registro de doctores de la clínica
            </p>
        </div>

        <a
            href="{{ route('doctores.create') }}"
            class="btn btn-clinica"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Registrar doctor
        </a>

    </div>


    {{-- Tarjeta principal --}}
    <div class="card doctors-card">

        {{-- Barra superior --}}
        <div class="doctors-toolbar">

            <div>
                <span class="doctors-count">
                    {{ $doctores->count() }}
                    {{ $doctores->count() == 1 ? 'doctor registrado' : 'doctores registrados' }}
                </span>
            </div>

        </div>


        {{-- Tabla --}}
        <div class="table-responsive">

            <table
                class="table doctors-table mb-0"
                id="tablaDoctores"
            >

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Doctor</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($doctores as $doctor)

                        <tr>

                            {{-- ID --}}
                            <td>
                                {{ $doctor->id_doctor }}
                            </td>


                            {{-- Doctor --}}
                            <td>

                                <div class="doctor-info">

                                    <div class="doctor-avatar">
                                        {{ strtoupper(substr($doctor->nombre, 0, 1)) }}
                                    </div>

                                    <div>

                                        <div class="doctor-name">
                                            {{ $doctor->nombre }}
                                        </div>

                                        <div class="doctor-detail">
                                            Médico
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- Cédula --}}
                            <td>
                                {{ $doctor->cedula ?? '—' }}
                            </td>


                            {{-- Teléfono --}}
                            <td>
                                {{ $doctor->telefono ?? '—' }}
                            </td>


                            {{-- Estado --}}
                            <td>

                                @if($doctor->activo)

                                    <span class="doctor-status active">
                                        <span class="status-dot"></span>
                                        Activo
                                    </span>

                                @else

                                    <span class="doctor-status inactive">
                                        <span class="status-dot"></span>
                                        Inactivo
                                    </span>

                                @endif

                            </td>


                            {{-- Acciones --}}
                            <td class="text-end">

                                {{-- Editar --}}
                                <a
                                    href="{{ route('doctores.edit', $doctor) }}"
                                    class="action-btn"
                                    title="Editar doctor"
                                >
                                    <i class="bi bi-pencil"></i>
                                </a>


                                {{-- Activar / Desactivar --}}
                                <form
                                    action="{{ route('doctores.estado', ['doctor' => $doctor]) }}"
                                    method="POST"
                                    class="d-inline"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="action-btn {{ $doctor->activo ? 'deactivate-btn' : 'activate-btn' }}"
                                        title="{{ $doctor->activo ? 'Desactivar doctor' : 'Activar doctor' }}"
                                    >

                                        @if($doctor->activo)

                                            <i class="bi bi-person-dash"></i>

                                        @else

                                            <i class="bi bi-person-check"></i>

                                        @endif

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-person-badge"></i>
                                    </div>

                                    <h5>No hay doctores registrados</h5>

                                    <p>
                                        Aún no se han registrado doctores en el sistema.
                                    </p>

                                    <a
                                        href="{{ route('doctores.create') }}"
                                        class="btn btn-clinica"
                                    >
                                        <i class="bi bi-plus-lg me-1"></i>
                                        Registrar doctor
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
       TARJETA
    ===================================== */

    .doctors-card {
        overflow: hidden;
        background-color: #ffffff;
    }


    /* =====================================
       BARRA SUPERIOR
    ===================================== */

    .doctors-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;

        padding: 18px 22px;

        border-bottom: 1px solid #edf0f2;
    }

    .doctors-count {
        color: #78909c;
        font-size: 13px;
    }


    /* =====================================
       TABLA
    ===================================== */

    .doctors-table {
        font-size: 14px;
        color: #455a64;
    }

    .doctors-table thead {
        background-color: #fafbfc;
    }

    .doctors-table th {
        padding: 13px 22px;

        border-bottom: 1px solid #edf0f2;

        color: #78909c;

        font-size: 12px;
        font-weight: 600;

        text-transform: uppercase;
        letter-spacing: 0.3px;

        white-space: nowrap;
    }

    .doctors-table td {
        padding: 15px 22px;

        vertical-align: middle;

        border-bottom: 1px solid #f0f2f3;
    }

    .doctors-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .doctors-table tbody tr:hover {
        background-color: #fafcfc;
    }

    .doctors-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* =====================================
       INFORMACIÓN DEL DOCTOR
    ===================================== */

    .doctor-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .doctor-avatar {
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

    .doctor-name {
        color: #263238;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .doctor-detail {
        color: #90a4ae;
        font-size: 12px;
    }


    /* =====================================
       ESTADO
    ===================================== */

    .doctor-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;

        padding: 5px 10px;

        border-radius: 20px;

        font-size: 12px;
        font-weight: 500;
    }

    .doctor-status.active {
        background-color: #e8f5f2;
        color: #28766f;
    }

    .doctor-status.inactive {
        background-color: #f1f3f4;
        color: #78909c;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background-color: currentColor;
    }


    /* =====================================
       BOTONES DE ACCIÓN
    ===================================== */

    .action-btn {
        width: 32px;
        height: 32px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        margin-left: 4px;

        border: none;
        border-radius: 6px;

        background-color: transparent;
        color: #78909c;

        text-decoration: none;

        cursor: pointer;

        transition: all 0.2s ease;
    }

    .action-btn:hover {
        background-color: #edf5f6;
        color: #176b75;
    }

    .deactivate-btn:hover {
        background-color: #fceeee;
        color: #c45b5b;
    }

    .activate-btn:hover {
        background-color: #e8f5f2;
        color: #28766f;
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

        .doctors-table th,
        .doctors-table td {
            padding: 12px 14px;
        }

    }

</style>

@endsection