<div class="glass-box">
    @if($planEncontrado)
        <h2 class="fw-bold">{{ $planEncontrado['titulo'] }}</h2>
        <p class="text-muted">{{ $planEncontrado['detalle'] }}</p>
        
        <div class="alert alert-info">
            <i class="bi bi-calendar-event"></i> Próxima Cita: {{ $planEncontrado['cita'] }}
        </div>

        @if($planEncontrado['archivo'] && $planEncontrado['archivo'] != 'sin_archivo')
            <a href="{{ asset($planEncontrado['archivo']) }}" class="btn btn-primary p-3 w-100" download>
                <i class="bi bi-file-earmark-pdf-fill"></i> Descargar Plan Completo (PDF)
            </a>
        @endif
    @else
        <p class="text-center">Aún no se ha cargado un plan para este niño.</p>
    @endif
</div>