@extends('layouts.app')

@section('title', 'Gestión de Servicios - Nutripeques')

@section('content')
<style>
    /* ====== VARIABLES NUTRI ====== */
    :root {
        --purple-gradient: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%);
        --soft-blue: #e3f2fd;
        --card-bg: rgba(255, 255, 255, 0.7);
        --accent-pink: #ff9a9e;
    }

    body {
        background-color: var(--soft-blue);
        background-image: radial-gradient(circle at 10% 20%, rgba(216, 241, 230, 0.46) 0.1%, rgba(233, 226, 226, 0.28) 90.1%);
        font-family: 'Quicksand', sans-serif;
    }

    /* ====== CONTENEDOR TIPO CRISTAL ====== */
    .services-container {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 2px solid white;
        border-radius: 40px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        margin-top: 20px;
    }

    .header-section {
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-section h2 {
        font-weight: 800;
        color: #333;
        margin: 0;
    }

    /* ====== BOTÓN CREAR ====== */
    .btn-create {
        background: var(--purple-gradient);
        color: white;
        border-radius: 20px;
        padding: 12px 25px;
        font-weight: 700;
        border: none;
        box-shadow: 0 10px 20px rgba(114, 118, 209, 0.3);
        transition: 0.3s;
        text-decoration: none;
    }

    .btn-create:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(114, 118, 209, 0.4);
        color: white;
    }

    /* ====== ESTILO DE TABLA ====== */
    .table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .table thead th {
        border: none;
        color: #7276d1;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
        padding: 15px;
    }

    .table tbody tr {
        background: white;
        transition: transform 0.2s;
        box-shadow: 0 5px 10px rgba(0,0,0,0.02);
    }

    .table tbody tr:hover {
        transform: scale(1.01);
    }

    .table tbody td {
        border: none;
        padding: 20px 15px;
        vertical-align: middle;
        color: #555;
    }

    .table tbody tr td:first-child { border-radius: 15px 0 0 15px; font-weight: 700; color: #333; }
    .table tbody tr td:last-child { border-radius: 0 15px 15px 0; }

    /* ====== BOTONES DE ACCIÓN ====== */
    .btn-action {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        margin: 0 5px;
        transition: 0.3s;
        border: none;
    }

    .btn-edit { background-color: #fff3e0; color: #ff9800; }
    .btn-edit:hover { background-color: #ff9800; color: white; }

    .btn-delete { background-color: #ffebee; color: #f44336; }
    .btn-delete:hover { background-color: #f44336; color: white; }

    .service-icon {
        width: 45px;
        height: 45px;
        background: #f0f2f5;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: #7276d1;
        font-size: 1.2rem;
    }
</style>

<div class="container py-5">
    <div class="services-container">
        <div class="header-section">
            <div>
                <h2><i class="bi bi-grid-fill me-2" style="color: #7276d1;"></i> Nuestros Servicios</h2>
                <p class="text-muted mb-0">Gestiona los planes y programas nutricionales</p>
            </div>
            <a href="{{ route('servicios.create') }}" class="btn-create">
                <i class="bi bi-plus-lg me-2"></i> Nuevo Servicio
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicios as $servicio)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="service-icon">
                                    <i class="bi bi-stars"></i>
                                </div>
                                {{ $servicio->nombre }}
                            </div>
                        </td>
                        <td>{{ Str::limit($servicio->descripcion, 80) }}</td>
                        <td class="text-center">
                            <a href="{{ route('servicios.edit', $servicio) }}" class="btn-action btn-edit" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este servicio?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Eliminar">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(count($servicios) == 0)
            <div class="text-center py-5">
                <i class="bi bi-clipboard-x opacity-25" style="font-size: 4rem;"></i>
                <p class="mt-3 text-muted">Aún no has creado ningún servicio.</p>
                <a href="{{ route('servicios.create') }}" class="btn btn-link text-decoration-none" style="color: #7276d1;">Comenzar ahora</a>
            </div>
        @endif
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection