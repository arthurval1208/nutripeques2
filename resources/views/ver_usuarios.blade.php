<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Clientes - Nutripeques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root { 
            --purple-gradient: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%); 
            --soft-blue: #f3f3f8; 
        }

        body { 
            font-family: 'Quicksand', sans-serif; 
            background-color: var(--soft-blue); 
        }

        .navbar { background: var(--purple-gradient) !important; }

        .navbar-brand img { height:35px; border-radius:8px; }

        .glass-container { 
            background: rgba(255, 255, 255, 0.7); 
            backdrop-filter: blur(10px); 
            border: 2px solid white; 
            border-radius: 40px; 
            padding: 40px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.05); 
            margin-top: 20px; 
        }

        .btn-back-link { 
            color: #7276d1; 
            font-size: 1.8rem; 
            transition: 0.3s; 
            text-decoration: none; 
            display: inline-flex; 
            align-items: center; 
        }

        .btn-back-link:hover { transform: translateX(-5px); }

        .btn-new-user {
            background: var(--purple-gradient);
            color: white;
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }

        .btn-new-user:hover {
            transform: scale(1.05);
            color: white;
        }

        .table { border-collapse: separate; border-spacing: 0 10px; }

        .table tbody tr { 
            background: white; 
            border-radius: 15px; 
            transition: 0.2s; 
            box-shadow: 0 5px 10px rgba(0,0,0,0.02); 
        }

        .table tbody tr:hover { transform: scale(1.01); }

        .table tbody td { 
            border: none; 
            padding: 20px; 
            vertical-align: middle; 
        }

        .table tbody tr td:first-child { border-radius: 15px 0 0 15px; }
        .table tbody tr td:last-child { border-radius: 0 15px 15px 0; }

        .btn-action { 
            width: 40px; 
            height: 40px; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 12px; 
            transition: 0.3s; 
            text-decoration: none; 
            border: none; 
        }

        .btn-edit { background-color: #fff3e0; color: #ff9800; }
        .btn-delete { background-color: #ffebee; color: #f44336; }

        .user-avatar { 
            width: 45px; 
            height: 45px; 
            background: #eee; 
            border-radius: 12px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-weight: bold; 
            color: #7276d1; 
            margin-right: 15px; 
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ url('/home') }}">
            <img src="{{ asset('imagenes/hala.png') }}" alt="logo" class="me-2"> Nutripeques
        </a>
        <div class="ms-auto text-white">
            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name ?? 'Arturo' }}
        </div>
    </div>
</nav>

<div class="container py-5">

    @if(session('status'))
        <div class="alert alert-success rounded-pill border-0 shadow-sm text-center mb-4">
            {{ session('status') }}
        </div>
    @endif

    <div class="glass-container">

        <!-- ENCABEZADO + BOTÓN NUEVO USUARIO -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <a href="{{ url('/home') }}" class="btn-back-link me-3">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </a>
                <div>
                    <h2 class="fw-bold mb-0">Clientes Registrados</h2>
                    <p class="text-muted mb-0">Gestión de usuarios en Firebase</p>
                </div>
            </div>

            <!-- BOTÓN NUEVO USUARIO -->
            <a href="{{ url('/crear-usuario') }}" class="btn btn-new-user">
                <i class="bi bi-plus-lg me-2"></i> Nuevo Usuario
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-muted small">
                        <th>FECHA REGISTRO</th>
                        <th>USUARIO</th>
                        <th>CORREO ELECTRÓNICO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $u)
                    <tr>
                        <td>{{ $u['fecha'] }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar">
                                    {{ substr($u['nombre'], 0, 1) }}
                                </div>
                                <strong>{{ $u['nombre'] }}</strong>
                            </div>
                        </td>
                        <td>{{ $u['email'] }}</td>
                        <td class="text-center">
                            <a href="{{ url('/editar-firebase/users/'.$u['id']) }}" 
                               class="btn-action btn-edit me-1" 
                               title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ url('/eliminar-firebase/users/'.$u['id']) }}" 
                                  method="POST" 
                                  class="d-inline" 
                                  onsubmit="return confirm('¿Eliminar cliente?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
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
