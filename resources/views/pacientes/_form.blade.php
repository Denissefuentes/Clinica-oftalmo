<div class="patient-form-card">


    <div class="form-header">
        <div class="form-icon">
            <i class="bi bi-person-plus"></i>
        </div>

        <div>
            <h2>
                {{ isset($paciente) ? 'Editar paciente' : 'Registrar paciente' }}
            </h2>

            <p>
                {{ isset($paciente)
                    ? 'Actualice la información del paciente.'
                    : 'Ingrese la información necesaria para registrar un nuevo paciente.'
                }}
            </p>
        </div>
    </div>


    {{-- Errores de validación --}}
    @if ($errors->any())

        <div class="form-errors">

            <div class="error-title">
                <i class="bi bi-exclamation-circle"></i>
                Revise la información ingresada
            </div>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    <div class="form-section">

        <div class="section-title">
            <i class="bi bi-person"></i>
            Información personal
        </div>

        <div class="section-line"></div>


        <div class="row g-4">

            {{-- Nombre --}}
            <div class="col-md-6">

                <label for="nombre" class="form-label-custom">
                    Nombre completo
                    <span>*</span>
                </label>

                <div class="input-wrapper">
                    <i class="bi bi-person"></i>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        class="form-control-custom"
                        placeholder="Ingrese el nombre completo"
                        value="{{ old('nombre', $paciente->nombre ?? '') }}"
                    >
                </div>

            </div>


            {{-- Fecha de nacimiento --}}
            <div class="col-md-3">

                <label for="f_nacimiento" class="form-label-custom">
                    Fecha de nacimiento
                    <span>*</span>
                </label>

                <input
                    type="date"
                    id="f_nacimiento"
                    name="f_nacimiento"
                    class="form-control-custom"
                    value="{{ old('f_nacimiento', $paciente->f_nacimiento ?? '') }}"
                >

            </div>


            {{-- Sexo --}}
            <div class="col-md-3">

                <label for="sexo" class="form-label-custom">
                    Sexo
                    <span>*</span>
                </label>

                <select
                    id="sexo"
                    name="sexo"
                    class="form-control-custom"
                >
                    <option value="">Seleccione...</option>

                    <option
                        value="Femenino"
                        {{ old('sexo', $paciente->sexo ?? '') == 'Femenino' ? 'selected' : '' }}
                    >
                        Femenino
                    </option>

                    <option
                        value="Masculino"
                        {{ old('sexo', $paciente->sexo ?? '') == 'Masculino' ? 'selected' : '' }}
                    >
                        Masculino
                    </option>

                </select>

            </div>


            {{-- Tipo de paciente --}}
            <div class="col-md-4">

                <label for="tipo_paciente" class="form-label-custom">
                    Tipo de paciente
                    <span>*</span>
                </label>

                <select
                    id="tipo_paciente"
                    name="tipo_paciente"
                    class="form-control-custom"
                >

                    <option value="">Seleccione...</option>

                    <option
                        value="Adulto"
                        {{ old('tipo_paciente', $paciente->tipo_paciente ?? '') == 'Adulto' ? 'selected' : '' }}
                    >
                        Adulto
                    </option>

                    <option
                        value="Pediatrico"
                        {{ old('tipo_paciente', $paciente->tipo_paciente ?? '') == 'Pediatrico' ? 'selected' : '' }}
                    >
                        Pediátrico
                    </option>

                </select>

            </div>


            {{-- Cédula --}}
            <div class="col-md-4">

                <label for="cedula" class="form-label-custom">
                    Cédula
                </label>

                <div class="input-wrapper">

                    <i class="bi bi-card-text"></i>

                    <input
                        type="text"
                        id="cedula"
                        name="cedula"
                        class="form-control-custom"
                        placeholder="Ej. 001-000000-0000A"
                        value="{{ old('cedula', $paciente->cedula ?? '') }}"
                    >

                </div>

            </div>


            {{-- Ocupación --}}
            <div class="col-md-4">

                <label for="ocupacion" class="form-label-custom">
                    Ocupación
                </label>

                <div class="input-wrapper">

                    <i class="bi bi-briefcase"></i>

                    <input
                        type="text"
                        id="ocupacion"
                        name="ocupacion"
                        class="form-control-custom"
                        placeholder="Ingrese la ocupación"
                        value="{{ old('ocupacion', $paciente->ocupacion ?? '') }}"
                    >

                </div>

            </div>

        </div>

    </div>


    {{-- Información de contacto --}}
    <div class="form-section">

        <div class="section-title">
            <i class="bi bi-telephone"></i>
            Información de contacto
        </div>

        <div class="section-line"></div>


        <div class="row g-4">

            {{-- Teléfono --}}
            <div class="col-md-6">

                <label for="telefono" class="form-label-custom">
                    Teléfono
                </label>

                <div class="input-wrapper">

                    <i class="bi bi-telephone"></i>

                    <input
                        type="text"
                        id="telefono"
                        name="telefono"
                        class="form-control-custom"
                        placeholder="Ingrese el número de teléfono"
                        value="{{ old('telefono', $paciente->telefono ?? '') }}"
                    >

                </div>

            </div>


            {{-- Dirección --}}
            <div class="col-md-6">

                <label for="direccion" class="form-label-custom">
                    Dirección
                </label>

                <div class="input-wrapper">

                    <i class="bi bi-geo-alt"></i>

                    <input
                        type="text"
                        id="direccion"
                        name="direccion"
                        class="form-control-custom"
                        placeholder="Ingrese la dirección"
                        value="{{ old('direccion', $paciente->direccion ?? '') }}"
                    >

                </div>

            </div>

        </div>

    </div>


    {{-- Botones --}}
    <div class="form-actions">

        <a
            href="{{ route('pacientes.index') }}"
            class="btn-cancelar"
        >
            Cancelar
        </a>

        <button
            type="submit"
            class="btn-guardar"
        >
            <i class="bi bi-check-lg"></i>

            {{ isset($paciente) ? 'Guardar cambios' : 'Registrar paciente' }}

        </button>

    </div>

