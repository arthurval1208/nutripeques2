@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow border-0 mx-auto" style="max-width: 750px; border-radius: 30px;">
        <div class="card-header bg-white border-0 pt-5 px-5">
            <h2 class="fw-bold" style="color: #7276d1;">
                <i class="bi bi-chat-dots-fill me-2"></i>Responder Consulta
            </h2>
            <hr class="opacity-10">
        </div>
        
        <div class="card-body px-5 pb-5">
            <div class="p-4 mb-4 rounded-4" style="background-color: #f8f9ff; border-left: 6px solid #7276d1;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold text-dark">De: {{ $consulta['nombre'] }}</span>
                    <span class="badge bg-white text-primary shadow-sm border">{{ $consulta['asunto'] }}</span>
                </div>
                <p class="text-muted mb-0" style="font-style: italic;">"{{ $consulta['mensaje'] }}"</p>
            </div>

            <form action="{{ route('mensaje.guardar', $consulta['id']) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold" style="color: #5a5eb1;">Escribe tu respuesta técnica:</label>
                    <textarea name="respuesta" 
                              class="form-control" 
                              rows="6" 
                              style="border-radius: 20px; border: 2px solid #eee; padding: 20px;" 
                              placeholder="Escribe aquí las recomendaciones..." 
                              required></textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-8">
                        <button type="submit" class="btn w-100 p-3 text-white fw-bold shadow-sm" style="background: #7276d1; border-radius: 15px;">
                            ENVIAR RESPUESTA Y FINALIZAR <i class="bi bi-send-check-fill ms-2"></i>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('ver.contactos') }}" class="btn btn-light w-100 p-3 fw-bold text-muted" style="border-radius: 15px;">
                            CANCELAR
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection