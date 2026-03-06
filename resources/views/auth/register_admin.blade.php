@extends('layouts.app')
@section('title', 'Alta de Administrador - Nutripeques')

@push('styles')
<style>
    :root{ 
        --admin-primary: #e67e22; 
        --admin-secondary: #f39c12; 
        --bg: #f3f3f8; 
        --card: #ffffff; 
    }
    body{ background: var(--bg); font-family: 'Quicksand', sans-serif; }
    .auth-wrap{ min-height: 90vh; display:flex; align-items:center; justify-content:center; padding: 20px; }
    .auth-card{ border-radius:30px; box-shadow: 0 12px 30px rgba(0,0,0,0.1); background: var(--card); width:100%; max-width:550px; overflow: hidden; border: 2px solid white; }
    .auth-header{ background: linear-gradient(135deg, var(--admin-primary), var(--admin-secondary)); color:#fff; padding:25px; font-weight:bold; text-align:center; font-size: 1.5rem; }
    .auth-body{ padding:40px; }
    .form-label { font-weight: 700; color: #555; margin-bottom: 8px; display: block; }
    .form-control{ border-radius:15px; padding:12px; margin-bottom:20px; border: 1px solid #ddd; width:100%; transition: all 0.3s; }
    .form-control:focus { border-color: var(--admin-primary); box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25); outline: none; }
    .btn-admin{ background: var(--admin-primary); border:0; border-radius:15px; padding:15px; width:100%; color:white; font-weight:bold; font-size: 1.1rem; transition: 0.3s; }
    .btn-admin:hover { background: var(--admin-secondary); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(230, 126, 34, 0.3); }
    .back-link { display: block; text-align: center; margin-top: 20px; color: #777; text-decoration: none; font-weight: 600; }
    .back-link:hover { color: var(--admin-primary); }
</style>
@endpush

@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-header">
            <i class="bi bi-shield-lock-fill"></i> Nuevo Administrador
        </div>
        <div class="auth-body">

            @if(session('error'))
                <div class="alert alert-danger" style="border-radius: 15px;">
                    {{ session('error') }}
                </div>
            @endif

 <form method="POST" action="{{ route('guardar.admin') }}">
    @csrf

    <input type="hidden" name="rol" value="admin">

    <div class="row">
        <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" placeholder="Ej. Juan" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Apellido</label>
            <input type="text" name="last_name" class="form-control" placeholder="Ej. Perez" required>
        </div>
    </div>

    <label class="form-label">Correo Electrónico Administrador</label>
    <input type="email" name="email" class="form-control" placeholder="admin@nutripeques.com" required>

    <label class="form-label">Contraseña de Acceso</label>
    <input type="password" name="password" class="form-control" placeholder="••••••••" required>

    <button type="submit" class="btn-admin mt-2">
        Dar de Alta Administrador
    </button>
</form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection