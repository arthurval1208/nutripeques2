@extends('layouts.app')

@section('title', 'Asignar Plan Nutricional')

@section('content')
<style>
    :root {
        --primary-color: #7276d1;
        --secondary-color: #5a5eb1;
        --accent-green: #10b981;
        --bg-body: #f4f7fe;
    }

    body { 
        background-color: var(--bg-body); 
        font-family: 'Quicksand', sans-serif; 
    }
    
    .profile-card {
        background: white;
        border-radius: 30px;
        padding: 30px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        position: sticky;
        top: 20px;
    }

    .imc-display {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        border-radius: 20px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(114, 118, 209, 0.3);
    }

    .form-section {
        background: white;
        border-radius: 30px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .form-label { 
        font-weight: 700; 
        color: #4a5568; 
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 15px;
        border: 2px solid #edf2f7;
        padding: 12px;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(114, 118, 209, 0.1);
    }

    .file-upload-wrapper {
        border: 2px dashed #cbd5e0;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        background: #f8fafc;
        transition: 0.3s;
    }

    .file-upload-wrapper:hover {
        border-color: var(--primary-color);
        background: #f0f4ff;
    }

    .btn-assign {
        background: var(--accent-green);
        color: white;
        border-radius: 18px;
        padding: 16px;
        font-weight: 700;
        border: none;
        transition: 0.4s;
        font-size: 1.1rem;
    }

    .btn-assign:hover {
        background: #059669;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
        color: white;
    }
</style>

<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('ver.ninos') }}" class="text-decoration-none text-muted fw-bold">
            <i class="bi bi-arrow-left me-2"></i> Volver al listado
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="profile-card text-center">
                <div class="avatar-large mb-3 mx-auto" style="width: 100px; height: 100px; background: #eef2ff; border-radius: 30px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-person-fill text-primary display-4"></i>
                </div>
                {{-- CORRECCIÓN: nombre y apellido en minúsculas --}}
                <h3 class="fw-bold mb-1 text-dark">{{ $nino['nombre'] ?? 'Sin nombre' }} {{ $nino['apellido'] ?? '' }}</h3>
                <span class="badge bg-light text-primary rounded-pill px-3 py-2 mb-3">Expediente Médico</span>

                <div class="imc-display my-4">
                    <small class="d-block opacity-75 text-uppercase fw-bold">IMC Calculado</small>
                    {{-- CORRECCIÓN: usamos imc_calculado que viene del controlador --}}
                    <h2 class="fw-bold mb-0" style="font-size: 3rem;">{{ $nino['imc_calculado'] ?? '0' }}</h2>
                    @php
                        $imc_val = $nino['imc_calculado'] ?? 0;
                        $msg = ($imc_val < 18.5) ? 'Bajo Peso' : (($imc_val > 24.9) ? 'Sobrepeso' : 'Normal');
                    @endphp
                    <span class="badge bg-white text-primary mt-2">{{ $msg }}</span>
                </div>

                <div class="row text-start g-3 mt-2">
                    <div class="col-6 border-end">
                        <small class="text-muted d-block text-uppercase" style="font-size: 0.7rem;">Peso</small>
                        {{-- CORRECCIÓN: peso en minúscula --}}
                        <strong class="fs-5">{{ $nino['peso'] ?? '0' }} kg</strong>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block text-uppercase" style="font-size: 0.7rem;">Estatura</small>
                        {{-- CORRECCIÓN: estatura en minúscula --}}
                        <strong class="fs-5">{{ $nino['estatura'] ?? '0' }} cm</strong>
                    </div>
                    <div class="col-12 border-top pt-3">
                        <small class="text-muted d-block text-uppercase" style="font-size: 0.7rem;">Edad del Paciente</small>
                        {{-- CORRECCIÓN: edad en minúscula --}}
                        <strong class="fs-5">{{ $nino['edad'] ?? '0' }} años</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="form-section">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-success text-white p-3 rounded-4 me-3">
                        <i class="bi bi-journal-check fs-3"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0">Prescribir Plan Nutricional</h2>
                        <p class="text-muted mb-0">Diseña la dieta y recomendaciones para el niño.</p>
                    </div>
                </div>
                
                <form action="{{ route('nino.guardar_plan', $nino['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label">Título del Plan</label>
                        <input type="text" name="titulo_plan" class="form-control" placeholder="Ej: Control de sobrepeso infantil" required>
                    </div>

                    {{-- NUEVO: Campo para el detalle del plan con la sugerencia prellenada --}}
                    <div class="mb-4">
                        <label class="form-label">Detalle del Menú y Recomendaciones</label>
                        <textarea name="detalle_plan" class="form-control" rows="8" required>{{ $sugerencia ?? '' }}</textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Calorías Objetivo (Kcal)</label>
                            <div class="input-group">
                                <input type="number" name="calorias" class="form-control" placeholder="1500">
                                <span class="input-group-text bg-white">kcal</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Próxima Cita (Opcional)</label>
                            <input type="date" name="proxima_cita" class="form-control">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Material de Apoyo (Opcional)</label>
                        <div class="file-upload-wrapper">
                            <i class="bi bi-cloud-arrow-up display-6 text-muted mb-2 d-block"></i>
                            <p class="mb-2 fw-bold">Sube una guía en PDF o TXT</p>
                            <input type="file" name="archivo_adjunto" class="form-control" accept=".pdf,.txt">
                            <small class="text-muted d-block mt-2">Formatos permitidos: PDF y TXT (Máx. 5MB)</small>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-assign">
                            <i class="bi bi-send-fill me-2"></i> Guardar Plan y Notificar al Padre
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
@endsection