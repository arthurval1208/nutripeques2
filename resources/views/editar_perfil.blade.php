<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Editar Registro - Nutripeques</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #7276d1;
            --primary-dark: #5a5eb1;
            --accent: #f5c542;
            --glass: rgba(255, 255, 255, 0.85);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f0f4ff 0%, #d9e2ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .edit-card {
            background: var(--glass);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 35px;
            padding: 50px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.1);
            max-width: 700px;
            width: 100%;
            border: 2px solid rgba(255,255,255,0.7);
            position: relative;
        }

        /* Línea de diseño superior */
        .edit-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 30%;
            right: 30%;
            height: 5px;
            background: var(--primary);
            border-radius: 0 0 10px 10px;
        }

        .header-box {
            margin-bottom: 40px;
            text-align: center;
        }

        .back-btn-wrapper {
            position: absolute;
            top: 45px;
            left: 40px;
            width: 45px;
            height: 45px;
            background: white;
            color: var(--primary);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 8px 15px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .back-btn-wrapper:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        h2 {
            font-weight: 800;
            color: #1a202c;
            margin-top: 10px;
        }

        .form-label {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--primary-dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .form-control {
            border-radius: 18px;
            padding: 14px 22px;
            border: 2px solid transparent;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 10px 20px rgba(114, 118, 209, 0.1);
            transform: translateY(-2px);
        }

        .input-group-text {
            background: white;
            border: none;
            border-radius: 0 18px 18px 0;
            color: var(--primary);
            padding-right: 20px;
        }

        .btn-update {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 22px;
            font-weight: 700;
            border: none;
            padding: 18px;
            font-size: 1.1rem;
            box-shadow: 0 15px 30px rgba(114, 118, 209, 0.3);
            transition: 0.4s;
            margin-top: 20px;
        }

        .btn-update:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 40px rgba(114, 118, 209, 0.4);
            color: white;
        }

        .field-container {
            margin-bottom: 25px;
        }

        .badge-type {
            background: #e0e7ff;
            color: var(--primary);
            padding: 5px 12px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 700;
        }
    </style>
</head>

<body>

<div class="edit-card">
    <a href="javascript:history.back()" class="back-btn-wrapper">
        <i class="bi bi-chevron-left"></i>
    </a>

    <div class="header-box">
        <span class="badge-type">Edita tus datos</span>
        <h2>Editar {{ ucfirst(substr($documento['coleccion'], 0, -1)) }}</h2>
    </div>

    <form action="{{ url('/actualizar-firebase/'.$documento['coleccion'].'/'.$documento['id']) }}" method="POST">
        @csrf
        @method('PUT')

        @foreach($documento as $campo => $valor)
            @php
                // Traducción de nombres de campos a Español
                $nombresEspañol = [
                    'name'        => 'Nombre Completo',
                    'nombre'      => 'Nombre Completo',
                    'email'       => 'Correo Electrónico',
                    'password'    => 'Contraseña',
                    'contraseña'  => 'Contraseña',
                    'role'        => 'Rol de Usuario',
                    'rol'         => 'Rol de Usuario',
                    'age'         => 'Edad',
                    'edad'        => 'Edad',
                    'description' => 'Descripción',
                    'descripcion' => 'Descripción',
                    'price'       => 'Precio',
                    'precio'      => 'Precio',
                    'last_name'   => 'Apellidos',
                    'apellido'    => 'Apellidos',
                    'phone'       => 'Teléfono'
                ];

                $label = $nombresEspañol[strtolower($campo)] ?? ucfirst($campo);
            @endphp

            @if(
                $campo != 'id' &&
                $campo != 'coleccion' &&
                $campo != 'created_at' &&
                $campo != 'updated_at'
            )

            <div class="field-container">
                <label class="form-label">
                    <i class="bi bi-patch-check-fill me-2" style="font-size: 0.8rem; opacity: 0.7;"></i>
                    {{ $label }}
                </label>

                {{-- Textarea --}}
                @if(strtolower($campo) == 'descripcion' || strtolower($campo) == 'mensaje' || strtolower($campo) == 'description')
                    <textarea name="{{ $campo }}" class="form-control" rows="4">{{ $valor }}</textarea>

                {{-- Contraseña --}}
                @elseif(strtolower($campo) == 'password' || strtolower($campo) == 'contraseña')
                    <div class="input-group">
                        <input type="password" name="{{ $campo }}" id="passInput" class="form-control" value="{{ $valor }}" required>
                        <span class="input-group-text" onclick="togglePass()">
                            <i class="bi bi-eye-fill" id="toggleIcon"></i>
                        </span>
                    </div>

                {{-- Números --}}
                @elseif(in_array(strtolower($campo), ['precio', 'edad', 'peso', 'price', 'age']))
                    <input type="number" name="{{ $campo }}" class="form-control" value="{{ $valor }}" required>

                {{-- Texto normal --}}
                @else
                    <input type="text" name="{{ $campo }}" class="form-control" value="{{ $valor }}" required>
                @endif
            </div>
            @endif
        @endforeach

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-update">
                <i class="bi bi-arrow-repeat me-2"></i> Guardar
            </button>
        </div>
    </form>
</div>

<script>
    function togglePass() {
        const passInput = document.getElementById('passInput');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passInput.type === "password") {
            passInput.type = "text";
            toggleIcon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
        } else {
            passInput.type = "password";
            toggleIcon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
        }
    }
</script>

</body>
</html>