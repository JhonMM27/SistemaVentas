<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\userController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/', function () {
    return view('login.index');
});

Route::middleware(['auth'])->group(function () {
    
    // Agrupar todas las rutas de reportes bajo el prefijo "reportes"
    Route::prefix('reportes')->group(function () {
        Route::get('/', function () {
            return view('reportes.index');
        })->name('reportes.index');

        // Reportes por día y mes
        Route::get('/ventas-diarias', [ReporteController::class, 'ventasDiarias'])->name('reportes.ventas_diarias');
        Route::get('/ventas-diarias/pdf', [ReporteController::class, 'exportarPDF'])->name('reportes.pdf');
        Route::get('/ventas-mensuales/{anio}/{mes}', [ReporteController::class, 'ventasMensuales'])->name('reportes.ventas_mensuales');
        Route::get('/ventas-mensuales/{anio}/{mes}/pdf', [ReporteController::class, 'exportarVentasMensualesPDF'])->name('reportes.ventas_mensuales_pdf');

        // Reportes por productos y categorías
        Route::get('/ventas-producto', [ReporteController::class, 'ventasPorProducto'])->name('reportes.ventas_producto');
        Route::get('/ventas-producto/pdf', [ReporteController::class, 'exportarVentasPorProducto'])->name('reportes.ventas_producto_pdf');

        Route::get('/ventas-categoria', [ReporteController::class, 'ventasPorCategoria'])->name('reportes.ventas_categoria');
        Route::get('/ventas-categoria/pdf', [ReporteController::class, 'exportarVentasPorCategoria'])->name('reportes.ventas_categoria_pdf');

        // Reporte de rendimiento de empleados
        Route::get('/rendimiento-empleados', [ReporteController::class, 'rendimientoEmpleados'])->name('reportes.rendimiento_empleados');
        Route::get('/rendimiento-empleados/pdf', [ReporteController::class, 'exportarRendimientoEmpleados'])->name('reportes.rendimiento_empleados_pdf');

        // Reporte de inventario
        Route::get('/inventario', [ReporteController::class, 'reporteInventario'])->name('reportes.inventario');
        Route::get('/inventario/exportar', [ReporteController::class, 'exportarInventario'])->name('reportes.exportar_inventario');
    });

    Route::get('/ventas/{ventaId}/descargar-boleta', [VentaController::class, 'descargarBoleta'])->name('ventas.descargarBoleta');
Route::get('/ventas/{ventaId}/descargar-factura', [VentaController::class, 'descargarFactura'])->name('ventas.descargarFactura');


    // Otras rutas protegidas
    Route::resource('categorias', CategoriaController::class)->middleware('permission:categoria-activar');
    Route::resource('usuarios', userController::class)->middleware('permission:usuario-activar');
    Route::resource('ventas', VentaController::class)->middleware('permission:venta-crear');
    Route::resource('productos', ProductoController::class);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
});
