@extends('layout.app')

@section('contenido')
<h2>Reporte de Ventas Diarias ({{ now()->format('d/m/Y') }})</h2>

<p>Total de Ventas: {{ $totalVentas }}</p>
<p>Ingresos Totales: {{ number_format($ingresosTotales, 2) }}</p>

<table border="1">
    <thead>
        <tr>
            <th>ID Venta</th>
            <th>Fecha</th>
            {{-- <th>Cliente</th> --}}
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
                {{-- <td>{{ $venta->cliente->nombre ?? 'N/A' }}</td> --}}
                <td>{{ $venta->comprobante->metodo_pago ?? 'N/A' }}</td>
                <td>{{ $venta->usuario->name ?? 'N/A' }}</td>
                <td>
                    <ul>
                        {{-- @dd($detalleVentas)
                        @foreach ($detalleVentas as $detalle)
                            <li>{{ $detalle->producto->nombre }} (x{{ $detalle->cantidad }})</li>
                        @endforeach --}}
                    </ul>
                </td>
                <td>{{ number_format($venta->total, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
