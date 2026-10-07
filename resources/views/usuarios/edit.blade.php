@extends('layouts.app')

@section('content')

    <!-- Encabezado de la pantalla de edición. -->
    <div class="mb-4">
        <h1 class="page-title">Editar usuario</h1>

        <p class="page-subtitle mb-0">
            Modifica los datos y el rol del usuario seleccionado.
        </p>
    </div>

    <!-- Formulario de edición del usuario. -->
    <div class="card">
        <div class="card-body">

            <form
                action="{{ route('usuarios.update', $usuario) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <!-- Nombre del usuario. -->
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nombre completo
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $usuario->name) }}"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
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
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $usuario->email) }}"
                        required
                    >

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Rol del usuario. -->
                <div class="mb-4">
                    <label for="role" class="form-label">
                        Rol
                    </label>

                    <select
                        name="role"
                        id="role"
                        class="form-select @error('role') is-invalid @enderror"
                        required
                    >
                        <option
                            value="doctor"
                            {{ old('role', $usuario->role) === 'doctor' ? 'selected' : '' }}
                        >
                            Doctor
                        </option>

                        <option
                            value="secretaria"
                            {{ old('role', $usuario->role) === 'secretaria' ? 'selected' : '' }}
                        >
                            Secretaria
                        </option>
                    </select>

                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Botones de acción. -->
                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i>
                        Guardar cambios
                    </button>

                    <a
                        href="{{ route('usuarios.index') }}"
                        class="btn btn-secondary"
                    >
                        Cancelar
                    </a>

                </div>

            </form>

        </div>
    </div>

@endsection