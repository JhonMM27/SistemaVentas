<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas por Producto</title>
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
    <div class="title">Reporte de Ventas por Producto</div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad Vendida</th>
                <th>Total Generado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventasPorProducto as $venta)
                <tr>
                    <td>{{ $venta->nombre }}</td>
                    <td>{{ $venta->cantidad_vendida }}</td>
                    <td>S/ {{ number_format($venta->total_generado, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
