@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Encabezado --}}
    <div class="mb-4">

        <h1 class="page-title">Cambiar contraseña</h1>

        <p class="page-subtitle">
            Actualiza la contraseña del usuario seleccionado
        </p>

    </div>


    {{-- Información del usuario --}}
    <div class="card user-form-card mb-4">

        <div class="user-form-header">

            <div class="form-header-icon">
                <i class="bi bi-person"></i>
            </div>

            <div>

                <h5>Usuario seleccionado</h5>

                <p>
                    Cuenta a la que se aplicará el cambio de contraseña.
                </p>

            </div>

        </div>


        <div class="user-form-body">

            <div class="row g-4">

                {{-- Nombre --}}
                <div class="col-md-6">

                    <label class="form-label-custom">
                        Nombre
                    </label>

                    <div class="input-wrapper">

                        <i class="bi bi-person"></i>

                        <input
                            type="text"
                            class="form-control-custom"
                            value="{{ $usuario->name }}"
                            disabled
                        >

                    </div>

                </div>


                {{-- Correo --}}
                <div class="col-md-6">

                    <label class="form-label-custom">
                        Correo electrónico
                    </label>

                    <div class="input-wrapper">

                        <i class="bi bi-envelope"></i>

                        <input
                            type="email"
                            class="form-control-custom"
                            value="{{ $usuario->email }}"
                            disabled
                        >

                    </div>

                </div>

            </div>

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


    {{-- Formulario de contraseña --}}
    <div class="card user-form-card">

        <div class="user-form-header">

            <div class="form-header-icon password-icon">
                <i class="bi bi-key"></i>
            </div>

            <div>

                <h5>Nueva contraseña</h5>

                <p>
                    Establece una nueva contraseña para esta cuenta.
                </p>

            </div>

        </div>


        <div class="user-form-body">

            <form
                action="{{ route('usuarios.password.update', $usuario) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="row g-4">

                    {{-- Nueva contraseña --}}
                    <div class="col-md-6">

                        <label
                            for="password"
                            class="form-label-custom"
                        >
                            Nueva contraseña
                            <span>*</span>
                        </label>

                        <div class="input-wrapper">

                            <i class="bi bi-lock"></i>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control-custom @error('password') input-error @enderror"
                                placeholder="Mínimo 8 caracteres"
                                required
                            >

                        </div>

                        @error('password')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Confirmar contraseña --}}
                    <div class="col-md-6">

                        <label
                            for="password_confirmation"
                            class="form-label-custom"
                        >
                            Confirmar nueva contraseña
                            <span>*</span>
                        </label>

                        <div class="input-wrapper">

                            <i class="bi bi-lock-fill"></i>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control-custom"
                                placeholder="Repita la contraseña"
                                required
                            >

                        </div>

                    </div>

                </div>


                {{-- Botones --}}
                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn btn-clinica"
                    >
                        <i class="bi bi-key me-1"></i>
                        Cambiar contraseña
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

    .password-icon {

        background-color: #edf1f8;
        color: #496b9b;
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

    .form-control-custom:disabled {

        background-color: #f7f9fa;

        color: #78909c;

        cursor: not-allowed;
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