</div>


<style>

    /* =====================================
       TARJETA DEL FORMULARIO
    ===================================== */

    .patient-form-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }


    /* =====================================
       ENCABEZADO
    ===================================== */

    .form-header {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 25px 28px;
        border-bottom: 1px solid #edf0f2;
    }

    .form-icon {
        width: 46px;
        height: 46px;
        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        background-color: #e1f1f3;
        color: #176b75;

        font-size: 21px;
    }

    .form-header h2 {
        margin: 0;
        color: #263238;
        font-size: 20px;
        font-weight: 600;
    }

    .form-header p {
        margin: 4px 0 0;
        color: #90a4ae;
        font-size: 13px;
    }


    /* =====================================
       SECCIONES
    ===================================== */

    .form-section {
        padding: 25px 28px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 8px;

        color: #37474f;
        font-size: 14px;
        font-weight: 600;
    }

    .section-title i {
        color: #176b75;
        font-size: 16px;
    }

    .section-line {
        height: 1px;
        background-color: #edf0f2;
        margin: 13px 0 22px;
    }


    /* =====================================
       LABELS
    ===================================== */

    .form-label-custom {
        display: block;
        margin-bottom: 7px;

        color: #455a64;
        font-size: 13px;
        font-weight: 500;
    }

    .form-label-custom span {
        color: #c45b5b;
    }


    /* =====================================
       CAMPOS
    ===================================== */

    .form-control-custom {
        width: 100%;
        height: 42px;

        padding: 9px 12px;

        border: 1px solid #dfe6e9;
        border-radius: 7px;

        background-color: #ffffff;

        color: #37474f;
        font-size: 14px;

        outline: none;

        transition: all 0.2s ease;
    }

    .form-control-custom:focus {
        border-color: #8fc5ca;

        box-shadow:
            0 0 0 3px rgba(23, 107, 117, 0.08);
    }

    .form-control-custom::placeholder {
        color: #aab5b9;
    }

    select.form-control-custom {
        cursor: pointer;
    }


    /* =====================================
       INPUT CON ICONO
    ===================================== */

    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;

        left: 13px;
        top: 50%;

        transform: translateY(-50%);

        color: #90a4ae;
        font-size: 15px;

        pointer-events: none;
    }

    .input-wrapper .form-control-custom {
        padding-left: 38px;
    }


    /* =====================================
       ERRORES
    ===================================== */

    .form-errors {
        margin: 22px 28px 0;
        padding: 14px 16px;

        background-color: #fff5f5;
        border: 1px solid #f2d7d7;
        border-radius: 8px;

        color: #8b4b4b;
        font-size: 13px;
    }

    .error-title {
        display: flex;
        align-items: center;
        gap: 7px;

        font-weight: 600;
        margin-bottom: 7px;
    }

    .form-errors ul {
        margin: 0;
        padding-left: 25px;
    }


    /* =====================================
       ACCIONES
    ===================================== */

    .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;

        padding: 20px 28px;

        background-color: #fafbfc;
        border-top: 1px solid #edf0f2;
    }

    .btn-cancelar {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        height: 40px;
        padding: 0 17px;

        border: 1px solid #dfe6e9;
        border-radius: 7px;

        background-color: #ffffff;
        color: #607d8b;

        font-size: 13px;
        font-weight: 500;

        text-decoration: none;

        transition: all 0.2s ease;
    }

    .btn-cancelar:hover {
        background-color: #f4f6f7;
        color: #455a64;
    }

    .btn-guardar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        height: 40px;
        padding: 0 18px;

        border: none;
        border-radius: 7px;

        background-color: #176b75;
        color: #ffffff;

        font-size: 13px;
        font-weight: 500;

        cursor: pointer;

        transition: all 0.2s ease;
    }

    .btn-guardar:hover {
        background-color: #125a63;
    }


    /* =====================================
       RESPONSIVE
    ===================================== */

    @media (max-width: 768px) {

        .form-header,
        .form-section {
            padding: 20px;
        }

        .form-actions {
            padding: 18px 20px;
        }

        .form-errors {
            margin-left: 20px;
            margin-right: 20px;
        }

    }

</style>