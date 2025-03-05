<!DOCTYPE html>
<html>
<head>
    <title>Boleta de Venta #{{ $venta->comprobante->numero }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Boleta de Venta #{{ $venta->comprobante->numero }}</h1>
    <p><strong>Fecha:</strong> {{ $venta->comprobante->fecha->format('d/m/Y') }}</p>
    <p><strong>Vendedor:</strong> {{ $venta->usuario->name }}</p>

    <h2>Detalles de la Venta</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                {{-- <th>Precio Unitario</th> --}}
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->detalles as $detalle)
            <tr>
                <td>{{ $detalle->producto->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
                {{-- <td>{{ $detalle->precio_unitario }}</td> --}}
                <td>{{ $detalle->subtotal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total General:</strong> {{ $venta->comprobante->total }}</p>
</body>
</html>
@php
    redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
@endphp