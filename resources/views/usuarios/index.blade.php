@extends('layouts.app')

@section('content')

    <!-- Encabezado del módulo de usuarios.  -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="page-title">Usuarios</h1>

            <p class="page-subtitle mb-0">
                Administración de las cuentas de acceso al sistema.
            </p>
        </div>

        <!-- Botón para registrar un nuevo usuario. -->
        <a
            href="{{ route('usuarios.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-person-plus"></i>
            Nuevo usuario
        </a>

    </div>


    <!-- Mensaje de éxito. -->
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif


    <!-- Tabla de usuarios registrados. -->
    <div class="card">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="py-3">Correo electrónico</th>
                            <th class="py-3">Rol</th>
                            <th class="py-3">Fecha de registro</th>
                            <th class="py-3">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($usuarios as $usuario)

                            <tr>

                                <!-- Nombre del usuario. -->
                                <td class="px-4">
                                    {{ $usuario->name }}
                                </td>

                                <!-- Correo electrónico. -->
                                <td>
                                    {{ $usuario->email }}
                                </td>

                                <!-- Rol del usuario. -->
                                <td>

                                    @if($usuario->role === 'admin')

                                        <span class="badge bg-primary">
                                            Administrador
                                        </span>

                                    @elseif($usuario->role === 'doctor')

                                        <span class="badge bg-success">
                                            Doctor
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Secretaria
                                        </span>

                                    @endif

                                </td>

                                <!-- Fecha en que se creó la cuenta. -->
                                <td>{{ $usuario->created_at?->format('d/m/Y') }}</td>

                                {{-- Acciones disponibles para el usuario. --}}
                                <td>

                                    {{-- Botón para editar los datos del usuario. --}}
                                    <a
                                        href="{{ route('usuarios.edit', $usuario) }}"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Editar usuario"
                                    >
                                        <i class="bi bi-pencil"></i>
                                        Editar
                                    </a>

                                    <a
                                        href="{{ route('usuarios.password.edit', $usuario) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Cambiar contraseña"
                                    >
                                        <i class="bi bi-key"></i>
                                        Cambiar contraseña
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <!-- Mensaje mostrado si todavía no existen usuarios. -->
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    No hay usuarios registrados.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection