@extends('layout.app')

@section('contenido')
<div class="container my-5">
    <h2 class="text-center my-4 fw-bold display-4 animate__animated animate__fadeIn">📊 Reportes</h2>

    <div class="row g-4">
        <!-- Reporte de Ventas Diarias -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow rounded-4 border-0 p-4 text-center animate__animated animate__fadeInUp">
                <div class="card-body d-flex flex-column align-items-center">
                    <h4 class="card-title fw-bold mb-3">📅 Ventas Diarias</h4>
                    <a href="{{ route('reportes.ventas_diarias') }}" class="btn btn-primary btn-lg w-75">Generar Reporte</a>
                </div>
            </div>
        </div>

        <!-- Reporte de Ventas Mensuales -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow rounded-4 border-0 p-4 text-center animate__animated animate__fadeInUp animate__delay-1s">
                <div class="card-body d-flex flex-column align-items-center">
                    <h4 class="card-title fw-bold mb-3">📆 Ventas Mensuales</h4>
                    <form action="" method="GET" id="formVentasMensuales" class="w-100 d-flex flex-column align-items-center">
                        <input type="month" id="fecha" class="form-control w-75 mb-3" required>
                        <button type="submit" class="btn btn-primary btn-lg w-75">Generar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Reporte de Ventas Por Productos -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow rounded-4 border-0 p-4 text-center animate__animated animate__fadeInUp animate__delay-2s">
                <div class="card-body d-flex flex-column align-items-center">
                    <h4 class="card-title fw-bold mb-3">📦 Ventas Por Productos</h4>
                    <a href="{{ route('reportes.ventas_producto') }}" class="btn btn-primary btn-lg w-75">Generar Reporte</a>
                </div>
            </div>
        </div>

        <!-- Reporte de Ventas Por Categoría -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow rounded-4 border-0 p-4 text-center animate__animated animate__fadeInUp animate__delay-3s">
                <div class="card-body d-flex flex-column align-items-center">
                    <h4 class="card-title fw-bold mb-3">📂 Ventas Por Categoría</h4>
                    <a href="{{ route('reportes.ventas_categoria') }}" class="btn btn-primary btn-lg w-75">Generar Reporte</a>
                </div>
            </div>
        </div>

        <!-- Reporte de Rendimiento de Empleados -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow rounded-4 border-0 p-4 text-center animate__animated animate__fadeInUp animate__delay-4s">
                <div class="card-body d-flex flex-column align-items-center">
                    <h4 class="card-title fw-bold mb-3">👨‍💼 Rendimiento de Empleados</h4>
                    <a href="{{ route('reportes.rendimiento_empleados') }}" class="btn btn-primary btn-lg w-75">Generar Reporte</a>
                </div>
            </div>
        </div>

        <!-- Reporte de Inventario -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow rounded-4 border-0 p-4 text-center animate__animated animate__fadeInUp animate__delay-5s">
                <div class="card-body d-flex flex-column align-items-center">
                    <h4 class="card-title fw-bold mb-3">📋 Inventario</h4>
                    <a href="{{ route('reportes.inventario') }}" class="btn btn-primary btn-lg w-75">Generar Reporte</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('formVentasMensuales').addEventListener('submit', function(e) {
        e.preventDefault();
        let fecha = document.getElementById('fecha').value;
        if (fecha) {
            let [anio, mes] = fecha.split('-'); 
            window.location.href = "{{ url('/reportes/ventas-mensuales') }}/" + anio + "/" + mes;
        }
    });
</script>
@endsection