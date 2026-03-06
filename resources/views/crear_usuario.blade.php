<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro -  Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary: #4e54c8;
            --primary-2: #6b73ff;
            --bg: #f3f3f8;
            --card: #ffffff;
            --text: #2a2a2a;
        }

        body {
            background: var(--bg);
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 20px 0;
        }

        .auth-card {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0,0,0,.12);
            background: var(--card);
            width: 100%;
            max-width: 550px;
        }

        .auth-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #fff;
            font-weight: 700;
            padding: 25px;
            text-align: center;
            font-size: 1.4rem;
        }

        .auth-body {
            padding: 35px;
        }

        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #d9dbe9;
            padding: 10px 15px;
            transition: all 0.2s;
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .2rem rgba(78,84,200,.15);
        }

        .btn-firebase {
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-weight: 700;
            width: 100%;
            margin-top: 15px;
            transition: transform 0.2s;
            cursor: pointer;
        }

        .btn-firebase:hover {
            filter: brightness(1.1);
            transform: translateY(-2px);
            color: white;
        }

        .footer-text {
            text-align: center;
            margin-top: 25px;
            font-size: 0.8rem;
            color: #999;
        }
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="auth-header">
            <i class="bi bi-person-plus-fill me-2"></i> Nuevo Usuario
        </div>

        <div class="auth-body">
            <form action="{{ url('/guardar-usuario') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" placeholder="Ej: Juan" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Ej: Pérez" required>
                    </div>
                </div>

                <div class="mb-1">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="juan@ejemplo.com" required>
                </div>

                <div class="mb-1">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-firebase">
                    <i class="bi bi-shield-check me-2"></i> Crear Cuenta
                </button>
            </form>

            <div class="footer-text">
                © {{ date('Y') }} nutripeques
            </div>
        </div>
    </div>

</body>
</html>