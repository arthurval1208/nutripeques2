@extends('layouts.app')

@section('title', 'Nuevo Usuario - Nutripeques')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    :root {
        --primary: #7276d1;
        --primary-dark: #5a5eb1;
        --glass: rgba(255, 255, 255, 0.9);
        --bg-main: #f0f4ff;
        --sidebar-width: 280px;
    }

    body {
        background: linear-gradient(135deg, #f0f4ff 0%, #d9e2ff 100%);
        font-family: 'Plus Jakarta Sans', sans-serif;
        margin: 0;
    }

    /* --- SIDEBAR INTEGRADO --- */
    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        left: 0; top: 0;
        background: white;
        padding: 30px 20px;
        box-shadow: 10px 0 30px rgba(0,0,0,0.02);
        z-index: 1100;
    }

    .nav-item {
        display: flex; align-items: center;
        padding: 14px 18px; margin-bottom: 8px;
        color: #7d8492; text-decoration: none;
        border-radius: 16px; transition: 0.3s;
        font-weight: 600;
    }

    .nav-item.active { background: #f0f4ff; color: var(--primary); }

    /* --- CONTENIDO AJUSTADO AL SIDEBAR --- */
    .main-wrapper {
        margin-left: var(--sidebar-width); /* Deja el espacio para el sidebar */
        padding: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    /* LA TARJETA DEL FORMULARIO */
    .edit-card {
        background: var(--glass);
        backdrop-filter: blur(15px);
        border-radius: 35px;
        padding: 50px;
        box-shadow: 0 25px 50px rgba(0,0,0,0.1);
        max-width: 600px;
        width: 100%;
        border: 2px solid rgba(255,255,255,0.7);
        position: relative;
    }

    .edit-card::after {
        content: ""; position: absolute; top: 0; left: 30%; right: 30%;
        height: 5px; background: var(--primary); border-radius: 0 0 10px 10px;
    }

    .form-control {
        border-radius: 18px; padding: 14px 22px;
        border: 2px solid #eee; background: white;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(114, 118, 209, 0.1);
    }

    .btn-update {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white; border-radius: 22px; padding: 18px;
        font-weight: 700; border: none; width: 100%;
        box-shadow: 0 15px 30px rgba(114, 118, 209, 0.3);
        transition: 0.4s;
    }

    .btn-update:hover { transform: translateY(-4px); filter: brightness(1.1); }
</style>

<nav class="sidebar">
    <div class="text-center mb-5">
        <span class="fw-800 fs-4">Nutri</span><span class="text-primary fw-800 fs-4">Peques</span>
    </div>

    <div class="nav-menu">
        <a href="{{ url('/home') }}" class="nav-item">
            <i class="bi bi-house-door me-2"></i> Dashboard
        </a>
        <a href="{{ route('ver.usuarios') }}" class="nav-item active">
            <i class="bi bi-people me-2"></i> Usuarios
        </a>
        <a href="{{ route('perfil') }}" class="nav-item">
            <i class="bi bi-person me-2"></i> Mi Perfil
        </a>
    </div>
</nav>

<div class="main-wrapper">
    <div class="edit-card">
        <div class="text-center mb-4">
            <span class="badge bg-light text-primary px-3 py-2 rounded-pill fw-bold mb-2">SISTEMA ADMIN</span>
            <h2 class="fw-800">Crear Nuevo Usuario</h2>
            <p class="text-muted">Completa los datos para el registro de padres</p>
        </div>

        <form action="{{ url('/guardar-usuario') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold small text-uppercase">Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Tu nombre" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold small text-uppercase">Apellido</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Tu apellido" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold small text-uppercase">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold small text-uppercase">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Mínimo 6 caracteres" required>
            </div>

            <button type="submit" class="btn-update">
                <i class="bi bi-person-check-fill me-2"></i> Registrarme
            </button>
            
            <div class="text-center mt-4">
                <a href="{{ route('ver.usuarios') }}" class="text-muted small text-decoration-none">
                    ¿Ya tienes cuenta? <span class="text-primary fw-bold">Inicia sesión</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection