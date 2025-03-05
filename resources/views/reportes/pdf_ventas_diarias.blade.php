<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas Diarias</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; margin: 20px; }
        h2 { text-align: center; }
        p { margin: 5px 0; font-size: 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #007bff; color: white; }
    </style>
</head>
<body>
    <h2>Reporte de Ventas Diarias ({{ now()->format('d/m/Y') }})</h2>
    <p><strong>Total de Ventas:</strong> {{ $totalVentas }}</p>
    <p><strong>Ingresos Totales:</strong> S/ {{ number_format($ingresosTotales, 2) }}</p>

    <table>
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Método de Pago</th>
                <th>Vendedor</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $venta->metodo_pago ?? 'N/A' }}</td>
                    <td>{{ $venta->usuario->name ?? 'N/A' }}</td>
                    <td>S/ {{ number_format($venta->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
