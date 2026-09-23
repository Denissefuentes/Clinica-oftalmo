@extends('layouts.app')
@section('content')

<h1>Registrar doctor</h1>

@if ($errors ->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('doctores.store') }}" method="POST">
    @csrf

    @include('doctores._form')
    @endsection