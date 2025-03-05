@extends('layout.app')

@section('contenido')
<div class="container mt-4">
    <h2 class="text-center mb-4">📊 Reporte de Rendimiento de Empleados</h2>

    <!-- Formulario para seleccionar el rango de fechas -->
    <form action="{{ route('reportes.rendimiento_empleados') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="fecha_inicio" class="form-label">Fecha Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $fechaInicio }}">
            </div>
            <div class="col-md-4">
                <label for="fecha_fin" class="form-label">Fecha Fin:</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ $fechaFin }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">🔍 Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla con los datos -->
    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Empleado</th>
                <th>Total Ventas</th>
                <th>Ingresos Totales</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventasPorEmpleado as $empleado)
                <tr>
                    <td>{{ $empleado->empleado }}</td>
                    <td>{{ $empleado->total_ventas }}</td>
                    <td>S/ {{ number_format($empleado->ingresos_totales, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Botones de acción -->
    <div class="text-end mt-3">
        <a href="{{ route('reportes.index') }}" class="btn btn-secondary"> Volver a Reportes</a>
        <a href="{{ route('reportes.rendimiento_empleados_pdf', ['fecha_inicio' => $fechaInicio, 'fecha_fin' => $fechaFin]) }}" class="btn btn-primary">📄 Exportar a PDF</a>
    </div>

</div>
@endsection
