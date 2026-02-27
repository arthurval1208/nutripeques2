@extends('layouts.app')

@section('content')

<style>
    /* ====== VARIABLES NUTRI ====== */
    :root {
        --purple-gradient: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%);
        --soft-blue: #e3f2fd;
        --card-bg: rgba(255, 255, 255, 0.6);
        --accent-pink: #ff9a9e;
        --dark-text: #444;
    }

    body {
        background-color: var(--soft-blue);
        background-image: radial-gradient(circle at 10% 20%, rgba(216, 241, 230, 0.46) 0.1%, rgba(233, 226, 226, 0.28) 90.1%);
        font-family: 'Quicksand', sans-serif;
        color: var(--dark-text);
        min-height: 100vh;
    }

    .profile-container {
        max-width: 700px;
        margin: 60px auto;
    }

    .profile-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 2px solid white;
        border-radius: 30px;
        padding: 40px;
        box-shadow: 0 15px 30px rgba(114, 118, 209, 0.1);
    }

    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .profile-header h1 {
        font-weight: 800;
        font-size: 2rem;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
        border: 4px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .form-control {
        border-radius: 15px;
        padding: 10px 15px;
    }

    .btn-primary-custom {
        background: var(--purple-gradient);
        border: none;
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 600;
        transition: 0.3s ease;
        color: white;
    }

    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(114, 118, 209, 0.3);
    }

    .profile-footer {
        text-align: center;
        margin-top: 20px;
        opacity: 0.6;
        font-size: 0.9rem;
    }
</style>

<div class="profile-container">
    <div class="profile-card">

        <div class="profile-header">
            <img src="{{ asset('images/default-user.png') }}" class="profile-avatar" alt="Avatar">
            <h1>Mi Perfil</h1>
            <p>{{ auth()->user()->email ?? 'usuario@email.com' }}</p>
        </div>

        <form method="POST" action="#">
            @csrf

            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" 
                       class="form-control" 
                       value="{{ auth()->user()->name ?? '' }}">
            </div>

            <div class="mb-3">
                <label>Nueva contraseña</label>
                <input type="password" 
                       class="form-control" 
                       placeholder="********">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary-custom">
                    Actualizar Perfil
                </button>
            </div>
        </form>

        <div class="profile-footer">
            NutriPeques © {{ date('Y') }}
        </div>

    </div>
</div>
@endsection