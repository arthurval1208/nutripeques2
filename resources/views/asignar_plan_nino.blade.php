@extends('layouts.app')

@section('title', 'Asignar Plan Nutricional')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
    :root {
        /* Colores dinámicos */
        --primary-color: {{ session('rol') == 'admin' ? '#7276d1' : '#43cea2' }};
        --secondary-color: {{ session('rol') == 'admin' ? '#5a5eb1' : '#185a9d' }};
        --accent-green: #10b981;
        --bg-body: #f4f7fe;
        --sidebar-width: 280px;
    }

    body { 
        background-color: var(--bg-body); 
        font-family: 'Quicksand', sans-serif; 
        margin: 0;
    }

    /* --- SIDEBAR DINÁMICO --- */
    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        left: 0; top: 0;
        background: white;
        padding: 20px;
        box-shadow: 10px 0 30px rgba(0,0,0,0.02);
        z-index: 1100;
        display: flex;
        flex-direction: column;
    }

    .nav-menu { margin-top: 20px; flex-grow: 1; display: flex; flex-direction: column; gap: 5px; }

    .nav-item {
        display: flex; align-items: center;
        padding: 12px 18px; margin-bottom: 4px;
        color: #7d8492; text-decoration: none;
        border-radius: 16px; transition: 0.3s;
        font-weight: 600;
    }

    /* Estilo Activo según Rol */
    .nav-item.active {
        background: {{ session('rol') == 'admin' ? '#e2eaf4' : '#dff0f6' }};
        color: var(--secondary-color);
    }

    .nav-item i { margin-right: 12px; font-size: 1.1rem; }

    /* --- CONTENIDO --- */
    .main-wrapper {
        margin-left: var(--sidebar-width);
        padding: 40px;
        min-height: 100vh;
    }
    
    .profile-card {
        background: white;
        border-radius: 30px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .imc-display {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        border-radius: 20px;
        padding: 20px;
        text-align: center;
    }

    .form-section {
        background: white;
        border-radius: 30px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .form-control {
        border-radius: 15px;
        border: 2px solid #edf2f7;
        padding: 12px;
    }

    .btn-assign {
        background: var(--accent-green);
        color: white;
        border-radius: 18px;
        padding: 16px;
        font-weight: 700;
        border: none;
        width: 100%;
    }

    .btn-logout-sidebar {
        background: #fff0f0; color: #ff5e5e; border: none; padding: 12px;
        border-radius: 15px; width: 100%; font-weight: 700; margin-top: auto;
    }

    @media (max-width: 992px) {
        .sidebar { transform: translateX(-100%); }
        .main-wrapper { margin-left: 0; padding: 20px; }
    }
</style>

<nav class="sidebar">
    <div class="text-center mb-4">
        <h4 class="fw-bold">Nutri<span style="color: #ff786e;">P</span>eques</h4>
    </div>

    <div class="nav-menu">
        @if(session('rol') == 'admin')
            <a href="{{ route('home') }}" class="nav-item">
                <i class="bi bi-house-door"></i> Inicio
            </a>
            <a href="{{ route('ver.ninos') }}" class="nav-item active">
                <i class="bi bi-file-earmark-medical"></i> Niños
            </a>
            <a href="{{ route('ver.usuarios') }}" class="nav-item">
                <i class="bi bi-people"></i> Usuarios
            </a>
        @elseif(session('rol') == 'nutriologo')
            <a href="{{ route('panel.nutriologo') }}" class="nav-item">
                <i class="bi bi-grid-fill"></i> Inicio
            </a>
            <a href="{{ route('nutri.pacientes') }}" class="nav-item active">
                <i class="bi bi-people-fill"></i> Mis Pacientes
            </a>
        @endif
        <a href="{{ route('perfil') }}" class="nav-item">
            <i class="bi bi-person-circle"></i> Mi Perfil
        </a>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout-sidebar">
            <i class="bi bi-box-arrow-right"></i> Salir
        </button>
    </form>
</nav>

<div class="main-wrapper">
    <div class="mb-4">
        <a href="javascript:history.back()" class="text-decoration-none text-muted fw-bold">
            <i class="bi bi-arrow-left me-2"></i> Volver atrás
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="profile-card text-center">
                <div class="avatar-large mb-3 mx-auto" style="width: 80px; height: 80px; background: #eef2ff; border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-person-fill text-primary fs-1"></i>
                </div>
                <h3 class="fw-bold mb-1 text-dark">{{ $nino['nombre'] ?? 'Sin nombre' }}</h3>
                <span class="badge bg-light text-primary rounded-pill px-3 py-2 mb-3">Expediente Médico</span>

                <div class="imc-display my-4">
                    <small class="d-block opacity-75 text-uppercase fw-bold">IMC Calculado</small>
                    <h2 class="fw-bold mb-0" style="font-size: 2.5rem;">{{ $nino['imc_calculado'] ?? '0' }}</h2>
                </div>

                <div class="row text-start g-3">
                    <div class="col-6 border-end">
                        <small class="text-muted d-block text-uppercase">Peso</small>
                        <strong class="fs-5">{{ $nino['peso'] ?? '0' }} kg</strong>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block text-uppercase">Estatura</small>
                        <strong class="fs-5">{{ $nino['estatura'] ?? '0' }} m</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="form-section">
                <div class="d-flex align-items-center mb-4">
                    <div class="p-3 rounded-4 me-3" style="background: var(--primary-color); color: white;">
                        <i class="bi bi-journal-check fs-3"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0">Prescribir Plan Nutricional</h2>
                        <p class="text-muted mb-0">Diseña la dieta y recomendaciones personalizadas.</p>
                    </div>
                </div>
                
                <form action="{{ route('nino.guardar_plan', $nino['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Título del Plan</label>
                        <input type="text" name="titulo_plan" class="form-control" placeholder="Ej: Control de peso" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Detalle del Menú</label>
                        <textarea name="detalle_plan" class="form-control" rows="6" required>{{ $sugerencia ?? '' }}</textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Calorías (Kcal)</label>
                            <input type="number" name="calorias" class="form-control" placeholder="1200">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Próxima Cita</label>
                            <input type="date" name="proxima_cita" class="form-control">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Archivo de Apoyo (PDF/TXT)</label>
                        <input type="file" name="archivo_adjunto" class="form-control" accept=".pdf,.txt">
                    </div>

                    <button type="submit" class="btn btn-assign">
                        <i class="bi bi-send-fill me-2"></i> Guardar y Notificar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection