<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    public function ventasDiarias()
    {
        $hoy = Carbon::today();
        $ventas = Venta::whereDate('created_at', $hoy)->get();
        $detalleVentas = Venta::whereDate('created_at', $hoy)->with('detalles')->get();

        $totalVentas = Venta::whereDate('created_at', $hoy)->count();
        $ingresosTotales = Venta::whereDate('created_at', $hoy)->sum('total');

        // Guardar el reporte si hay ventas
        if ($totalVentas > 0) {
            $this->guardarReporteVentas('ventas', $totalVentas, $ingresosTotales);
        }

        return view('reportes.ventas_diarias', compact('totalVentas', 'ingresosTotales','ventas','detalleVentas'));
    }

    public function ventasMensuales(Request $request)
    {
        $mes = $request->input('mes', Carbon::now()->month);
        $anio = $request->input('anio', Carbon::now()->year);

        $totalVentas = Venta::whereYear('created_at', $anio)
            ->whereMonth('created_at', $mes)
            ->count();

        $ingresosTotales = Venta::whereYear('created_at', $anio)
            ->whereMonth('created_at', $mes)
            ->sum('total');

        // Guardar el reporte si hay ventas
        if ($totalVentas > 0) {
            $this->guardarReporteVentas('ventas_mensuales', $totalVentas, $ingresosTotales);
        }

        return view('reportes.ventas_mensuales', compact('totalVentas', 'ingresosTotales', 'mes', 'anio'));
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
}
