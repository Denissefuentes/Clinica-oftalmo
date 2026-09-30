@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Encabezado --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="page-title">Pacientes</h1>
            <p class="page-subtitle">
                Gestión y registro de pacientes de la clínica
            </p>
        </div>

        <a href="{{ route('pacientes.create') }}" class="btn btn-clinica">
            <i class="bi bi-plus-lg me-1"></i>
            Nuevo paciente
        </a>

    </div>


    {{-- Tarjeta principal --}}
    <div class="card pacientes-card">

        {{-- Barra superior --}}
        <div class="patients-toolbar">

            <div class="search-box">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="buscarPaciente"
                    placeholder="Buscar paciente..."
                    autocomplete="off"
                >

            </div>

            <span class="patients-count">
                {{ $pacientes->count() }}
                {{ $pacientes->count() == 1 ? 'paciente registrado' : 'pacientes registrados' }}
            </span>

        </div>


        {{-- Tabla --}}
        <div class="table-responsive">

            <table class="table patients-table mb-0" id="tablaPacientes">

                <thead>

                    <tr>
                        <th>Paciente</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Tipo</th>
                        <th class="text-end">Acciones</th>
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

                                        <div class="patient-detail">
                                            {{ $paciente->sexo ?? 'Sin información' }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- Cédula --}}
                            <td>
                                {{ $paciente->cedula ?? '—' }}
                            </td>


                            {{-- Teléfono --}}
                            <td>
                                {{ $paciente->telefono ?? '—' }}
                            </td>


                            {{-- Tipo de paciente --}}
                            <td>

                                @if($paciente->tipo_paciente === 'Pediatrico')

                                    <span class="patient-badge pediatric">
                                        Pediátrico
                                    </span>

                                @else

                                    <span class="patient-badge regular">
                                        Regular
                                    </span>

                                @endif

                            </td>


                            {{-- Acciones --}}
                            <td class="text-end">

                                {{-- Editar --}}
                                <a
                                    href="{{ route('pacientes.edit', $paciente) }}"
                                    class="action-btn"
                                    title="Editar paciente"
                                >
                                    <i class="bi bi-pencil"></i>
                                </a>


                                {{-- Eliminar --}}
                                <form
                                    action="{{ route('pacientes.destroy', $paciente) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('¿Está seguro de eliminar este paciente?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn delete-btn"
                                        title="Eliminar paciente"
                                    >
                                        <i class="bi bi-trash3"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-people"></i>
                                    </div>

                                    <h5>No hay pacientes registrados</h5>

                                    <p>
                                        Aún no se han registrado pacientes en el sistema.
                                    </p>

                                    <a
                                        href="{{ route('pacientes.create') }}"
                                        class="btn btn-clinica"
                                    >
                                        <i class="bi bi-plus-lg me-1"></i>
                                        Registrar paciente
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


{{-- Estilos específicos de pacientes --}}
<style>

    /* ==============================
       BOTÓN PRINCIPAL
    ============================== */

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


    /* ==============================
       TARJETA
    ============================== */

    .pacientes-card {
        overflow: hidden;
        background-color: #ffffff;
    }


    /* ==============================
       BARRA DE HERRAMIENTAS
    ============================== */

    .patients-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 22px;
        border-bottom: 1px solid #edf0f2;
    }


    /* ==============================
       BUSCADOR
    ============================== */

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
        box-shadow: 0 0 0 3px rgba(23, 107, 117, 0.08);
    }


    /* ==============================
       CONTADOR
    ============================== */

    .patients-count {
        color: #78909c;
        font-size: 13px;
    }


    /* ==============================
       TABLA
    ============================== */

    .patients-table {
        font-size: 14px;
        color: #455a64;
    }

    .patients-table thead {
        background-color: #fafbfc;
    }

    .patients-table th {
        padding: 13px 22px;
        border-bottom: 1px solid #edf0f2;
        color: #78909c;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }

    .patients-table td {
        padding: 15px 22px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f2f3;
    }

    .patients-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .patients-table tbody tr:hover {
        background-color: #fafcfc;
    }

    .patients-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* ==============================
       INFORMACIÓN DEL PACIENTE
    ============================== */

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
        margin-bottom: 2px;
    }

    .patient-detail {
        color: #90a4ae;
        font-size: 12px;
    }


    /* ==============================
       BADGES
    ============================== */

    .patient-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .patient-badge.regular {
        background-color: #eef3f5;
        color: #607d8b;
    }

    .patient-badge.pediatric {
        background-color: #e5f3f1;
        color: #28766f;
    }


    /* ==============================
       BOTONES DE ACCIÓN
    ============================== */

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

    .delete-btn:hover {
        background-color: #fceeee;
        color: #c45b5b;
    }


    /* ==============================
       ESTADO VACÍO
    ============================== */

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


    /* ==============================
       RESPONSIVE
    ============================== */

    @media (max-width: 768px) {

        .patients-toolbar {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .search-box {
            width: 100%;
        }

        .patients-count {
            align-self: flex-end;
        }

        .patients-table th,
        .patients-table td {
            padding: 12px 14px;
        }

    }

</style>


<script>

    document.addEventListener('DOMContentLoaded', function () {

        const buscador = document.getElementById('buscarPaciente');
        const filas = document.querySelectorAll('#tablaPacientes tbody tr');

        buscador.addEventListener('keyup', function () {

            const texto = this.value.toLowerCase().trim();

            filas.forEach(function (fila) {

                const contenido = fila.textContent.toLowerCase();

                if (contenido.includes(texto)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }

            });

        });

    });

</script>

@endsection