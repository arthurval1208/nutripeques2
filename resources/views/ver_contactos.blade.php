<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mensajes - Nutripeques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --purple-gradient: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%); --soft-blue: #f8f9ff; }
        body { font-family: 'Quicksand', sans-serif; background-color: var(--soft-blue); }
        .navbar { background: var(--purple-gradient) !important; }
        .navbar-brand img { height:35px; border-radius:8px; }
        .glass-container { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 2px solid white; border-radius: 40px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); margin-top: 20px; }
        .btn-back-link { color: #7276d1; font-size: 1.8rem; transition: 0.3s; text-decoration: none; }
        .custom-table { border-collapse: separate; border-spacing: 0 15px; width: 100%; }
        .custom-table thead th { border: none; color: #7276d1; text-transform: uppercase; font-size: 0.75rem; font-weight: 700; padding: 0 25px; }
        .custom-table tbody tr { background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-radius: 20px; transition: 0.3s; }
        .custom-table tbody tr.done { opacity: 0.6; filter: grayscale(0.5); }
        .custom-table tbody td { padding: 25px; border: none; vertical-align: middle; }
        .custom-table tbody tr td:first-child { border-radius: 20px 0 0 20px; }
        .custom-table tbody tr td:last-child { border-radius: 0 20px 20px 0; }
        .btn-action { width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; border-radius: 12px; border: none; }
        .btn-done { background-color: #e8f5e9; color: #4caf50; }
        .btn-delete { background-color: #ffebee; color: #f44336; }
        .msg-text { font-size: 0.9rem; color: #777; line-height: 1.4; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ url('/home') }}">
            <img src="{{ asset('imagenes/hala.png') }}" alt="logo" class="me-2"> Nutripeques
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-2"></i> {{ Auth::user()->name ?? 'Arturo' }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end p-2 border-0 shadow">
                        <a class="dropdown-item rounded-3" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid px-5 py-5">
    <div class="glass-container">
        <div class="d-flex align-items-center mb-5">
            <a href="{{ url('/home') }}" class="btn-back-link me-3"><i class="bi bi-arrow-left-circle-fill"></i></a>
            <h2 class="fw-bold mb-0">Bandeja de Entrada</h2>
        </div>

        <table class="custom-table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Remitente</th>
                    <th>Asunto / Mensaje</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contactos as $c)
                <tr class="{{ $c['estado'] == 'Finalizado' ? 'done' : '' }}">
                    <td><small class="text-muted">{{ $c['fecha'] }}</small></td>
                    <td><strong>{{ $c['nombre'] }}</strong></td>
                    <td style="max-width: 400px;">
                        <span class="text-primary fw-600">{{ $c['asunto'] }}</span>
                        <p class="msg-text mb-0 mt-1">{{ $c['mensaje'] }}</p>
                    </td>
                    <td>
                        @if($c['estado'] == 'Finalizado')
                            <span class="badge bg-success rounded-pill px-3">Finalizado</span>
                        @else
                            <span class="badge bg-warning text-dark rounded-pill px-3">Pendiente</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            @if($c['estado'] != 'Finalizado')
                            <a href="{{ url('/estado-contacto/'.$c['id'].'/Finalizado') }}" class="btn-action btn-done" title="Marcar como Finalizado">
                                <i class="bi bi-check-lg"></i>
                            </a>
                            @endif
                            <form action="{{ url('/eliminar-firebase/contacts/'.$c['id']) }}" method="POST" onsubmit="return confirm('¿Borrar?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-delete"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>