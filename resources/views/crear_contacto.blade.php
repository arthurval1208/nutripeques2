@extends('layouts.master')

@section('title', 'Contacto - Nutripeques')

@section('content')
<style>
    /* ====== VARIABLES NUTRI ====== */
    :root {
        --purple-gradient: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%);
        --soft-blue: #e3f2fd;
        --card-bg: rgba(201, 235, 242, 0.7);
        --accent-pink: #ff9a9e;
        --dark-text: #444;
    }

    body {
        background-color: var(--soft-blue);
        background-image: radial-gradient(circle at 10% 20%, rgba(216, 241, 230, 0.46) 0.1%, rgba(233, 226, 226, 0.28) 90.1%);
        font-family: 'Quicksand', sans-serif;
        color: var(--dark-text);
    }

    /* ====== NAVBAR NUTRI ====== */
    .navbar {
        background: var(--purple-gradient);
        margin: 15px 25px;
        border-radius: 20px;
        padding: 12px 30px;
        box-shadow: 0 10px 20px rgba(114, 118, 209, 0.3);
    }
    .navbar-brand { font-weight: 800; font-size: 1.5rem; color: white !important; }
    .nav-link { color: rgba(255,255,255,0.9) !important; font-weight: 600; margin: 0 10px; }
    .nav-link:hover { color: var(--accent-pink) !important; }

    /* ====== CONTENEDOR DE CONTACTO (ESTILO CRISTAL) ====== */
    .contact-container {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 2px solid white;
        max-width: 850px;
        margin: 50px auto;
        padding: 50px;
        border-radius: 50px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
    }

    .contact-container h1 {
        text-align: center;
        color: #333;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .contact-header {
        text-align: center;
        color: #666;
        margin-bottom: 35px;
        font-size: 1.1rem;
    }

    /* ====== FORMULARIO ====== */
    .form-label { font-weight: 700; color: #555; margin-left: 5px; }
    .form-control {
        border-radius: 15px;
        border: 1px solid white;
        padding: 12px 20px;
        background: rgba(255,255,255,0.8);
    }
    .form-control:focus {
        background: white;
        box-shadow: 0 0 15px rgba(114, 118, 209, 0.2);
        border-color: #7276d1;
    }

    .btn-enviar {
        background: var(--purple-gradient);
        color: white;
        border: none;
        border-radius: 20px;
        padding: 15px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(114, 118, 209, 0.3);
    }
    .btn-enviar:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(114, 118, 209, 0.4);
        color: white;
    }

    /* ====== FOOTER NUTRI ====== */
    .footer {
        background: var(--purple-gradient);
        color: white;
        padding: 60px 0 30px;
        margin-top: 80px;
        border-radius: 60px 60px 0 0;
    }
    .footer h5 { font-weight: 800; margin-bottom: 20px; }
    .footer-links { list-style: none; padding: 0; }
    .footer-links li { margin-bottom: 10px; }
    .footer-links a { color: rgba(255,255,255,0.8); text-decoration: none; transition: 0.3s; }
    .footer-links a:hover { color: white; padding-left: 5px; }
</style>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Nutripeques</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Panel</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Dietas</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Progreso</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="contact-container">
        <h1>¡Hola! Escríbenos</h1>
        <p class="contact-header">
            Nuestro equipo de nutricionistas está listo para ayudarte.
        </p>

        {{-- Alertas de éxito o error --}}
        @if(session('success'))
            <div class="alert alert-success" style="border-radius: 20px;">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" style="border-radius: 20px;">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('guardar-contacto') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre del tutor</label>
                    <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Ej: María García" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input class="form-control" type="email" id="email" name="correo" placeholder="ejemplo@correo.com" required>
                </div>

                <div class="col-md-12">
                    <label for="prioridad" class="form-label">¿Qué tan urgente es tu duda?</label>
                    <select class="form-control" name="prioridad" id="prioridad" required>
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="alta">Muy urgente</option>
                        <option value="media">Consulta normal</option>
                        <option value="baja">Sugerencia o comentario</option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="asunto" class="form-label">Asunto</label>
                    <input class="form-control" id="asunto" name="asunto" type="text" placeholder="¿Sobre qué quieres hablar?" required>
                </div>

                <div class="col-12">
                    <label for="mensaje" class="form-label">Mensaje</label>
                    <textarea class="form-control" name="mensaje" id="mensaje" rows="4" placeholder="Cuéntanos cómo podemos ayudarte..." required></textarea>
                </div>

                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-enviar w-100">Enviar Mensaje a Nutripeques</button>
                </div>
            </div>
        </form>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <h5>NUTRIPEQUES</h5>
                <p class="opacity-75">Cuidando el crecimiento y la salud de los que más quieres.</p>
            </div>
            <div class="col-md-3 ms-auto text-center">
                <h5>Contacto</h5>
                <ul class="footer-links">
                    <li><a href="#"><i class="bi bi-instagram me-2"></i>Instagram</a></li>
                    <li><a href="#"><i class="bi bi-whatsapp me-2"></i>WhatsApp</a></li>
                </ul>
            </div>
        </div>
        <hr class="mt-5 opacity-25">
        <div class="text-center mt-4 small opacity-50">
            © 2026 Nutripeques — Especialistas en Nutrición Infantil.
        </div>
    </div>
</footer>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection