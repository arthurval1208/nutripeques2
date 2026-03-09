@extends('layouts.app')

@section('title', 'Planes Nutricionales - Nutripeques')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700;800&display=swap');

    :root {
        --bg-main: #f4f9f9;
        --sidebar-white: #ffffff;
        --active-blue-bg: #e1f1f6;
        --active-blue-text: #0056b3;
        --logout-red-bg: #fff0f0;
        --logout-red-text: #ff5e5e;
        --text-gray: #636e72;
        --sidebar-width: 260px;
    }

    body {
        background-color: var(--bg-main);
        font-family: 'Quicksand', sans-serif;
        margin: 0;
    }

    /* --- SIDEBAR COMPACTO --- */
    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        left: 0; top: 0;
        background: var(--sidebar-white);
        padding: 15px 15px;
        display: flex;
        flex-direction: column;
        z-index: 1000;
        box-shadow: 2px 0 10px rgba(0,0,0,0.02);
    }

    .logo-container {
        text-align: center;
        margin-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 10px;
    }

    .logo-peques span { font-weight: 800; }

    .nav-menu {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        color: var(--text-gray);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        border-radius: 15px;
        transition: 0.3s;
        margin-bottom: 4px;
    }

    .nav-item i {
        margin-right: 12px;
        font-size: 1.1rem;
    }

    .nav-item.active {
        background: var(--active-blue-bg);
        color: var(--active-blue-text);
    }

    .nav-item:hover:not(.active) {
        background: #f8f9fa;
        color: #333;
    }

    .btn-logout {
        margin-top: auto;
        background: var(--logout-red-bg);
        color: var(--logout-red-text);
        border: none;
        padding: 8px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        transition: 0.3s;
    }

    /* --- CONTENIDO PRINCIPAL --- */
    .main-wrapper {
        margin-left: var(--sidebar-width);
        padding: 40px;
    }

    .plan-header-banner {
        background: white;
        padding: 25px;
        border-radius: 25px;
        margin-bottom: 35px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .icon-circle {
        width: 55px; height: 55px;
        background: #e1f6f0;
        color: #43cea2;
        border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
    }

    /* --- TARJETAS DE EDAD ANIMADAS --- */
    .card-plan-link { text-decoration: none !important; display: block; }

    .card-age-plan {
        background: white;
        border-radius: 25px;
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid transparent;
        position: relative;
    }

    .card-age-plan:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.07) !important;
        border-color: #e1f1f6;
    }

    .age-icon {
        width: 60px; height: 60px;
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 1.5rem; flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .card-age-plan:hover .age-icon { transform: rotate(-10deg) scale(1.1); }

    .arrow-go { color: #dee2e6; font-size: 1.2rem; transition: 0.3s; }
    .card-age-plan:hover .arrow-go { transform: translateX(5px); color: var(--active-blue-text); }

    /* Animación de entrada */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .col-animate { animation: fadeInUp 0.5s ease backwards; }
</style>

<nav class="sidebar">
    <div class="logo-container">
        <div style="display: inline-flex; align-items: baseline; gap: 4px;">
            <span style="font-weight: 800; font-size: 18px; color: #333;">Nutri</span>
            <div class="logo-peques" style="font-size: 16px; display: flex; gap: 1px;">
                <span style="color: #ff786e;">P</span>
                <span style="color: #aec982;">e</span>
                <span style="color: #ffadd1;">q</span>
                <span style="color: #f4be5d;">u</span>
                <span style="color: #b3caff;">e</span>
                <span style="color: #ff786e;">s</span>
            </div>
        </div>
    </div>

    <div class="nav-menu">
        <a href="{{ route('perfil') }}" class="nav-item {{ Request::is('perfil') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> <span>Mi Perfil</span>
        </a>
        <a href="{{ route('panel.usuario') }}" class="nav-item {{ Request::is('panel-usuario') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> <span>Inicio</span>
        </a>
        <a href="{{ url('/plan/15-18') }}" class="nav-item {{ Request::is('plan*') ? 'active' : '' }}">
            <i class="bi bi-egg-fried"></i> <span>Planes</span>
        </a>
        <a href="{{ route('hijos.registrados') }}" class="nav-item"><i class="bi bi-people-fill"></i> <span>Mis Hijos</span></a>
        <a href="{{ url('/agregar_hijo') }}" class="nav-item"><i class="bi bi-person-plus-fill"></i> <span>Agregar Hijo</span></a>
        <a href="{{ url('/actividades') }}" class="nav-item"><i class="bi bi-bicycle"></i> <span>Actividades</span></a>
        <a href="{{ url('/crear_contacto') }}" class="nav-item"><i class="bi bi-envelope-paper-heart-fill"></i> <span>Consulta</span></a>
        <a href="{{ url('/inicio') }}" class="nav-item"><i class="bi bi-house-heart-fill"></i> <span>Resumen Diario</span></a>
    </div>

    <form action="{{ route('logout') }}" method="POST" style="margin-top: auto;">
        @csrf
        <button type="submit" class="btn-logout">
            <i class="bi bi-box-arrow-right"></i> Salir
        </button>
    </form>
</nav>

<div class="main-wrapper">
    <div class="plan-header-banner">
        <div class="icon-circle">
            <i class="bi bi-rocket-takeoff-fill"></i>
        </div>
        <div>
            <h2 style="font-weight: 800; margin-bottom: 0;">Planes Nutricionales por Edad</h2>
            <p class="text-muted mb-0">Selecciona una etapa para ver su guía personalizada.</p>
        </div>
    </div>

    <div class="row">
        @php
            $planes = [
                ['rango' => '0 - 6 meses', 'color' => '#ff786e', 'icon' => 'bi-baby', 'delay' => '0.1s'],
                ['rango' => '6 - 12 meses', 'color' => '#aec982', 'icon' => 'bi-apple', 'delay' => '0.2s'],
                ['rango' => '1 - 3 años', 'color' => '#ffadd1', 'icon' => 'bi-bicycle', 'delay' => '0.3s'],
                ['rango' => '3 - 5 años', 'color' => '#f4be5d', 'icon' => 'bi-palette', 'delay' => '0.4s'],
                ['rango' => '6 - 12 años', 'color' => '#b3caff', 'icon' => 'bi-backpack-fill', 'delay' => '0.5s'],
                ['rango' => '13+ años', 'color' => '#43cea2', 'icon' => 'bi-lightning-charge', 'delay' => '0.6s'],
            ];
        @endphp

        @foreach($planes as $p)
        <div class="col-md-6 col-lg-4 mb-4 col-animate" style="animation-delay: {{ $p['delay'] }}">
            <a href="{{ url('/plan/' . Str::slug($p['rango'])) }}" class="card-plan-link">
                <div class="card-age-plan shadow-sm">
                    <div class="age-icon" style="background-color: {{ $p['color'] }}">
                        <i class="bi {{ $p['icon'] }}"></i>
                    </div>
                    <div style="flex-grow: 1;">
                        <h5 class="fw-800 mb-0" style="color: #333;">{{ $p['rango'] }}</h5>
                        <small class="text-muted">Ver recomendaciones</small>
                    </div>
                    <div class="arrow-go">
                        <i class="bi bi-arrow-right-short"></i>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection