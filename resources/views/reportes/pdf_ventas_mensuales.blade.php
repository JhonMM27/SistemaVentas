<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas Mensuales</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #007bff; color: white; }
        .title { text-align: center; font-size: 20px; margin-bottom: 10px; }
        .summary { margin-top: 20px; font-size: 16px; }
    </style>
</head>
<body>
    <div class="title">Reporte de Ventas Mensuales ({{ str_pad($mes, 2, '0', STR_PAD_LEFT) }}/{{ $anio }})</div>

    <div class="summary">
        <p><strong>Total de Ventas:</strong> {{ $totalVentas }}</p>
        <p><strong>Ingresos Totales:</strong> S/ {{ number_format($ingresosTotales, 2) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Método de Pago</th>
                <th>Vendedor</th>
                <th>Productos Vendidos</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $venta->comprobante->metodo_pago ?? 'N/A' }}</td>
                    <td>{{ $venta->usuario->name ?? 'N/A' }}</td>
                    <td>
                        <ul>
                            @foreach ($venta->detalles as $detalle)
                                <li>{{ $detalle->producto->nombre ?? 'Producto eliminado' }} (x{{ $detalle->cantidad }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>S/ {{ number_format($venta->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
