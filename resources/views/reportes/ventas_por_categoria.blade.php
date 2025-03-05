@extends('layout.app')

@section('contenido')

<div class="container mt-5">
    <!-- Título del Reporte -->
    <div class="text-center mb-4">
        <h2 class="display-4 font-weight-bold text-primary">📊 Reporte de Ventas por Categoría</h2>
    </div>

    <!-- Tabla de Reporte -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center py-3">Categoría</th>
                            <th class="text-center py-3">Cantidad Vendida</th>
                            <th class="text-center py-3">Total Generado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventasPorCategoria as $categoria)
                        <tr class="align-middle">
                            <td class="fw-bold text-primary">{{ $categoria->categoria }}</td>
                            <td class="text-center">{{ $categoria->cantidad_vendida }}</td>
                            <td class="text-center text-success fw-bold">S/ {{ number_format($categoria->total_generado, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Botones de Acción -->
    <div class="text-end mt-3">
        <a href="{{ route('reportes.index') }}" class="btn btn-secondary">Volver a Reportes</a>
        <a href="{{ route('reportes.ventas_categoria_pdf') }}" class="btn btn-primary">📄 Exportar a PDF</a>
    </div>
</div>

<style>
    /* Estilos personalizados para la tabla */
.table-hover tbody tr:hover {
    background-color: #f8f9fa; /* Fondo gris claro al pasar el mouse */
}

/* Estilos para los botones */
.btn-outline-secondary {
    transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
    background-color: #6c757d; /* Fondo gris al pasar el mouse */
    color: #fff; /* Texto blanco */
}

.btn-primary {
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3; /* Color azul más oscuro al pasar el mouse */
    border-color: #0056b3;
}
</style>

@endsection