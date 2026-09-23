<div class="appointment-form-card">

    {{-- =====================================
         PACIENTE SELECCIONADO
    ====================================== --}}

    @if ($paciente)

        <div class="selected-patient">

            <div class="selected-patient-icon">
                <i class="bi bi-person-check"></i>
            </div>

            <div class="selected-patient-info">

                <span class="selected-label">
                    Paciente seleccionado
                </span>

                <strong>
                    {{ $paciente->nombre }}
                </strong>

            </div>

            <input
                type="hidden"
                name="id_paciente"
                value="{{ $paciente->id_paciente }}"
            >

        </div>

    @endif


    {{-- =====================================
         INFORMACIÓN DE LA CITA
    ====================================== --}}

    <div class="appointment-section">

        <div class="section-title">
            <i class="bi bi-calendar3"></i>
            Información de la cita
        </div>

        <div class="section-line"></div>


        <div class="row g-4">

            {{-- Doctor --}}

            <div class="col-md-6">

                <label for="id_doctor" class="form-label-custom">
                    Doctor encargado
                    <span>*</span>
                </label>

                <select
                    name="id_doctor"
                    id="id_doctor"
                    class="form-control-custom"
                    required
                >

                    <option value="">
                        Seleccione un doctor
                    </option>

                    @foreach ($doctores as $doctor)

                        <option
                            value="{{ $doctor->id_doctor }}"
                            {{ old('id_doctor', $cita->id_doctor ?? '') == $doctor->id_doctor ? 'selected' : '' }}
                        >
                            {{ $doctor->nombre }}
                        </option>

                    @endforeach

                </select>

                @error('id_doctor')
                    <div class="field-error">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Fecha --}}

            <div class="col-md-3">

                <label for="fecha" class="form-label-custom">
                    Fecha de la cita
                    <span>*</span>
                </label>

                <input
                    type="date"
                    name="fecha"
                    id="fecha"
                    class="form-control-custom"
                    value="{{ old('fecha', $cita->fecha ?? '') }}"
                    required
                >

                @error('fecha')
                    <div class="field-error">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Hora --}}

            <div class="col-md-3">

                <label for="hora" class="form-label-custom">
                    Hora de la cita
                    <span>*</span>
                </label>

                <select
                    name="hora"
                    id="hora"
                    class="form-control-custom"
                    required
                >

                    <option value="">
                        Seleccione
                    </option>

                    @for ($hora = 8; $hora <= 17; $hora++)

                        @php
                            $valor = sprintf('%02d:00:00', $hora);
                            $texto = sprintf('%02d:00', $hora);
                        @endphp

                        <option
                            value="{{ $valor }}"
                            {{ old('hora', $cita->hora ?? '') == $valor ? 'selected' : '' }}
                        >
                            {{ $texto }}
                        </option>

                    @endfor

                </select>

                @error('hora')
                    <div class="field-error">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Motivo --}}

            <div class="col-md-8">

                <label for="motivo" class="form-label-custom">
                    Motivo de la cita
                    <span>*</span>
                </label>

                <input
                    type="text"
                    name="motivo"
                    id="motivo"
                    class="form-control-custom"
                    placeholder="Ingrese el motivo de la consulta"
                    value="{{ old('motivo', $cita->motivo ?? '') }}"
                    required
                >

                @error('motivo')
                    <div class="field-error">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Estado --}}

            <div class="col-md-4">

                <label for="estado" class="form-label-custom">
                    Estado
                    <span>*</span>
                </label>

                <select
                    name="estado"
                    id="estado"
                    class="form-control-custom"
                    required
                >

                    <option
                        value="Pendiente"
                        {{ old('estado', $cita->estado ?? 'Pendiente') == 'Pendiente' ? 'selected' : '' }}
                    >
                        Pendiente
                    </option>

                    <option
                        value="Atendida"
                        {{ old('estado', $cita->estado ?? '') == 'Atendida' ? 'selected' : '' }}
                    >
                        Atendida
                    </option>

                    <option
                        value="Cancelada"
                        {{ old('estado', $cita->estado ?? '') == 'Cancelada' ? 'selected' : '' }}
                    >
                        Cancelada
                    </option>

                </select>

                @error('estado')
                    <div class="field-error">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>

</div>


<style>

/* =====================================
   TARJETA
===================================== */

.appointment-form-card {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    overflow: hidden;
}


/* =====================================
   PACIENTE
===================================== */

.selected-patient {
    display: flex;
    align-items: center;
    gap: 14px;
    margin: 25px 28px;
    padding: 15px 17px;
    border: 1px solid #dceff1;
    border-radius: 9px;
    background-color: #f5fbfb;
}

.selected-patient-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: #dceff1;
    color: #176b75;
    font-size: 18px;
    flex-shrink: 0;
}

.selected-patient-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.selected-label {
    color: #78909c;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.selected-patient-info strong {
    color: #263238;
    font-size: 15px;
    font-weight: 600;
}


/* =====================================
   SECCIÓN
===================================== */

.appointment-section {
    padding: 0 28px 28px;
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
   INPUTS
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
    box-shadow: 0 0 0 3px rgba(23, 107, 117, 0.08);
}

.form-control-custom::placeholder {
    color: #aab5b9;
}


/* =====================================
   ERRORES
===================================== */

.field-error {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 6px;
    color: #c45b5b;
    font-size: 12px;
}

</style>