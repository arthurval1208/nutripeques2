@extends('layouts.app')
@section('title', 'Crear cuenta - Nutripeques')

@push('styles')
<style>
    :root{ --primary:#4e54c8; --primary-2:#6b73ff; --bg:#f3f3f8; --card:#ffffff; }
    body{ background: var(--bg); font-family: 'Poppins', sans-serif; }
    .auth-wrap{ min-height: 90vh; display:flex; align-items:center; justify-content:center; }
    .auth-card{ border-radius:18px; box-shadow: 0 12px 30px rgba(0,0,0,.12); background: var(--card); width:100%; max-width:600px; }
    .auth-header{ background: linear-gradient(135deg, var(--primary), var(--primary-2)); color:#fff; padding:20px; font-weight:bold; text-align:center; }
    .auth-body{ padding:30px; }
    .form-control{ border-radius:10px; padding:12px; margin-bottom:15px; border:1px solid #ddd; width:100%; }
    .btn-primary{ background: var(--primary); border:0; border-radius:10px; padding:12px; width:100%; color:white; font-weight:bold; }
</style>
@endpush

@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-header">Crear Cuenta</div>
        <div class="auth-body">

            @if(session('error'))
                <div style="color:red; margin-bottom:15px;">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/guardar-usuario') }}">
                @csrf

                <label>Nombre</label>
                <input type="text" name="name" class="form-control" required>

                <label>Apellido (solo usuario)</label>
                <input type="text" name="last_name" class="form-control">

                <label>Correo</label>
                <input type="email" name="email" class="form-control" required>

                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>

                <label>Tipo de cuenta</label>
                <select name="rol" class="form-control" required>
                    <option value="user">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>

                <button type="submit" class="btn-primary mt-3">
                    Registrarme
                </button>

                <div class="mt-3 text-center">
                    <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection