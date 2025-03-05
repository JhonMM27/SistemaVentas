<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = $request->get('texto');

        $categorias = Categoria::select('id','nombre')->get();
        $registros = Producto::with('categoria')->where('nombre','LIKE','%'.$texto.'%')->orWhere('id','LIKE','%'.$texto.'%')->orderBy('id','desc')->paginate(10);
        return view('producto.index',compact(['registros','texto','categorias']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        $registro = new Producto();
        $registro->nombre = $request->input('nombre');
        $registro->categoria_id = $request->input('categoria_id');
        $registro->codigo = $request->input('codigo');
        $registro->precio = $request->input('precio');
        $registro->stock = $request->input('stock');

        $registro->save();

        return redirect()->route('productos.index')->with('mensaje','Nuevo Producto '.$registro->nombre.' agerado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, $id)
    {
    

    $registro = Producto::findOrFail($id);

    $registro->update($request->only(['nombre', 'codigo', 'stock', 'precio', 'categoria_id']));



        return redirect()->route('productos.index')->with('mensaje','El Producto [ '.$registro->nombre.' ] Se Actualizo con Exito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $registro = Producto::findOrFail($id);
            $registro->delete();
            return redirect()->route('productos.index')->with('mensaje','Producto '.$registro->nombre.' eliminado con exito');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('productos.index')->with('error','Error al eliminar el Producto porque esta siendo usado');
        }
    }
}
