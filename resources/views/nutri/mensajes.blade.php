@extends('layouts.app')
@section('content')
<div class="container py-4" style="max-width: 500px;">
    <a href="{{ route('panel.nutriologo') }}" class="text-dark fs-4"><i class="bi bi-arrow-left"></i></a>
    <h4 class="fw-bold mt-3">Enviar Mensaje</h4>
    
    <div class="bg-white p-4 rounded-4 shadow-sm mt-3">
        <label class="fw-bold mb-2">Para: Padre de familia / Niño</label>
        <textarea class="form-control rounded-3 mb-3" rows="5" placeholder="Escribe aquí la retroalimentación..."></textarea>
        <button class="btn btn-primary w-100 rounded-pill p-2 fw-bold" style="background: #7276d1; border:none;">
            Enviar Notificación
        </button>
    </div>
</div>
@endsection