@extends('layouts.app')

@section('content')
<style>
    :root {
        --admin-purple: #7276d1;
        --admin-blue: #5a5eb1;
        --bg-light: #f4f7fe;
        --accent-green: #43cea2; /* Color para destacar la gestión de salud/niños */
    }

    body {
        background-color: var(--bg-light);
        font-family: 'Quicksand', sans-serif;
    }

    .dashboard-header {
        background: linear-gradient(135deg, var(--admin-purple) 0%, var(--admin-blue) 100%);
        color: white;
        padding: 40px 0;
        border-radius: 0 0 50px 50px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(114, 118, 209, 0.2);
    }

    .dashboard-card {
        background: white;
        border: none;
        border-radius: 25px;
        padding: 30px;
        text-align: center;
        transition: 0.3s all ease;
        text-decoration: none;
        color: #444;
        display: block;
        height: 100%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(114, 118, 209, 0.15);
        color: var(--admin-purple);
    }

    /* Estilo especial para la nueva tarjeta de Niños */
    .card-highlight {
        border: 2px solid var(--accent-green) !important;
    }
    
    .card-highlight i {
        color: var(--accent-green) !important;
    }

    .dashboard-card i {
        font-size: 3rem;
        margin-bottom: 15px;
        display: block;
        color: var(--admin-purple);
    }

    .dashboard-card h5 {
        font-weight: 700;
        margin-bottom: 0;
    }

    .badge-admin {
        background: rgba(255,255,255,0.2);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
    }
</style>

<div class="dashboard-header text-center">
    <div class="container">
        <h1 class="display-5 font-weight-bold">Panel de Control</h1>
        <p class="mb-0">Bienvenido, <strong>{{ session('usuario') }}</strong> <span class="badge-admin">Administrador</span></p>
    </div>
</div>

<div class="container">
    <div class="row g-4">
        
        <div class="col-md-4">
            <a href="{{ route('ver.usuarios') }}" class="dashboard-card">
                <i class="bi bi-people-fill"></i>
                <h5>Ver Usuarios</h5>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('ver.ninos') }}" class="dashboard-card card-highlight">
                <i class="bi bi-person-hearts"></i>
                <h5>Expedientes Niños (IMC)</h5>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.register_nutri') }}" class="dashboard-card" style="border: 2px solid var(--admin-purple);">
                <i class="bi bi-person-badge-fill"></i>
                <h5>Registrar Nutriólogo</h5>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.register') }}" class="dashboard-card">
                <i class="bi bi-person-plus-fill"></i>
                <h5>Registrar Admin</h5>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('ver.servicios') }}" class="dashboard-card">
                <i class="bi bi-egg-fried"></i>
                <h5>Ver Servicios</h5>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('ver.contactos') }}" class="dashboard-card">
                <i class="bi bi-chat-dots-fill"></i>
                <h5>Ver Consultas</h5>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('perfil') }}" class="dashboard-card">
                <i class="bi bi-gear-wide-connected"></i>
                <h5>Configurar Mi Perfil</h5>
            </a>
        </div>

    </div>

    <div class="text-center mt-5 mb-5">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger px-5 py-2" style="border-radius: 20px; font-weight: 700;">
                <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
            </button>
        </form>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection