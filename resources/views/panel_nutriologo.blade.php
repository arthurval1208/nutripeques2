@extends('layouts.app')

@section('content')
<style>
    :root { --bg-nutri: #f0f7ff; --text-purple: #7276d1; --accent-orange: #f8b133; }
    body { background-color: var(--bg-nutri); font-family: 'Quicksand', sans-serif; }
    .panel-container { padding: 20px; max-width: 600px; margin: 0 auto; }
    .header-nutri { text-align: center; margin-bottom: 30px; color: var(--text-purple); padding-top: 20px; }
    .menu-card { 
        background: white; border-radius: 20px; padding: 20px; margin-bottom: 15px; 
        display: flex; align-items: center; text-decoration: none; color: #444; 
        border-left: 6px solid var(--text-purple); box-shadow: 0 4px 15px rgba(0,0,0,0.05); 
        transition: 0.3s ease; 
    }
    .menu-card:hover { transform: translateX(10px); color: var(--text-purple); }
    .menu-card i { font-size: 1.8rem; margin-right: 20px; color: var(--text-purple); }
    .card-plan { border-left-color: var(--accent-orange); }
    .card-plan i { color: var(--accent-orange); }
    .footer-profile { position: fixed; bottom: 25px; left: 25px; }
    .profile-btn { font-size: 3rem; color: #555; transition: 0.3s; }
    .profile-btn:hover { color: var(--text-purple); }
</style>

<div class="panel-container">
    <div class="header-nutri">
        <h2 class="fw-bold">Panel Nutriólogo</h2>
        <p class="text-muted">Bienvenido(a), Nut. {{ session('usuario') }}</p>
    </div>

    <a href="{{ route('nutri.pacientes') }}" class="menu-card">
        <i class="bi bi-people-fill"></i>
        <div><h5 class="mb-0 fw-bold">Niños que ayudas</h5><p class="mb-0 small text-muted">Ver lista de pacientes</p></div>
    </a>

    <a href="{{ route('nutri.plan') }}" class="menu-card card-plan">
        <i class="bi bi-calendar-check-fill"></i>
        <div><h5 class="mb-0 fw-bold">Ajustar plan alimenticio</h5><p class="mb-0 small text-muted">Editar desayunos, comidas y cenas</p></div>
    </a>

    <a href="{{ route('nutri.progreso') }}" class="menu-card">
        <i class="bi bi-graph-up-arrow" style="color: #ff7675;"></i>
        <div><h5 class="mb-0 fw-bold">Ver progreso de niños</h5><p class="mb-0 small text-muted">Gráficas de peso y talla</p></div>
    </a>

    <a href="{{ route('nutri.mensajes') }}" class="menu-card">
        <i class="bi bi-chat-left-text-fill"></i>
        <div><h5 class="mb-0 fw-bold">Enviar Mensaje</h5><p class="mb-0 small text-muted">Retroalimentación para padres</p></div>
    </a>

    <div class="footer-profile">
        <a href="{{ route('perfil') }}" class="profile-btn"><i class="bi bi-person-circle"></i></a>
    </div>
</div>
@endsection