@extends('layouts.app')

@section('content')

    <!-- Encabezado de la pantalla. -->
    <div class="mb-4">
        <h1 class="page-title">Cambiar contraseña</h1>

        <p class="page-subtitle mb-0">
            Actualiza la contraseña del usuario seleccionado.
        </p>
    </div>

    <!-- Información del usuario al que se cambiará la contraseña. -->
    <div class="card mb-4">
        <div class="card-body">

            <h5 class="mb-3">Usuario seleccionado</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $usuario->name }}"
                        disabled
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Correo electrónico</label>

                    <input
                        type="email"
                        class="form-control"
                        value="{{ $usuario->email }}"
                        disabled
                    >
                </div>

            </div>

        </div>
    </div>

    <!-- Formulario para establecer la nueva contraseña. -->
    <div class="card">
        <div class="card-body">

            <h5 class="mb-4">Nueva contraseña</h5>

            <form
                action="{{ route('usuarios.password.update', $usuario) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <!-- Nueva contraseña. -->
                <div class="mb-3">
                    <label for="password" class="form-label">
                        Nueva contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required
                    >

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirmación de la nueva contraseña. -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">
                        Confirmar nueva contraseña
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        required
                    >
                </div>

                <!-- Botones de acción. -->
                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-key"></i>
                        Cambiar contraseña
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