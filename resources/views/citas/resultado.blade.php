<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Cita</title>
    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, Noto Sans, Helvetica, Arial, sans-serif; margin: 2rem; color: #222; }
        .card { max-width: 760px; margin: auto; border: 1px solid #ddd; border-radius: 8px; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,.06); }
        h1 { margin-top: 0; font-size: 1.4rem; }
        .muted { color: #666; font-size: .9rem; }
        pre { white-space: pre-wrap; background: #f8f8f8; padding: 1rem; border-radius: 6px; }
    </style>
    </head>
<body>
    <div class="card">
        <h1>Resultado de la consulta</h1>
        <p class="muted">Cita #{{ $cita->id }} — Estado: {{ $cita->estado }}</p>
        <p>
            Paciente: <strong>{{ $cita->paciente->nombre ?? 'N/D' }}</strong><br>
            Profesional: <strong>{{ $cita->empleado->nombre ?? 'N/D' }}</strong><br>
            Fecha: <strong>{{ optional($cita->fecha_hora_inicio)->format('Y-m-d H:i') }}</strong>
        </p>
        <h3>Resultado</h3>
        @if($cita->resultado)
            <pre>{{ $cita->resultado }}</pre>
        @else
            <p class="muted">Aún no hay un resultado cargado.</p>
        @endif
    </div>
</body>
</html>

