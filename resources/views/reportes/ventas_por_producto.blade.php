@extends('layout.app')
@section('contenido')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4>📊 Reporte de Ventas por Producto</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad Vendida</th>
                        <th>Total Generado</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($ventasPorProducto as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->cantidad_vendida }}</td>
                        <td><strong>S/ {{ number_format($producto->total_generado, 2) }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end mt-3">
                <a href="{{ route('reportes.index') }}" class="btn btn-secondary">Volver a Reportes</a>
                <a href="{{ route('reportes.pdf') }}" class="btn btn-primary">📄 Exportar a PDF</a>
            </div>
        </div>
    </div>
</div>

@endsection
