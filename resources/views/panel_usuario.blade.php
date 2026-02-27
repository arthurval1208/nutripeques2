@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Bienvenido Usuario 👤</h2>

    <p>Hola {{ session('usuario') }}</p>

    <a href="{{ route('logout') }}" class="btn btn-danger">
        Cerrar sesión
    </a>
</div>
@endsection