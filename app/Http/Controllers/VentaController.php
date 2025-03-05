<?php

namespace App\Http\Controllers;

use App\Http\Requests\VentaRequest;
use App\Models\Comprobante;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;
use App\Models\Pago;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $texto = $request->get('texto');
        $ventas = Venta::with('detalles.producto')->where('id', 'LIKE', '%' . $texto . '%')->orderBy('id', 'desc')->paginate(10);
        return view('venta.index', compact('ventas'));
    }

    public function create()
    {
        $usuarios = User::all();
        $productos = Producto::all();
        return view('venta.create', compact('productos', 'usuarios'));
    }

    public function store(VentaRequest $request)
    {
        // $request->validate([
        //     'productos'            => 'required|array|min:1',
        //     'productos.*'          => 'exists:productos,id',
        //     'cantidades'           => 'required|array|min:1',
        //     'cantidades.*'         => 'required|integer|min:1',
        //     'metodo_pago'          => 'required|in:efectivo,tarjeta,transferencia',
        //     'tipo_comprobante'     => 'required|in:boleta,factura',
        // ]);
    
        $ventaId = null;
    
        DB::transaction(function () use ($request, &$ventaId) {
            $venta = Venta::create([
                'total'   => 0,
                'user_id' => Auth::user()->id,
                'metodo_pago' => $request->input('metodo_pago'),
            ]);
    
            $totalVenta = 0;
    
            foreach ($request->productos as $index => $producto_id) {
                $producto = Producto::findOrFail($producto_id);
                $cantidad = $request->cantidades[$index];
                $subtotal = $producto->precio * $cantidad;
                $totalVenta += $subtotal;
    
                DetalleVenta::create([
                    'ventas_id'   => $venta->id,
                    'productos_id' => $producto->id,
                    'cantidad'    => $cantidad,
                    'subtotal'    => $subtotal,
                ]);
    
                $producto->decrement('stock', $cantidad);
            }
    
            $venta->update(['total' => $totalVenta]);
    
            Comprobante::create([
                'ventas_id' => $venta->id,
                'tipo' => $request->input('tipo_comprobante'),
                'numero' => Comprobante::generarNumeroComprobante($request->tipo_comprobante),
                'fecha' => now(),
                'total' => $venta->total,
            ]);
    
            $ventaId = $venta->id;
        });
    
        // Devolver una respuesta JSON con la URL de descarga y la URL de redirección
        return response()->json([
            'download_url' => $request->tipo_comprobante === 'boleta'
                ? route('ventas.descargarBoleta', $ventaId)
                : route('ventas.descargarFactura', $ventaId),
            'redirect_url' => route('ventas.index'),
        ]);
    }

    public function show(Venta $venta)
    {
        $venta->load('detalles.producto');
        return view('venta.show', compact('venta'));
    }

    public function edit($id) {}

    public function destroy($id)
    {
        try {
            $venta = Venta::findOrFail($id);
            $venta->delete();

            return redirect()->route('ventas.index')->with('mensaje', 'Venta eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('ventas.index')->with('error', 'Error al eliminar la venta.');
        }
    }

    //Descaragar Comprobantes de Venta

    public function descargarBoleta($ventaId)
    {
        // Obtener la venta con sus relaciones
        $venta = Venta::with(['detalles.producto', 'comprobante', 'usuario'])->findOrFail($ventaId);

        // Verificar que el comprobante sea una boleta
        if ($venta->comprobante->tipo !== 'boleta') {
            return redirect()->back()->with('error', 'El comprobante no es una boleta.');
        }

        // Generar el PDF para la boleta
        $pdf = Pdf::loadView('venta.pdf_boleta', compact('venta'));

        // Descargar el PDF
        return $pdf->download('boleta-' . $venta->comprobante->numero . '.pdf');
    }

    public function descargarFactura($ventaId)
    {
        // Obtener la venta con sus relaciones
        $venta = Venta::with(['detalles.producto', 'comprobante', 'usuario'])->findOrFail($ventaId);

        // Verificar que el comprobante sea una factura
        if ($venta->comprobante->tipo !== 'factura') {
            return redirect()->back()->with('error', 'El comprobante no es una factura.');
        }

        // Generar el PDF para la factura
        $pdf = Pdf::loadView('venta.pdf_factura', compact('venta'));

        // Descargar el PDF
        return $pdf->download('factura-' . $venta->comprobante->numero . '.pdf');
    }
}
