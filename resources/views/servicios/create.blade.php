@extends('layouts.app')

@section('title', 'Nuevo Servicio - Nutripeques')

@section('content')
<style>
    /* ====== VARIABLES NUTRI ====== */
    :root {
        --purple-gradient: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%);
        --soft-blue: #e3f2fd;
        --card-bg: rgba(255, 255, 255, 0.7);
        --accent-pink: #ff9a9e;
    }

    body {
        background-color: var(--soft-blue);
        background-image: radial-gradient(circle at 10% 20%, rgba(216, 241, 230, 0.46) 0.1%, rgba(233, 226, 226, 0.28) 90.1%);
        font-family: 'Quicksand', sans-serif;
        min-height: 100vh;
    }

    /* ====== TARJETA DE FORMULARIO ====== */
    .form-container {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 2px solid white;
        border-radius: 40px;
        padding: 50px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        max-width: 600px;
        margin: 40px auto;
    }

    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-header h1 {
        font-weight: 800;
        color: #333;
        font-size: 2rem;
    }

    /* ====== INPUTS ESTILIZADOS ====== */
    .form-label {
        font-weight: 700;
        color: #555;
        margin-left: 5px;
        margin-top: 15px;
    }

    .form-control {
        border-radius: 15px;
        border: 1px solid white;
        padding: 12px 20px;
        background: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background: white;
        border-color: #7276d1;
        box-shadow: 0 0 15px rgba(114, 118, 209, 0.2);
        outline: none;
    }

    textarea.form-control {
        resize: none;
        min-height: 120px;
    }

    /* ====== BOTÓN GUARDAR ====== */
    .btn-save {
        background: var(--purple-gradient);
        color: white;
        border: none;
        border-radius: 20px;
        padding: 15px;
        font-weight: 700;
        width: 100%;
        margin-top: 30px;
        box-shadow: 0 10px 20px rgba(114, 118, 209, 0.3);
        transition: 0.3s;
    }

    .btn-save:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(114, 118, 209, 0.4);
        color: white;
    }

    .btn-cancel {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #888;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .btn-cancel:hover {
        color: #555;
    }
</style>

<div class="container py-5">
    <div class="form-container">
        <div class="form-header">
            <div class="mb-3">
                <i class="bi bi-plus-circle-fill" style="font-size: 3rem; color: #7276d1;"></i>
            </div>
            <h1>Crear Servicio</h1>
            <p class="text-muted">Ingresa los detalles del nuevo plan nutricional</p>
        </div>

        <form action="{{ route('servicios.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre del Servicio</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej: Dieta para etapa escolar" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción Detallada</label>
                <textarea name="descripcion" class="form-control" placeholder="Escribe aquí de qué trata este servicio..." required></textarea>
            </div>

            <button type="submit" class="btn-save">
                <i class="bi bi-check-lg me-2"></i> Guardar Servicio
            </button>

            <a href="{{ route('servicios.index') }}" class="btn-cancel">
                Cancelar y volver
            </a>
        </form>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection