@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Servicio</h1>

    <p><strong>Nombre:</strong> {{ $servicio->nombre }}</p>
    <p><strong>Descripción:</strong> {{ $servicio->descripcion }}</p>
    <p><strong>Precio:</strong> {{ $servicio->precio }}</p>

    <a href="{{ route('servicio.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
