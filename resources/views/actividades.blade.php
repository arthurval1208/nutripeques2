<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actividades Saludables - Nutripeques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root { --purple-gradient: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%); --soft-blue: #f3f3f8; }
        body { font-family: 'Quicksand', sans-serif; background-color: var(--soft-blue); }
        .navbar { background: var(--purple-gradient) !important; }
        .navbar-brand img { height:35px; border-radius:8px; }
        .glass-container { 
            background: rgba(255, 255, 255, 0.75); 
            backdrop-filter: blur(10px); 
            border: 2px solid white; 
            border-radius: 40px; 
            padding: 40px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.05); 
            margin-top: 20px; 
        }
        .btn-back-link { color: #7276d1; font-size: 1.8rem; text-decoration: none; }
        .section-title { color: #5a5eb1; font-weight: 700; margin-top: 25px; }
        ul { padding-left: 20px; }
        li { margin-bottom: 8px; }
        .highlight-box {
            background: #f3f0ff;
            border-radius: 20px;
            padding: 20px;
            margin-top: 20px;
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
            <a href="{{ url('/panel-usuario') }}" class="btn-back-link me-3">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-0">Actividades Saludables Recomendadas</h2>
            </div>
        </div>

        <div class="highlight-box">
            <h4 class="fw-bold">Actividad 1: Caminar al Aire Libre</h4>
            <p class="mb-0">Caminar 30 minutos al aire libre todos los días ayuda a mejorar la salud cardiovascular y reduce el estrés. Asegúrate de hacerlo en un lugar tranquilo, como el parque o un sendero natural.</p>
        </div>

        <div class="highlight-box">
            <h4 class="fw-bold">Actividad 2: Yoga y Estiramientos</h4>
            <p class="mb-0">El yoga es una excelente actividad para mantener la flexibilidad, fortalecer los músculos y mejorar la postura. A lo largo de la semana, realiza una sesión de yoga o estiramientos para liberar tensiones.</p>
        </div>

        <div class="highlight-box">
            <h4 class="fw-bold">Actividad 3: Ejercicio en Casa</h4>
            <p class="mb-0">Realizar ejercicios como abdominales, flexiones o saltos en casa puede ser una forma efectiva de mantenerte en forma sin necesidad de equipos. Dedica unos minutos diarios a entrenar.</p>
        </div>

        <div class="highlight-box">
            <h4 class="fw-bold">Actividad 4: Bailar</h4>
            <p class="mb-0">Bailar es una forma divertida y energética de ejercitarse. Puedes bailar música alegre en tu casa para mejorar el estado de ánimo y quemar calorías al mismo tiempo.</p>
        </div>

        <!-- Agrega más actividades aquí según sea necesario -->

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>