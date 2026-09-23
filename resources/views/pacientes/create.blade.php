@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h1 class="page-title">Nuevo paciente</h1>

        <p class="page-subtitle">
            Registre la información del paciente en el sistema
        </p>
    </div>

    <form action="{{ route('pacientes.store') }}" method="POST">

        @csrf

        @include('pacientes._form')

    </form>

</div>

@endsection