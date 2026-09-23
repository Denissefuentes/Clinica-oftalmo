@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <div class="d-flex align-items-center gap-2 mb-1">
            <a
                href="{{ route('expedientes.index') }}"
                class="back-link"
            >
                <i class="bi bi-arrow-left"></i>
                Expedientes
            </a>
        </div>

        <h1 class="page-title">
            Expediente clínico
        </h1>

        <p class="page-subtitle">
            Información clínica y oftalmológica del paciente
        </p>

    </div>


    <div class="patient-header-card">

        <div class="patient-header-info">

            <div class="patient-avatar-large">
                {{ strtoupper(substr($expediente->paciente->nombre, 0, 1)) }}
            </div>

            <div>

                <span class="patient-label">
                    Paciente
                </span>

                <h2>
                    {{ $expediente->paciente->nombre }}
                </h2>

                <div class="patient-meta">

                    <span>
                        <i class="bi bi-person"></i>
                        {{ $expediente->paciente->tipo_paciente }}
                    </span>

                    <span>
                        <i class="bi bi-calendar3"></i>
                        Apertura:
                        {{ $expediente->fecha_apertura }}
                    </span>

                </div>

            </div>

        </div>

    </div>


    <div class="clinical-card">

        <div class="clinical-card-header">

            <div>

                <div class="clinical-title">
                    <i class="bi bi-clipboard2-pulse"></i>
                    Antecedentes
                </div>

                <span class="clinical-description">
                    Antecedentes médicos registrados del paciente
                </span>

            </div>

            <a
                href="{{ route('expedientes.antecedentes', $expediente) }}"
                class="section-action"
            >
                <i class="bi bi-pencil"></i>
                Agregar o modificar
            </a>

        </div>


        <div class="clinical-card-body">

            @forelse($expediente->antecedentes as $antecedente)

                <div class="clinical-item">

                    <div class="clinical-item-icon">
                        <i class="bi bi-check2"></i>
                    </div>

                    <div>

                        <span class="clinical-item-category">
                            {{ $antecedente->categoria }}
                        </span>

                        <strong>
                            {{ $antecedente->nombre }}
                        </strong>

                    </div>

                </div>

            @empty

                <div class="empty-clinical">

                    <i class="bi bi-clipboard2-x"></i>

                    <span>
                        No se han registrado antecedentes.
                    </span>

                </div>

            @endforelse

        </div>

    </div>


    <div class="clinical-card">

        <div class="clinical-card-header">

            <div>

                <div class="clinical-title">
                    <i class="bi bi-eyeglasses"></i>
                    Datos oftalmológicos
                </div>

                <span class="clinical-description">
                    Información relacionada con la salud visual del paciente
                </span>

            </div>

            <a
                href="{{ route('datos_adicionales.create', $expediente) }}"
                class="section-action"
            >
                <i class="bi bi-pencil"></i>
                Agregar o modificar
            </a>

        </div>


        <div class="clinical-card-body">

            @if($expediente->datos_adicionales)

                <div class="data-grid">

                    <div class="data-item">

                        <span>
                            Uso de lentes
                        </span>

                        <strong>
                            {{ $expediente->datos_adicionales->uso_lentes ? 'Sí' : 'No' }}
                        </strong>

                    </div>


                    <div class="data-item">

                        <span>
                            Tipo de lentes
                        </span>

                        <strong>
                            {{ $expediente->datos_adicionales->tipo_lentes ?? 'No registrado' }}
                        </strong>

                    </div>


                    <div class="data-item">

                        <span>
                            Graduación previa
                        </span>

                        <strong>
                            {{ $expediente->datos_adicionales->graduacion_previa ?? 'No registrada' }}
                        </strong>

                    </div>


                    <div class="data-item">

                        <span>
                            Quirúrgicos generales
                        </span>

                        <strong>
                            {{ $expediente->datos_adicionales->quirurgicos_generales ?? 'No registrado' }}
                        </strong>

                    </div>


                    <div class="data-item">

                        <span>
                            Medicamentos actuales
                        </span>

                        <strong>
                            {{ $expediente->datos_adicionales->medicamentos_actuales ?? 'No registrados' }}
                        </strong>

                    </div>

                </div>

            @else

                <div class="empty-clinical">

                    <i class="bi bi-eye-slash"></i>

                    <span>
                        No se han registrado datos oftalmológicos.
                    </span>

                </div>

            @endif

        </div>

    </div>


    <div class="clinical-card">

        <div class="clinical-card-header">

            <div>

                <div class="clinical-title">
                    <i class="bi bi-chat-left-text"></i>
                    Consultas
                </div>

                <span class="clinical-description">
                    Historial de consultas realizadas al paciente
                </span>

            </div>

            <a
                href="{{ route('expedientes.consultas', $expediente) }}"
                class="section-action"
            >
                <i class="bi bi-arrow-right"></i>
                Ver consultas
            </a>

        </div>


        <div class="clinical-card-body consultation-preview">

            <div class="module-icon">
                <i class="bi bi-file-medical"></i>
            </div>

            <div>

                <strong>
                    Historial de consultas
                </strong>

                <span>
                    Consulte las consultas registradas y agregue nuevas atenciones.
                </span>

            </div>

        </div>

    </div>

</div>


<style>


.back-link {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 8px;
    color: #78909c;
    font-size: 12px;
    text-decoration: none;
}

.back-link:hover {
    color: #176b75;
}


.patient-header-card {
    margin-bottom: 20px;
    padding: 22px 26px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.patient-header-info {
    display: flex;
    align-items: center;
    gap: 16px;
}

.patient-avatar-large {
    width: 58px;
    height: 58px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: #dceff1;
    color: #176b75;
    font-size: 21px;
    font-weight: 600;
    flex-shrink: 0;
}

.patient-label {
    display: block;
    margin-bottom: 3px;
    color: #90a4ae;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}

.patient-header-info h2 {
    margin: 0;
    color: #263238;
    font-size: 20px;
    font-weight: 600;
}

.patient-meta {
    display: flex;
    align-items: center;
    gap: 18px;
    margin-top: 7px;
}

.patient-meta span {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #78909c;
    font-size: 12px;
}

.patient-meta i {
    color: #176b75;
}


.clinical-card {
    margin-bottom: 20px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    overflow: hidden;
}

.clinical-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 20px 26px;
    border-bottom: 1px solid #edf0f2;
}

.clinical-title {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #37474f;
    font-size: 14px;
    font-weight: 600;
}

.clinical-title i {
    color: #176b75;
    font-size: 17px;
}

.clinical-description {
    display: block;
    margin-top: 4px;
    color: #90a4ae;
    font-size: 12px;
}

.clinical-card-body {
    padding: 22px 26px;
}

.section-action {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 12px;
    border: 1px solid #dceff1;
    border-radius: 7px;
    background-color: #f5fbfb;
    color: #176b75;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
    white-space: nowrap;
}

.section-action:hover {
    background-color: #dceff1;
    color: #125a63;
}


.clinical-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f0f2f3;
}

.clinical-item:last-child {
    padding-bottom: 0;
    border-bottom: none;
}

.clinical-item-icon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: #e7f4f1;
    color: #39786f;
    font-size: 14px;
    flex-shrink: 0;
}

.clinical-item-category {
    display: block;
    margin-bottom: 2px;
    color: #90a4ae;
    font-size: 11px;
}

.clinical-item strong {
    color: #455a64;
    font-size: 13px;
    font-weight: 500;
}


.data-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.data-item {
    padding: 14px;
    border: 1px solid #edf0f2;
    border-radius: 8px;
    background-color: #fafbfc;
}

.data-item span {
    display: block;
    margin-bottom: 5px;
    color: #90a4ae;
    font-size: 11px;
}

.data-item strong {
    color: #455a64;
    font-size: 13px;
    font-weight: 500;
}


.empty-clinical {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #90a4ae;
    font-size: 13px;
}

.empty-clinical i {
    color: #aab8bd;
    font-size: 18px;
}


.consultation-preview {
    display: flex;
    align-items: center;
    gap: 14px;
}

.module-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background-color: #dceff1;
    color: #176b75;
    font-size: 19px;
    flex-shrink: 0;
}

.consultation-preview strong {
    display: block;
    color: #455a64;
    font-size: 13px;
    font-weight: 600;
}

.consultation-preview span {
    display: block;
    margin-top: 3px;
    color: #90a4ae;
    font-size: 12px;
}


@media (max-width: 900px) {

    .data-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}

@media (max-width: 600px) {

    .clinical-card-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .patient-meta {
        align-items: flex-start;
        flex-direction: column;
        gap: 5px;
    }

    .data-grid {
        grid-template-columns: 1fr;
    }

}

</style>

@endsection