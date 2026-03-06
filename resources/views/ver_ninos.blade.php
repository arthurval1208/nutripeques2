@extends('layouts.app')

@section('title', 'Expedientes de Niños - Nutripeques')

@section('content')
<style>
    :root {
        --primary-blue: #185a9d;
        --soft-bg: #f8fafc;
        --imc-low: #f59e0b; /* Ámbar */
        --imc-good: #10b981; /* Verde */
        --imc-high: #ef4444; /* Rojo */
        --admin-purple: #7276d1;
    }

    body {
        background-color: var(--soft-bg);
        font-family: 'Quicksand', sans-serif;
    }

    /* Diseño del Botón Regresar Estilo "Admin Action" */
    .back-nav {
        display: inline-flex;
        align-items: center;
        padding: 10px 20px;
        background: white;
        color: var(--admin-purple);
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid #edf2f7;
        margin-bottom: 20px;
    }

    .back-nav:hover {
        background: var(--admin-purple);
        color: white;
        transform: translateX(-5px);
        box-shadow: 0 6px 20px rgba(114, 118, 209, 0.2);
    }

    .page-header {
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        margin-bottom: 30px;
    }

    .table-container {
        background: white;
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
        border: none;
    }

    .table thead {
        background-color: #f1f5f9;
    }

    .table thead th {
        border: none;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        padding: 20px;
    }

    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: white;
    }

    .imc-badge {
        padding: 8px 15px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 1.1rem;
    }

    .btn-plan {
        background-color: #10b981;
        color: white;
        border: none;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-plan:hover {
        background-color: #059669;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .status-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }
</style>

<div class="container py-5">
    
    <a href="{{ route('home') }}" class="back-nav">
        <i class="bi bi-arrow-left-short fs-4 me-1"></i>
        <span>Volver al Panel de Control</span>
    </a>

    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1 text-dark">Expedientes Nutricionales</h2>
            <p class="text-muted mb-0">Monitoreo global de niños y cálculo de IMC automático</p>
        </div>
        <div class="text-end">
            <span class="badge bg-light text-primary p-3 rounded-4 border">
                <i class="bi bi-people-fill me-2"></i> {{ count($ninos) }} Niños Registrados
            </span>
        </div>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Paciente</th>
                        <th>Tutor / Correo</th>
                        <th>Edad</th>
                        <th>Medidas (P/T)</th>
                        <th>IMC Actual</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ninos as $nino)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3 bg-{{ $nino['genero'] ? 'info' : 'danger' }}">
                                    {{ substr($nino['nombre'], 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $nino['nombre'] }}</h6>
                                    <small class="text-muted">
                                        {{ $nino['genero'] ? 'Niño' : 'Niña' }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-dark small fw-bold">{{ $nino['correo'] }}</div>
                        </td>
                        <td>
                            <span class="fw-bold">{{ $nino['edad'] }} años</span>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="small"><i class="bi bi-geo-fill text-muted"></i> {{ $nino['peso'] }} kg</span>
                                <span class="small"><i class="bi bi-ruler text-muted"></i> {{ $nino['talla'] }} m</span>
                            </div>
                        </td>
                        <td>
                            @php
                                $statusColor = 'var(--imc-good)';
                                $statusText = 'Normal';
                                if($nino['imc'] < 18.5) { $statusColor = 'var(--imc-low)'; $statusText = 'Bajo Peso'; }
                                if($nino['imc'] > 24.9) { $statusColor = 'var(--imc-high)'; $statusText = 'Sobrepeso'; }
                            @endphp
                            <div class="d-flex align-items-center">
                                <span class="imc-badge me-2" style="color: {{ $statusColor }}; background: {{ $statusColor }}15;">
                                    {{ $nino['imc'] }}
                                </span>
                                <div class="small fw-bold d-none d-md-block" style="color: {{ $statusColor }};">
                                    <span class="status-indicator" style="background-color: {{ $statusColor }};"></span>
                                    {{ $statusText }}
                                </div>
                            </div>
                        </td>
                        <td class="text-center pe-4">
                            <a href="{{ route('nino.asignar_plan', $nino['id']) }}" class="btn btn-plan shadow-sm">
                                <i class="bi bi-journal-plus me-1"></i> Asignar Plan
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-folder-x display-1 text-muted"></i>
                            <p class="mt-3 text-muted">No hay niños registrados en el sistema actualmente.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
@endsection