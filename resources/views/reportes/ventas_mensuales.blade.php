@extends('layout.app')

@section('contenido')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Reporte de Ventas Mensuales ({{ str_pad($mes, 2, '0', STR_PAD_LEFT) }}/{{ $anio }})</h2>
        </div>
        <div class="card-body">
            <div class="row text-center mb-4">
                <div class="col-md-6">
                    <h5><strong>Total de Ventas:</strong> {{ $totalVentas }}</h5>
                </div>
                <div class="col-md-6">
                    <h5><strong>Ingresos Totales:</strong> S/ {{ number_format($ingresosTotales, 2) }}</h5>
                </div>
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
                                <td>{{ $venta->comprobante->metodo_pago ?? 'N/A' }}</td>
                                <td>{{ $venta->usuario->name ?? 'N/A' }}</td>
                                <td class="text-start">
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($venta->detalles as $detalle)
                                            <li>• {{ $detalle->producto->nombre ?? 'Producto eliminado' }} (x{{ $detalle->cantidad }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>S/ {{ number_format($venta->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('reportes.index') }}" class="btn btn-secondary">Volver a Reportes</a>
                <a href="{{ route('reportes.ventas_mensuales_pdf', ['anio' => $anio, 'mes' => $mes]) }}" class="btn btn-primary">
                    <i class="fas fa-file-pdf"></i> Exportar a PDF
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
