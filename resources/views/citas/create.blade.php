
@extends('layouts.app')
@section('content')

        <h1>Agendar cita</h1>

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('citas.store') }}" method="POST">
            @csrf

            @include('citas._form')
            <div class="appointment-actions">

            <a href="{{ route('citas.index') }}"
                class="btn-cancelar">
                Cancelar
            </a>

            <button
                type="submit"
                class="btn-guardar">
                <i class="bi bi-calendar-check"></i>
                Guardar cita
            </button>

        </div>
        </form>

<style>


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
</style>
@endsection
