@extends('layout.app')

@section('contenido')
<div class="container mt-5">
    <!-- Título del Reporte -->
    <div class="text-center mb-4">
        <h2 class="display-4 font-weight-bold text-primary">📦 Reporte de Inventario</h2>
    </div>

    <!-- Tabla de Reporte -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center py-3">Producto</th>
                            <th class="text-center py-3">Categoría</th>
                            <th class="text-center py-3">Stock</th>
                            <th class="text-center py-3">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                        <tr class="align-middle {{ $producto->stock <= 5 ? 'table-danger' : '' }}">
                            <td class="fw-bold">{{ $producto->nombre }}</td>
                            <td class="text-center">{{ $producto->categoria }}</td>
                            <td class="text-center">{{ $producto->stock }}</td>
                            <td class="text-center">
                                @if($producto->stock <= 5)
                                    <span class="badge bg-danger">Bajo Stock</span>
                                @else
                                    <span class="badge bg-success">Disponible</span>
                                @endif
                            </td>
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
        <a href="{{ route('reportes.exportar_inventario') }}" class="btn btn-primary">📄 Exportar a PDF</a>
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

.btn-danger {
    transition: all 0.3s ease;
}

.btn-danger:hover {
    background-color: #dc3545; /* Color rojo más oscuro al pasar el mouse */
    border-color: #dc3545;
}
</style>
@endsection