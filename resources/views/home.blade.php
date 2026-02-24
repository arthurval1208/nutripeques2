@extends('layouts.app')

@section('title', 'Panel de Control - Nutripeques')

@section('content')
<style>
    /* ====== VARIABLES NUTRI ====== */
    :root {
        --purple-gradient: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%);
        --soft-blue: #e3f2fd;
        --card-bg: rgba(255, 255, 255, 0.6);
        --accent-pink: #ff9a9e;
        --dark-text: #444;
    }

    body {
        background-color: var(--soft-blue);
        background-image: radial-gradient(circle at 10% 20%, rgba(216, 241, 230, 0.46) 0.1%, rgba(233, 226, 226, 0.28) 90.1%);
        font-family: 'Quicksand', sans-serif;
        color: var(--dark-text);
        min-height: 100vh;
    }

    .dashboard-header {
        text-align: center;
        margin-top: 40px;
        margin-bottom: 50px;
    }

    .dashboard-header h1 {
        color: #333;
        font-weight: 800;
        font-size: 2.5rem;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 25px;
        padding: 20px;
    }

    .dashboard-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 2px solid white;
        border-radius: 30px;
        text-align: center;
        padding: 35px 20px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        box-shadow: 0 10px 20px rgba(0,0,0,0.03);
    }

    .dashboard-card:hover {
        transform: translateY(-10px);
        background: white;
        box-shadow: 0 15px 30px rgba(114, 118, 209, 0.15);
        text-decoration: none;
    }

    .dashboard-card i {
        font-size: 45px;
        background: var(--purple-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
    }

    .dashboard-card h5 {
        font-weight: 700;
        color: #333;
        margin-bottom: 12px;
    }

    .dashboard-card p {
        font-size: 0.9rem;
        color: #777;
        line-height: 1.4;
        margin-bottom: 0;
    }

    .logout-btn {
        border: none;
        background: none;
        padding: 0;
        width: 100%;
    }

    .logout-btn .dashboard-card i {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        -webkit-background-clip: text;
    }

    .dashboard-footer {
        margin-top: 60px;
        text-align: center;
        padding-bottom: 40px;
        opacity: 0.6;
    }
</style>

<div class="container py-5">

    <div class="dashboard-header">
        <span class="badge rounded-pill bg-white text-primary px-3 py-2 mb-3 shadow-sm">ADMINISTRACIÓN NUTRI</span>
        <h1>Hola, {{ session('admin_nombre') ?? 'Administrador' }}</h1>
    </div>

    <div class="card-grid">

        {{-- Perfil --}}
        <a href="#" class="dashboard-card">
            <i class="bi bi-person-circle"></i>
            <h5>Mi Perfil</h5>
            <p>Configura tu cuenta y preferencias de acceso.</p>
        </a>

        {{-- Servicios (Nueva vista Firebase) --}}
        <a href="{{ url('/ver-servicios') }}" class="dashboard-card">
            <i class="bi bi-grid-1x2-fill"></i>
            <h5>Servicios</h5>
            <p>Gestiona el catálogo de servicios en Firebase.</p>
        </a>


        {{-- Clientes (Nueva vista Firebase de usuarios) --}}
        <a href="{{ url('/ver-usuarios') }}" class="dashboard-card">
            <i class="bi bi-person-badge-fill"></i>
            <h5>Clientes</h5>
            <p>Nueva lista de padres y clientes en Firestore.</p>
        </a>

        {{-- Mensajes (Nueva vista Firebase) --}}
        <a href="{{ url('/ver-contactos') }}" class="dashboard-card">
            <i class="bi bi-chat-heart-fill"></i>
            <h5>Mensajes</h5>
            <p>Lee las consultas enviadas por los usuarios a la nube.</p>
        </a>

        {{-- Formulario (Crear contacto) --}}
        <a href="{{ url('/crear-contacto') }}" class="dashboard-card">
            <i class="bi bi-envelope-paper-heart-fill"></i>
            <h5>Formulario</h5>
            <p>Vista previa del formulario de contacto Firebase.</p>
        </a>

        {{-- Ir al Sitio --}}
        <a href="{{ url('/') }}" class="dashboard-card">
            <i class="bi bi-house-heart-fill"></i>
            <h5>Ir al Sitio</h5>
            <p>Volver a la página principal de Nutripeques.</p>
        </a>

        {{-- Salir --}}
        <form method="POST" action="{{ route('logout') }}" class="logout-btn">
            @csrf
            <button type="submit" class="dashboard-card w-100 border-0">
                <i class="bi bi-box-arrow-right"></i>
                <h5>Salir</h5>
                <p>Cerrar la sesión de administrador de forma segura.</p>
            </button>
        </form>

    </div>

    <div class="dashboard-footer">
        <p>© 2026 Nutripeques — Panel de Control Administrativo</p>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection