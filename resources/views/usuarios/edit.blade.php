@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Encabezado --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="page-title">Editar usuario</h1>

            <p class="page-subtitle">
                Modifica los datos y el rol del usuario seleccionado
            </p>
        </div>

    </div>


    {{-- Errores de validación --}}
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


    {{-- Tarjeta principal --}}
    <div class="card user-form-card">

        {{-- Encabezado del formulario --}}
        <div class="user-form-header">

            <div class="form-header-icon">
                <i class="bi bi-person-gear"></i>
            </div>

            <div>

                <h5>Información de la cuenta</h5>

                <p>
                    Actualiza los datos de acceso del usuario.
                </p>

            </div>

        </div>


        {{-- Cuerpo del formulario --}}
        <div class="user-form-body">

            <form
                action="{{ route('usuarios.update', $usuario) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="row g-4">


                    {{-- Nombre --}}
                    <div class="col-md-6">

                        <label
                            for="name"
                            class="form-label-custom"
                        >
                            Nombre completo
                            <span>*</span>
                        </label>

                        <div class="input-wrapper">

                            <i class="bi bi-person"></i>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control-custom @error('name') input-error @enderror"
                                value="{{ old('name', $usuario->name) }}"
                                required
                            >

                        </div>

                        @error('name')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Correo electrónico --}}
                    <div class="col-md-6">

                        <label
                            for="email"
                            class="form-label-custom"
                        >
                            Correo electrónico
                            <span>*</span>
                        </label>

                        <div class="input-wrapper">

                            <i class="bi bi-envelope"></i>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control-custom @error('email') input-error @enderror"
                                value="{{ old('email', $usuario->email) }}"
                                required
                            >

                        </div>

                        @error('email')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Rol --}}
                    <div class="col-md-6">

                        <label
                            for="role"
                            class="form-label-custom"
                        >
                            Rol
                            <span>*</span>
                        </label>

                        <div class="input-wrapper">

                            <i class="bi bi-person-badge"></i>

                            <select
                                name="role"
                                id="role"
                                class="form-control-custom @error('role') input-error @enderror"
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

                        </div>

                        @error('role')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                </div>


                {{-- Botones --}}
                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn btn-clinica"
                    >
                        <i class="bi bi-save me-1"></i>
                        Guardar cambios
                    </button>

                    <a
                        href="{{ route('usuarios.index') }}"
                        class="btn btn-cancel"
                    >
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>


<style>

    /* =====================================
       TARJETA DEL FORMULARIO
    ===================================== */

    .user-form-card {
        overflow: hidden;
        background-color: #ffffff;
    }


    /* =====================================
       ENCABEZADO
    ===================================== */

    .user-form-header {

        display: flex;
        align-items: center;
        gap: 14px;

        padding: 20px 24px;

        border-bottom: 1px solid #edf0f2;
    }

    .form-header-icon {

        width: 42px;
        height: 42px;
        min-width: 42px;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background-color: #e1f1f3;
        color: #176b75;

        font-size: 18px;
    }

    .user-form-header h5 {

        margin: 0 0 3px;

        color: #37474f;

        font-size: 15px;
        font-weight: 600;
    }

    .user-form-header p {

        margin: 0;

        color: #90a4ae;

        font-size: 13px;
    }


    /* =====================================
       CUERPO
    ===================================== */

    .user-form-body {
        padding: 26px 24px;
    }


    /* =====================================
       ETIQUETAS
    ===================================== */

    .form-label-custom {

        display: block;

        margin-bottom: 7px;

        color: #455a64;

        font-size: 13px;
        font-weight: 600;
    }

    .form-label-custom span {
        color: #c45b5b;
    }


    /* =====================================
       CAMPOS
    ===================================== */

    .input-wrapper {
        position: relative;
    }

    .input-wrapper > i {

        position: absolute;

        left: 13px;
        top: 50%;

        transform: translateY(-50%);

        color: #90a4ae;

        font-size: 16px;

        pointer-events: none;

        z-index: 2;
    }

    .form-control-custom {

        width: 100%;

        min-height: 42px;

        padding: 9px 12px 9px 40px;

        border: 1px solid #dce3e6;
        border-radius: 7px;

        background-color: #ffffff;

        color: #37474f;

        font-size: 14px;

        outline: none;

        transition: all 0.2s ease;
    }

    .form-control-custom:focus {

        border-color: #176b75;

        box-shadow: 0 0 0 3px rgba(23, 107, 117, 0.08);
    }

    .form-control-custom::placeholder {
        color: #b0bec5;
    }

    select.form-control-custom {
        cursor: pointer;
    }


    /* =====================================
       ERRORES
    ===================================== */

    .form-control-custom.input-error {
        border-color: #c45b5b;
    }

    .form-control-custom.input-error:focus {

        border-color: #c45b5b;

        box-shadow: 0 0 0 3px rgba(196, 91, 91, 0.08);
    }

    .field-error {

        margin-top: 6px;

        color: #c45b5b;

        font-size: 12px;
    }


    /* =====================================
       BOTONES
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

    .btn-cancel {

        background-color: #ffffff;
        color: #607d8b;

        border: 1px solid #dce3e6;

        padding: 9px 16px;

        font-size: 14px;
        font-weight: 500;

        border-radius: 7px;

        text-decoration: none;

        transition: all 0.2s ease;
    }

    .btn-cancel:hover {

        background-color: #f5f7f8;
        color: #455a64;

        border-color: #cfd8dc;
    }

    .form-actions {

        display: flex;
        align-items: center;
        gap: 8px;

        margin-top: 28px;

        padding-top: 22px;

        border-top: 1px solid #edf0f2;
    }


    /* =====================================
       RESPONSIVE
    ===================================== */

    @media (max-width: 768px) {

        .user-form-header,
        .user-form-body {
            padding: 18px;
        }

    }

</style>

@endsection