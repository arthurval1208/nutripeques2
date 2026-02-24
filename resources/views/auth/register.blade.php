@extends('layouts.app')
@section('title', 'Crear cuenta - Nutripeques')
@push('styles')
<style>
    :root{ --primary:#4e54c8; --primary-2:#6b73ff; --accent:#f5c542; --rose:#b04a63; --bg:#f3f3f8; --card:#ffffff; --nav-h:64px; }
    body{ background: var(--bg); font-family: 'Poppins', sans-serif; }
    .auth-wrap{ min-height: calc(100vh - var(--nav-h)); display:flex; align-items:center; justify-content:center; padding: 20px 0; }
    .auth-card{ border:0; border-radius:18px; overflow:hidden; box-shadow: 0 12px 30px rgba(0,0,0,.12); background: var(--card); width: 100%; max-width: 820px; }
    .auth-header{ background: linear-gradient(135deg, var(--primary), var(--primary-2)); color:#fff; font-weight:700; padding: 18px 22px; }
    .auth-body{ padding: 28px 26px 26px; }
    .form-control{ border-radius:10px; border:1px solid #d9dbe9; padding: .65rem .9rem; }
    .btn-primary{ background: var(--primary); border:0; border-radius:10px; padding: .65rem 1.25rem; font-weight:700; color:white; }
</style>
@endpush

@section('content')
<div class="container auth-wrap">
    <div class="card auth-card">
        <div class="auth-header"><span>{{ __('Crear cuenta de Administrador') }}</span></div>
        <div class="auth-body">
            <form method="POST" action="{{ url('/register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Nombre Completo (Nombre y Apellido)</label>
                        <input type="text" name="name" class="form-control" placeholder="Ej: Arturo Perez" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="tucorreo@ejemplo.com" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repite tu contraseña" required>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between">
                    <button type="submit" class="btn btn-primary px-5">Registrarme</button>
                    <a href="{{ url('/login') }}" class="text-decoration-none fw-bold" style="color:var(--primary)">¿Ya tienes cuenta? Inicia sesión</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection