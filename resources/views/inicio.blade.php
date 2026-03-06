@extends("layouts.master")
@section('title', 'Inicio - Nutripeques')

@section("content") 
<style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700;800&display=swap');

    :root {
        --primary-purple: #7b7fd4;
        --primary-soft: #f0f4f9;
        --accent-pink: #ff9a9e;
        --bg-main: #f4f7fe;
        --card-bg: #ffffff;
        --soft-cyan-bg: #dff0f6;
        
        --logo-red: #ff786e;
        --logo-green: #aec982;
        --logo-pink: #ffadd1;
        --logo-yellow: #f4be5d;
        --logo-blue: #b3caff;
    }

    body {
        background-color: var(--bg-main);
        font-family: 'Quicksand', sans-serif;
        color: #4a4a4a;
    }

    .main-wrapper {
        padding: 40px 20px;
        max-width: 1300px;
        margin: 0 auto;
    }

    /* BARRA SUPERIOR */
    .user-top-bar {
        background: white;
        border-radius: 30px;
        padding: 15px 35px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 35px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    /* BOTÓN REGRESAR */
    .btn-back {
        background: var(--primary-soft);
        color: var(--primary-purple);
        border: none;
        padding: 10px 20px;
        border-radius: 15px;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: 0.3s;
    }
    .btn-back:hover {
        background: var(--primary-purple);
        color: white;
        transform: translateX(-5px);
    }

    .logo-container { user-select: none; line-height: 1; }
    .logo-nutri { font-weight: 800; font-size: 26px; color: #333; }
    .logo-peques { font-size: 22px; font-weight: 800; display: flex; gap: 2px; }
    .logo-peques span:nth-child(1) { color: var(--logo-red); }
    .logo-peques span:nth-child(2) { color: var(--logo-green); }
    .logo-peques span:nth-child(3) { color: var(--logo-pink); }
    .logo-peques span:nth-child(4) { color: var(--logo-yellow); }
    .logo-peques span:nth-child(5) { color: var(--logo-blue); }
    .logo-peques span:nth-child(6) { color: var(--logo-red); }

    /* PANEL CENTRAL */
    .kcal-panel {
        background: var(--soft-cyan-bg);
        border-radius: 60px;
        padding: 60px 40px;
        text-align: center;
        border: 12px solid white;
        box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        height: 100%;
    }

    .kcal-number { font-size: 7rem; font-weight: 800; color: #2d3436; line-height: 1; margin: 10px 0; }

    /* WIDGETS */
    .widget-card {
        background: white;
        border-radius: 35px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .day-pill {
        background: white;
        border-radius: 20px;
        padding: 10px;
        width: 65px;
        text-align: center;
        font-weight: 700;
        box-shadow: 0 5px 15px rgba(0,0,0,0.02);
    }
    .day-pill.active {
        background: var(--accent-pink);
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(255, 154, 158, 0.3);
    }

    .water-glass {
        width: 25px;
        height: 35px;
        border: 2px solid #ced6e0;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    .water-glass.filled {
        background: #81d4fa;
        border-color: #81d4fa;
    }

    .btn-action {
        background: white;
        border: 2px solid var(--primary-soft);
        border-radius: 18px;
        padding: 10px 25px;
        font-weight: 700;
        color: var(--primary-purple);
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
    }
    .btn-action:hover { background: var(--primary-purple); color: white; }
</style>

<div class="main-wrapper">
    <header class="user-top-bar">
        <div class="d-flex align-items-center gap-4">
            <a href="{{ url('/panel-usuario') }}" class="btn-back">
                <i class="bi bi-arrow-left-short" style="font-size: 1.5rem;"></i>
                <span>Panel</span>
            </a>
            <div class="logo-container d-none d-lg-block">
                <div class="logo-nutri">Nutri</div>
                <div class="logo-peques">
                    <span>P</span><span>e</span><span>q</span><span>u</span><span>e</span><span>s</span>
                </div>
            </div>
        </div>
        
        <div class="d-flex align-items-center gap-3">
            <div class="text-end d-none d-sm-block">
                <span class="fw-bold d-block">Hola, {{ session('usuario') }}</span>
                <small class="text-muted">Plan Infantil v1.2</small>
            </div>
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                <i class="bi bi-person-fill" style="font-size: 1.2rem;"></i>
            </div>
        </div>
    </header>

    <div class="d-flex justify-content-center gap-3 mb-5">
        <div class="day-pill">J 13</div>
        <div class="day-pill active">V 14</div>
        <div class="day-pill">S 15</div>
        <div class="day-pill">D 16</div>
        <div class="day-pill">L 17</div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="kcal-panel">
                <span class="badge bg-white text-dark rounded-pill px-4 py-2 mb-4 shadow-sm fw-bold">RESUMEN DIARIO</span>
                <h1 class="kcal-number">1,035</h1>
                <p class="text-muted fw-bold text-uppercase" style="letter-spacing: 2px;">Kilocalorías</p>

                <div class="mt-5">
                    <svg width="200" height="50" viewBox="0 0 100 20">
                        <path d="M10,15 Q50,0 90,15" stroke="#ced6e0" stroke-width="2" fill="none" />
                        <circle cx="68" cy="8" r="4" fill="var(--primary-purple)" />
                    </svg>
                    <div class="fw-bold mt-2">1,050 Meta Diaria</div>
                </div>

                <div class="row mt-5 g-3">
                    <div class="col-6">
                        <div class="bg-white p-4 rounded-4 shadow-sm text-start">
                            <span class="small fw-bold text-muted d-block mb-2">PROTEÍNAS</span>
                            <div class="progress" style="height: 10px; border-radius: 10px;">
                                <div class="progress-bar" style="width: 45%; background: var(--logo-green);"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-white p-4 rounded-4 shadow-sm text-start">
                            <span class="small fw-bold text-muted d-block mb-2">GRASAS</span>
                            <div class="progress" style="height: 10px; border-radius: 10px;">
                                <div class="progress-bar" style="width: 30%; background: var(--logo-red);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="widget-card text-center">
                <h6 class="fw-bold mb-4">HIDRATACIÓN</h6>
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <div class="water-glass filled"></div>
                    <div class="water-glass filled"></div>
                    <div class="water-glass filled"></div>
                    <div class="water-glass"></div>
                    <div class="water-glass"></div>
                    <div class="water-glass"></div>
                </div>
                <p class="small text-muted mb-0">3 de 6 vasos hoy</p>
            </div>

            <div class="widget-card">
                <div class="icon-circle" style="width: 45px; height: 45px; border-radius: 50%; background: var(--primary-soft); color: var(--primary-purple); display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                    <i class="bi bi-egg-fried"></i>
                </div>
                <h5 class="fw-bold">Cena Recomendada</h5>
                <p class="text-muted small">Tortilla de vegetales con aguacate.</p>
                <a href="#" class="btn-action w-100 text-center">Ver Receta</a>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection