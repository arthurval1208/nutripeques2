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
            
            @if($errors->any())
                <div class="alert alert-danger" style="color:red; margin-bottom:15px;">
                    <ul class="mb-0">@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                </div>
            @endif

            {{-- USAMOS LA RUTA MANUAL QUE FUNCIONA EN TU NAVEGADOR --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="admin@nutripeques.com" required autofocus>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-primary">Entrar al Panel</button>

                <div class="mt-3 text-center">
                    <a href="http://localhost:81/dev/public/register" style="color:var(--primary); text-decoration:none;">Crear cuenta nueva</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection