@extends("layouts.master")
@section('title', 'Inicio - Nutripeques')

@section("content") 
<style>

    .btn-back-link { 
        color: #7276d1; 
        font-size: 2.2rem; 
        text-decoration: none; 
        transition: transform 0.2s, color 0.2s;
        display: inline-block;
        line-height: 1;
    }

    .btn-back-link:hover { 
        transform: scale(1.1); 
        color: #5a5eb1; 
    }
    /* ====== VARIABLES Y BASES ====== */
    :root {
        --purple-gradient: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%);
        --soft-blue: #e3f2fd;
        --card-bg: rgba(201, 235, 242, 0.7);
        --accent-pink: #ff9a9e;
        --glass-white: rgba(255, 255, 255, 0.4);
        --dark-text: #444;
    }

    body {
        background-color: var(--soft-blue);
        background-image: radial-gradient(circle at 10% 20%, rgba(216, 241, 230, 0.46) 0.1%, rgba(233, 226, 226, 0.28) 90.1%);
        font-family: 'Quicksand', sans-serif;
        color: var(--dark-text);
    }

    /* ====== NAVBAR ESTILO FLOTANTE ====== */
    .navbar {
        background: var(--purple-gradient);
        margin: 15px 25px;
        border-radius: 20px;
        padding: 12px 30px;
        box-shadow: 0 10px 20px rgba(114, 118, 209, 0.3);
    }
    .navbar-brand { font-weight: 800; font-size: 1.5rem; color: white !important; }
    
    /* ====== CALENDARIO INTERACTIVO ====== */
    .day-pill {
        background: white;
        border-radius: 25px;
        padding: 12px;
        width: 70px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
        border: 2px solid transparent;
    }
    .day-pill.active {
        background: var(--accent-pink);
        color: white;
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(255, 154, 158, 0.4);
    }

    /* ====== TARJETA CENTRAL ====== */
    .main-card-style {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 2px solid white;
        border-radius: 60px;
        padding: 50px 40px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
    }

    .kcal-number {
        font-size: 5rem;
        font-weight: 900;
        color: #333;
        margin-bottom: 0;
    }

    /* ====== ELEMENTOS EXTRA (WIDGETS) ====== */
    .info-card {
        background: white;
        border-radius: 30px;
        padding: 25px;
        border: none;
        box-shadow: 0 10px 20px rgba(0,0,0,0.03);
        height: 100%;
        transition: transform 0.3s ease;
    }
    .info-card:hover { transform: translateY(-5px); }

    .icon-box {
        width: 50px;
        height: 50px;
        background: var(--soft-blue);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--purple-main);
        margin-bottom: 15px;
    }

    /* ====== TRACKER DE AGUA ====== */
    .glass-container { display: flex; justify-content: center; gap: 12px; }
    .glass-item {
        width: 32px;
        height: 45px;
        border: 2.5px solid #444;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        position: relative;
        overflow: hidden;
    }
    .glass-item.filled { background-color: #81d4fa; border-color: #81d4fa; }

    .btn-custom {
        background: white;
        border-radius: 15px;
        padding: 10px 25px;
        border: none;
        font-weight: 700;
        color: var(--purple-main);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* ====== FOOTER ====== */
    .footer {
        background: var(--purple-gradient);
        color: white;
        padding: 60px 0 30px;
        margin-top: 80px;
        border-radius: 80px 80px 0 0;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">Nutripeques</a>
        
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link text-white" href="#">Panel</a></li>
                <li class="nav-item ms-lg-3"><button class="btn-custom">Mi Perfil</button></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('panel.usuario') }}" class="btn-back-link me-3">
            <i class="bi bi-arrow-left-circle-fill"></i>
        </a>
    </div>

    <div class="d-flex justify-content-center gap-3 mb-5">
        <div class="day-pill">S 15</div>
        <div class="day-pill active">V 14</div>
        <div class="day-pill">D 16</div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="main-card-style text-center shadow-lg">
                <span class="badge rounded-pill bg-white text-dark px-3 py-2 mb-3 shadow-sm">RESUMEN DIARIO</span>
                <h1 class="kcal-number">1,035</h1>
                <p class="text-uppercase fw-bold ls-2" style="letter-spacing: 2px;">Kilocalorías</p>
                
                <div class="my-4">
                    <svg width="180" height="40" viewBox="0 0 100 20">
                        <path d="M10,15 Q50,0 90,15" stroke="#333" stroke-width="3" fill="none" />
                        <circle cx="50" cy="7" r="2.5" fill="#333" />
                    </svg>
                    <div class="small fw-bold">1,050 Meta</div>
                </div>

                <div class="row mt-5 g-4">
                    <div class="col-md-6 text-start">
                        <div class="p-4 bg-white rounded-4 shadow-sm">
                            <h6 class="fw-bold"><i class="bi bi-activity text-primary"></i> Carbohidratos</h6>
                            <div class="progress mt-2" style="height: 10px;">
                                <div class="progress-bar bg-primary" style="width: 20%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-start">
                        <div class="p-4 bg-white rounded-4 shadow-sm">
                            <h6 class="fw-bold"><i class="bi bi-droplet-fill text-danger"></i> Grasas</h6>
                            <div class="progress mt-2" style="height: 10px;">
                                <div class="progress-bar bg-danger" style="width: 10%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h6 class="fw-bold mb-3">HIDRATACIÓN</h6>
                    <div class="glass-container">
                        <div class="glass-item filled"></div>
                        <div class="glass-item filled"></div>
                        <div class="glass-item"></div>
                        <div class="glass-item"></div>
                        <div class="glass-item"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="info-card">
                        <div class="icon-box"><i class="bi bi-egg"></i></div>
                        <h5 class="fw-bold">Cena de Hoy</h5>
                        <p class="small text-muted">Tortilla de vegetales fresca.</p>
                        <button class="btn btn-sm btn-outline-primary rounded-pill">Receta</button>
                    </div>
                </div>
                <div class="col-12">
                    <div class="info-card">
                        <div class="icon-box"><i class="bi bi-lightning"></i></div>
                        <h5 class="fw-bold">Energía</h5>
                        <p class="small text-muted">Has completado tu meta matutina.</p>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 80%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-start">
                <h2 class="fw-bold">NUTRIPEQUES</h2>
                <p class="small opacity-75 mb-0">Nutrición inteligente para los más pequeños.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="small opacity-50 mb-0">© 2026 Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection