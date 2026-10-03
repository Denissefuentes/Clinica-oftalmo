@extends('layouts.app')

@section('content')

    <!-- Encabezado de la página. -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title">Registrar usuario</h1>

            <p class="page-subtitle mb-0">
                Crea una cuenta para un doctor o una secretaria.
            </p>
        </div>
    </div>


    <!-- Mensaje de registro exitoso. -->
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif


    <!-- Mostrar los errores de validación.  -->
    @if($errors->any())
        <div class="alert alert-danger mb-4">

            <strong>Revisa los siguientes datos:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


     <!-- Formulario para crear el usuario. -->
    <div class="card">
        <div class="card-body p-4">

            <form action="{{ route('usuarios.store') }}" method="POST">

                @csrf

                <!-- Nombre del usuario. -->
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nombre completo
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="Ej. Juan Pérez"
                        required
                    >
                </div>


                <!-- Correo electrónico. -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="Ej. usuario@sanlucas.com"
                        required
                    >
                </div>


                 <!-- Selección del rol.  -->
                <div class="mb-3">
                    <label for="role" class="form-label">
                        Rol
                    </label>

                    <select
                        name="role"
                        id="role"
                        class="form-select"
                        required
                    >
                        <option value="">Seleccione un rol</option>

                        <option value="doctor" {{ old('role') === 'doctor' ? 'selected' : '' }}>
                            Doctor
                        </option>

                        <option value="secretaria" {{ old('role') === 'secretaria' ? 'selected' : '' }}>
                            Secretaria
                        </option>
                    </select>
                </div>


                 <!-- Contraseña. -->
                <div class="mb-3">
                    <label for="password" class="form-label">
                        Contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Mínimo 8 caracteres"
                        required
                    >
                </div>


                 <!-- Confirmación de contraseña. -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">
                        Confirmar contraseña
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        placeholder="Repita la contraseña"
                        required
                    >
                </div>


                 <!-- Botón para guardar el usuario. -->
                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-person-plus"></i>
                        Registrar usuario
                    </button>

                    <a
                        href="{{ route('pacientes.index') }}"
                        class="btn btn-secondary"
                    >
                        Cancelar
                    </a>

                </div>

            </form>

        </div>
    </div>

@endsection