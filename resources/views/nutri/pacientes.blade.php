@extends('layouts.app')
@section('content')
<div class="container py-4" style="max-width: 500px;">
    <a href="{{ route('panel.nutriologo') }}" class="text-dark fs-4 text-decoration-none"><i class="bi bi-arrow-left"></i></a>
    <h4 class="fw-bold mt-3 mb-4">Niños que ayudas</h4>
    
    @foreach(['Juan Pérez', 'María García', 'Luis Hernández'] as $niño)
    <div class="d-flex justify-content-between align-items-center bg-white p-3 mb-2 rounded-4 shadow-sm">
        <span class="fw-bold">{{ $niño }}</span>
        <a href="{{ route('nutri.plan') }}" class="btn btn-primary btn-sm rounded-pill px-3">Alimentos</a>
    </div>
    @endforeach
</div>
@endsection