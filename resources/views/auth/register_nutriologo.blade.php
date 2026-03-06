@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow border-0 mx-auto" style="max-width: 550px; border-radius: 30px;">
        <div class="card-body p-5">
            <h3 class="text-center mb-4 font-weight-bold" style="color: #7276d1;">Nuevo Especialista</h3>
            
            <form method="POST" action="{{ route('guardar.nutriologo') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nombre(s)</label>
                    <input type="text" name="nombre" class="form-control" style="border-radius: 12px;" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Apellido(s)</label>
                    <input type="text" name="apellido" class="form-control" style="border-radius: 12px;" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="correo" class="form-control" style="border-radius: 12px;" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Campo / Especialidad</label>
                    <input type="text" name="campo" class="form-control" placeholder="Ej: Nutrición Infantil" style="border-radius: 12px;" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Contraseña Temporal</label>
                    <input type="password" name="contraseña" class="form-control" style="border-radius: 12px;" required>
                </div>

                <button type="submit" class="btn w-100 p-3 text-white font-weight-bold" style="background: #7276d1; border-radius: 15px; box-shadow: 0 5px 15px rgba(114, 118, 209, 0.3);">
                    Registrar en Sistema <i class="bi bi-person-check-fill ms-2"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection