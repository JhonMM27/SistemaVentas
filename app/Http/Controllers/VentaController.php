<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;
use App\Models\Pago;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $texto = $request->get('texto');
        $ventas = Venta::with('detalles.producto')->where('id','LIKE','%'.$texto.'%')->orderBy('created_at', 'desc')->paginate(10);
        return view('venta.index', compact('ventas'));
    }

    public function create()
    {
        $usuarios = User::all();
        $productos = Producto::all();
        return view('venta.create', compact('productos', 'usuarios'));
    }

    public function store(Request $request)
{
    $request->validate([
        'productos'            => 'required|array|min:1',
        'productos.*'          => 'exists:productos,id',
        'cantidades'           => 'required|array|min:1',
        'cantidades.*'         => 'required|integer|min:1',
        'metodo_pago'          => 'required|in:efectivo,tarjeta,transferencia',
    ]);

    DB::transaction(function () use ($request) {
        $venta = Venta::create([
            'total'   => 0, // Se calculará después
            'user_id' => Auth::user()->id,
            'metodo_pago' => $request->input('metodo_pago'), // Ahora tomará 'efectivo', 'tarjeta' o 'transferencia'
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
            'tipo' => $request->input('tipo_comprobante'), // Ahora toma 'boleta' o 'factura'
            'numero' => Comprobante::generarNumeroComprobante($request->tipo_comprobante), 
            'fecha' => now(),
            'total' => $venta->total,
        ]);
    });

    return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
}

    public function show(Venta $venta)
    {
        $venta->load('detalles.producto');
        return view('venta.show', compact('venta'));
    }

    public function edit($id)
    {
        
    }

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
}
