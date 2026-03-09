@extends('layouts.app')

@section('title', 'Panel Usuario - Nutripeques')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700;800&display=swap');

    :root {
        /* Paleta basada en la imagen (Salud/Cian) */
        --primary-cyan: #43cea2;
        --secondary-blue: #185a9d;
        --soft-cyan-bg: #dff0f6; /* El color clave del panel central de la imagen */
        --bg-main: #f4f9f9;
        --card-bg: #ffffff;
        --text-dark: #2d3436;
        
        /* Colores del Logo */
        --logo-red: #ff786e;
        --logo-green: #aec982;
        --logo-pink: #ffadd1;
        --logo-yellow: #f4be5d;
        --logo-blue: #b3caff;
    }

    body {
        background-color: var(--bg-main);
        font-family: 'Quicksand', sans-serif;
        margin: 0;
        overflow-x: hidden;
    }

    /* --- SIDEBAR FUNCIONAL --- */
    .sidebar {
        width: 280px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        background: var(--card-bg);
        padding: 30px 20px;
        box-shadow: 10px 0 40px rgba(0,0,0,0.03);
        z-index: 1000;
        display: flex;
        flex-direction: column;
    }

    .logo-container {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo-nutri { font-weight: 800; font-size: 26px; color: #333; line-height: 1; }
    .logo-peques { font-size: 22px; font-weight: 800; display: flex; justify-content: center; gap: 2px; }
    .logo-peques span:nth-child(1) { color: var(--logo-red); }
    .logo-peques span:nth-child(2) { color: var(--logo-green); }
    .logo-peques span:nth-child(3) { color: var(--logo-pink); }
    .logo-peques span:nth-child(4) { color: var(--logo-yellow); }
    .logo-peques span:nth-child(5) { color: var(--logo-blue); }
    .logo-peques span:nth-child(6) { color: var(--logo-red); }

    .nav-menu { flex-grow: 1; margin-top: 20px; }

    .nav-item {
        display: flex;
        align-items: center;
        padding: 14px 18px;
        margin-bottom: 8px;
        color: #636e72;
        text-decoration: none;
        border-radius: 20px;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .nav-item:hover, .nav-item.active {
        background: var(--soft-cyan-bg);
        color: var(--secondary-blue);
    }

    .nav-item i { margin-right: 12px; font-size: 1.2rem; }

    .btn-logout {
        background: #fff0f0;
        color: #ff5e5e;
        border: none;
        padding: 12px;
        border-radius: 15px;
        width: 100%;
        font-weight: 700;
        transition: 0.3s;
        margin-top: auto;
    }

    /* --- ÁREA CENTRAL --- */
    .main-wrapper {
        margin-left: 280px;
        padding: 40px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Panel Central (Estilo exacto a la imagen) */
    .hero-panel {
        background: var(--soft-cyan-bg);
        border-radius: 60px; /* Bordes extra redondeados */
        padding: 60px 40px;
        text-align: center;
        border: 12px solid white; /* Borde blanco grueso característico */
        box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }

    .hero-panel h1 {
        font-weight: 800;
        font-size: 2.8rem;
        color: var(--text-dark);
        max-width: 700px;
        margin: 20px auto;
    }

    .fact-card {
        background: white;
        border-radius: 35px;
        padding: 25px;
        display: inline-block;
        max-width: 450px;
        margin-top: 30px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
    }

    .fact-label {
        color: var(--primary-cyan);
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.8rem;
        display: block;
        margin-bottom: 10px;
    }

    #nutri-fact {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-dark);
        min-height: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.5s ease;
    }

    /* Floating Icons Decorativos */
    .floating-icon {
        position: absolute;
        opacity: 0.4;
        z-index: 0;
    }
</style>

<nav class="sidebar" style="padding: 15px 15px;"> <div class="logo-container" style="text-align: center; margin-bottom: 15px; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px;">
        <div style="display: inline-flex; align-items: baseline; gap: 4px;">
            <span style="font-weight: 800; font-size: 18px; color: #333;">Nutri</span>
            <div class="logo-peques" style="font-size: 16px; font-weight: 800; display: flex; gap: 1px;">
                <span style="color: #ff786e;">P</span>
                <span style="color: #aec982;">e</span>
                <span style="color: #ffadd1;">q</span>
                <span style="color: #f4be5d;">u</span>
                <span style="color: #b3caff;">e</span>
                <span style="color: #ff786e;">s</span>
            </div>
        </div>
    </div>

    <div class="nav-menu" style="gap: 5px;"> <a href="{{ route('perfil') }}" class="nav-item {{ Request::is('perfil') ? 'active' : '' }}" style="padding: 10px 15px; margin-bottom: 4px;">
            <i class="bi bi-person-circle" style="font-size: 1.1rem;"></i> <span>Mi Perfil</span>
        </a>
        <a href="{{ route('panel.usuario') }}" class="nav-item {{ Request::is('panel-usuario') ? 'active' : '' }}" style="padding: 10px 15px; margin-bottom: 4px;">
            <i class="bi bi-grid-1x2-fill" style="font-size: 1.1rem;"></i> <span>Inicio</span>
        </a>
        <a href="{{ url('/plan/15-18') }}" class="nav-item {{ Request::is('plan*') ? 'active' : '' }}" style="padding: 10px 15px; margin-bottom: 4px;">
            <i class="bi bi-egg-fried" style="font-size: 1.1rem;"></i> <span>Planes</span>
        </a>
        <a href="{{ route('hijos.registrados') }}" class="nav-item" style="padding: 10px 15px; margin-bottom: 4px;"><i class="bi bi-people-fill"></i> <span>Mis Hijos</span></a>
        <a href="{{ url('/agregar_hijo') }}" class="nav-item" style="padding: 10px 15px; margin-bottom: 4px;"><i class="bi bi-person-plus-fill"></i> <span>Agregar Hijo</span></a>
        <a href="{{ url('/actividades') }}" class="nav-item" style="padding: 10px 15px; margin-bottom: 4px;"><i class="bi bi-bicycle"></i> <span>Actividades</span></a>
        <a href="{{ url('/crear_contacto') }}" class="nav-item" style="padding: 10px 15px; margin-bottom: 4px;"><i class="bi bi-envelope-paper-heart-fill"></i> <span>Consulta</span></a>
        <a href="{{ url('/inicio') }}" class="nav-item " style="padding: 10px 15px; margin-bottom: 4px;"><i class="bi bi-house-heart-fill"></i> <span>Resumen Diario</span></a>
    </div>

    <form action="{{ route('logout') }}" method="POST" style="margin-top: auto; padding-top: 10px;">
        @csrf
        <button type="submit" class="btn-logout" style="padding: 8px; font-size: 13px; border-radius: 12px;">
            <i class="bi bi-box-arrow-right"></i> Salir
        </button>
    </form>
</nav>
<div class="main-wrapper">
    <div class="hero-panel">
        <span class="badge rounded-pill bg-white text-info px-4 py-2 shadow-sm fw-bold">BIENVENIDO, {{ session('usuario') }}</span>
        
        <h1>La mejor página para mejorar la salud de tus pequeños</h1>
        <p class="text-muted fs-5">Gestiona, aprende y crece junto a nosotros.</p>

        <div class="fact-card">
            <span class="fact-label">¿Sabías que?</span>
            <div id="nutri-fact">Cargando consejos nutricionales...</div>
        </div>
        
        <div class="mt-4">
            <i class="bi bi-heart-pulse-fill text-white fs-1"></i>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
    const facts = [
        "El hierro se absorbe mejor si se acompaña con vitamina C (naranja, limón).",
        "Los niños necesitan grasas saludables para su desarrollo cerebral.",
        "El desayuno mejora la concentración escolar notablemente.",
        "Las frutas de colores intensos tienen más antioxidantes.",
        "El agua es la mejor bebida para la hidratación infantil.",
        "Involucrar a los niños en la cocina reduce el rechazo a nuevos alimentos.",
        "Cinco porciones de frutas y verduras al día son la clave de la energía.",
        "El calcio es fundamental para fortalecer los huesos en crecimiento."
    ];

    let factIndex = 0;
    const factElement = document.getElementById('nutri-fact');

    function rotateFact() {
                            factElement.style.opacity = 0;
                            setTimeout(() => {
                                factElement.innerText = facts[factIndex];
                                factElement.style.opacity = 1;
                                factIndex = (factIndex + 1) % facts.length;
                            }, 500);
                        }

                        setInterval(rotateFact, 5000); 
                        rotateFact();
                    </script>
                    @endsection