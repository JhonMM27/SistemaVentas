@extends('layout.app')

@section('contenido')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2 class="mb-3 text-center">📊 Reporte de Ventas Diarias ({{ now()->format('d/m/Y') }})</h2>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <p class="fs-5"><strong>Total de Ventas:</strong> {{ $totalVentas }}</p>
            <p class="fs-5"><strong>Ingresos Totales:</strong> ${{ number_format($ingresosTotales, 2) }}</p>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
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
                            <td>{{ $venta->metodo_pago ?? 'Otro Método' }}</td>
                            <td>{{ $venta->usuario->name ?? 'N/A' }}</td>
                            <td class="text-start">
                                <ul class="list-unstyled">
                                    @foreach ($venta->detalles as $detalle)
                                        <li>📦 {{ $detalle->producto->nombre ?? 'Producto eliminado' }} <strong>(x{{ $detalle->cantidad }})</strong></li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="fw-bold">${{ number_format($venta->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end mt-3">
            <a href="{{ route('reportes.index') }}" class="btn btn-secondary">Volver a Reportes</a>
            <a href="{{ route('reportes.pdf') }}" class="btn btn-primary">📄 Exportar a PDF</a>
        </div>
    </div>
</div>
@endsection
