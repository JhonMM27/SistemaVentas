<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Rendimiento de Empleados</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #333; color: white; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #555; }
    </style>
</head>
<body>

    <h2>Reporte de Rendimiento de Empleados</h2>
    <p><strong>Desde:</strong> {{ $fechaInicio }} | <strong>Hasta:</strong> {{ $fechaFin }}</p>

    <table>
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Total Ventas</th>
                <th>Ingresos Totales</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventasPorEmpleado as $empleado)
                <tr>
                    <td>{{ $empleado->empleado }}</td>
                    <td>{{ $empleado->total_ventas }}</td>
                    <td>S/ {{ number_format($empleado->ingresos_totales, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="footer">Generado automáticamente el {{ now()->format('d/m/Y H:i:s') }}</p>

</body>
</html>
