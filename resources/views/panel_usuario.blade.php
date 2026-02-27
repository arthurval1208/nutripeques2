@extends('layouts.app')

@section('title', 'Panel Usuario - Nutripeques')

@section('content')
<style>
:root {
    --green-gradient: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
    --soft-bg: #f4f9f9;
    --card-bg: rgba(255, 255, 255, 0.65);
}

body {
    background-color: var(--soft-bg);
    font-family: 'Quicksand', sans-serif;
}

.dashboard-header {
    text-align: center;
    margin-bottom: 50px;
}

.dashboard-header h1 {
    font-weight: 800;
    font-size: 2.5rem;
}

.card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 25px;
}

.dashboard-card {
    background: var(--card-bg);
    backdrop-filter: blur(12px);
    border: 2px solid white;
    border-radius: 30px;
    text-align: center;
    padding: 35px 20px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.03);
}

.dashboard-card:hover {
    transform: translateY(-10px);
    background: white;
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.dashboard-card i {
    font-size: 45px;
    background: var(--green-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 20px;
}

.dashboard-card h5 {
    font-weight: 700;
    margin-bottom: 12px;
}
</style>

<div class="container py-5">

    <div class="dashboard-header">
        <span class="badge rounded-pill bg-white text-success px-3 py-2 mb-3 shadow-sm">
            MI PANEL PERSONAL
        </span>
        <h1>Hola, {{ session('usuario') }}</h1>
    </div>

    <div class="card-grid">

        <a href="{{ route('perfil') }}" class="dashboard-card">
            <i class="bi bi-person-circle"></i>
            <h5>Mi Perfil</h5>
        </a>

        <a href="{{ url('/plan/15-18') }}" class="dashboard-card">
            <i class="bi bi-grid-1x2-fill"></i>
            <h5>Planes Nutricionales</h5>
        </a>

        <a href="{{ url('/crear_contacto') }}" class="dashboard-card">
            <i class="bi bi-envelope-paper-heart-fill"></i>
            <h5>Enviar Consulta</h5>
        </a>

        <a href="{{ url('/actividades') }}" class="dashboard-card">
            <i class="bi bi-bicycle"></i>
            <h5>Actividades Saludables Recomendadas</h5>
        </a>

        <a href="{{ url('/') }}" class="dashboard-card">
            <i class="bi bi-house-heart-fill"></i>
            <h5>Ir al Inicio</h5>
        </a>

    </div>

</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection