@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --purple-primary: #7276d1;
        --purple-dark: #5a5eb1;
        --soft-blue: #f4f7fe;
        --white: #ffffff;
    }

    body {
        background-color: var(--soft-blue);
        font-family: 'Quicksand', sans-serif;
    }

    .main-profile-wrapper {
        max-width: 900px;
        margin: 50px auto;
        padding: 0 20px;
    }

    /* Tarjeta Principal */
    .profile-header-card {
        background: var(--white);
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        position: relative;
        margin-bottom: 30px;
    }

    .profile-banner {
        height: 150px;
        background: linear-gradient(135deg, #7276d1 0%, #ff9a9e 100%);
    }

    .back-arrow {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(255,255,255,0.2);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        backdrop-filter: blur(5px);
        transition: 0.3s;
        z-index: 10;
    }

    .back-arrow:hover {
        background: white;
        color: var(--purple-primary);
        transform: translateX(-5px);
    }

    .profile-info-main {
        padding: 0 40px 30px;
        margin-top: -70px;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .avatar-container {
        position: relative;
        display: inline-block;
        width: 140px;
        height: 140px;
    }

    .profile-avatar {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 6px solid var(--white);
        object-fit: cover;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        background: #7276d1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        font-weight: bold;
    }

    .badge-role {
        position: absolute;
        bottom: 10px;
        right: 0;
        background: #7276d1;
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        border: 3px solid white;
        text-transform: uppercase;
    }

    .user-name-title {
        font-weight: 800;
        font-size: 2rem;
        margin-top: 15px;
        margin-bottom: 5px;
        color: #333;
    }

    /* Grid de Información */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .info-card {
        background: var(--white);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.03);
    }

    .card-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        color: var(--purple-primary);
    }

    .card-title i { margin-right: 10px; }

    /* Estilos de visualización de datos */
    .data-group { margin-bottom: 20px; }
    .data-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #888;
        text-transform: uppercase;
        margin-bottom: 5px;
        display: block;
    }
    .data-value {
        font-weight: 700;
        color: #333;
        font-size: 1.05rem;
        padding-bottom: 8px;
        border-bottom: 1px solid #f0f0f0;
    }

    .btn-action {
        background: var(--purple-primary);
        color: white;
        border: none;
        padding: 15px;
        border-radius: 15px;
        font-weight: 700;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-action:hover {
        background: var(--purple-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(114, 118, 209, 0.3);
    }

    .btn-logout {
        background: transparent;
        color: #dc3545;
        border: 2px solid #f8d7da;
        padding: 12px;
        border-radius: 15px;
        font-weight: 700;
        width: 100%;
        margin-top: 15px;
        transition: 0.3s;
    }

    .btn-logout:hover {
        background: #dc3545;
        color: white;
        border-color: #dc3545;
    }
</style>

<div class="main-profile-wrapper">
    
    @php
        $urlRegreso = route('inicio');
        if(session('rol') == 'admin') $urlRegreso = route('home');
        elseif(session('rol') == 'nutriologo') $urlRegreso = route('panel.nutriologo');
        elseif(session('rol') == 'user') $urlRegreso = route('panel.usuario');
    @endphp

    <div class="profile-header-card">
        <a href="{{ $urlRegreso }}" class="back-arrow">
            <i class="fas fa-arrow-left"></i>
        </a>

        <div class="profile-banner"></div>
        
        <div class="profile-info-main">
            <div class="avatar-container">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(session('usuario')) }}&background=7276d1&color=fff&size=128" 
                     class="profile-avatar" alt="Avatar">
                <span class="badge-role">{{ session('rol') }}</span>
            </div>
            
            <h2 class="user-name-title">{{ session('usuario') }} {{ session('apellido') }}</h2>
            <p class="text-muted"><i class="far fa-envelope me-1"></i> {{ session('email_login') }}</p>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-card">
            <h3 class="card-title"><i class="fas fa-id-card"></i> Información Personal</h3>
            
            <div class="data-group">
                <span class="data-label">Nombre Completo</span>
                <div class="data-value">{{ session('usuario') }} {{ session('apellido') }}</div>
            </div>

            <div class="data-group">
                <span class="data-label">Correo Electrónico</span>
                <div class="data-value">{{ session('email_login') }}</div>
            </div>

            @if(session('especialidad'))
            <div class="data-group">
                <span class="data-label">Especialidad</span>
                <div class="data-value">{{ session('especialidad') }}</div>
            </div>
            @endif
        </div>

        <div class="info-card">
            <h3 class="card-title"><i class="fas fa-cog"></i> Gestión de Cuenta</h3>
            
            <p class="text-muted mb-4" style="font-size: 0.9rem;">
                Puedes actualizar tu información personal o cambiar tu contraseña en la sección de edición.
            </p>
<a href="{{ url('editar-perfil/' . session('user_id')) }}" class="btn-action">
    <i class="fas fa-user-edit"></i> Editar mi información
</a>    
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</div>
@endsection