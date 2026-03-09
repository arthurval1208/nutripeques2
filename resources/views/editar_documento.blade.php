<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Editar Registro - Nutripeques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; background: #e3f2fd; padding-top: 50px; }
        .edit-container {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 40px;
            border: 2px solid white;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            max-width: 600px;
            margin: auto;
        }
        .form-control { border-radius: 15px; padding: 12px; border: 2px solid #eee; }
        .btn-update { background: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%); color: white; border-radius: 15px; font-weight: 700; border: none; }
    </style>
</head>
<body>

<div class="container">
    <div class="edit-container">
        <div class="d-flex align-items-center mb-4">
            <a href="javascript:history.back()" class="text-decoration-none me-3" style="font-size: 1.5rem; color: #7276d1;">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
            <h2 class="fw-bold mb-0">Editar {{ ucfirst(substr($documento['coleccion'], 0, -1)) }}</h2>
        </div>

        <form action="{{ url('/actualizar-firebase/'.$documento['coleccion'].'/'.$documento['id']) }}" method="POST">
            @csrf @method('PUT')

            @foreach($documento as $campo => $valor)
                @if($campo != 'id' && $campo != 'coleccion')
                <div class="mb-3">
                    <label class="form-label fw-bold text-muted">{{ ucfirst($campo) }}</label>
                    @if($campo == 'descripcion' || $campo == 'Mensaje')
                        <textarea name="{{ $campo }}" class="form-control" rows="4">{{ $valor }}</textarea>
                    @else
                        <input type="{{ $campo == 'precio' ? 'number' : 'text' }}" 
                               name="{{ $campo }}" 
                               class="form-control" 
                               value="{{ $valor }}" required>
                    @endif
                </div>
                @endif
            @endforeach

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-update btn-lg">
                    <i class="bi bi-cloud-upload me-2"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
