@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --purple-primary: #7276d1;
        --purple-dark: #5a5eb1;
        --soft-blue: #f0f4f8;
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

    .profile-info-main {
        padding: 0 40px 30px;
        margin-top: -70px; /* Ajuste para que la foto flote sobre el banner */
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
        background: white;
    }

    .badge-premium {
        position: absolute;
        bottom: 10px;
        right: 0;
        background: #ffd700;
        color: #856404;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        border: 3px solid white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .user-name-title {
        font-weight: 800;
        font-size: 2rem;
        margin-top: 15px;
        margin-bottom: 5px;
        color: #333;
        display: block;
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
        height: 100%;
    }

    .card-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        color: var(--purple-primary);
    }

    .card-title i {
        margin-right: 10px;
    }

    /* Inputs Estilizados */
    .input-group-custom {
        margin-bottom: 20px;
    }

    .input-group-custom label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: #666;
        margin-bottom: 8px;
    }

    .form-control-custom {
        width: 100%;
        padding: 12px 15px;
        border-radius: 12px;
        border: 1.5px solid #eee;
        background: #fdfdfd;
        transition: 0.3s;
        box-sizing: border-box;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: var(--purple-primary);
        box-shadow: 0 0 10px rgba(114, 118, 209, 0.1);
    }

    .btn-update {
        background: linear-gradient(to right, var(--purple-primary), var(--purple-dark));
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 15px;
        font-weight: 700;
        width: 100%;
        transition: 0.3s;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(114, 118, 209, 0.3);
    }

    .stats-row {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 20px;
    }

    .stat-item b {
        display: block;
        font-size: 1.2rem;
        color: #333;
    }

    .stat-item span {
        font-size: 0.8rem;
        color: #888;
    }
</style>

<div class="main-profile-wrapper">

    @if(session('status'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px; background-color: #d4edda; color: #155724; padding: 15px;">
            <i class="fas fa-check-circle me-2"></i> {{ session('status') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 15px; background-color: #f8d7da; color: #721c24; padding: 15px;">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="profile-header-card">
        <div class="profile-banner"></div>
        <div class="profile-info-main">
            <div class="avatar-container">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user['name']['stringValue'] ?? 'U') }}&background=7276d1&color=fff&size=128" 
                    class="profile-avatar" 
                    alt="Avatar">
                <span class="badge-premium"><i class="fas fa-star"></i> Usuario</span>
            </div>
            
            <h2 class="user-name-title">{{ $user['name']['stringValue'] ?? 'Usuario' }}</h2>
            <p class="text-muted"><i class="far fa-envelope me-1"></i> {{ $user['email']['stringValue'] ?? 'Sin correo registrado' }}</p>
            
            <div class="stats-row">
                <div class="stat-item">
                    <b>05</b>
                    <span>Actividades</span>
                </div>
                <div class="stat-item">
                    <b>{{ date('M Y') }}</b>
                    <span>Miembro desde</span>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('update.profile') }}">
        @csrf
        <div class="info-grid">
            
            <div class="info-card">
                <h3 class="card-title"><i class="fas fa-user-circle"></i> Datos Personales</h3>
                
                <div class="input-group-custom">
                    <label>Nombre Completo</label>
                    <input type="text" class="form-control-custom" name="nombre" 
                        value="{{ $user['name']['stringValue'] ?? '' }}" required>
                </div>

                <div class="input-group-custom">
                    <label>Correo Electrónico (No editable)</label>
                    <input type="email" class="form-control-custom" 
                        value="{{ $user['email']['stringValue'] ?? '' }}" readonly 
                        style="background: #f5f5f5; color: #999; cursor: not-allowed;">
                </div>
            </div>

            <div class="info-card">
                <h3 class="card-title"><i class="fas fa-shield-alt"></i> Seguridad</h3>
                
                <div class="input-group-custom">
                    <label>Nueva Contraseña</label>
                    <input type="password" class="form-control-custom" name="nueva_contrasena" 
                        placeholder="••••••••">
                </div>

                <p class="text-muted" style="font-size: 0.85rem; line-height: 1.4;">
                    <i class="fas fa-info-circle me-1"></i> Deja el campo de contraseña en blanco si deseas mantener la clave actual.
                </p>

                <div class="mt-4">
                    <button type="submit" class="btn-update">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>

@endsection