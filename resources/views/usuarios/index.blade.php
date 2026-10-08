@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Encabezado --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="page-title">Usuarios</h1>

            <p class="page-subtitle">
                Administración de las cuentas de acceso al sistema
            </p>
        </div>

        {{-- Botón para registrar un nuevo usuario. --}}
        <a
            href="{{ route('usuarios.create') }}"
            class="btn btn-clinica"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Nuevo usuario
        </a>

    </div>


    {{-- Mensaje de error --}}
    @if(session('error'))

        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>

    @endif


    {{-- Tarjeta principal --}}
    <div class="card users-card">

        {{-- Barra superior --}}
        <div class="users-toolbar">

            <div>
                <span class="users-count">
                    {{ $usuarios->count() }}
                    {{ $usuarios->count() == 1 ? 'usuario registrado' : 'usuarios registrados' }}
                </span>
            </div>

        </div>


        {{-- Tabla --}}
        <div class="table-responsive">

            <table class="table users-table mb-0">

                <thead>

                    <tr>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Fecha de registro</th>
                        <th class="text-end">Acciones</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($usuarios as $usuario)

                        {{-- La fila cambia de color cuando la cuenta está inactiva. --}}
                        <tr class="{{ !$usuario->activo ? 'user-row-inactive' : '' }}">

                            {{-- Información del usuario --}}
                            <td>

                                <div class="user-info">

                                    <div class="user-avatar">
                                        {{ strtoupper(substr($usuario->name, 0, 1)) }}
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            {{ $usuario->name }}
                                        </div>

                                        <div class="user-detail">
                                            {{ $usuario->email }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- Rol --}}
                            <td>

                                @if($usuario->role === 'admin')

                                    <span class="user-role admin">
                                        Administrador
                                    </span>

                                @elseif($usuario->role === 'doctor')

                                    <span class="user-role doctor">
                                        Doctor
                                    </span>

                                @else

                                    <span class="user-role secretaria">
                                        Secretaria
                                    </span>

                                @endif

                            </td>


                            {{-- Estado --}}
                            <td>

                                @if($usuario->activo)

                                    <span class="user-status active">
                                        <span class="status-dot"></span>
                                        Activo
                                    </span>

                                @else

                                    <span class="user-status inactive">
                                        <span class="status-dot"></span>
                                        Inactivo
                                    </span>

                                @endif

                            </td>


                            {{-- Fecha de registro --}}
                            <td>
                                {{ $usuario->created_at?->format('d/m/Y') }}
                            </td>


                            {{-- Acciones --}}
                            <td class="text-end">

                                {{-- Editar usuario --}}
                                <a
                                    href="{{ route('usuarios.edit', $usuario) }}"
                                    class="action-btn"
                                    title="Editar usuario"
                                >
                                    <i class="bi bi-pencil"></i>
                                </a>


                                {{-- Cambiar contraseña --}}
                                <a
                                    href="{{ route('usuarios.password.edit', $usuario) }}"
                                    class="action-btn password-btn"
                                    title="Cambiar contraseña"
                                >
                                    <i class="bi bi-key"></i>
                                </a>


                                {{-- Activar o desactivar cuenta --}}
                                <form
                                    action="{{ route('usuarios.estado', $usuario) }}"
                                    method="POST"
                                    class="d-inline"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="action-btn {{ $usuario->activo ? 'deactivate-btn' : 'activate-btn' }}"
                                        title="{{ $usuario->activo ? 'Desactivar cuenta' : 'Activar cuenta' }}"
                                    >

                                        @if($usuario->activo)

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

                            <td colspan="5">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-people"></i>
                                    </div>

                                    <h5>No hay usuarios registrados</h5>

                                    <p>
                                        Aún no se han registrado cuentas de acceso en el sistema.
                                    </p>

                                    <a
                                        href="{{ route('usuarios.create') }}"
                                        class="btn btn-clinica"
                                    >
                                        <i class="bi bi-plus-lg me-1"></i>
                                        Registrar usuario
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

    .users-card {

        overflow: hidden;

        background-color: #ffffff;
    }


    /* =====================================
       BARRA SUPERIOR
    ===================================== */

    .users-toolbar {

        display: flex;
        justify-content: space-between;
        align-items: center;

        padding: 18px 22px;

        border-bottom: 1px solid #edf0f2;
    }

    .users-count {

        color: #78909c;

        font-size: 13px;
    }


    /* =====================================
       TABLA
    ===================================== */

    .users-table {

        font-size: 14px;

        color: #455a64;
    }

    .users-table thead {

        background-color: #fafbfc;
    }

    .users-table th {

        padding: 13px 22px;

        border-bottom: 1px solid #edf0f2;

        color: #78909c;

        font-size: 12px;
        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: 0.3px;

        white-space: nowrap;
    }

    .users-table td {

        padding: 15px 22px;

        vertical-align: middle;

        border-bottom: 1px solid #f0f2f3;
    }

    .users-table tbody tr {

        transition: background-color 0.2s ease;
    }

    .users-table tbody tr:hover {

        background-color: #fafcfc;
    }


    /* =====================================
       USUARIO INACTIVO
    ===================================== */

    .users-table tbody tr.user-row-inactive {

        background-color: #fff5f5;
    }

    .users-table tbody tr.user-row-inactive:hover {

        background-color: #fceeee;
    }

    .users-table tbody tr.user-row-inactive .user-name {

        color: #a94442;
    }

    .users-table tbody tr.user-row-inactive .user-detail {

        color: #b97878;
    }


    .users-table tbody tr:last-child td {

        border-bottom: none;
    }


    /* =====================================
       INFORMACIÓN DEL USUARIO
    ===================================== */

    .user-info {

        display: flex;
        align-items: center;

        gap: 12px;
    }

    .user-avatar {

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

    .user-name {

        color: #263238;

        font-weight: 600;

        margin-bottom: 2px;
    }

    .user-detail {

        color: #90a4ae;

        font-size: 12px;
    }


    /* =====================================
       ROL
    ===================================== */

    .user-role {

        display: inline-flex;
        align-items: center;

        padding: 5px 10px;

        border-radius: 20px;

        font-size: 12px;
        font-weight: 500;
    }

    .user-role.admin {

        background-color: #e8eef8;

        color: #496b9b;
    }

    .user-role.doctor {

        background-color: #e8f5f2;

        color: #28766f;
    }

    .user-role.secretaria {

        background-color: #f1f3f4;

        color: #607d8b;
    }


    /* =====================================
       ESTADO
    ===================================== */

    .user-status {

        display: inline-flex;
        align-items: center;

        gap: 7px;

        padding: 5px 10px;

        border-radius: 20px;

        font-size: 12px;
        font-weight: 500;
    }

    .user-status.active {

        background-color: #e8f5f2;

        color: #28766f;
    }

    .user-status.inactive {

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

    .password-btn:hover {

        background-color: #edf1f8;

        color: #496b9b;
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

        .users-table th,
        .users-table td {

            padding: 12px 14px;
        }

    }

</style>

@endsection