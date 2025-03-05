<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Inventario</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .bajo-stock { background-color: #ffcccc; }
    </style>
</head>
<body>
    <h2>Reporte de Inventario</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr class="{{ $producto->stock <= 5 ? 'bajo-stock' : '' }}">
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria }}</td>
                <td>{{ $producto->stock }}</td>
                <td>
                    @if($producto->stock <= 5)
                        <strong style="color: red;">Bajo Stock</strong>
                    @else
                        <strong style="color: green;">Disponible</strong>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
