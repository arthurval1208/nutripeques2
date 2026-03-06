@extends('layouts.app') {{-- ASEGÚRATE DE QUE EL NOMBRE SEA EL CORRECTO (app o master) --}}

@section('title', 'Contacto - Nutripeques')

@section('content')

<style>
    .contact-section {
        padding: 40px 0;
        min-height: 80vh;
    }

    .glass-box {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(15px);
        border: 2px solid white;
        border-radius: 35px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    }

    .contact-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .btn-back-custom {
        background: white;
        color: #7276d1;
        border-radius: 15px;
        padding: 8px 20px;
        text-decoration: none;
        font-weight: 700;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        transition: 0.3s;
    }

    .btn-back-custom:hover {
        background: #7276d1;
        color: white;
    }

    .form-label { font-weight: 700; color: #5a5eb1; margin-left: 5px; }

    .form-control, .form-select {
        border-radius: 15px;
        padding: 12px 20px;
        border: 2px solid #eee;
        background: white;
    }

    .form-control:focus {
        border-color: #7276d1;
        box-shadow: none;
    }

    .btn-enviar {
        background: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%);
        border: none;
        border-radius: 20px;
        padding: 15px;
        font-weight: 700;
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.3s;
    }

    .btn-enviar:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(114, 118, 209, 0.3);
    }
</style>

@php
    // Determinamos el regreso según el rol para que no se pierda el admin
    $urlRegreso = route('panel.usuario');
    if(session('rol') == 'admin') $urlRegreso = route('home');
    elseif(session('rol') == 'nutriologo') $urlRegreso = route('panel.nutriologo');
@endphp

<div class="contact-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-box">

                    <div class="contact-header">
                        <h2 class="fw-bold m-0" style="color: #333;">
                            <i class="bi bi-chat-dots-fill me-2" style="color: #7276d1;"></i>Contacto
                        </h2>
                        <a href="{{ $urlRegreso }}" class="btn-back-custom">
                            <i class="bi bi-arrow-left me-1"></i> Volver
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('guardar.contacto') }}">
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Nombre del tutor</label>
                                <input type="text" name="nombre" class="form-control" placeholder="Ej. Juan Pérez" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Correo electrónico</label>
                                <input type="email" name="correo" class="form-control" placeholder="correo@ejemplo.com" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Nivel de prioridad</label>
                                <select name="prioridad" class="form-select" required>
                                    <option value="" disabled selected>Selecciona la urgencia...</option>
                                    <option value="alta">Alta (Urgente)</option>
                                    <option value="media">Media</option>
                                    <option value="baja">Baja</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Asunto</label>
                                <input type="text" name="asunto" class="form-control" placeholder="¿En qué podemos ayudarte?" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Mensaje</label>
                                <textarea name="mensaje" rows="4" class="form-control" placeholder="Escribe tu mensaje aquí..." required></textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-enviar w-100">
                                    <i class="bi bi-send-fill me-2"></i> Enviar Mensaje
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection