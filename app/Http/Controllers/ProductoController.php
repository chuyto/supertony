<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Descuento; // Asegúrate de tener este modelo


class ProductoController extends Controller
{


function getLowStockProducts()
{
    $lowStockThreshold = 10;
    $lowStockProducts = Producto::where('quantity', '<', $lowStockThreshold)->get();
    return $lowStockProducts;
}

    public function index()
    {
        $Productos = Producto::all();
        return view('productos.index', compact('Productos'));
    }

    public function create()
    {
          // Obtener todas las categorías
    $categorias = Categoria::all();
    $descuentos = Descuento::all(); // Obtener todos los descuentos

    // Pasar las categorías a la vista
    return view('productos.create', compact('categorias', 'descuentos'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:100',
            'description' => 'required|string|min:1',
            'category_id' => 'required|exists:categorias,id',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'quantity' => 'required|integer',
            'sku' => 'required|string',
            'image' => 'required|string'
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index');





    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $descuentos = Descuento::all(); // Obtener todos los descuentos

        return view('productos.edit', compact('producto', 'categorias', 'descuentos'));

    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:100',
            'description' => 'required|string|min:1',
            'category_id' => 'required|exists:categorias,id',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'quantity' => 'required|integer',
            'sku' => 'required|string',
            'image' => 'required|string'
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('productos.index');
    }


    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        // Devuelve una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado exitosamente'
        ]);
    }

}
