@extends('layouts.app')
@section('title', 'Iniciar sesión - Nutripeques')

@push('styles')
<style>
    :root{ --primary:#4e54c8; --primary-2:#6b73ff; --accent:#f5c542; --bg:#f3f3f8; --card:#ffffff; }
    body{ background: var(--bg); font-family: 'Poppins', sans-serif; }
    .auth-wrap{ min-height: 80vh; display:flex; align-items:center; justify-content:center; }
    .auth-card{ border:0; border-radius:18px; box-shadow: 0 12px 30px rgba(0,0,0,.12); background: var(--card); width: 100%; max-width: 450px; overflow:hidden; }
    .auth-header{ background: linear-gradient(135deg, var(--primary), var(--primary-2)); color:#fff; padding: 20px; text-align: center; font-weight: bold; }
    .auth-body{ padding: 30px; }
    .form-control{ border-radius:10px; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; width: 100%; }
    .btn-primary{ background: var(--primary); border:0; border-radius:10px; padding: 12px; width:100%; color:white; font-weight:bold; cursor:pointer; }
</style>
@endpush

@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-header">Iniciar Sesión</div>
        <div class="auth-body">

            @if(session('error'))
                <div style="color:red; margin-bottom:15px;">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ url('/procesar-login') }}">
                @csrf

                <label class="form-label fw-bold">Correo electrónico</label>
                <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com" required>

                <label class="form-label fw-bold">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>

                <button type="submit" class="btn-primary">Entrar al Panel</button>

                <div class="mt-3 text-center">
                    <a href="{{ url('/register') }}" style="color:var(--primary); text-decoration:none;">
                        Crear cuenta nueva
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection