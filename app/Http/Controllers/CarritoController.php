<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $producto = [
            'id' => $request->id,
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad
        ];

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$producto['id']])) {
            $carrito[$producto['id']]['cantidad'] += $producto['cantidad'];
        } else {
            $carrito[$producto['id']] = $producto;
        }

        session()->put('carrito', $carrito);

        return response()->json(['success' => true, 'carrito' => $carrito]);
    }
    public function mostrar()
    {
        $carrito = session()->get('carrito', []);
        return view('venta.carrito', compact('carrito'));
    }
    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return response()->json(['success' => true, 'carrito' => $carrito]);
    }
    public function vaciar()
    {
        session()->forget('carrito');
        return response()->json(['success' => true]);
    }
}
