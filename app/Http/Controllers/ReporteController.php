<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Reporte;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function ventasDiarias()
    {
        $hoy = Carbon::today('America/Lima');
        // Cargar las ventas con las relaciones necesarias
        $ventas = Venta::whereDate('created_at', $hoy)
            ->with(['detalles.producto', 'usuario', 'comprobante']) // Se incluye 'comprobante'
            ->get();

        $totalVentas = $ventas->count();
        $ingresosTotales = $ventas->sum('total');

        // Guardar el reporte si hay ventas
        if ($totalVentas > 0) {
            $this->guardarReporteVentas('ventas', $totalVentas, $ingresosTotales);
        }

        return view('reportes.ventas_diarias', compact('totalVentas', 'ingresosTotales', 'ventas'));
    }

    public function ventasMensuales($anio, $mes)
    {
        $fechaInicio = Carbon::create($anio, $mes, 1)->startOfMonth();
        $fechaFin = Carbon::create($anio, $mes, 1)->endOfMonth();

        $ventas = Venta::whereBetween('created_at', [$fechaInicio, $fechaFin])->get();
        $totalVentas = $ventas->count();
        $ingresosTotales = $ventas->sum('total');

        return view('reportes.ventas_mensuales', compact('mes', 'anio', 'ventas', 'totalVentas', 'ingresosTotales'));
    }

    private function guardarReporteVentas($tipo, $totalVentas, $ingresosTotales)
    {
        if (Auth::check()) {
            Reporte::create([
                'fecha' => Carbon::today(),
                'total_ventas' => $totalVentas,
                'ingresos_totales' => $ingresosTotales,
                'tipo_reporte' => $tipo,
                'usuario_id' => Auth::id(),
            ]);
        }
    }



    public function exportarPDF()
    {
        $hoy = Carbon::today();
        $ventas = Venta::whereDate('created_at', $hoy)->with(['detalles.producto', 'usuario', 'comprobante'])->get();
        $totalVentas = $ventas->count();
        $ingresosTotales = $ventas->sum('total');

        $pdf = Pdf::loadView('reportes.pdf_ventas_diarias', compact('ventas', 'totalVentas', 'ingresosTotales'))
            ->setPaper('a4', 'landscape'); // Ajustar formato

        return $pdf->download('reporte_pdf_ventas_diarias.pdf');
    }


    public function exportarVentasMensualesPDF($anio, $mes)
    {
        $fechaInicio = Carbon::create($anio, $mes, 1)->startOfMonth();
        $fechaFin = Carbon::create($anio, $mes, 1)->endOfMonth();

        $ventas = Venta::whereBetween('created_at', [$fechaInicio, $fechaFin])->get();
        $totalVentas = $ventas->count();
        $ingresosTotales = $ventas->sum('total');

        $pdf = Pdf::loadView('reportes.pdf_ventas_mensuales', compact('mes', 'anio', 'ventas', 'totalVentas', 'ingresosTotales'));

        return $pdf->download("Reporte_Ventas_Mensuales_{$mes}_{$anio}.pdf");
    }


    //////////////////////////////////////////////////////////////////////////////////////
    //Ventas por producto y categoria

    // Reporte de Ventas por Producto
    public function ventasPorProducto()
    {
        $ventasPorProducto = DB::table('detalles_ventas') // Corrección del nombre de la tabla
            ->join('productos', 'detalles_ventas.productos_id', '=', 'productos.id')
            ->select(
                'productos.nombre',
                DB::raw('SUM(detalles_ventas.cantidad) as cantidad_vendida'),
                DB::raw('SUM(detalles_ventas.subtotal * detalles_ventas.cantidad) as total_generado')
            )
            ->groupBy('productos.nombre')->orderBy('total_generado', 'desc')
            ->get();

        return view('reportes.ventas_por_producto', compact('ventasPorProducto'));
    }

    public function exportarVentasPorProducto()
    {
        $ventasPorProducto = DB::table('detalles_ventas')
            ->join('productos', 'detalles_ventas.productos_id', '=', 'productos.id')
            ->select(
                'productos.nombre',
                DB::raw('SUM(detalles_ventas.cantidad) as cantidad_vendida'),
                DB::raw('SUM(detalles_ventas.subtotal) as total_generado')
            )
            ->groupBy('productos.nombre')->orderBY('total_generado', 'desc')
            ->get();

        $pdf = Pdf::loadView('reportes.pdf_ventas_por_producto', compact('ventasPorProducto'));
        return $pdf->download('reporte_ventas_por_producto.pdf');
    }

    // Reporte de Ventas por Categoría
    public function ventasPorCategoria()
    {
        $ventasPorCategoria = DB::table('detalles_ventas') // Corrige el nombre de la tabla
            ->join('productos', 'detalles_ventas.productos_id', '=', 'productos.id')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->select(
                'categorias.nombre as categoria',
                DB::raw('SUM(detalles_ventas.cantidad) as cantidad_vendida'),
                DB::raw('SUM(detalles_ventas.subtotal) as total_generado') // Usa subtotal en lugar de precio * cantidad
            )
            ->groupBy('categorias.nombre')
            ->orderBy('total_generado', 'desc')
            ->get();

        return view('reportes.ventas_por_categoria', compact('ventasPorCategoria'));
    }

    // Exportar Reporte de Ventas por Categoría a PDF
    public function exportarVentasPorCategoria()
    {
        $ventasPorCategoria = DB::table('detalles_ventas')
            ->join('productos', 'detalles_ventas.productos_id', '=', 'productos.id')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->select(
                'categorias.nombre as categoria',
                DB::raw('SUM(detalles_ventas.cantidad) as cantidad_vendida'),
                DB::raw('SUM(detalles_ventas.subtotal) as total_generado')
            )
            ->groupBy('categorias.nombre')
            ->orderBy('total_generado', 'desc')
            ->get();

        $pdf = Pdf::loadView('reportes.pdf_ventas_por_categoria', compact('ventasPorCategoria'));
        return $pdf->download('reporte_ventas_por_categoria.pdf');
    }
    //Rendiminetos de Empleados
    public function rendimientoEmpleados(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio', now()->startOfMonth()->toDateString());
        $fechaFin = $request->input('fecha_fin', now()->endOfMonth()->toDateString());

        $ventasPorEmpleado = DB::table('ventas')
            ->join('users', 'ventas.user_id', '=', 'users.id') // Cambiado de usuario_id a user_id según la estructura de la tabla
            ->select(
                'users.name as empleado',
                DB::raw('COUNT(ventas.id) as total_ventas'),
                DB::raw('SUM(ventas.total) as ingresos_totales')
            )
            ->whereBetween('ventas.created_at', [$fechaInicio, $fechaFin]) // Cambiado de ventas.fecha a ventas.created_at
            ->groupBy('users.name')
            ->orderBy('ingresos_totales', 'desc')
            ->get();

        return view('reportes.rendimiento_empleado', compact('ventasPorEmpleado', 'fechaInicio', 'fechaFin'));
    }


    public function exportarRendimientoEmpleados(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio', now()->startOfMonth()->toDateString());
        $fechaFin = $request->input('fecha_fin', now()->endOfMonth()->toDateString());

        $ventasPorEmpleado = DB::table('ventas')
            ->join('users', 'ventas.user_id', '=', 'users.id') // Se usa user_id según la tabla
            ->select(
                'users.name as empleado',
                DB::raw('COUNT(ventas.id) as total_ventas'),
                DB::raw('SUM(ventas.total) as ingresos_totales')
            )
            ->whereBetween('ventas.created_at', [$fechaInicio, $fechaFin]) // Se usan las fechas dinámicas
            ->groupBy('users.name')
            ->orderBy('ingresos_totales', 'desc')
            ->get();

        $pdf = Pdf::loadView('reportes.pdf_rendimiento_empleado', compact('ventasPorEmpleado', 'fechaInicio', 'fechaFin'));
        return $pdf->download('reporte_rendimiento_empleados.pdf');
    }


    //Reporte de inventario

    public function reporteInventario()
    {
        $productos = DB::table('productos')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->select(
                'productos.nombre',
                'categorias.nombre as categoria',
                'productos.stock',
            )
            ->orderBy('productos.stock', 'asc') // Ordenamos por menor stock primero
            ->get();

        return view('reportes.inventario', compact('productos'));
    }

    public function exportarInventario()
    {
        $productos = DB::table('productos')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->select(
                'productos.nombre',
                'categorias.nombre as categoria',
                'productos.stock',
            )
            ->orderBy('productos.stock', 'asc')
            ->get();

        $pdf = Pdf::loadView('reportes.pdf_inventario', compact('productos'));
        return $pdf->download('reporte_inventario.pdf');
    }
}
