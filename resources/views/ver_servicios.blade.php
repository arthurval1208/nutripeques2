<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Planes Nutricionales - Nutripeques</title>
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
        .btn-view {
            background: var(--purple-gradient);
            color: white;
            border-radius: 20px;
            padding: 8px 20px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-view:hover {
            opacity: 0.9;
            color: white;
        }
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
        <div class="d-flex align-items-center mb-4">
            <a href="{{ url('/home') }}" class="btn-back-link me-3">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-0">Planes Nutricionales</h2>
                <p class="text-muted mb-0">Programas recomendados por rango de edad</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-muted small">
                        <th>RANGO DE EDAD</th>
                        <th>PLAN NUTRICIONAL</th>
                        <th>DESCRIPCIÓN</th>
                        <th class="text-center">VER</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td><strong>5 - 8 años</strong></td>
                        <td>Plan Infantil Inicial</td>
                        <td class="text-muted">
                            Programa enfocado en hábitos saludables y crecimiento adecuado.
                        </td>
                        <td class="text-center">
                            <a href="{{ url('/plan/5-8') }}" class="btn-view">
                                Ver Plan
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>9 - 11 años</strong></td>
                        <td>Plan Escolar Activo</td>
                        <td class="text-muted">
                            Optimización de energía y concentración durante etapa escolar.
                        </td>
                        <td class="text-center">
                            <a href="{{ url('/plan/9-11') }}" class="btn-view">
                                Ver Plan
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>12 - 15 años</strong></td>
                        <td>Plan Adolescente en Desarrollo</td>
                        <td class="text-muted">
                            Soporte nutricional en etapa de crecimiento acelerado.
                        </td>
                        <td class="text-center">
                            <a href="{{ url('/plan/12-15') }}" class="btn-view">
                                Ver Plan
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>15 - 18 años</strong></td>
                        <td>Plan Juvenil Integral</td>
                        <td class="text-muted">
                            Nutrición estratégica para rendimiento académico y deportivo.
                        </td>
                        <td class="text-center">
                            <a href="{{ url('/plan/15-18') }}" class="btn-view">
                                Ver Plan
                            </a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>