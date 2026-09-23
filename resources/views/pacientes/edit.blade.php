@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h1 class="page-title">Editar paciente</h1>

        <p class="page-subtitle">
            Actualice la información registrada del paciente
        </p>
    </div>

    <form
        action="{{ route('pacientes.update', $paciente) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        @include('pacientes._form')

    </form>

</div>

@endsection