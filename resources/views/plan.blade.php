<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle del Plan - Nutripeques</title>
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
            <a href="{{ url('/ver-servicios') }}" class="btn-back-link me-3">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-0">Plan Alimenticio</h2>
                <p class="text-muted mb-0">Rango de edad: {{ $edad }} años</p>
            </div>
        </div>

        @php
            switch($edad) {

                case '5-8':
                    $titulo = "Plan Infantil Inicial";
                    $descripcion = "Enfocado en fortalecer el crecimiento y crear hábitos saludables desde temprana edad.";
                    $desayuno = "Avena con leche + banana en rodajas + huevo hervido.";
                    $media = "Yogurt natural con fresas.";
                    $almuerzo = "Arroz, pollo a la plancha, ensalada de zanahoria y jugo natural.";
                    $merienda = "Pan integral con queso fresco.";
                    $cena = "Crema de verduras + tortilla de huevo.";
                break;

                case '9-11':
                    $titulo = "Plan Escolar Activo";
                    $descripcion = "Optimiza energía y concentración durante actividades escolares.";
                    $desayuno = "Batido de leche con avena + tostadas integrales con aguacate.";
                    $media = "Manzana + puñado de nueces.";
                    $almuerzo = "Lentejas con arroz + carne magra + ensalada verde.";
                    $merienda = "Yogurt griego + granola.";
                    $cena = "Sandwich integral de pollo + jugo natural.";
                break;

                case '12-15':
                    $titulo = "Plan Adolescente en Desarrollo";
                    $descripcion = "Apoya el crecimiento acelerado y cambios hormonales.";
                    $desayuno = "Huevos revueltos + pan integral + batido de frutas.";
                    $media = "Fruta + yogurt alto en proteína.";
                    $almuerzo = "Pasta integral + carne o pescado + ensalada variada.";
                    $merienda = "Batido energético natural.";
                    $cena = "Ensalada completa con pollo o atún.";
                break;

                case '15-18':
                    $titulo = "Plan Juvenil Integral";
                    $descripcion = "Nutrición estratégica para rendimiento académico y deportivo.";
                    $desayuno = "Omelette + avena con frutas + leche.";
                    $media = "Barra de cereal saludable + fruta.";
                    $almuerzo = "Arroz integral + pollo o salmón + vegetales salteados.";
                    $merienda = "Yogurt griego + frutos secos.";
                    $cena = "Wrap integral de pollo + ensalada.";
                break;

                default:
                    $titulo = "Plan Nutricional";
                    $descripcion = "Plan general equilibrado.";
                    $desayuno = $media = $almuerzo = $merienda = $cena = "Información no disponible.";
            }
        @endphp

        <div class="highlight-box">
            <h4 class="fw-bold">{{ $titulo }}</h4>
            <p class="mb-0">{{ $descripcion }}</p>
        </div>

        <h5 class="section-title">Desayuno</h5>
        <p>{{ $desayuno }}</p>

        <h5 class="section-title">Media Mañana</h5>
        <p>{{ $media }}</p>

        <h5 class="section-title">Almuerzo</h5>
        <p>{{ $almuerzo }}</p>

        <h5 class="section-title">Merienda</h5>
        <p>{{ $merienda }}</p>

        <h5 class="section-title">Cena</h5>
        <p>{{ $cena }}</p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>