<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Servicios Nutricionales - Nutripeques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --purple-gradient: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%); --soft-blue: #f3f3f8; }
        body { font-family: 'Quicksand', sans-serif; background-color: var(--soft-blue); }
        .navbar { background: var(--purple-gradient) !important; }
        .navbar-brand img { height:35px; border-radius:8px; }
        .glass-container { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 2px solid white; border-radius: 40px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); margin-top: 20px; }
        .btn-back-link { color: #7276d1; font-size: 1.8rem; text-decoration: none; }
        .table { border-collapse: separate; border-spacing: 0 10px; }
        .table tbody tr { background: white; border-radius: 15px; box-shadow: 0 5px 10px rgba(0,0,0,0.02); }
        .table tbody td { border: none; padding: 20px; vertical-align: middle; }
        .btn-action { width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; border-radius: 12px; text-decoration: none; transition: 0.3s; }
        .btn-edit { background-color: #fff3e0; color: #ff9800; }
        .btn-delete { background-color: #ffebee; color: #f44336; }
        .price-badge { background: #e8f5e9; color: #2e7d32; padding: 8px 15px; border-radius: 20px; font-weight: 700; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ url('/home') }}">
            <img src="{{ asset('imagenes/hala.png') }}" alt="logo" class="me-2"> Nutripeques
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="glass-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <a href="{{ url('/home') }}" class="btn-back-link me-3"><i class="bi bi-arrow-left-circle-fill"></i></a>
                <div>
                    <h2 class="fw-bold mb-0">Catálogo de Servicios</h2>
                    <p class="text-muted mb-0">Planes y programas nutricionales</p>
                </div>
            </div>
            <a href="{{ url('/crear-servicio') }}" class="btn btn-primary rounded-pill px-4" style="background: var(--purple-gradient); border:none;">
                <i class="bi bi-plus-lg me-2"></i> Nuevo Servicio
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-muted small">
                        <th>SERVICIO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>PRECIO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios as $s)
                    <tr>
                        <td><strong>{{ $s['nombre'] }}</strong></td>
                        <td class="text-muted">{{ Str::limit($s['desc'], 50) }}</td>
                        <td><span class="price-badge">${{ $s['precio'] }}</span></td>
                        <td class="text-center">
                            <a href="{{ url('/editar-firebase/servicios/'.$s['id']) }}" class="btn-action btn-edit me-1" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ url('/eliminar-firebase/servicios/'.$s['id']) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar servicio?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-delete"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>