@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =====================================
         ENCABEZADO
    ====================================== --}}

    <div class="mb-4">

        <h1 class="page-title">
            Editar cita
        </h1>

        <p class="page-subtitle">
            Actualice la información de la cita registrada
        </p>

    </div>


    {{-- =====================================
         ERRORES
    ====================================== --}}

    @if ($errors->any())

        <div class="form-errors">

            <div class="form-errors-title">
                <i class="bi bi-exclamation-circle"></i>
                No se pudo actualizar la cita
            </div>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================
         FORMULARIO
    ====================================== --}}

    <form
        action="{{ route('citas.update', $cita) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        @include('citas._form')


        {{-- =====================================
             BOTONES
        ====================================== --}}

        <div class="appointment-actions">

            <a
                href="{{ route('citas.index') }}"
                class="btn-cancelar"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="btn-guardar"
            >
                <i class="bi bi-check2-circle"></i>
                Actualizar cita
            </button>

        </div>

    </form>

</div>


<style>

.form-errors {
    margin-bottom: 18px;
    padding: 14px 17px;
    border: 1px solid #f1d3d3;
    border-radius: 9px;
    background-color: #fff7f7;
    color: #7a4545;
}

.form-errors-title {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 6px;
    color: #8f4c4c;
    font-size: 14px;
    font-weight: 600;
}

.form-errors-title i {
    color: #c45b5b;
}

.form-errors ul {
    margin: 0;
    padding-left: 25px;
    font-size: 13px;
}

.form-errors li {
    margin-bottom: 3px;
}

.appointment-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 18px;
    padding: 20px 28px;
    background-color: #fafbfc;
    border-top: 1px solid #edf0f2;
    border-radius: 0 0 12px 12px;
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
}

.btn-guardar:hover {
    background-color: #125a63;
}

</style>

@endsection