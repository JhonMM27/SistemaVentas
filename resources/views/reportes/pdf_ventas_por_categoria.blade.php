<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas por Categoría</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
        }
        .titulo {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="titulo">Reporte de Ventas por Categoría</div>

    <table>
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Cantidad Vendida</th>
                <th>Total Generado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventasPorCategoria as $categoria)
            <tr>
                <td>{{ $categoria->categoria }}</td>
                <td>{{ $categoria->cantidad_vendida }}</td>
                <td>S/ {{ number_format($categoria->total_generado, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
