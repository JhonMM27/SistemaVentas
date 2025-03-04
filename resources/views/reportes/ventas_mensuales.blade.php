@extends('layout.app')

@section('contenido')
    <h2>Reporte de Ventas Mensuales ({{ $mes }}/{{ $anio }})</h2>
    <p>Total de Ventas: {{ $totalVentas }}</p>
    <p>Ingresos Totales: {{ number_format($ingresosTotales, 2) }}</p>

    <form method="GET" action="{{ url('/reportes/ventas-mensuales') }}">
        <label for="mes">Mes:</label>
        <input type="number" name="mes" min="1" max="12" value="{{ $mes }}">
        
        <label for="anio">Año:</label>
        <input type="number" name="anio" min="2000" max="{{ now()->year }}" value="{{ $anio }}">

        <button type="submit">Filtrar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($venta->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
