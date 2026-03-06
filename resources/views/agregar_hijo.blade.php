@extends('layouts.app')

@section('title', 'Agregar Hijo - Nutripeques')

@section('content')
<style>
    :root {
        --purple-primary: #7276d1;
        --purple-hover: #5a5eb1;
        --soft-bg: #f4f9f9;
    }

    body {
        background-color: var(--soft-bg);
    }

    .glass-container {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(10px);
        border: 2px solid white;
        border-radius: 40px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    }

    /* Estilo del botón de regreso que te gustó */
    .btn-back-link { 
        color: var(--purple-primary); 
        font-size: 2.2rem; 
        text-decoration: none; 
        transition: transform 0.2s, color 0.2s;
        display: inline-block;
        line-height: 1;
    }

    .btn-back-link:hover { 
        transform: scale(1.1); 
        color: var(--purple-hover); 
    }

    .form-control {
        border-radius: 12px;
        padding: 12px;
        border: 1px solid #e0e0e0;
    }

    .btn-success-custom {
        background-color: #43cea2;
        border: none;
        border-radius: 15px;
        padding: 12px 30px;
        font-weight: 700;
        transition: all 0.3s;
    }

    .btn-success-custom:hover {
        background-color: #38b68f;
        transform: translateY(-2px);
    }
</style>

<div class="container py-5">
    <div class="glass-container">
        
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('panel.usuario') }}" class="btn-back-link me-3">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
            <div>
                <span class="badge rounded-pill bg-white text-success px-3 py-2 mb-1 shadow-sm border">
                    NUEVO REGISTRO
                </span>
                <h1 class="fw-bold mb-0">Ingrese los datos de su hijo</h1>
            </div>
        </div>

        <hr class="mb-4" style="opacity: 0.1;">

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 15px;">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 15px;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('agregar_hijo') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre del Niño</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej. Juan" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apellido" class="form-label fw-bold">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ej. Pérez" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="edad" class="form-label fw-bold">Edad</label>
                    <input type="number" name="edad" id="edad" class="form-control" placeholder="0" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="estatura" class="form-label fw-bold">Estatura (mts)</label>
                    <input type="text" name="estatura" id="estatura" class="form-control" placeholder="120" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="peso" class="form-label fw-bold">Peso (kg)</label>
                    <input type="text" name="peso" id="peso" class="form-control" placeholder="25" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="sexo" class="form-label fw-bold">Sexo</label>
                <select name="sexo" id="sexo" class="form-select" style="border-radius: 12px; padding: 12px;" required>
                    <option value="" selected disabled>Seleccione una opción</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success-custom text-white shadow-sm">
                    <i class="bi bi-person-plus-fill me-2"></i> Registrar Hijo
                </button>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
@endsection