@extends('layouts.app')

@section('title', 'Mis Hijos - Nutripeques')

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

    /* Tarjetas de los hijos */
    .child-card {
        background: white;
        border-radius: 25px;
        padding: 25px;
        border: none;
        transition: all 0.3s ease;
        border-left: 6px solid var(--purple-primary);
    }

    .child-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }

    .info-badge {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 8px 15px;
        border: 1px solid #eee;
    }

    .imc-badge {
        font-weight: 700;
        padding: 5px 15px;
        border-radius: 20px;
    }
</style>

<div class="container py-5">
    <div class="glass-container">
        
        <div class="d-flex align-items-center mb-5">
            <a href="{{ route('panel.usuario') }}" class="btn-back-link me-3">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
            <div>
                <span class="badge rounded-pill bg-white text-primary px-3 py-2 mb-1 shadow-sm border text-uppercase">
                    Configuración de Familia
                </span>
                <h1 class="fw-bold mb-0">Mis Hijos Registrados</h1>
            </div>
        </div>

        <div class="row">
            @forelse($todosLosNinios as $hijo)
                <div class="col-md-6 mb-4">
                    <div class="child-card shadow-sm">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="fw-bold text-dark mb-1">{{ $hijo['nombre'] }} {{ $hijo['apellido'] }}</h3>
                                <p class="text-muted mb-3">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $hijo['edad'] }} años • 
                                    <i class="bi bi-gender-ambiguous me-1"></i> {{ ucfirst($hijo['sexo']?? 'No definido') }}
                                </p>
                                
                                <div class="d-flex align-items-center mt-3">
                                    @php
                                        // Lógica de color según IMC
                                        $colorImc = 'bg-success'; // Normal
                                        $estado = 'Normal';
                                        
                                        if($hijo['imc'] < 18.5) { $colorImc = 'bg-info'; $estado = 'Bajo peso'; }
                                        elseif($hijo['imc'] >= 25 && $hijo['imc'] < 30) { $colorImc = 'bg-warning text-dark'; $estado = 'Sobrepeso'; }
                                        elseif($hijo['imc'] >= 30) { $colorImc = 'bg-danger'; $estado = 'Obesidad'; }
                                    @endphp
                                    
                                    <span class="imc-badge {{ $colorImc }} text-white me-2">
                                        IMC: {{ number_format((float)$hijo['imc'], 1) }}
                                    </span>
                                    <small class="fw-bold text-muted">{{ $estado }}</small>
                                </div>
                            </div>

                            <div class="text-end">
                                <div class="info-badge mb-2">
                                    <small class="text-muted d-block">Peso</small>
                                    <span class="fw-bold">{{ $hijo['peso'] }} kg</span>
                                </div>
                                <div class="info-badge">
                                    <small class="text-muted d-block">Estatura</small>
                                    <span class="fw-bold">{{ $hijo['estatura'] }} mts</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-emoji-smile text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                    </div>
                    <h3 class="text-muted">Aún no has registrado a tus hijos</h3>
                    <p class="text-muted mb-4">Comienza agregando a tu primer pequeño para realizar su seguimiento nutricional.</p>
                    <a href="{{ route('agregar_hijo') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
                        <i class="bi bi-plus-lg me-2"></i> Registrar ahora
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
@endsection