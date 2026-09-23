@extends('layouts.app')
@section('content')

<h1>Editar doctor</h1>

@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('doctores.update', $doctor) }}" method="POST">
    @csrf
    @method ('PUT')

    @include('doctores._form')
    @endsection